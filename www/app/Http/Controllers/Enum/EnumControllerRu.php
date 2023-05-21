<?php

namespace App\Http\Controllers\Enum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnumControllerRu extends Controller
{
    /**
     * Меню
     */
    const MENU = 'Меню';

    /**
     * Меню
     */
    const ADMIN = 'Админ';

    /**
     * Главная страница
     */
    const MAIN = 'Главная страница';

    /**
     * О нас
     */
    const ABOUT = 'О нас';

    /**
     * Наши партнеры
     */
    const PARTNERS = 'Наши партнеры';

    /**
     * Наши продукты
     */
    const PRODUCTS = 'Наши продукты';

    /**
     * Наши проекты
     */
    const PROJECTS = 'Наши проекты';

    /**
     * Связаться с нами
     */
    const CONTACT = 'Связаться с нами';

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
    const CREATE = 'Создать';

    /**
     * Цена
     */
    const PRICE = 'Цена';

    /**
     * Штрихкод
     */
    const BARCODE = 'Штрихкод';

    /**
     * Описание
     */
    const DESCRIPTION = 'Описание';

    /**
     * Выберите категорию
     */
    const SELECT_CATEGORY = 'Выберите категорию';

    /**
     * Создать новый продукт
     */
    const CREATE_NEW_PRODUCT = 'Создать новый продукт';

    /**
     * Добавить файл
     */
    const SELECT_FILE = 'Добавить фотографию';

    /**
     * Добавить еще фотографии
     */
    const ADD_MORE_PHOTO = 'Добавить еще фотографии';

    /**
     * Скрыть
     */
    const HIDE = 'Скрыть';

    /**
     * Удалить
     */
    const CLEAR = 'Удалить';

}
