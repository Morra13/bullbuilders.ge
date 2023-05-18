<?php
namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Instruction;
use App\Models\Settings;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\SuccessPayed;
use App\Services\PDF;
use App\Services\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

/**
 * Class TransactionController
 * @package App\Http\Controllers\Api
 */
class TransactionController extends Controller
{
    /** @var string  */
    const ROUTE_CREATE   = 'api.transaction.create';

    /** @var string  */
    const ROUTE_ERROR    = 'api.transaction.error';

    /** @var string  */
    const ROUTE_SUCCESS  = 'api.transaction.success';

    /** @var string  */
    const ROUTE_WITHDRAW = 'api.transaction.withdraw';

    /**
     * Create transaction
     * @param Request $request
     * @return string[]
     */
    public static function create(Request $request)
    {
        $arResult = [
            'result' => 'success',
            'message' => '',
        ];

        try {
            $sTransactionId = bin2hex(openssl_random_pseudo_bytes(16));
            $sEmail         = trim($request->get('email'));
            $iInstructionId = (int) $request->get('instruction_id');

            if (!filter_var($sEmail, FILTER_VALIDATE_EMAIL)) {
                throw new \Exception('Enter correct email address');
            }

            if (!$sTransactionId || !$sEmail || !$iInstructionId) {
                throw new \Exception('Empty data');
            }

            $obInstruction = (new Instruction)->where('id', $iInstructionId)->first();
            if (!$obInstruction) {
                throw new \Exception('Instruction not found');
            }

            $obUser = (new User)->where('email', $sEmail)->first();
            if (!$obUser) {
                $obUser = new User();
                $obUser->name      = '';
                $obUser->nick_name = str_replace(['@', '.', '-'], '_', $sEmail);
                $obUser->email     = $sEmail;
                $obUser->password  = '';
                $obUser->role      = 'subscriber';
                $obUser->save();
            }

            $obTransaction = new Transaction();
            $obTransaction->transaction_id = $sTransactionId;
            $obTransaction->instruction_id = $iInstructionId;
            $obTransaction->user_id        = $obUser->id;
            $obTransaction->author_id      = $obInstruction->User->id;
            $obTransaction->price          = (float) $obInstruction->price;
            $obTransaction->commission     = floatval( $obInstruction->price * Settings::getCommission() / 100);
            $obTransaction->status         = Transaction::STATUS_NEW;
            $obTransaction->type           = Transaction::TYPE_DEBIT;
            $obTransaction->save();

            $arResult['transaction_id'] = $sTransactionId;
        } catch (\Throwable $exception) {
            $arResult['result'] = 'error';
            $arResult['message'] = $exception->getMessage();
        }

        return $arResult;
    }

    /**
     * Error transaction
     * @param Request $request
     * @return string[]
     */
    public static function error(Request $request)
    {
        $arResult = [
            'result'  => 'success',
            'message' => '',
        ];

        try {
            $sTransactionId = $request->get('transaction_id', '');

            $obTransaction = (new Transaction())
                ->where('transaction_id', $sTransactionId)
                ->first()
            ;

            if (!$obTransaction) {
                throw new \Exception('Transaction not found: ' . $sTransactionId);
            }

            $obTransaction->status = Transaction::STATUS_ERROR;
            $obTransaction->payment_data = json_encode($request->get('payment_data'));
            $obTransaction->save();

        } catch (\Throwable $exception) {
            $arResult['result'] = 'error';
            $arResult['message'] = $exception->getMessage();
        }

        return $arResult;
    }

    /**
     * Success transaction, send PDF
     * @param Request $request
     * @return string[]
     */
    public static function success(Request $request)
    {
        $arResult = [
            'result'  => 'success',
            'message' => '',
        ];

        try {
            $obTransaction = (new Transaction())
                ->where('transaction_id', $request->get('transaction_id', ''))
                ->first()
            ;

            if (!$obTransaction) {
                throw new \Exception('Transaction not found: ' . $request->get('transaction_id'));
            }

            $obTransaction->status = Transaction::STATUS_PAYED;
            $obTransaction->payment_data = json_encode($request->get('payment_data'));
            $obTransaction->save();

            $sFileName = time() . '.pdf';

            Storage::put(
                'pdf/' . $sFileName,
                file_get_contents(
                    PDF::getPdfLink($obTransaction->Instruction->id)
                )
            );

            $obTransaction->User->notify(
                new SuccessPayed(
                    $obTransaction->User,
                    $obTransaction->Instruction,
                    $sFileName
                )
            );

            unlink('/var/www/storage/app/pdf/' . $sFileName);

            $obTransaction->status = Transaction::STATUS_PDF_SENT;
            $obTransaction->save();

        } catch (\Throwable $exception) {
            $arResult['result'] = 'error';
            $arResult['message'] = $exception->getMessage();
        }

        return $arResult;
    }

    /**
     * Withdraw transaction
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function withdraw(Request $request)
    {
        try {
            $iUserId = (int) $request->get('user-id', 0);
            $fAmount = str_replace(',', '.', $request->get('user-amount', 0));
            $fAmount = (float) str_replace(' ', '', $fAmount);

            if (empty($iUserId)) {
                throw new \Exception('User id not found');
            }

            if (empty($fAmount)) {
                throw new \Exception('Amount is empty');
            }

            $obUser = (new User())->where('id', $iUserId)->first();

            if (!$obUser) {
                throw new \Exception('User not found');
            }

            if ($obUser->balance < $fAmount) {
                throw new \Exception('The transfer amount is greater than the balance');
            }

            $obTransaction = new Transaction();
            $obTransaction->transaction_id = bin2hex(openssl_random_pseudo_bytes(16));
            $obTransaction->user_id        = Auth::user()->id;
            $obTransaction->author_id      = $obUser->id;
            $obTransaction->price          = (float) $fAmount;
            $obTransaction->status         = Transaction::STATUS_SUCCESS;
            $obTransaction->type           = Transaction::TYPE_CREDIT;
            $obTransaction->save();

            $arParams['success'] = 'Success!';

        } catch (\Throwable $exception) {
            $arParams['error'] = $exception->getMessage();
        }

        return redirect()->route('user.admin.list', $arParams);
    }
}
