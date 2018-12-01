<?php

/**
 * Created by PhpStorm.
 * User: Dejair Sisconeto
 * Date: 17/05/2016
 * Time: 21:07
 */
sysLoadClass("ActionNewsContentImg");

class NewsContentImg extends ActionNewsContentImg
{
    public function __construct()
    {
        $this->setImgFolder("news_content");


    }


    public function selectByUser()
    {
        $login = SystemLogin::getLogin();
        if ($login->validateLogIn() && $login->getSystemUserPermissionNews()):

            $cri = new Criteria();
            $cri->setProperty("order", "news_content_img_id DESC");
            $cri->add(New Filter("system_user_id_fk", "=", $login->getSystemUserId()));

            return $this->sqlSelect($cri);
        else:
            return false;
        endif;

    }


    public function validateUser($newsContentImgId)
    {
        $login = SystemLogin::getLogin();
        $this->sqlLoad($newsContentImgId);

        if ($login->validateLogIn() && $login->getSystemUserId() == $this->getSystemUserIdFk()):
            return true;
        else:
            return false;
        endif;


    }


}