<?php

namespace App\Http\Controllers;

use App\Models\Charity;
use App\Models\Charity_en;
use App\Models\Charity_ge;
use App\Models\Charity_img;
use App\Models\Charity_ru;
use App\Models\Partners;
use App\Models\Partners_en;
use App\Models\Partners_ge;
use App\Models\Partners_ru;
use App\Models\Products;
use App\Models\Products_en;
use App\Models\Products_ge;
use App\Models\Products_ru;
use App\Models\Projects;
use App\Models\Projects_en;
use App\Models\Projects_ge;
use App\Models\Projects_ru;
use App\Models\ProjectsImg;
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

    /** @var string  */
    const ROUTE_CHARITY     = 'bullbuilders.charity';

    /**
     * О нас
     *
     * @return View|Factory
     */
    public function about()
    {
        $page = 'about';
        $arStaff = [];
        $arCharity = [];

        $obStaff = new Staff_ge();
        $obCharity = new Charity_ge();
        if (session()->get('lang') == 'ru') {
            $obStaff = new Staff_ru();
            $obCharity = new Charity_ru();
        } elseif (session()->get('lang') == 'en') {
            $obStaff = new Staff_en();
            $obCharity = new Charity_en();

        }

        $arStaffMain = Staff::all();

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

        $arCharityMain = Charity::all();

        foreach ($arCharityMain as $key => $charity) {
            $arInfoCharity = $obCharity::all()->where('charity_id', $charity->id)->first();

            $arCharity [$key] = [
                'id'            => $charity->id,
                'main_img'      => $charity->main_img,
                'manager_phone' => $charity->manager_phone,
                'date'          => $charity->date,
                'name'          => $arInfoCharity['name'],
                'manager'       => $arInfoCharity['manager'],
                'title'         => $arInfoCharity['title'],
                'description'   => $arInfoCharity['description'],
            ];
        }
        return view('bullbuilders.about' , [
                'page'          => $page,
                'arStaff'       => $arStaff,
                'arCharity'     => $arCharity,
            ]
        );
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function partners()
    {
        $arPartners = [];
        $page = 'partners';

        $obPartners = new Partners_ge();

        if (session()->get('lang') == 'ru') {
            $obPartners = new Partners_ru();
        } elseif (session()->get('lang') == 'en') {
            $obPartners = new Partners_en();
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
            $arInfoPartners = $obPartners::all()->where('partner_id', $partner->id)->first();

            $arPartners [$key] = [
                'id'            => $partner->id,
                'main_img'      => $partner->main_img,
                'name'          => $arInfoPartners['name'],
                'title'         => $arInfoPartners['title'],
                'description'   => $arInfoPartners['description'],
            ];
        }

        return view('bullbuilders.partners',
            [
                'page'          => $page,
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
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function products()
    {
        $arProducts = [];
        $page = 'products';

        $obProducts = new Products_ge();

        if (session()->get('lang') == 'ru') {
            $obProducts = new Products_ru();
        } elseif (session()->get('lang') == 'en') {
            $obProducts = new Products_en();
        }

        $iCount = (new Products())
            ->get()
            ->count();

        $iPage = $_REQUEST['page'] ?? 1;

        if (($iPage - 1) * self::TABLE_ROWS_LIMIT > $iCount) {
            $iPage = 1;
        }

        $arProductsMain = (new Products())
            ->skip(($iPage - 1) * self::TABLE_ROWS_LIMIT)
            ->take(self::TABLE_ROWS_LIMIT)
            ->orderByDesc('created_at')
            ->get();

        foreach ($arProductsMain as $key => $product) {
            $arInfoProducts = $obProducts::all()->where('product_id', $product->id)->first();

            $arProducts [$key] = [
                'id'            => $product->id,
                'main_img'      => $product->main_img,
                'price'         => $product->price,
                'name'          => $arInfoProducts['name'],
                'title'         => $arInfoProducts['title'],
                'description'   => $arInfoProducts['description'],
            ];
        }

        return view('bullbuilders.products' ,
            [
                'page'          => $page,
                'arProducts'    => $arProducts,
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
                'id'            => $project->id,
                'status'        => $project->status,
                'main_img'      => $project->main_img,
                'manager_phone' => $project->manager_phone,
                'name'          => $arInfo->name,
                'manager'       => $arInfo->manager,
                'description'   => $arInfo->description,
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
            'status'        => $arProjectMain['status'],
            'main_img'      => $arProjectMain['main_img'],
            'manager_phone' => $arProjectMain['manager_phone'],
            'name'          => $arProjectInfo['name'],
            'manager'       => $arProjectInfo['manager'],
            'address'       => $arProjectInfo['address'],
            'description'   => $arProjectInfo['description'],
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

    /**
     * Страница Благотворительности
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View
     */
    public function charity($id)
    {
        $page = '';
        $arImg = [];
        $arCharity = [];

        $arCharityMain = Charity::all()->where('id', $id)->first();

        $obCharity = new Charity_ge();
        if (session()->get('lang') == 'ru') {
            $obCharity = new Charity_ru();
        } elseif (session()->get('lang') == 'en') {
            $obCharity = new Charity_en();
        }

        $arCharityInfo = $obCharity::all()->where('charity_id', $id)->first();

        $arCharity = [
            'id'            => $arCharityMain['id'],
            'date'          => $arCharityMain['date'],
            'main_img'      => $arCharityMain['main_img'],
            'manager_phone' => $arCharityMain['manager_phone'],
            'name'          => $arCharityInfo['name'],
            'manager'       => $arCharityInfo['manager'],
            'title'         => $arCharityInfo['title'],
            'description'   => $arCharityInfo['description'],
        ];

        $page = $arCharityInfo['name'];

        $arImg = Charity_img::all()->where('charity_id', $id);

        return view('bullbuilders.charity' , [
                'page'          => $page,
                'arCharity'     => $arCharity,
                'arImg'         => $arImg,
            ]
        );
    }
}
