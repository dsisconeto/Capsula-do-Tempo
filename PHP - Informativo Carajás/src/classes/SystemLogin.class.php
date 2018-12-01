<?php

sysLoadClass("SystemUser");

class SystemLogin extends SystemUser
{

    private static $login;
    private static $validate;

    public function __construct()
    {
        $this->setImgFolder("systemUserProfilePhoto");
        // validateLogin
        $this->setMsg("Usuario logado", true, 1);
        $this->setMsg("Usuario não logado", false, 2);

        // LogIn
        $this->setMsg("LogIn efetuado com sucesso", true, 3);
        $this->setMsg("Erro ao fazer login, verifique a senha e o usuario e tente novamente", false, 4);

        // logOut
        $this->setMsg("LogOut efetuado com sucesso", false, 6);

        $this->loadData();
    }


    public function logIn($login, $password)
    {

        $cri = new Criteria();
        // criando criterios de login
        $cri->add(new Filter("system_user_login", "=", md5($login)));
        $cri->add(new Filter("system_user_password", "=", md5($password)));
        $cri->add(new Filter("system_user_status", "=", 1));
        $cri->setProperty("limit", 1);
        $res = $this->sqlSelect($cri);
        if ($res):

            $res = $res[0];
            $this->sqlLoad($res["system_user_id"]);
            /// criando session com id do usuario
            $_SESSION["SYSTEM_USER_ID"] = $this->getSystemUserId();
            $_SESSION["SYSTEM_USER_NAME"] = $this->getSystemUserName();
            // criando seção unica

            return true;
        else:

            $this->logout();
            return false;
        endif;


    }


    public function validateLogIn()
    {
        return self::$validate;
    }


    public static function validate()
    {

        return self::$validate;
    }


    public function loadData()

    {
        if (isset($_SESSION["SYSTEM_USER_ID"])):

            if (!$this->getValidate()):
                $cri = new Criteria();
                $cri->add(New Filter("system_user_id", "=", $_SESSION["SYSTEM_USER_ID"]));
                $cri->add(New Filter("system_user_status", "=", 1));


                $cri->setProperty("limit", 1);

                $res = $this->sqlSelect($cri);


                if ($res):

                    $this->sqlLoad($res[0]["system_user_id"]) ? $this->setValidate(true) : $this->setValidate(false);

                else:

                    $this->setValidate(FALSE);
                endif;

            endif;
        else:

            $this->setValidate(FALSE);
            return false;
        endif;


    }


    public function logout()
    {

        if (isset($_SESSION["SYSTEM_USER_ID"])):
            unset($_SESSION["SYSTEM_USER_ID"]);
        endif;

        if (isset($_SESSION["SYSTEM_USER_NAME"])):
            unset($_SESSION["SYSTEM_USER_NAME"]);
        endif;

        $this->setValidate(FALSE);

        $this->setReturn(6);


        return $this->getReturn();
    }


    public static function getLogin()
    {
        if (is_null(self::$login)):
            self::$login = new SystemLogin();
            return self::$login;
        else:
            return self::$login;
        endif;
    }


    /**
     * @return mixed
     */
    private function setValidate($validate)
    {
        self::$validate = $validate;
    }

    private static function getValidate()
    {
        return self::$validate;
    }


}
