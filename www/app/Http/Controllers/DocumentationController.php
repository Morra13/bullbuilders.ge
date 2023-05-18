<?php
namespace App\Http\Controllers;

/**
 * Class DocumentationController
 * @package App\Http\Controllers
 */
class DocumentationController extends Controller
{
    /** @var string  */
    const ROUTE_HOW_IT_WORK = 'documentation.how.its.work';

    /** @var string  */
    const ROUTE_POLICY      = 'documentation.policy';

    /**
     * How its work page
     * @return mixed
     */
    public function howItWork()
    {
        return view('documentation.how-it-work');
    }

    /**
     * Policy page
     * @return mixed
     */
    public function policy()
    {
        return view('documentation.policy');
    }
}
