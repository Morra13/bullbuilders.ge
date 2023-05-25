<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use App\Models\Reviews_en;
use App\Models\Reviews_ge;
use App\Models\Reviews_ru;
use App\Models\Staff;
use App\Models\Staff_en;
use App\Models\Staff_ge;
use App\Models\Staff_ru;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class BullbuildersController extends Controller
{
    /** @var string  */
    const ROUTE_ABOUT           = 'bullbuilders.about';

    /** @var string  */
    const ROUTE_PARTNERS        = 'bullbuilders.partners';

    /** @var string  */
    const ROUTE_PRODUCTS        = 'bullbuilders.products';

    /** @var string  */
    const ROUTE_PROJECTS        = 'bullbuilders.projects';

    /** @var string  */
    const ROUTE_CONTACT        = 'bullbuilders.contact';

    /**
     * О нас
     *
     * @return View|Factory
     */
    public function about()
    {
        $page = 'about';

        $obReviews = new Reviews_ge();
        $obStaff = new Staff_ge();

        if (session()->get('lang') == 'ru') {
            $obReviews = new Reviews_ru();
            $obStaff = new Staff_ru();
        } elseif (session()->get('lang') == 'en') {
            $obReviews = new Reviews_en();
            $obStaff = new Staff_en();
        }

        $arReviewsMain = Reviews::orderBy('id', 'desc')->take(5)->get();
        $arStaffMain = Staff::all();

        foreach ($arReviewsMain as $key => $review) {
            $arInfo = $obReviews::all()->where('review_id', $review->id)->first();
            $arReviews [$key] = [
                'id'            => $review->id,
                'photo'         => $review->photo,
                'name'          => $arInfo->name,
                'surname'       => $arInfo->surname,
                'position'      => $arInfo->position,
                'comment'       => $arInfo->comment,
            ];
        }

        foreach ($arStaffMain as $key => $staff) {
            $arInfo = $obStaff::all()->where('staff_id', $staff->id)->first();
            $arStaff [$key] = [
                'id'            => $staff->id,
                'photo'         => $staff->photo,
                'name'          => $arInfo->name,
                'surname'       => $arInfo->surname,
                'position'      => $arInfo->position,
                'comment'       => $arInfo->comment,
            ];
        }

        return view('bullbuilders.about' , [
                'page'          => $page,
                'arReviews'     => $arReviews,
                'arStaff'       => $arStaff,
            ]
        );
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function partners()
    {
        $page = 'partners';
        return view('bullbuilders.partners', [
                'page'  => $page,
            ]
        );
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function products()
    {
        $page = 'products';
        return view('bullbuilders.products' , [
                'page'  => $page,
            ]
        );
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function projects()
    {
        $page = 'projects';
        return view('bullbuilders.projects' , [
                'page'  => $page,
            ]
        );
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function contact()
    {
        $page = 'contact';
        return view('bullbuilders.contact' , [
                'page'  => $page,
            ]
        );
    }
}
