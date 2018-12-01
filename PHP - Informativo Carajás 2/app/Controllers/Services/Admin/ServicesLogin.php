<?php

namespace App\Controllers\Services\Admin;

use App\Models\User\Login;
use App\Models\User\User;
use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataBase\SQL\Filter;
use DSisconeto\Simple\Request;

class ServicesLogin
{

    public function __construct()
    {
        Login::validate(Request::cookie("jwt"));
    }

    public function data()
    {
        $col = Request::get("column", "array", array());
        $cri = new Criteria();
        $user = new User();

        $cri->add(new Filter("system_user_id", "=", Login::user()->getId()));
        $cri->setProperty("limit", "1");
        $result = $user->select($cri, $col);

        if ($result) {
            $result = $result[0];

        }
        return $result;
    }


}