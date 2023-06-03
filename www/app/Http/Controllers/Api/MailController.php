<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    /** @var string  */
    const ROUTE_SEND_MAIL = 'api.sendMail';

    /**
     * Отправка сообщения
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendMail(Request $request)
    {
        $date = [
            'name'      => $request->get('name'),
            'email'     => $request->get('email'),
            'theme'     => $request->get('theme'),
            'message'   => $request->get('message'),
        ];

        Mail::to('bullbuilders.ge@gmail.com')->send(new SendMail($date));

        return redirect()->back();
    }
}
