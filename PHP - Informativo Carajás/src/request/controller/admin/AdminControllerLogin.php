<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 29/08/16
 * Time: 13:18
 */
class AdminControllerLogin extends DjView
{


    public function displayLogin()
    {
        $systemLogin = SystemLogin::getLogin();

        if (!$systemLogin->validateLogIn()):
            // verificando se tem os dados no post para efetuar login

            // caso não tenha dados para fazer login
            // exibir a pagina

            $token = md5(time());
            $this->setDate("token", $token);
            $this->setDate("continue", DjRequest::get("continue", "str", ""));

            DjRequest::setSession("TOKEN_FORM_LOGIN", $token);

            $this->view("admin@login");

        else:
            $this->location("admin/");
        endif;


    }

    public function logOut()
    {
        $systemLogin = SystemLogin::getLogin();

        $systemLogin->logout();

        $this->location("login/");

    }
}