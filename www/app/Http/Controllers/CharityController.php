<?php

namespace App\Http\Controllers;

use App\Models\Charity;
use App\Models\Charity_comment;
use App\Models\Charity_en;
use App\Models\Charity_ge;
use App\Models\Charity_ru;
use App\Models\Charity_img;
use Illuminate\Http\Request;

class CharityController extends Controller
{
    /** @var string  */
    const ROUTE_CREATE_CHARITY        = 'admin.charity.createCharity';

    /** @var string  */
    const ROUTE_CHARITY               = 'admin.charity.charity';

    /** @var string  */
    const ROUTE_UPDATE_CHARITY        = 'admin.charity.updateCharity';

    /** @var string  */
    const ROUTE_UPDATE_CHARITY_IMG    = 'admin.charity.updateCharityImg';

    /** @var string  */
    const ROUTE_COMMENT               = 'admin.charity.comment';

    /**
     * Страница создать благотворительность
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createCharity()
    {
        return view('admin.charity.createCharity');
    }

    /**
     * Страница с благотворительностью
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function charity()
    {
        $arCharity = [];

        $obCharity = new Charity_ge();

        if (session()->get('lang') == 'ru') {
            $obCharity = new Charity_ru();
        } elseif (session()->get('lang') == 'en') {
            $obCharity = new Charity_en();
        }

        $iCount = (new Charity())
            ->get()
            ->count();

        $iPage = $_REQUEST['page'] ?? 1;

        if (($iPage - 1) * self::TABLE_ROWS_LIMIT > $iCount) {
            $iPage = 1;
        }

        $arCharityMain = (new Charity())
            ->skip(($iPage - 1) * self::TABLE_ROWS_LIMIT)
            ->take(self::TABLE_ROWS_LIMIT)
            ->orderByDesc('created_at')
            ->get();

        foreach ($arCharityMain as $key => $charity) {
            $arInfoCharity = $obCharity::all()->where('charity_id', $charity->id)->first();

            $arCharity [$key] = [
                'id'            => $charity->id,
                'main_img'      => $charity->main_img,
                'manager_phone' => $charity->manager_phone,
                'date'          => $charity->date,
                'name'          => $arInfoCharity['name'],
                'manager'       => $arInfoCharity['manager'],
                'title'       => $arInfoCharity['title'],
                'description'   => $arInfoCharity['description'],
            ];
        }

        return view(
            'admin.charity.charity',
            [
                'arCharity'       => $arCharity,
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
     * Страница обновления благотворительности
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function updateCharity(int $id)
    {
        $arCharity = [];

        $obCharityGe = new Charity_ge();
        $obCharityRu = new Charity_ru();
        $obCharityEn = new Charity_en();

        $arCharityMain   = Charity::all()->where('id', $id)->first();
        $arInfoCharityGe = $obCharityGe::all()->where('charity_id', $id)->first();
        $arInfoCharityRu = $obCharityRu::all()->where('charity_id', $id)->first();
        $arInfoCharityEn = $obCharityEn::all()->where('charity_id', $id)->first();

        $arCharity = [
            'ge'    => [
                'id'            => $arCharityMain->id,
                'main_img'      => $arCharityMain->main_img,
                'manager_phone' => $arCharityMain->manager_phone,
                'date'          => $arCharityMain->date,
                'name'          => $arInfoCharityGe['name'],
                'manager'       => $arInfoCharityGe['manager'],
                'title'         => $arInfoCharityGe['title'],
                'description'   => $arInfoCharityGe['description'],
            ],
            'ru'    => [
                'name'          => $arInfoCharityRu['name'],
                'manager'       => $arInfoCharityRu['manager'],
                'title'         => $arInfoCharityRu['title'],
                'description'   => $arInfoCharityRu['description'],
            ],
            'en'    => [
                'name'          => $arInfoCharityEn['name'],
                'manager'       => $arInfoCharityEn['manager'],
                'title'         => $arInfoCharityEn['title'],
                'description'   => $arInfoCharityEn['description'],
            ],
        ];

        return view(
            'admin.charity.updateCharity',
            [
                'arCharity'  => $arCharity,
            ]
        );
    }

    /**
     * Страница обновления дополнительных фото
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function updateCharityImg(int $id)
    {
        $arCharityImg = [];

        $obCharityImg = new Charity_img();
        $arCharityImg = $obCharityImg::all()->where('charity_id', $id);

        return view(
            'admin.charity.updateCharityImg',
            [
                'id'            => $id,
                'arCharityImg' => $arCharityImg,
            ]
        );
    }

    /**
     * Коментарии
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function comment(int $id)
    {
        $arComment = [];

        $iCount = (new Charity_comment())
            ->where('charity_id', $id)
            ->get()
            ->count();

        $iPage = $_REQUEST['page'] ?? 1;

        if (($iPage - 1) * self::TABLE_ROWS_LIMIT > $iCount) {
            $iPage = 1;
        }

        $arComment = (new Charity_comment())
            ->where('charity_id', $id)
            ->skip(($iPage - 1) * self::TABLE_ROWS_LIMIT)
            ->take(self::TABLE_ROWS_LIMIT)
            ->orderByDesc('created_at')
            ->get();

        return view(
            'admin.charity.comment',
            [
                'arComment'       => $arComment,
                'pagination'    => [
                    'total'       => $iCount,
                    'limit'       => self::TABLE_ROWS_LIMIT,
                    'page_count'  => ceil($iCount / self::TABLE_ROWS_LIMIT),
                    'page'        => $iPage,
                ]
            ]
        );
    }
}

