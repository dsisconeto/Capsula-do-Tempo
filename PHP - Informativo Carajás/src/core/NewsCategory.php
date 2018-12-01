<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 18/04/16
 * Time: 14:53
 */

sysLoadClass("ActionNewsCategory");

class NewsCategory extends ActionNewsCategory
{


    public function __construct()
    {
        $this->setMsg("Não existe a Categoria selecionada", false, 1);
        $this->setMsg("Categorua existe", true, 2);


    }

    public function selectAllByName()
    {
        $cri = new Criteria();
        $cri->setProperty("order", "news_category_name ASC");
        return $this->sqlSelect($cri);
    }

    public function issetCategory($newsCategoryId)
    {

        $cri = new Criteria();
        $cri->add(new Filter("news_category_id", "=", $newsCategoryId));

        if ($this->sqlSelect($cri)):
            $this->setReturn(2);
        else:
            $this->setReturn(1);
        endif;

        return $this->getReturn();

    }


}