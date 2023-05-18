<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class SettingsController
 * @package App\Http\Api\Controllers
 */
class SettingsController extends Controller
{
    /** @var string  */
    const ROUTE_UPDATE     = 'api.settings.update';

    /**
     * Update
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'commission' => 'required|numeric',
        ]);

        Settings::setCommission($request->get('commission'), 0);

        return back();
    }
}
