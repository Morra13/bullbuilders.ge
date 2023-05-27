<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Reviews;
use App\Models\Reviews_en;
use App\Models\Reviews_ge;
use App\Models\Reviews_ru;
use App\Models\Staff;
use App\Models\Staff_en;
use App\Models\Staff_ge;
use App\Models\Staff_ru;

class AdminCotroller extends Controller
{
    /** @var string  */
    const ROUTE_ADMIN               = 'admin.admin';

    /** @var string  */
    const ROUTE_USER_ROLE_UPDATE    = 'admin.userRoleUpdate';

    /** @var string  */
    const ROUTE_CREATE_STAFF        = 'admin.createStaff';

    /** @var string  */
    const ROUTE_STAFF               = 'admin.staff';

    /** @var string  */
    const ROUTE_STAFF_UPDATE        = 'admin.staffUpdate';

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

    /**
     * Создать сотрудника
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createStaff()
    {
        return view('admin.createStaff');
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function staff()
    {
        $arStaff = [];

        $obStaff = new Staff_ge();

        if (session()->get('lang') == 'ru') {
            $obStaff = new Staff_ru();
        } elseif (session()->get('lang') == 'en') {
            $obStaff = new Staff_en();
        }

        $iCount = (new Staff())
            ->get()
            ->count();

        $iPage = $_REQUEST['page'] ?? 1;

        if (($iPage - 1) * self::TABLE_ROWS_LIMIT > $iCount) {
            $iPage = 1;
        }

        $arStaffMain = (new Staff())
            ->skip(($iPage - 1) * self::TABLE_ROWS_LIMIT)
            ->take(self::TABLE_ROWS_LIMIT)
            ->orderByDesc('created_at')
            ->get();

        foreach ($arStaffMain as $key => $staff) {
            $arInfoStaff = $obStaff::all()->where('staff_id', $staff->id)->first();

            $arStaff [$key] = [
                'id'            => $staff->id,
                'photo'         => $staff->photo,
                'name'          => $arInfoStaff['name'],
                'surname'       => $arInfoStaff['surname'],
                'position'      => $arInfoStaff['position'],
                'comment'       => $arInfoStaff['comment'],
            ];
        }

        return view(
            'admin.staff',
            [
                'arStaff'       => $arStaff,
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
     * Карточка пользователя и возможность изменить роль
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function staffUpdate(int $id)
    {
        $arStaff = [];

        $obStaffGe = new Staff_ge();
        $obStaffRu = new Staff_ru();
        $obStaffEn = new Staff_en();

        $arStaffMain = Staff::all()->where('id', $id)->first();
            $arInfoStaffGe = $obStaffGe::all()->where('staff_id', $arStaffMain->id)->first();
            $arInfoStaffRu = $obStaffRu::all()->where('staff_id', $arStaffMain->id)->first();
            $arInfoStaffEn = $obStaffEn::all()->where('staff_id', $arStaffMain->id)->first();

            $arStaff = [
                'ge'    => [
                    'id'        => $arStaffMain->id,
                    'photo'     => $arStaffMain->photo,
                    'name'      => $arInfoStaffGe['name'],
                    'surname'   => $arInfoStaffGe['surname'],
                    'position'  => $arInfoStaffGe['position'],
                    'comment'   => $arInfoStaffGe['comment'],
                ],
                'ru'    => [
                    'name'      => $arInfoStaffRu['name'],
                    'surname'   => $arInfoStaffRu['surname'],
                    'position'  => $arInfoStaffRu['position'],
                    'comment'   => $arInfoStaffRu['comment'],
                ],
                'en'    => [
                    'name'      => $arInfoStaffEn['name'],
                    'surname'   => $arInfoStaffEn['surname'],
                    'position'  => $arInfoStaffEn['position'],
                    'comment'   => $arInfoStaffEn['comment'],
                ],
            ];

        return view(
            'admin.staffUpdate',
            [
                'arStaff'  => $arStaff,
            ]
        );
    }

}
