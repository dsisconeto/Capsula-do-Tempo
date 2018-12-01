<?php
sysLoadClass("ActionSystemUser");
sysLoadClass("SystemLogin");


class SystemUser extends ActionSystemUser
{


    public function __construct()
    {

        $this->setImgFolder("sys-avatar");
        $this->setMsg("O usuario não está logado, ou não tem permissão", false, 1);


    }


    public function issetLogin($login)
    {
        $this->setSystemUserLogin($login);
        $options = sprintf("AND system_user_login = md5('%s')", $this->getSystemUserLogin());
        return $this->sqlLoad($options);
    }

    public function lastId()
    {

        $options = "ORDER BY system_user_id DESC LIMIT 1";
        $res = $this->sqlLoad($options);
        return $this->sqlLoad($res[0]["system_user_id"]);
    }

    public function validateUserManager($userId)
    {

        $login =  SystemLogin::getLogin();
        $cri = new Criteria();
        if ($userId == $login->getSystemUserId()) {

            $cri->add(new Filter("system_user_id", "=", $login->getSystemUserId()));

        } else {

            $cri->add(new Filter("system_user_id_register", "=", $login->getSystemUserId()));

        }

        $col[] = "system_user_id";

        return boolval($this->sqlSelect($cri, $col));
    }


}
