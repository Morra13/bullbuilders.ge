<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\Projects_en;
use App\Models\Projects_ge;
use App\Models\Projects_ru;
use App\Models\ProjectsImg;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProjectsController extends Controller
{
    /** @var string  */
    const ROUTE_CREATE_PROJECT        = 'admin.projects.createProject';

    /** @var string  */
    const ROUTE_PROJECT               = 'admin.projects.project';

    /** @var string  */
    const ROUTE_PROJECT_UPDATE        = 'admin.projects.projectUpdate';

    /** @var string  */
    const ROUTE_PROJECT_UPDATE_IMG    = 'admin.projects.projectUpdateImg';

    /**
     * Создать сотрудника
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createProject()
    {
        return view('admin.projects.createProject');
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function project()
    {
        $arProjects = [];

        $obProjects = new Projects_ge();

        if (session()->get('lang') == 'ru') {
            $obProjects = new Projects_ru();
        } elseif (session()->get('lang') == 'en') {
            $obProjects = new Projects_en();
        }

        $iCount = (new Projects())
            ->get()
            ->count();

        $iPage = $_REQUEST['page'] ?? 1;

        if (($iPage - 1) * self::TABLE_ROWS_LIMIT > $iCount) {
            $iPage = 1;
        }

        $arProjectsMain = (new Projects())
            ->skip(($iPage - 1) * self::TABLE_ROWS_LIMIT)
            ->take(self::TABLE_ROWS_LIMIT)
            ->orderByDesc('created_at')
            ->get();

        foreach ($arProjectsMain as $key => $project) {
            $arInfoProjects = $obProjects::all()->where('project_id', $project->id)->first();

            $arProjects [$key] = [
                'id'            => $project->id,
                'status'        => $project->status,
                'main_img'      => $project->main_img,
                'manager_phone' => $project->manager_phone,
                'date_begin'    => $project->date_begin,
                'date_end'      => $project->date_end,
                'name'          => $arInfoProjects['name'],
                'manager'       => $arInfoProjects['manager'],
                'address'       => $arInfoProjects['address'],
                'description'   => $arInfoProjects['description'],
            ];
        }

        return view(
            'admin.projects.project',
            [
                'arProjects'       => $arProjects,
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
     * Страница обновления проекта
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function projectUpdate(int $id)
    {
        $arProjects = [];

        $obProjectsGe = new Projects_ge();
        $obProjectsRu = new Projects_ru();
        $obProjectsEn = new Projects_en();

        $arProjectsMain   = Projects::all()->where('id', $id)->first();
        $arInfoProjectsGe = $obProjectsGe::all()->where('project_id', $arProjectsMain->id)->first();
        $arInfoProjectsRu = $obProjectsRu::all()->where('project_id', $arProjectsMain->id)->first();
        $arInfoProjectsEn = $obProjectsEn::all()->where('project_id', $arProjectsMain->id)->first();

        $arProjects = [
            'ge'    => [
                'id'            => $arProjectsMain->id,
                'status'        => $arProjectsMain->status,
                'main_img'      => $arProjectsMain->main_img,
                'manager_phone' => $arProjectsMain->manager_phone,
                'date_begin'    => $arProjectsMain->date_begin,
                'date_end'      => $arProjectsMain->date_end,
                'name'          => $arInfoProjectsGe['name'],
                'manager'       => $arInfoProjectsGe['manager'],
                'address'       => $arInfoProjectsGe['address'],
                'description'   => $arInfoProjectsGe['description'],
            ],
            'ru'    => [
                'name'          => $arInfoProjectsRu['name'],
                'manager'       => $arInfoProjectsRu['manager'],
                'address'       => $arInfoProjectsRu['address'],
                'description'   => $arInfoProjectsRu['description'],
            ],
            'en'    => [
                'name'          => $arInfoProjectsEn['name'],
                'manager'       => $arInfoProjectsEn['manager'],
                'address'       => $arInfoProjectsEn['address'],
                'description'   => $arInfoProjectsEn['description'],
            ],
        ];

        return view(
            'admin.projects.projectUpdate',
            [
                'arProjects'  => $arProjects,
            ]
        );
    }

    /**
     * Страница обновления дополнительных фото
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function projectUpdateImg(int $id)
    {
        $arProjectsImg = [];

        $obProjectsImg = new ProjectsImg();
        $arProjectsImg = $obProjectsImg::all()->where('project_id', $id);

        return view(
            'admin.projects.projectUpdateImg',
            [
                'id'            => $id,
                'arProjectsImg' => $arProjectsImg,
            ]
        );
    }

}
