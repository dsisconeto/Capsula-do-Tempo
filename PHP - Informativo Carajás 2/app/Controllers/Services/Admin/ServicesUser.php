<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 11/05/17
 * Time: 16:57
 */

namespace App\Controllers\Services\Admin;


use App\Models\User\Login;
use DSisconeto\Simple\Request;

class ServicesUser
{


    public function __construct()
    {

        Login::validate(Request::cookie("jwt"));

    }




}