<?php

namespace App\Http\Controllers\Enum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LangController extends Controller
{
    /**
     * Получить язык
     *
     * @return EnumControllerEng|EnumControllerGe|EnumControllerRu
     */
    public static function getLang()
    {
        self::lang();

        if ($_REQUEST['lang'] == 'ru') {
            $obResult = new EnumControllerRu();
        } elseif ($_REQUEST['lang'] == 'eng') {
            $obResult = new EnumControllerEng();
        } else {
            $obResult = new EnumControllerGe();
        }

        return $obResult;
    }

    /**
     * Установка языка по дефолту
     *
     * @return bool
     */
    public static function lang()
    {
        if (empty($_REQUEST['lang'])) {
            $_REQUEST['lang'] = 'ru';
        }

        return true;
    }
}
