<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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
     * About
     * @return View|Factory
     */
    public function about()
    {
        $page = 'about';
        return view('bullbuilders.about' , [
                'page'  => $page,
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
