<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
class AmadoController extends Controller
{
    /** @var string  */
    const ROUTE_ABOUT           = 'amado.about';

    /** @var string  */
    const ROUTE_PRODUCT         = 'amado.product';

    /** @var string  */
    const ROUTE_PRODUCT_DETAIL  = 'amado.productDetail';

    /** @var string  */
    const ROUTE_BASKET          = 'amado.basket';

    /**
     * About
     * @return View|Factory
     */
    public function about()
    {
        return view('amado.about');
    }

    /**
     * Product
     * @return View|Factory
     */
    public function product()
    {
        return view('amado.product');
    }

    /**
     * Product detail
     * @return View|Factory
     */
    public function productDetail()
    {
        return view('amado.productDetail');
    }

    /**
     * Basket
     * @return View|Factory
     */
    public function basket()
    {
        return view('amado.basket');
    }
}
