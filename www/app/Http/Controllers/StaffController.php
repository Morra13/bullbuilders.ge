<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Staff_en;
use App\Models\Staff_ge;
use App\Models\Staff_ru;

class StaffController extends Controller
{
    /** @var string  */
    const ROUTE_CREATE_STAFF        = 'admin.staff.createStaff';

    /** @var string  */
    const ROUTE_STAFF               = 'admin.staff.staff';

    /** @var string  */
    const ROUTE_STAFF_UPDATE        = 'admin.staff.staffUpdate';

    /**
     * Создать сотрудника
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createStaff()
    {
        return view('admin/staff.createStaff');
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
            'admin/staff.staff',
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
            'admin/staff.staffUpdate',
            [
                'arStaff'  => $arStaff,
            ]
        );
    }

}
