<?php

namespace App\Controllers\Forms\Admin;

use App\Models\User\Login;
use DSisconeto\Simple\Form;
use DSisconeto\Simple\Request;

class FormLogin extends Form
{

    public function login()
    {
        $this->setMsg("Login Efetuado com sucesso.", true, 1);
        $this->setMsg("Usuário ou senha invalido.", false, 2);

        $login = Request::post("login_user", "str", "");
        $pass = Request::post("login_password", "str", "");

        $token = Login::logIn($login, $pass);

        if ($token) {

            Request::setCookie("jwt", $token, time() + 86400);
            Request::setCookie("user_name", Login::user()->getName(), time() + 86400);


            $this->setReturn(1);

        } else {
            $this->setReturn(2);
        }

        return $this->getReturn();
    }


    public function validate()
    {
        $this->setMsg("Token Valido", true, 1);
        $this->setMsg("Token Invalido", false, 2);

        $token = Request::post("jwt", "str", "");

        if (Login::validate($token)) {

            $this->setReturn(1);

        } else {
            $this->setReturn(2);
        }

        return $this->getReturn();

    }


}