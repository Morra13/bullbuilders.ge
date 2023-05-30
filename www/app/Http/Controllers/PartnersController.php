<?php

namespace App\Http\Controllers;

use App\Models\Partners;
use App\Models\Partners_en;
use App\Models\Partners_ge;
use App\Models\Partners_ru;
use Illuminate\Http\Request;

class PartnersController extends Controller
{
    /** @var string  */
    const ROUTE_CREATE_PARTNER        = 'admin.partners.createPartner';

    /** @var string  */
    const ROUTE_PARTNER              = 'admin.partners.partner';

    /** @var string  */
    const ROUTE_PARTNER_UPDATE        = 'admin.partners.partnerUpdate';

    /**
     * Создать партнера
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createPartner()
    {
        return view('admin.partners.createPartner');
    }

    /**
     * Страница партнеров
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function partner()
    {
        $arPartners = [];

        $obStaff = new Partners_ge();

        if (session()->get('lang') == 'ru') {
            $obStaff = new Partners_ru();
        } elseif (session()->get('lang') == 'en') {
            $obStaff = new Partners_en();
        }

        $iCount = (new Partners())
            ->get()
            ->count();

        $iPage = $_REQUEST['page'] ?? 1;

        if (($iPage - 1) * self::TABLE_ROWS_LIMIT > $iCount) {
            $iPage = 1;
        }

        $arPartnersMain = (new Partners())
            ->skip(($iPage - 1) * self::TABLE_ROWS_LIMIT)
            ->take(self::TABLE_ROWS_LIMIT)
            ->orderByDesc('created_at')
            ->get();

        foreach ($arPartnersMain as $key => $partner) {
            $arInfoPartners = $obStaff::all()->where('partner_id', $partner->id)->first();

            $arPartners [$key] = [
                'id'            => $partner->id,
                'main_img'      => $partner->main_img,
                'name'          => $arInfoPartners['name'],
                'title'         => $arInfoPartners['title'],
                'description'   => $arInfoPartners['description'],
            ];
        }

        return view(
            'admin.partners.partner',
            [
                'arPartners'    => $arPartners,
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
     * Обновление партнера
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function partnerUpdate(int $id)
    {
        $arPartner = [];

        $obPartnerGe = new Partners_ge();
        $obPartnerRu = new Partners_ru();
        $obPartnerEn = new Partners_en();

        $arPartnerMain = Partners::all()->where('id', $id)->first();
        $arInfoPartnerGe = $obPartnerGe::all()->where('partner_id', $arPartnerMain->id)->first();
        $arInfoPartnerRu = $obPartnerRu::all()->where('partner_id', $arPartnerMain->id)->first();
        $arInfoPartnerEn = $obPartnerEn::all()->where('partner_id', $arPartnerMain->id)->first();

        $arPartner = [
            'ge'    => [
                'id'            => $arPartnerMain->id,
                'main_img'      => $arPartnerMain->main_img,
                'name'          => $arInfoPartnerGe['name'],
                'title'         => $arInfoPartnerGe['title'],
                'description'   => $arInfoPartnerGe['description'],
            ],
            'ru'    => [
                'name'          => $arInfoPartnerRu['name'],
                'title'         => $arInfoPartnerRu['title'],
                'description'   => $arInfoPartnerRu['description'],
            ],
            'en'    => [
                'name'          => $arInfoPartnerEn['name'],
                'title'         => $arInfoPartnerEn['title'],
                'description'   => $arInfoPartnerEn['description'],
            ],
        ];

        return view(
            'admin.partners.partnerUpdate',
            [
                'arPartner'  => $arPartner,
            ]
        );
    }

}
