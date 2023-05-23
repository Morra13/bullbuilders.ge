<?php
namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Debtors;
use GuzzleHttp\Psr7\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;

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

    /** @var string  */
    const ROUTE_CHANGE_LANG        = 'public.changeLang';

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

    /**
     * Изменение языка
     *
     * @param $lang
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeLang($lang)
    {
        session(['lang' => $lang]);
        App::setLocale($lang);

        return redirect()->back();
    }
}
