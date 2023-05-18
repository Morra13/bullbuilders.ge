<?php
namespace App\Http\Controllers;


/**
 * Class DefaultController
 * @package App\Http\Controllers
 */
class DefaultController extends Controller
{
    /** @var string  */
    const ROUTE_LOGOUT = 'logout';

    /** @var string  */
    const ROUTE_REGISTER = 'register';

    /** @var string  */
    const ROUTE_LOGIN = 'login';

    /** @var string  */
    const ROUTE_PASSWORD_CONFIRM = 'password.confirm';

    /** @var string  */
    const ROUTE_PASSWORD_REQUEST = 'password.request';

    /** @var string  */
    const ROUTE_PASSWORD_UPDATE = 'password.update';

    /** @var string  */
    const ROUTE_PASSWORD_EMAIL = 'password.email';
}
