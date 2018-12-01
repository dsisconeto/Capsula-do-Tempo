<?php

/**
 * Created by PhpStorm.
 * User: Dejair Sisconeto
 * Date: 20/05/2016
 * Time: 13:15
 */
class ModelNewsTag extends dbConnection
{
    private $newsTagId;
    private $newsTagNickname;
    private $newsCategoryIdFk;
    private $newsTagName;

    /**
     * @return mixed
     */
    public function getNewsTagNickname()
    {
        return $this->newsTagNickname;
    }

    /**
     * @param mixed $newsTagNickname
     */
    public function setNewsTagNickname($newsTagNickname)
    {
        $this->newsTagNickname = $newsTagNickname;
    }

    
    /**
     * @return mixed
     */
    public function getNewsTagId()
    {
        return $this->newsTagId;
    }

    /**
     * @param mixed $newsTagId
     */
    public function setNewsTagId($newsTagId)
    {
        $this->newsTagId = $newsTagId;
    }

    /**
     * @return mixed
     */
    public function getNewsCategoryIdFk()
    {
        return $this->newsCategoryIdFk;
    }

    /**
     * @param mixed $newsCategoryIdFk
     */
    public function setNewsCategoryIdFk($newsCategoryIdFk)
    {
        $this->newsCategoryIdFk = $newsCategoryIdFk;
    }

    /**
     * @return mixed
     */
    public function getNewsTagName()
    {
        return $this->newsTagName;
    }

    /**
     * @param mixed $newsTagName
     */
    public function setNewsTagName($newsTagName)
    {
        $this->newsTagName = $newsTagName;
    }


}