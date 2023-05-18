<?php

namespace App\Http\Controllers\Enum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnumControllerEng extends Controller
{
    /**
     * Главная страница
     */
    const MAIN = 'Main page';

    /**
     * О нас
     */
    const ABOUT = 'About';

    /**
     * Продукты
     */
    const PRODUCTS = 'Products';

    /**
     * Корзина
     */
    const BASKET = 'Basket';

    /**
     * Имя
     */
    const NAME = 'Name';

    /**
     * Создать новую категорию
     */
    const CREATE_NEW_CATEGORY = 'Create new category';

    /**
     * Создать
     */
    const CREATE = 'Create';

}
