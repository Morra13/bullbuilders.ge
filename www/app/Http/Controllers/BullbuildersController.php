<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\Projects_en;
use App\Models\Projects_ge;
use App\Models\Projects_ru;
use App\Models\ProjectsImg;
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
    const ROUTE_ABOUT       = 'bullbuilders.about';

    /** @var string  */
    const ROUTE_PARTNERS    = 'bullbuilders.partners';

    /** @var string  */
    const ROUTE_PRODUCTS    = 'bullbuilders.products';

    /** @var string  */
    const ROUTE_PROJECTS    = 'bullbuilders.projects';

    /** @var string  */
    const ROUTE_CONTACT     = 'bullbuilders.contact';

    /** @var string  */
    const ROUTE_PROJECT     = 'bullbuilders.project';

    /**
     * О нас
     *
     * @return View|Factory
     */
    public function about()
    {
        $page = 'about';
        $arReviews = [];
        $arStaff = [];

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
     * Страница проектов
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function projects()
    {
        $page = 'projects';
        $arProjects = [];

        $iCompletedCount = Projects::all()->where('status', 'completed')->count();
        $iIncompleteCount = Projects::all()->where('status', 'incomplete')->count();

        $obProjects = new Projects_ge();
        if (session()->get('lang') == 'ru') {
            $obProjects = new Projects_ru();
        } elseif (session()->get('lang') == 'en') {
            $obProjects = new Projects_en();
        }

        $arProjectsMain = Projects::all();
        if (!empty($_REQUEST['status'])) {
            $arProjectsMain = Projects::all()->where('status', $_REQUEST['status']);
        }

        foreach ($arProjectsMain as $key => $project) {
            $arInfo = $obProjects::all()->where('project_id', $project->id)->first();
            $arProjects [$key] = [
                'id' => $project->id,
                'status' => $project->status,
                'main_img' => $project->main_img,
                'manager_phone' => $project->manager_phone,
                'name' => $arInfo->name,
                'manager' => $arInfo->manager,
                'description' => $arInfo->description,
            ];
        }

        return view('bullbuilders.projects' , [
                'page'              => $page,
                'iCompletedCount'   => $iCompletedCount,
                'iIncompleteCount'  => $iIncompleteCount,
                'arProjects'        => $arProjects,
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

    /**
     * Страница проекта
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function project($id)
    {
        $page = '';
        $arProject = [];
        $arImg = [];

        $arProjectMain = Projects::all()->where('id', $id)->first();
        $obProject = new Projects_ge();

        if (session()->get('lang') == 'ru') {
            $obProject = new Projects_ru();
        } elseif (session()->get('lang') == 'en') {
            $obProject = new Projects_en();
        }

        $arProjectInfo = $obProject::all()->where('project_id', $id)->first();

        $arProject = [
            'status' => $arProjectMain['status'],
            'main_img' => $arProjectMain['main_img'],
            'manager_phone' => $arProjectMain['manager_phone'],
            'name' => $arProjectInfo['name'],
            'manager' => $arProjectInfo['manager'],
            'address' => $arProjectInfo['address'],
            'description' => $arProjectInfo['description'],
        ];

        $page = $arProjectInfo['name'];

        $arImg = ProjectsImg::all()->where('project_id', $id);

        return view('bullbuilders.project' , [
                'page'          => $page,
                'arProject'     => $arProject,
                'arImg'         => $arImg,
            ]
        );
    }
}
