<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 29/08/16
 * Time: 13:34
 */
class AdminFormLogin extends DjReturnMsg
{

    public function login()
    {
        $this->setMsg("Login Efetuado com sucesso.", true, 1);
        $this->setMsg("Usuário ou senha invalido.", false, 2);
        $this->setMsg("Faltando token do formulario.", false, 3);
        $this->setMsg("Você já esta logado.", true, 4);

        $login = new SystemLogin();

        if (!$login->validateLogIn()) {

            if (DjRequest::post("token") == DjRequest::session("TOKEN_FORM_LOGIN")) {

                $login->logIn(DjRequest::post("login_user"), DjRequest::post("login_password")) ? $this->setReturn(1) : $this->setReturn(2);

            } else {

                $this->setReturn(3);
            }

        } else {

            $this->setReturn(4);

        }


        return $this->getReturn();
    }
}