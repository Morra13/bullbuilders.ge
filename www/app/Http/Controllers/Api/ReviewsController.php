<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reviews;
use App\Models\Reviews_ge;
use App\Models\Reviews_ru;
use App\Models\Reviews_en;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    /** @var string  */
    const ROUTE_CREATE_REVIEWS        = 'api.admin.createReviews';

    /** @var string  */
    const ROUTE_REVIEWS_UPDATE        = 'api.admin.ReviewsUpdate';

    /** @var string  */
    const ROUTE_REVIEWS_DELETE        = 'api.admin.ReviewsDelete';

    /**
     * Добавление нового сотрудника
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createReviews(Request $request)
    {
        $obReviews = new Reviews();
        $obReviewsGe = new Reviews_ge();
        $obReviewsRu = new Reviews_ru();
        $obReviewsEn = new Reviews_en();

        if (!empty($request->file())){
            $fileName = time().'_'.$request->file('main_img')->getClientOriginalName();
            $filePath = $request->file('main_img')->storeAs('/uploads', $fileName , 'public');
            $obReviews->photo = $filePath;
            $obReviews->save();
            $iReviewsId = $obReviews->id;
        }

        if (!empty($iReviewsId)) {
            $obReviewsGe->review_id   = $iReviewsId;
            $obReviewsGe->name        = $request->get('name_ge');
            $obReviewsGe->surname     = $request->get('surname_ge');
            $obReviewsGe->position    = $request->get('position_ge');
            $obReviewsGe->comment     = $request->get('comment_ge');
            $obReviewsGe->save();

            $obReviewsRu->review_id   = $iReviewsId;
            $obReviewsRu->name        = $request->get('name_ru') ?? $request->get('name_ge');
            $obReviewsRu->surname     = $request->get('surname_ru') ?? $request->get('surname_ge');
            $obReviewsRu->position    = $request->get('position_ru') ?? $request->get('position_ge');
            $obReviewsRu->comment     = $request->get('comment_ru') ?? $request->get('comment_ge');
            $obReviewsRu->save();

            $obReviewsEn->review_id   = $iReviewsId;
            $obReviewsEn->name        = $request->get('name_en') ?? $request->get('name_ge');
            $obReviewsEn->surname     = $request->get('surname_en') ?? $request->get('surname_ge');
            $obReviewsEn->position    = $request->get('position_en') ?? $request->get('position_ge');
            $obReviewsEn->comment     = $request->get('comment_en') ?? $request->get('comment_ge');
            $obReviewsEn->save();
        }

        return redirect()->route(\App\Http\Controllers\ReviewsController::ROUTE_CREATE_REVIEWS);
    }

    /**
     * Обновление сотрудника
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ReviewsUpdate(Request $request)
    {
        $obReviews = (new Reviews())
            ->where('id', (int) $request->get('id'))
            ->first()
        ;

        $fileMainImg = storage_path('app/public/' . $obReviews['photo']);

        if (!empty($request->file('main_img'))){
            if (file_exists($fileMainImg)) {
                if (!empty($obReviews['photo'])) {
                    unlink(storage_path('app/public/' . $obReviews['photo']));
                }
            }
            $fileName = time().'_'.$request->file('main_img')->getClientOriginalName();
            $filePath = $request->file('main_img')->storeAs('/uploads', $fileName , 'public');
            $obReviews->photo = $filePath;
            $obReviews->update();
        }

        $obReviewsRu = (new Reviews_ge())
            ->where('review_id', (int) $request->get('id'))
            ->update(
                [
                    'name'      => $request->get('name_ge'),
                    'surname'   => $request->get('surname_ge'),
                    'position'  => $request->get('position_ge'),
                    'comment'   => $request->get('comment_ge'),
                ]
            )
        ;
        $obReviewsRu = (new Reviews_ru())
            ->where('review_id', (int) $request->get('id'))
            ->update(
                [
                    'name'      => $request->get('name_ru'),
                    'surname'   => $request->get('surname_ru'),
                    'position'  => $request->get('position_ru'),
                    'comment'   => $request->get('comment_ru'),
                ]
            )
        ;
        $obReviewsRu = (new Reviews_en())
            ->where('review_id', (int) $request->get('id'))
            ->update(
                [
                    'name'      => $request->get('name_en'),
                    'surname'   => $request->get('surname_en'),
                    'position'  => $request->get('position_en'),
                    'comment'   => $request->get('comment_en'),
                ]
            )
        ;

        return redirect()->route(\App\Http\Controllers\ReviewsController::ROUTE_REVIEWS);
    }

    /**
     * Удаление сотрудника
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ReviewsDelete($id)
    {
        $obReviews = (new Reviews())->where('id', $id)->first();
        if (!empty($obReviews['photo'])) {
            unlink(storage_path('app/public/' . $obReviews['photo']));
        }
        $obReviews->delete();
        $obReviewsGe = (new Reviews_ge())->where('review_id', $id)->delete();
        $obReviewsRu = (new Reviews_ru())->where('review_id', $id)->delete();
        $obReviewsEn = (new Reviews_en())->where('review_id', $id)->delete();

        return redirect()->route(\App\Http\Controllers\ReviewsController::ROUTE_REVIEWS);
    }

}

