<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\Staff_en;
use App\Models\Staff_ge;
use App\Models\Staff_ru;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /** @var string  */
    const ROUTE_CREATE_STAFF = 'api.admin.createStaff';

    /**
     * Добавление нового сотрудника
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createStaff(Request $request)
    {
        $obStaff = new Staff();
        $obStaffGe = new Staff_ge();
        $obStaffRu = new Staff_ru();
        $obStaffEn = new Staff_en();

        if (!empty($request->file())){
            $fileName = time().'_'.$request->file('main_img')->getClientOriginalName();
            $filePath = $request->file('main_img')->storeAs('/uploads', $fileName , 'public');
            $obStaff->photo = $filePath;
            $obStaff->save();
            $iStaffId = $obStaff->id;
        }

        if (!empty($iStaffId)) {
            $obStaffGe->staff_id    = $iStaffId;
            $obStaffGe->name        = $request->get('name_ge');
            $obStaffGe->surname     = $request->get('surname_ge');
            $obStaffGe->position    = $request->get('position_ge');
            $obStaffGe->comment     = $request->get('comment_ge');
            $obStaffGe->save();

            $obStaffRu->staff_id    = $iStaffId;
            $obStaffRu->name        = $request->get('name_ru');
            $obStaffRu->surname     = $request->get('surname_ru');
            $obStaffRu->position    = $request->get('position_ru');
            $obStaffRu->comment     = $request->get('comment_ru');
            $obStaffRu->save();

            $obStaffEn->staff_id    = $iStaffId;
            $obStaffEn->name        = $request->get('name_en');
            $obStaffEn->surname     = $request->get('surname_en');
            $obStaffEn->position    = $request->get('position_en');
            $obStaffEn->comment     = $request->get('comment_en');
            $obStaffEn->save();
        }

        return redirect()->route(\App\Http\Controllers\AdminCotroller::ROUTE_CREATE_STAFF);
    }

}
