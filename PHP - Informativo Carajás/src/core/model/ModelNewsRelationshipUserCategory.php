<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 03/04/16
 * Time: 19:49
 */
class ModelNewsRelationshipUserCategory
{

    private $systemUserId;
    private $newsCategoryId;

    /**
     * @return mixed
     */
    public function getSystemUserId()
    {
        return $this->systemUserId;
    }

    /**
     * @param mixed $systemUserId
     */
    public function setSystemUserId($systemUserId)
    {
        $this->systemUserId = $systemUserId;
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
    


}