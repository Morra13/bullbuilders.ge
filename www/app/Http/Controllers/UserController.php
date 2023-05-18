<?php

namespace App\Http\Controllers;

use App\Models\Instruction;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /** @var string  */
    const ROUTE_EDIT       = 'user.edit';

    /** @var string  */
    const ROUTE_PASSWORD   = 'user.password';

    /** @var string  */
    const ROUTE_ADMIN_LIST = 'user.admin.list';

    /** @var string  */
    const ROUTE_ADMIN_USER = 'user.admin.user';

    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit()
    {
        return view('user.edit');
    }

    /**
     * Page change password
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function password()
    {
        return view('user.password');
    }

    /**
     * Display a listing of the users
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function adminList(Request $request)
    {
        $iCount = (new User())
            ->when($request->get('role'), function (Builder $query) use ($request) {
                return $query->where('role', (string) $request->get('role'));
            })
            ->get()
            ->count();
        $iAuthors = (new Instruction())
            ->select(['user_id'])
            ->groupBy('user_id')
            ->get()
            ->count();

        $iPage = $_REQUEST['page'] ?? 1;

        if (($iPage - 1) * self::TABLE_ROWS_LIMIT> $iCount) {
            $iPage = 1;
        }

        return view(
            'user.admin.list',
            [
                'users'         => (new User)
                    ->when($request->get('role'), function (Builder $query) use ($request) {
                        return $query->where('role', (string) $request->get('role'));
                    })
                    ->skip(($iPage - 1) * self::TABLE_ROWS_LIMIT)
                    ->take(self::TABLE_ROWS_LIMIT)
                    ->get()
                    ->all(),
                'error'         => $request->get('error', null),
                'success'       => $request->get('success', null),
                'total'         => $iCount,
                'total_authors' => $iAuthors,
                'last_week'     => (new User())
                    ->where('created_at', '>=', date('Y-m-d H:i:s', strtotime('-1 week')))
                    ->get()
                    ->count(),
                'last_month'    => (new User())
                    ->where('created_at', '>=', date('Y-m-d H:i:s', strtotime('-1 month')))
                    ->get()
                    ->count(),
                'pagination'    => [
                    'total'       => (new User())
                        ->get()
                        ->count(),
                    'limit'       => self::TABLE_ROWS_LIMIT,
                    'page_count'  => ceil($iCount / self::TABLE_ROWS_LIMIT),
                    'page'        => $iPage,
                ]
            ]
        );
    }

    /**
     * Display a listing of the users
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function adminUser(int $id)
    {
        return view(
            'user.admin.user',
            [
                'user'  => (new User)->find($id)
            ]
        );
    }
}
