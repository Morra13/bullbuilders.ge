<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /** @var string  */
    const ROUTE_CREATE_SLIDER        = 'api.admin.createSlider';

    /** @var string  */
    const ROUTE_UPDATE_SLIDER        = 'api.admin.updateSlider';

    /** @var string  */
    const ROUTE_DELETE_SLIDER        = 'api.admin.deleteSlider';

    /**
     * Добавление нового слайдера
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createSlider(Request $request)
    {
        $obSlider = new Slider();

        if (!empty($request->file())){
            $fileName = time().'_'.$request->file('main_img')->getClientOriginalName();
            $filePath = $request->file('main_img')->storeAs('/uploads', $fileName , 'public');
            $obSlider->main_img = $filePath;
        }
        $obSlider->subtitle_ge  = $request->get('subtitle_ge');
        $obSlider->title_ge     = $request->get('title_ge');
        $obSlider->subtitle_ru  = $request->get('subtitle_ru');
        $obSlider->title_ru     = $request->get('title_ru');
        $obSlider->subtitle_en  = $request->get('subtitle_en');
        $obSlider->title_en     = $request->get('title_en');
        $obSlider->save();

        return redirect()->route(\App\Http\Controllers\SliderController::ROUTE_CREATE_SLIDER);
    }

    /**
     * Обновление слайдера
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSlider(Request $request)
    {
        $obSlider = (new Slider())
            ->where('id', (int) $request->get('id'))
            ->first()
        ;

        $fileMainImg = storage_path('app/public/' . $obSlider['main_img']);

        if (!empty($request->file('main_img'))){
            if (file_exists($fileMainImg)) {
                if (!empty($obSlider['main_img'])) {
                    unlink(storage_path('app/public/' . $obSlider['main_img']));
                }
            }
            $fileName = time().'_'.$request->file('main_img')->getClientOriginalName();
            $filePath = $request->file('main_img')->storeAs('/uploads', $fileName , 'public');
            $obSlider->main_img = $filePath;
        }
        $obSlider->subtitle_ge  = $request->get('subtitle_ge');
        $obSlider->title_ge     = $request->get('title_ge');
        $obSlider->subtitle_ru  = $request->get('subtitle_ru');
        $obSlider->title_ru     = $request->get('title_ru');
        $obSlider->subtitle_en  = $request->get('subtitle_en');
        $obSlider->title_en     = $request->get('title_en');
        $obSlider->update();

        return redirect()->route(\App\Http\Controllers\SliderController::ROUTE_SLIDER);
    }

    /**
     * Удаление слйдера
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteSlider($id)
    {
        $obSlider = (new Slider())->where('id', $id)->first();
        if (!empty($obSlider['main_img'])) {
            unlink(storage_path('app/public/' . $obSlider['main_img']));
        }
        $obSlider->delete();

        return redirect()->route(\App\Http\Controllers\SliderController::ROUTE_SLIDER);
    }

}
