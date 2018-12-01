<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 31/08/16
 * Time: 19:21
 */

sysLoadClass("NewsContentImg");

class AdminServicesNewsContentImg
{


    public function selectByUser()
    {
        $newsImg = new NewsContentImg();
        $login = SystemLogin::getLogin();

        if ($login->validateLogIn() && $login->getSystemUserPermissionNews()) {

            $cri = new Criteria();
            $cri->setProperty("order", "news_content_img_id DESC");
            $cri->setProperty("limit", 8);
            $cri->add(New Filter("system_user_id_fk", "=", $login->getSystemUserId()));

            return $newsImg->sqlSelect($cri);


        } else {

            return false;

        }


    }

}