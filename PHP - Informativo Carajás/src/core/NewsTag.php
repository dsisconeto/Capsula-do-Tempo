<?php

/**
 * Created by PhpStorm.
 * User: Dejair Sisconeto
 * Date: 20/05/2016
 * Time: 13:22
 */
sysLoadClass("ActionNewsTag");
sysLoadClass("NewsRelationshipUserCategory");

class NewsTag extends ActionNewsTag
{


    public function __construct()
    {
    }


    public function selectByCategory($newsCategoryId)
    {


        $newsTag = new NewsTag();
        $cri = new Criteria();
        $cri->add(new Filter("news_category_id_fk", "=", $newsCategoryId));
        $cri->setProperty("order", "news_tag_name ASC");


        return $newsTag->sqlSelect($cri);
    }
    public function issetTagId($newsTagId){

        $cri = new Criteria();
        $cri->add(new Filter("news_tag_id", "=", $newsTagId));
        $col[] = "news_tag_id";
       return boolval($this->sqlSelect($cri, $col));
    }

    public function issetTagByCategory($name, $newsCategoryId)
    {
        $cri = new Criteria();
        $cri->add(new Filter("news_tag_name", "=", $name));
        $cri->add(new Filter("news_category_id_fk", "=", $newsCategoryId));
        $cri->add(new Filter("news_tag_nickname", "=", $this->standardizeUrl($name)), Criteria::OR_OPERATOR);
        $this->sqlSelect($cri);
    }


    public function validateUser($newsCategoryId)
    {


        $category = new NewsRelationshipUserCategory();
        $login = SystemLogin::getLogin();

        if ($category->validateRelationship($login->getSystemUserId(), $newsCategoryId) && $login->validateLogIn() && $login->getSystemUserPermissionNewsCategory()):

            return true;

        else:
            return false;
        endif;


    }


}