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
    const ROUTE_CREATE_STAFF        = 'api.admin.createStaff';

    /** @var string  */
    const ROUTE_STAFF_UPDATE        = 'api.admin.staffUpdate';

    /** @var string  */
    const ROUTE_STAFF_DELETE        = 'api.admin.staffDelete';

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

    /**
     * Обновление сотрудника
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function staffUpdate(Request $request)
    {
        $obStaff = (new Staff())
            ->where('id', (int) $request->get('id'))
            ->first()
        ;

        $fileMainImg = storage_path('app/public/' . $obStaff['photo']);

        if (!empty($request->file('main_img'))){
            if (file_exists($fileMainImg)) {
                if (!empty($obStaff['photo'])) {
                    unlink(storage_path('app/public/' . $obStaff['photo']));
                }
            }
            $fileName = time().'_'.$request->file('main_img')->getClientOriginalName();
            $filePath = $request->file('main_img')->storeAs('/uploads', $fileName , 'public');
            $obStaff->photo = $filePath;
            $obStaff->update();
        }

        $obStaffRu = (new Staff_ge())
            ->where('staff_id', (int) $request->get('id'))
            ->update(
                [
                    'name'      => $request->get('name_ge'),
                    'surname'   => $request->get('surname_ge'),
                    'position'  => $request->get('position_ge'),
                    'comment'   => $request->get('comment_ge'),
                ]
            )
        ;
        $obStaffRu = (new Staff_ru())
            ->where('staff_id', (int) $request->get('id'))
            ->update(
                [
                    'name'      => $request->get('name_ru'),
                    'surname'   => $request->get('surname_ru'),
                    'position'  => $request->get('position_ru'),
                    'comment'   => $request->get('comment_ru'),
                ]
            )
        ;
        $obStaffRu = (new Staff_en())
            ->where('staff_id', (int) $request->get('id'))
            ->update(
                [
                    'name'      => $request->get('name_en'),
                    'surname'   => $request->get('surname_en'),
                    'position'  => $request->get('position_en'),
                    'comment'   => $request->get('comment_en'),
                ]
            )
        ;

        return redirect()->route(\App\Http\Controllers\AdminCotroller::ROUTE_STAFF);
    }

    /**
     * Удаление сотрудника
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function staffDelete($id)
    {
        $obStaff = (new Staff())->where('id', $id)->first();
        if (!empty($obStaff['photo'])) {
            unlink(storage_path('app/public/' . $obStaff['photo']));
        }
        $obStaff->delete();
        $obStaffGe = (new Staff_ge())->where('staff_id', $id)->delete();
        $obStaffRu = (new Staff_ru())->where('staff_id', $id)->delete();
        $obStaffEn = (new Staff_en())->where('staff_id', $id)->delete();

        return redirect()->route(\App\Http\Controllers\AdminCotroller::ROUTE_STAFF);
    }

}
