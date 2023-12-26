<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Partners;
use App\Models\Partners_en;
use App\Models\Partners_ge;
use App\Models\Partners_ru;
use Illuminate\Http\Request;

class PartnersController extends Controller
{
    /** @var string  */
    const ROUTE_CREATE_PARTNER        = 'api.admin.createPartner';

    /** @var string  */
    const ROUTE_PARTNER_UPDATE        = 'api.admin.partnerUpdate';

    /** @var string  */
    const ROUTE_PARTNER_DELETE        = 'api.admin.partnerDelete';

    /**
     * Добавление нового партнера
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createPartner(Request $request)
    {
        $obPartner = new Partners();
        $obPartnerGe = new Partners_ge();
        $obPartnerRu = new Partners_ru();
        $obPartnerEn = new Partners_en();

        if (!empty($request->file())){
            $fileName = time().'_'.$request->file('main_img')->getClientOriginalName();
            $filePath = $request->file('main_img')->storeAs('/uploads', $fileName , 'public');
            $obPartner->main_img = $filePath;
            $obPartner->save();
            $iPartnerId = $obPartner->id;
        }

        if (!empty($iPartnerId)) {
            $obPartnerGe->partner_id    = $iPartnerId;
            $obPartnerGe->name          = $request->get('name_ge');
            $obPartnerGe->title         = $request->get('title_ge');
            $obPartnerGe->description   = $request->get('description_ge');
            $obPartnerGe->save();

            $obPartnerRu->partner_id    = $iPartnerId;
            $obPartnerRu->name          = $request->get('name_ru') ?? $request->get('name_ge');
            $obPartnerRu->title         = $request->get('title_ru') ?? $request->get('title_ge');
            $obPartnerRu->description   = $request->get('description_ru') ?? $request->get('description_ge');
            $obPartnerRu->save();

            $obPartnerEn->partner_id    = $iPartnerId;
            $obPartnerEn->name          = $request->get('name_en') ?? $request->get('name_ge');
            $obPartnerEn->title         = $request->get('title_en') ?? $request->get('title_ge');
            $obPartnerEn->description   = $request->get('description_en') ?? $request->get('description_ge');
            $obPartnerEn->save();
        }

        return redirect()->route(\App\Http\Controllers\PartnersController::ROUTE_CREATE_PARTNER);
    }

    /**
     * Обновление партнера
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function partnerUpdate(Request $request)
    {
        $obPartner = (new Partners())
            ->where('id', (int) $request->get('id'))
            ->first()
        ;

        $fileMainImg = storage_path('app/public/' . $obPartner['main_img']);

        if (!empty($request->file('main_img'))){
            if (file_exists($fileMainImg)) {
                if (!empty($obPartner['main_img'])) {
                    unlink(storage_path('app/public/' . $obPartner['main_img']));
                }
            }
            $fileName = time().'_'.$request->file('main_img')->getClientOriginalName();
            $filePath = $request->file('main_img')->storeAs('/uploads', $fileName , 'public');
            $obPartner->main_img = $filePath;
            $obPartner->update();
        }

        $obPartnerGe = (new Partners_ge())
            ->where('partner_id', (int) $request->get('id'))
            ->update(
                [
                    'name'          => $request->get('name_ge'),
                    'title'         => $request->get('title_ge'),
                    'description'   => $request->get('description_ge'),
                ]
            )
        ;
        $obPartnerRu = (new Partners_ru())
            ->where('partner_id', (int) $request->get('id'))
            ->update(
                [
                    'name'          => $request->get('name_ru'),
                    'title'         => $request->get('title_ru'),
                    'description'   => $request->get('description_ru'),
                ]
            )
        ;
        $obPartnerEn = (new Partners_en())
            ->where('partner_id', (int) $request->get('id'))
            ->update(
                [
                    'name'          => $request->get('name_en'),
                    'title'         => $request->get('title_en'),
                    'description'   => $request->get('description_en'),
                ]
            )
        ;

        return redirect()->route(\App\Http\Controllers\PartnersController::ROUTE_PARTNER);
    }

    /**
     * Удаление партнера
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function partnerDelete($id)
    {
        $obPartner = (new Partners())->where('id', $id)->first();
        if (!empty($obPartner['main_img'])) {
            unlink(storage_path('app/public/' . $obPartner['main_img']));
        }
        $obPartner->delete();
        $obPartnerGe = (new Partners_ge())->where('partner_id', $id)->delete();
        $obPartnerRu = (new Partners_ru())->where('partner_id', $id)->delete();
        $obPartnerEn = (new Partners_en())->where('partner_id', $id)->delete();

        return redirect()->route(\App\Http\Controllers\PartnersController::ROUTE_PARTNER);
    }

}
