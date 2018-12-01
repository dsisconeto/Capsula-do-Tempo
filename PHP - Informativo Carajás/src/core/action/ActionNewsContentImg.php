<?php

/**
 * Created by PhpStorm.
 * User: Dejair Sisconeto
 * Date: 17/05/2016
 * Time: 20:57
 */
sysLoadClass("ModelNewsContentImg");

class ActionNewsContentImg extends ModelNewsContentImg
{

    public function sqlInsert()
    {
        $sql = new SqlInsert();
        $sql->setEntity("news_content_img");

        $sql->setRowData("news_content_img_id", $this->getNewsContentImgId());
        $sql->setRowData("system_user_id_fk", $this->getSystemUserIdFk());
        $sql->setRowData("news_content_img_file", $this->getNewsContentImgFile());
        $sql->setRowData("news_content_img_date_insert", $this->currentTime());
        return $this->runQuery($sql);
    }


    public function sqlDelete()
    {
        $sql = new SqlDelete();
        $sql->setEntity("news_content_img");
        $cri = new Criteria();
        $cri->add(New Filter("news_content_img_id", "=", $this->getNewsContentImgId()));
        $sql->setCriteria($cri);
        return $this->runQuery($sql);

    }

    public function sqlSelect($criteria = null, $col = false)
    {
        $sql = new SqlSelect();
        $sql->setEntity("news_content_img");
        $sql->addColumn($col);

        if ($criteria):
            $sql->setCriteria($criteria);
        endif;

        return $this->runSelect($sql);
    }

    public function sqlLoad($newsContentImgId)
    {
        $criteria = new Criteria();
        $criteria->add(New Filter('news_content_img_id', '=', $newsContentImgId));
        $criteria->setProperty("limit", 1);
        $res = $this->sqlSelect($criteria);
        if ($res):
            $res = $res[0];
            $this->setNewsContentImgId($res["news_content_img_id"]);
            $this->setSystemUserIdFk($res["system_user_id_fk"]);
            $this->setNewsContentImgFile($res["news_content_img_file"]);
            $this->setNewsContentImgDateInsert($res["news_content_img_date_insert"]);
        endif;

        return $res;
    }


}