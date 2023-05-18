<?php
namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

/**
 * Class ValidationController
 * @package App\Http\Controllers\Api
 */
class ValidationController extends Controller
{
    /** @var string  */
    const ROUTE_NICK               = 'api.validation.nick';

    /** @var string  */
    const ROUTE_USER_NICK          = 'api.user.validation.nick';

    /** @var string  */
    const ROUTE_EMAIL_CORRECT      = 'api.validation.email.correct';

    /** @var string  */
    const ROUTE_EMAIL_EXISTS       = 'api.validation.email.exists';

    /** @var string  */
    const ROUTE_USER_EMAIL_EXISTS  = 'api.user.validation.email.exists';

    /** @var string  */
    const ROUTE_PASSWORD           = 'api.validation.password';

    /**
     * Check nick name exists
     *
     * @param Request $request
     * @return string[]
     */
    public static function nick(Request $request)
    {
        $sNickName = (string) $request->get('nickname');

        $arResult = [
            'result' => 'success',
            'message' => '',
        ];

        try {
            $sReplaced = preg_replace('/([^a-z0-9_]+)/ui', '', $sNickName);
            if ($sReplaced != $sNickName) {
                throw new \Exception('Only letters of the Latin alphabet, numbers and _');
            }

            if (mb_strlen($sNickName) <= 3) {
                throw new \Exception('The minimum number of characters is 3');
            }

            $obUser = (new User())
                ->where('nick_name', $sNickName)
                ->when(Auth::check(), function (Builder $query) {
                    $query->whereNotIn('id', [Auth::user()->id]);
                })
                ->first();
            if ($obUser) {
                throw new \Exception('The chosen nickname is already occupied, try another one');
            }

        } catch (\Throwable $exception) {
            $arResult['result'] = 'error';
            $arResult['message'] = $exception->getMessage();
        }

        return $arResult;
    }

    /**
     * Check email exists
     *
     * @param Request $request
     * @return string[]
     */
    public static function emailExist(Request $request)
    {
        $email = (string) $request->get('email');

        $arResult = [
            'result' => 'success',
            'message' => '',
        ];

        try {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new \Exception('Enter correct email address');
            }

            $obUser = (new User())
                ->where('email', $email)
                ->when(Auth::check(), function (Builder $query) {
                    $query->whereNotIn('id', [Auth::user()->id]);
                })
                ->first();
            if ($obUser) {
                throw new \Exception('The specified email is already registered, if you forgot your password, try to restore it using the password recovery form');
            }

        } catch (\Throwable $exception) {
            $arResult['result'] = 'error';
            $arResult['message'] = $exception->getMessage();
        }

        return $arResult;
    }

    /**
     * Check email correct
     *
     * @param Request $request
     * @return string[]
     */
    public static function emailCorrect(Request $request)
    {
        $email = (string) $request->get('email');

        $arResult = [
            'result' => 'success',
            'message' => '',
        ];

        try {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new \Exception('Enter correct email address');
            }

        } catch (\Throwable $exception) {
            $arResult['result'] = 'error';
            $arResult['message'] = $exception->getMessage();
        }

        return $arResult;
    }

    /**
     * Check password correct
     * @param Request $request
     * @return string[]
     */
    public static function password(Request $request)
    {
        $arResult = [
            'result' => 'success',
            'message' => '',
        ];

        try {
            $password = (string) $request->get('password');
            $passwordConfirmation = (string) $request->get('password_confirmation');
            $type = (string) $request->get('type', 'password_confirmation');

            if (mb_strlen($password) < 8) {
                throw new \Exception('The minimum password length is 8 characters');
            }

            if ($type == 'password_confirmation' || !empty($passwordConfirmation)) {
                if ($password != $passwordConfirmation) {
                    throw new \Exception('The entered passwords do not match');
                }
            }

        } catch (\Throwable $exception) {
            $arResult['result'] = 'error';
            $arResult['message'] = $exception->getMessage();
        }

        return $arResult;
    }
}
