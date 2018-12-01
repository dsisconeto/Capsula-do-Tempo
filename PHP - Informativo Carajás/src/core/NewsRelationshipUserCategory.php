<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 19/04/16
 * Time: 14:58
 */
sysLoadClass("ActionNewsRelationshipUserCategory");

class NewsRelationshipUserCategory extends ActionNewsRelationshipUserCategory
{


    public function relatedToUser($systemUserId = null)
    {
        $login = SystemLogin::getLogin();
        $cri = new Criteria();

        if ($systemUserId):

            $cri->add(new Filter("system_user_id_fk", "=", $systemUserId));

        else:

            $cri->add(new Filter("system_user_id_fk", "=", $login->getSystemUserId()));

        endif;

        return $this->sqlSelect($cri);
    }


    public function validateRelationship($systemUserId, $newsCategoryId)
    {
        $cri = new Criteria();
        $cri->add(new Filter("system_user_id_fk", "=", $systemUserId));
        $cri->add(new Filter("news_category_id_fk", "=", $newsCategoryId));

        return $this->sqlSelect($cri);
    }


}