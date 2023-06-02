<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Charity;
use App\Models\Charity_comment;
use App\Models\Charity_en;
use App\Models\Charity_ge;
use App\Models\Charity_img;
use App\Models\Charity_ru;
use Illuminate\Http\Request;

class CharityController extends Controller
{
    /** @var string  */
    const ROUTE_CREATE_CHARITY        = 'api.admin.createCharity';

    /** @var string  */
    const ROUTE_UPDATE_CHARITY        = 'api.admin.updateCharity';

    /** @var string  */
    const ROUTE_DELETE_CHARITY        = 'api.admin.deleteCharity';

    /** @var string  */
    const ROUTE_UPDATE_CHARITY_IMG    = 'api.admin.updateCharityImg';

    /** @var string  */
    const ROUTE_DELETE_CHARITY_IMG    = 'api.admin.deleteCharityImg';

    /** @var string  */
    const ROUTE_CREATE_COMMENT        = 'api.admin.createComment';

    /** @var string  */
    const ROUTE_DELETE_COMMENT        = 'api.admin.deleteComment';

    /**
     * Добавление новой благотворительности
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createCharity(Request $request)
    {
        $obCharity = new Charity();
        $obCharityGe = new Charity_ge();
        $obCharityRu = new Charity_ru();
        $obCharityEn = new Charity_en();

        if (!empty($request->file())){
            $fileName = time().'_'.$request->file('main_img')->getClientOriginalName();
            $filePath = $request->file('main_img')->storeAs('/uploads', $fileName , 'public');
            $obCharity->main_img = $filePath;
        }
        $obCharity->date = $request->get('date');
        $obCharity->manager_phone = $request->get('manager_phone');
        $obCharity->save();
        $iProductId = $obCharity->id;

        if (!empty($iProductId)) {
            $obCharityGe->charity_id    = $iProductId;
            $obCharityGe->name          = $request->get('name_ge');
            $obCharityGe->manager       = $request->get('manager_ge');
            $obCharityGe->title         = $request->get('title_ge');
            $obCharityGe->description   = $request->get('description_ge');
            $obCharityGe->save();

            $obCharityRu->charity_id    = $iProductId;
            $obCharityRu->name          = $request->get('name_ru');
            $obCharityRu->manager       = $request->get('manager_ru');
            $obCharityRu->title         = $request->get('title_ru');
            $obCharityRu->description   = $request->get('description_ru');
            $obCharityRu->save();

            $obCharityEn->charity_id    = $iProductId;
            $obCharityEn->name          = $request->get('name_en');
            $obCharityEn->manager       = $request->get('manager_en');
            $obCharityEn->title         = $request->get('title_en');
            $obCharityEn->description   = $request->get('description_en');
            $obCharityEn->save();
        }

        return redirect()->route(\App\Http\Controllers\CharityController::ROUTE_CREATE_CHARITY);
    }

    /**
     * Обновление благотворительности
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCharity(Request $request)
    {
        $obCharity = (new Charity())
            ->where('id', (int) $request->get('id'))
            ->first()
        ;

        $fileMainImg = storage_path('app/public/' . $obCharity['main_img']);

        if (!empty($request->file('main_img'))){
            if (file_exists($fileMainImg)) {
                if (!empty($obCharity['main_img'])) {
                    unlink(storage_path('app/public/' . $obCharity['main_img']));
                }
            }
            $fileName = time().'_'.$request->file('main_img')->getClientOriginalName();
            $filePath = $request->file('main_img')->storeAs('/uploads', $fileName , 'public');
            $obCharity->main_img = $filePath;
        }
        $obCharity->date = $request->get('date');
        $obCharity->manager_phone = $request->get('manager_phone');
        $obCharity->update();


        $obCharityGe = (new Charity_ge())
            ->where('charity_id', (int) $request->get('id'))
            ->update(
                [
                    'name'          => $request->get('name_ge'),
                    'manager'       => $request->get('manager_ge'),
                    'title'         => $request->get('title_ge'),
                    'description'   => $request->get('description_ge'),
                ]
            )
        ;
        $obCharityRu = (new Charity_ru())
            ->where('charity_id', (int) $request->get('id'))
            ->update(
                [
                    'name'          => $request->get('name_ru'),
                    'manager'       => $request->get('manager_ru'),
                    'title'         => $request->get('title_ru'),
                    'description'   => $request->get('description_ru'),
                ]
            )
        ;
        $obCharityEn = (new Charity_en())
            ->where('charity_id', (int) $request->get('id'))
            ->update(
                [
                    'name'          => $request->get('name_en'),
                    'manager'       => $request->get('manager_en'),
                    'title'         => $request->get('title_en'),
                    'description'   => $request->get('description_en'),
                ]
            )
        ;

        return redirect()->route(\App\Http\Controllers\CharityController::ROUTE_CHARITY);
    }

    /**
     * Удаление благотворительность
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCharity($id)
    {
        $obCharity = (new Charity())->where('id', $id)->first();
        if (!empty($obCharity['main_img'])) {
            unlink(storage_path('app/public/' . $obCharity['main_img']));
        }
        $obCharity->delete();
        $obCharityGe = (new Charity_ge())->where('charity_id', $id)->delete();
        $obCharityRu = (new Charity_ru())->where('charity_id', $id)->delete();
        $obCharityEn = (new Charity_en())->where('charity_id', $id)->delete();

        $obCharityImg = (new Charity_img())->where('charity_id', $id)->get();
        foreach ($obCharityImg as $charityImg) {
            if (!empty($charityImg->img)) {
                unlink(storage_path('app/public/' . $charityImg->img));
            }
            $charityImg->delete();
        }


        return redirect()->route(\App\Http\Controllers\CharityController::ROUTE_CHARITY);
    }

    /**
     * Обновление фотографий благотворительности
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCharityImg(Request $request, $id)
    {
        if (!empty($request->file('more_img'))) {
            foreach ($request->file('more_img') as $key => $file) {
                $obCharityImg = new Charity_img();

                $fileNameMoreImg = $key . time().'_'.$file->getClientOriginalName();
                $filePathMoreImg = $file->storeAs('/uploads', $fileNameMoreImg , 'public');

                $obCharityImg->charity_id = $id;
                $obCharityImg->img = $filePathMoreImg;
                $obCharityImg->save();
            }
        }

        return redirect()->back();
    }

    /**
     * Удаление дополнительных фотографии
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCharityImg($id)
    {
        $obCharityImg = (new Charity_img())->where('id', $id)->first();
        if (!empty($obCharityImg->img)) {
            unlink(storage_path('app/public/' . $obCharityImg->img));
        }
        $obCharityImg->delete();

        return redirect()->back();
    }

    /**
     * Создать коментарий
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createComment(Request $request)
    {
        $obComment = new Charity_comment();

        if (!empty($request->file())){
            $fileName = time().'_'.$request->file('main_img')->getClientOriginalName();
            $filePath = $request->file('main_img')->storeAs('/uploads', $fileName , 'public');
            $obComment->main_img = $filePath;
        }

        $obComment->charity_id  = $request->get('charity_id');
        $obComment->main_img    = $request->get('main_img');
        $obComment->name        = $request->get('name');
        $obComment->email       = $request->get('email');
        $obComment->comment     = $request->get('comment');
        $obComment->save();

        return redirect()->back();
    }

    /**
     * Удаление коментария
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteComment($id)
    {
        $obComment = (new Charity_comment())->where('id', $id)->first();
        if (!empty($obComment->img)) {
            unlink(storage_path('app/public/' . $obComment->img));
        }
        $obComment->delete();

        return redirect()->back();
    }
}

