<?php
namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Debtors;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * Class PublicController
 * @package App\Http\Controllers
 */
class PublicController extends Controller
{
    /** @var string  */
    const ROUTE_HOW_IT_WORK = 'public.how.it.work';

    /** @var string  */
    const ROUTE_INDEX       = 'public.index';

    /** @var string  */
    const ROUTE_BOX         = 'public.box';

    /** @var string  */
    const ROUTE_POLICY      = 'public.policy';

    /** @var string  */
    const ROUTE_COOKIE      = 'public.cookie';

    /**
     * How its work page
     * @return View|Factory
     */
    public function howItWork()
    {
        return view('public.how-it-work');
    }

    /**
     * Index page
     * @return View|Factory
     */
    public function index()
    {
        $page = 'main';
        return view('public.index', [
            'page'  => $page,
            ]
        );
    }

    /**
     * Index page
     * @return View|Factory
     */
    public function box()
    {
        $obBasket = (new Basket())
            ->orderBy('updated_at', 'desc')
            ->get()
        ;

        $arName = [];
        $obDebtorsName = (new Debtors())->get('name')->all();
        foreach ($obDebtorsName as $value) {
            $arName[] = $value->name;
        }
        $arName = array_unique($arName);

        return view('public.box', [
            'arBasket'    => $obBasket,
            'arName'    => $arName,
            ]
        );
    }

    /**
     * Policy page
     * @return View|Factory
     */
    public function policy()
    {
        return view('public.policy');
    }

    /**
     * Cookie page
     * @return View|Factory
     */
    public function cookie()
    {
        return view('public.cookie');
    }
}
