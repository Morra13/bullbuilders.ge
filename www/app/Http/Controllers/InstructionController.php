<?php
namespace App\Http\Controllers;

use App\Models\Instruction;
use App\Services\PDF;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class InstructionController
 * @package App\Http\Controllers
 */
class InstructionController extends Controller
{
    /** @var string  */
    const ROUTE_CREATE     = 'instruction.create';

    /** @var string  */
    const ROUTE_LIST       = 'instruction.list';

    /** @var string  */
    const ROUTE_ADMIN_LIST = 'instruction.admin.list';

    /** @var string  */
    const ROUTE_EDIT       = 'instruction.edit';

    /** @var string  */
    const ROUTE_PDF        = 'instruction.pdf';

    /** @var string  */
    const ROUTE_DOWNLOAD   = 'instruction.download';

    /** @var string  */
    const ROUTE_PAYMENT    = 'instruction.payment';

    /**
     * Create page
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('instruction.create');
    }

    /**
     * Get list
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function list()
    {
        $iCount = (new Instruction())
            ->where('user_id', auth()->user()->getAuthIdentifier())
            ->get()
            ->count();

        $iPage = $_REQUEST['page'] ?? 1;

        if (($iPage - 1) * self::TABLE_ROWS_LIMIT > $iCount) {
            $iPage = 1;
        }

        $arInstructionList = (new Instruction)
            ->skip(($iPage - 1) * self::TABLE_ROWS_LIMIT)
            ->take(self::TABLE_ROWS_LIMIT)
            ->where('user_id', auth()->user()->getAuthIdentifier())
            ->orderByDesc('created_at')
            ->get();

        return view(
            'instruction.list',
            [
                'arInstruction' => $arInstructionList,
                'pagination'    => [
                    'total'       => $iCount,
                    'limit'       => self::TABLE_ROWS_LIMIT,
                    'page_count'  => ceil($iCount / self::TABLE_ROWS_LIMIT),
                    'page'        => $iPage,
                ]
            ]
        );
    }

    /**
     * Get admin list
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function adminList(Request $request)
    {
        $iCount = (new Instruction())
            ->when($request->get('user_id'), function (Builder $query) use ($request) {
                return $query->where('user_id', (int) $request->get('user_id'));
            })
            ->when($request->get('status'), function (Builder $query) use ($request) {
                return $query->where('status', (string) $request->get('status'));
            })
            ->get()
            ->count()
        ;

        $iPage = $_REQUEST['page'] ?? 1;

        if (($iPage - 1) * self::TABLE_ROWS_LIMIT > $iCount) {
            $iPage = 1;
        }

        $arInstructionList = (new Instruction)
            ->when($request->get('user_id'), function (Builder $query) use ($request) {
                return $query->where('user_id', (int) $request->get('user_id'));
            })
            ->when($request->get('status'), function (Builder $query) use ($request) {
                return $query->where('status', (string) $request->get('status'));
            })
            ->skip(($iPage - 1) * self::TABLE_ROWS_LIMIT)
            ->take(self::TABLE_ROWS_LIMIT)
            ->orderByDesc('id')
            ->get()
            ->all();

        return view(
            'instruction.admin.list',
            [
                'arInstructionList' => $arInstructionList,
                'pagination'    => [
                    'total'       => $iCount,
                    'limit'       => self::TABLE_ROWS_LIMIT,
                    'page_count'  => ceil($iCount / self::TABLE_ROWS_LIMIT),
                    'page'        => $iPage,
                ],
                'authors'      => (new Instruction())->distinct('user_id')->count(),
                'instructions' => (new Instruction())->count(),
                'forSale'      => (new Instruction())->where('status', Instruction::STATUS_SALE)->count(),
            ]
        );
    }

    /**
     * Get edit page
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(int $id)
    {
        $obInstruction = (new Instruction())
            ->when(!Auth::user()->isAdmin(), function (Builder $query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->where('id', $id)
            ->first()
        ;

        return view(
            'instruction.edit',
            [
                'instruction' => $obInstruction
            ]
        );
    }

    /**
     * Get PDF page
     * @param int $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function pdf(int $id, Request $request)
    {
        $obInstruction = Instruction::where('id', $id)->first();

        if (!$obInstruction) {
            abort(404);
        }

        try {
            PDF::checkLink(
                $request->get('id', 0),
                $request->get('t', 0),
                $request->get('p', '')
            );
        } catch (\Throwable $exception) {
            abort(404, $exception->getMessage());
        }

        return view(
            'instruction.pdf',
            [
                'instruction' => $obInstruction,
                'user'        => $obInstruction->User
            ]
        );
    }

    /**
     * Download PDF
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function download(int $id)
    {
        $obInstruction = (new Instruction())
            ->when(!Auth::user()->isAdmin(), function (Builder $query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->where('id', $id)
            ->first()
        ;

        if (!$obInstruction) {
            abort(404);
        }

        return view(
            'instruction.download',
            [
                'link' => PDF::getPdfLink($id),
            ]
        );
    }


    /**
     * Instruction payment page
     * @param string $nick
     * @param string $post
     * @return mixed
     */
    public function payment(string $nick, string $post)
    {
        /** @var User $obUser */
        $obUser = (new User())->where('nick_name', $nick)->first();

        if (!$obUser) {
            abort(404);
        }

        /** @var Instruction $obInstruction */
        $obInstruction = (new Instruction())
            ->where('user_id', $obUser->id)
            ->where('id', (int) $post)
            ->where('status', Instruction::STATUS_SALE)
            ->first();

        if (!$obInstruction) {
            abort(404);
        }

        return view(
            'instruction.payment',
            [
                'title'       => $obInstruction->name . ' by ' . $obUser->name,
                'user'        => $obUser,
                'instruction' => $obInstruction
            ]
        );
    }
}
