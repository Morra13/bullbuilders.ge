<?php

namespace App\Http\Controllers\Enum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnumControllerGe extends Controller
{
    /**
     * Главная страница
     */
    const MAIN = 'მთავარი გვერდი';

    /**
     * О нас
     */
    const ABOUT = 'О нас';

    /**
     * Продукты
     */
    const PRODUCTS = 'Продукты';

    /**
     * Корзина
     */
    const BASKET = 'Корзина';

    /**
     * Имя
     */
    const NAME = 'Имя';

    /**
     * Создать новую категорию
     */
    const CREATE_NEW_CATEGORY = 'Создать новую категорию';

    /**
     * Создать
     */
    const CREATE = 'შექმნა';


}
