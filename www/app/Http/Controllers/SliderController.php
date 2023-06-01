<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /** @var string  */
    const ROUTE_CREATE_SLIDER       = 'admin.slider.createSlider';

    /** @var string  */
    const ROUTE_SLIDER              = 'admin.slider.slider';

    /** @var string  */
    const ROUTE_UPDATE_SLIDER       = 'admin.slider.updateSlider';

    /**
     * Создать слайдер
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createSlider()
    {
        return view('admin.slider.createSlider');
    }

    /**
     * Страница слайдеров
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function slider()
    {
        $arSliders = [];

        $iCount = (new Slider())
            ->get()
            ->count();

        $iPage = $_REQUEST['page'] ?? 1;

        if (($iPage - 1) * self::TABLE_ROWS_LIMIT > $iCount) {
            $iPage = 1;
        }

        $arSliders = (new Slider())
            ->skip(($iPage - 1) * self::TABLE_ROWS_LIMIT)
            ->take(self::TABLE_ROWS_LIMIT)
            ->orderByDesc('created_at')
            ->get();

        return view(
            'admin.slider.slider',
            [
                'arSliders'    => $arSliders,
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
     * Обновление слайдера
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function updateSlider(int $id)
    {
        $arSlider = [];

        $obSlider = Slider::all()->where('id', $id)->first();

        $arSlider = [
            'ge'    => [
                'id'            => $obSlider->id,
                'main_img'      => $obSlider->main_img,
                'subtitle'      => $obSlider['subtitle_ge'],
                'title'         => $obSlider['title_ge'],
            ],
            'ru'    => [
                'subtitle'      => $obSlider['subtitle_ru'],
                'title'         => $obSlider['title_ru'],
            ],
            'en'    => [
                'subtitle'      => $obSlider['subtitle_en'],
                'title'         => $obSlider['title_en'],
            ],
        ];

        return view(
            'admin.slider.updateSlider',
            [
                'arSlider'  => $arSlider,
            ]
        );
    }

}
