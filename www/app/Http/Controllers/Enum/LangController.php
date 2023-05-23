<?php

namespace App\Http\Controllers\Enum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LangController extends Controller
{
    /** @var string  */
    const ROUTE_SET_LANG = 'setLang';

    /**
     * Установка языка по дефолту и получение языка
     *
     * @return bool
     */
    public static function lang()
    {
        if (empty(\request()->session()->get('lang'))) {
            request()->session()->put('lang', 'ge');
        }

        return \request()->session()->get('lang');
    }

    /**
     * Установка языка
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setLang(Request $request)
    {
        request()->session()->put('lang', $request->get('lang'));

        return redirect()->back();
    }

    /**
     * Получить язык
     *
     * @return EnumControllerEng|EnumControllerGe|EnumControllerRu
     */
    public static function getEnum()
    {
        self::lang();

        if (\request()->session()->get('lang') == 'ru') {
            $obResult = new EnumControllerRu();
        } elseif (\request()->session()->get('lang') == 'eng') {
            $obResult = new EnumControllerEng();
        } else {
            $obResult = new EnumControllerGe();
        }

        return $obResult;
    }

}
