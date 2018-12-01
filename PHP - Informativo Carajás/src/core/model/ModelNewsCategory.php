<?php


class ModelNewsCategory extends dbConnection
{

    private $newsCategoryId;
    private $newsCategoryNickname;
    private $newsCategoryName;
    private $newsCategoryLevel;
    private $newsCategoryParentId;
    private $newsCategoryDateInsert;
    private $newsCategoryDateUpdate;
    
    
    /**
     * @return mixed
     */
    public function getNewsCategoryNickname()
    {
        return $this->newsCategoryNickname;
    }

    /**
     * @param mixed $newsCategoryNickname
     */
    public function setNewsCategoryNickname($newsCategoryNickname)
    {
        $this->newsCategoryNickname = $newsCategoryNickname;
    }
    
    /**
     * @return mixed
     */
    public function getNewsCategoryId()
    {
        return $this->newsCategoryId;
    }

    /**
     * @param mixed $newsCategoryId
     */
    public function setNewsCategoryId($newsCategoryId)
    {
        $this->newsCategoryId = $newsCategoryId;
    }

    /**
     * @return mixed
     */
    public function getNewsCategoryName()
    {
        return $this->newsCategoryName;
    }

    /**
     * @param mixed $newsCategoryName
     */
    public function setNewsCategoryName($newsCategoryName)
    {
        $this->newsCategoryName = $newsCategoryName;
    }

    /**
     * @return mixed
     */
    public function getNewsCategoryLevel()
    {
        return $this->newsCategoryLevel;
    }

    /**
     * @param mixed $newsCategoryLevel
     */
    public function setNewsCategoryLevel($newsCategoryLevel)
    {
        $this->newsCategoryLevel = $newsCategoryLevel;
    }

    /**
     * @return mixed
     */
    public function getNewsCategoryParentId()
    {
        return $this->newsCategoryParentId;
    }

    /**
     * @param mixed $newsCategoryParentId
     */
    public function setNewsCategoryParentId($newsCategoryParentId)
    {
        $this->newsCategoryParentId = $newsCategoryParentId;
    }

    /**
     * @return mixed
     */
    public function getNewsCategoryDateInsert()
    {
        return $this->newsCategoryDateInsert;
    }

    /**
     * @param mixed $newsCategoryDateInsert
     */
    public function setNewsCategoryDateInsert($newsCategoryDateInsert)
    {
        $this->newsCategoryDateInsert = $newsCategoryDateInsert;
    }

    /**
     * @return mixed
     */
    public function getNewsCategoryDateUpdate()
    {
        return $this->newsCategoryDateUpdate;
    }

    /**
     * @param mixed $newsCategoryDateUpdate
     */
    public function setNewsCategoryDateUpdate($newsCategoryDateUpdate)
    {
        $this->newsCategoryDateUpdate = $newsCategoryDateUpdate;
    }


}