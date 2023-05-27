<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use App\Models\Reviews_en;
use App\Models\Reviews_ge;
use App\Models\Reviews_ru;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    /** @var string  */
    const ROUTE_CREATE_REVIEWS        = 'admin.reviews.createReviews';

    /** @var string  */
    const ROUTE_REVIEWS               = 'admin.reviews.reviews';

    /** @var string  */
    const ROUTE_REVIEWS_UPDATE        = 'admin.reviews.reviewsUpdate';

    /**
     * Создать сотрудника
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createReviews()
    {
        return view('admin.reviews.createReviews');
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function reviews()
    {
        $arReviews = [];

        $obReviews = new Reviews_ge();

        if (session()->get('lang') == 'ru') {
            $obReviews = new Reviews_ru();
        } elseif (session()->get('lang') == 'en') {
            $obReviews = new Reviews_en();
        }

        $iCount = (new Reviews())
            ->get()
            ->count();

        $iPage = $_REQUEST['page'] ?? 1;

        if (($iPage - 1) * self::TABLE_ROWS_LIMIT > $iCount) {
            $iPage = 1;
        }

        $arReviewsMain = (new Reviews())
            ->skip(($iPage - 1) * self::TABLE_ROWS_LIMIT)
            ->take(self::TABLE_ROWS_LIMIT)
            ->orderByDesc('created_at')
            ->get();

        foreach ($arReviewsMain as $key => $reviews) {
            $arInfoReviews = $obReviews::all()->where('review_id', $reviews->id)->first();

            $arReviews [$key] = [
                'id'            => $reviews->id,
                'photo'         => $reviews->photo,
                'name'          => $arInfoReviews['name'],
                'surname'       => $arInfoReviews['surname'],
                'position'      => $arInfoReviews['position'],
                'comment'       => $arInfoReviews['comment'],
            ];
        }

        return view(
            'admin.reviews.reviews',
            [
                'arReviews'       => $arReviews,
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
    public function reviewsUpdate(int $id)
    {
        $arReviews = [];

        $obReviewsGe = new Reviews_ge();
        $obReviewsRu = new Reviews_ru();
        $obReviewsEn = new Reviews_en();

        $arReviewsMain = Reviews::all()->where('id', $id)->first();
        $arInfoReviewsGe = $obReviewsGe::all()->where('review_id', $arReviewsMain->id)->first();
        $arInfoReviewsRu = $obReviewsRu::all()->where('review_id', $arReviewsMain->id)->first();
        $arInfoReviewsEn = $obReviewsEn::all()->where('review_id', $arReviewsMain->id)->first();

        $arReviews = [
            'ge'    => [
                'id'        => $arReviewsMain->id,
                'photo'     => $arReviewsMain->photo,
                'name'      => $arInfoReviewsGe['name'],
                'surname'   => $arInfoReviewsGe['surname'],
                'position'  => $arInfoReviewsGe['position'],
                'comment'   => $arInfoReviewsGe['comment'],
            ],
            'ru'    => [
                'name'      => $arInfoReviewsRu['name'],
                'surname'   => $arInfoReviewsRu['surname'],
                'position'  => $arInfoReviewsRu['position'],
                'comment'   => $arInfoReviewsRu['comment'],
            ],
            'en'    => [
                'name'      => $arInfoReviewsEn['name'],
                'surname'   => $arInfoReviewsEn['surname'],
                'position'  => $arInfoReviewsEn['position'],
                'comment'   => $arInfoReviewsEn['comment'],
            ],
        ];

        return view(
            'admin.reviews.reviewsUpdate',
            [
                'arReviews'  => $arReviews,
            ]
        );
    }

}

