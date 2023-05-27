<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Projects;
use App\Models\Projects_ge;
use App\Models\Projects_ru;
use App\Models\Projects_en;
use App\Models\ProjectsImg;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /** @var string  */
    const ROUTE_CREATE_PROJECT        = 'api.admin.createProject';

    /** @var string  */
    const ROUTE_PROJECT_UPDATE        = 'api.admin.projectUpdate';

    /** @var string  */
    const ROUTE_PROJECT_DELETE        = 'api.admin.projectDelete';

    /**
     * Добавление нового проекта
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createProject(Request $request)
    {
        $obProjects = new Projects();
        $obProjectsGe = new Projects_ge();
        $obProjectsRu = new Projects_ru();
        $obProjectsEn = new Projects_en();

        if (!empty($request->file())){
            $fileName = time().'_'.$request->file('main_img')->getClientOriginalName();
            $filePath = $request->file('main_img')->storeAs('/uploads', $fileName , 'public');
            $obProjects->main_img = $filePath;

        }
        $obProjects->status         = $request->get('status');
        $obProjects->manager_phone  = $request->get('manager_phone');
        $obProjects->save();

        $iProjectId = $obProjects->id;

        if (!empty($iProjectId)) {
            $obProjectsGe->project_id   = $iProjectId;
            $obProjectsGe->name         = $request->get('name_ge');
            $obProjectsGe->manager      = $request->get('manager_ge');
            $obProjectsGe->address      = $request->get('address_ge');
            $obProjectsGe->description  = $request->get('description_ge');
            $obProjectsGe->save();

            $obProjectsRu->project_id   = $iProjectId;
            $obProjectsRu->name         = $request->get('name_ru');
            $obProjectsRu->manager      = $request->get('manager_ru');
            $obProjectsRu->address      = $request->get('address_ru');
            $obProjectsRu->description  = $request->get('description_ru');
            $obProjectsRu->save();

            $obProjectsEn->project_id   = $iProjectId;
            $obProjectsEn->name         = $request->get('name_ru');
            $obProjectsEn->manager      = $request->get('manager_ru');
            $obProjectsEn->address      = $request->get('address_ru');
            $obProjectsEn->description  = $request->get('description_ru');
            $obProjectsEn->save();
        }

        return redirect()->route(\App\Http\Controllers\ProjectsController::ROUTE_CREATE_PROJECT);
    }

    /**
     * Обновление проекта
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function projectUpdate(Request $request)
    {
        $obProjects = (new Projects())
            ->where('id', (int) $request->get('id'))
            ->first()
        ;

        $fileMainImg = storage_path('app/public/' . $obProjects['main_img']);

        if (!empty($request->file('main_img'))){
            if (file_exists($fileMainImg)) {
                if (!empty($obProjects['main_img'])) {
                    unlink(storage_path('app/public/' . $obProjects['main_img']));
                }
            }
            $fileName = time().'_'.$request->file('main_img')->getClientOriginalName();
            $filePath = $request->file('main_img')->storeAs('/uploads', $fileName , 'public');
            $obProjects->main_img = $filePath;
        }
        $obProjects->status         = $request->get('status');
        $obProjects->manager_phone  = $request->get('manager_phone');
        $obProjects->update();

        $obProjectsGe = (new Projects_ge())
            ->where('project_id', (int) $request->get('id'))
            ->update(
                [
                    'name'          => $request->get('name_ge'),
                    'manager'       => $request->get('manager_ge'),
                    'address'       => $request->get('address_ge'),
                    'description'   => $request->get('description_ge'),
                ]
            )
        ;
        $obProjectsRu = (new Projects_ru())
            ->where('project_id', (int) $request->get('id'))
            ->update(
                [
                    'name'          => $request->get('name_ru'),
                    'manager'       => $request->get('manager_ru'),
                    'address'       => $request->get('address_ru'),
                    'description'   => $request->get('description_ru'),
                ]
            )
        ;
        $obProjectsEn = (new Projects_en())
            ->where('project_id', (int) $request->get('id'))
            ->update(
                [
                    'name'          => $request->get('name_en'),
                    'manager'       => $request->get('manager_en'),
                    'address'       => $request->get('address_en'),
                    'description'   => $request->get('description_en'),
                ]
            )
        ;

        return redirect()->route(\App\Http\Controllers\ProjectsController::ROUTE_PROJECT);
    }

    /**
     * Удаление проека
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function projectDelete($id)
    {
        $obProjects = (new Projects())->where('id', $id)->first();
        if (!empty($obProjects['main_img'])) {
            unlink(storage_path('app/public/' . $obProjects['main_img']));
        }
        $obProjects->delete();
        $obProjectsGe = (new Projects_ge())->where('project_id', $id)->delete();
        $obProjectsRu = (new Projects_ru())->where('project_id', $id)->delete();
        $obProjectsEn = (new Projects_en())->where('project_id', $id)->delete();

        return redirect()->route(\App\Http\Controllers\ProjectsController::ROUTE_PROJECT);
    }

}
