<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AdminCotroller extends Controller
{
    /** @var string  */
    const ROUTE_ADMIN               = 'admin.admin';

    /** @var string  */
    const ROUTE_USER_ROLE_UPDATE    = 'admin.userRoleUpdate';

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function admin(Request $request)
    {
        $iCount = (new User())
            ->when($request->get('role'), function (Builder $query) use ($request) {
                return $query->where('role', (string) $request->get('role'));
            })
            ->get()
            ->count();

        $iPage = $_REQUEST['page'] ?? 1;

        if (($iPage - 1) * self::TABLE_ROWS_LIMIT> $iCount) {
            $iPage = 1;
        }

        return view(
            'admin.admin',
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
     * Карточка пользователя и возможность изменить роль
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function userRoleUpdate(int $id)
    {
        return view(
            'admin.userRoleUpdate',
            [
                'user'  => (new User)->find($id)
            ]
        );
    }

}
