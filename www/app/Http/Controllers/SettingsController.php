<?php
namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * Class SettingsController
 * @package App\Http\Controllers
 */
class SettingsController extends Controller
{
    /** @var string  */
    const ROUTE_ADMIN_INDEX    = 'settings.admin.index';

    /**
     * Settings index page
     * @return View|Factory
     */
    public function adminIndex()
    {
        return view(
            'settings.admin.index',
            [
                'commission' => Settings::getCommission()
            ]
        );
    }
}
