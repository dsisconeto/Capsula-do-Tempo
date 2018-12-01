<?php

class ModelNews extends dbConnection
{
    private $newsId;
    private $newsTitle;
    private $newsPost;
    private $newsPreview;
    private $newsKeywords;
    private $newsTagIdFk;
    private $newsLocalId;
    private $newsCover;
    private $newsStatus;
    private $newsNotificationApp;
    private $newsCounterView;
    private $systemUserIdFk;
    private $systemUrlIdFk;
    private $systemUserIdPermissionFk;
    private $newsDateInsert;
    private $newsDateUpdate;
    private $newsOrder;
 
    
    

    /**
     * @return mixed
     */
    public function getNewsLocalId()
    {
        return $this->newsLocalId;
    }

    /**
     * @param mixed $newsLocalId
     */
    public function setNewsLocalId($newsLocalId)
    {
        $this->newsLocalId = $newsLocalId;
    }

    /**
     * @return mixed
     */
    public function getNewsOrder()
    {
        return $this->newsOrder;
    }

    /**
     * @param mixed $newsOrder
     */
    public function setNewsOrder($newsOrder)
    {
        $this->newsOrder = $newsOrder;
    }
    
    /**
     * @return mixed
     */
    public function getSystemUrlIdFk()
    {
        return $this->systemUrlIdFk;
    }

    /**
     * @param mixed $systemUrlIdFk
     */
    public function setSystemUrlIdFk($systemUrlIdFk)
    {
        $this->systemUrlIdFk = intval($systemUrlIdFk);
    }

    /**
     * @return mixed
     */
    public function getNewsId()
    {
        return $this->newsId;
    }

    /**
     * @param mixed $newsId
     */
    public function setNewsId($newsId)
    {
        $this->newsId = $newsId;
    }

    /**
     * @return mixed
     */
    public function getNewsTitle()
    {
        return $this->newsTitle;
    }

    /**
     * @param mixed $newsTitle
     */
    public function setNewsTitle($newsTitle)
    {
        $this->newsTitle = $newsTitle;
    }

    /**
     * @return mixed
     */
    public function getNewsPost()
    {
        return $this->newsPost;
    }

    /**
     * @param mixed $newsPost
     */
    public function setNewsPost($newsPost)
    {
        $this->newsPost = $newsPost;
    }

    /**
     * @return mixed
     */
    public function getNewsPreview()
    {
        return $this->newsPreview;
    }

    /**
     * @param mixed $newsPreview
     */
    public function setNewsPreview($newsPreview)
    {
        $this->newsPreview = $newsPreview;
    }

    /**
     * @return mixed
     */
    public function getNewsKeywords()
    {
        return $this->newsKeywords;
    }

    /**
     * @param mixed $newsKeywords
     */
    public function setNewsKeywords($newsKeywords)
    {
        $this->newsKeywords = $newsKeywords;
    }

    /**
     * @return mixed
     */
    public function getNewsTagIdFk()
    {
        return $this->newsTagIdFk;
    }

    /**
     * @param mixed $newsTagIdFk
     */
    public function setNewsTagIdFk($newsTagIdFk)
    {
        $this->newsTagIdFk = $newsTagIdFk;
    }

    /**
     * @return mixed
     */
    public function getNewsCover()
    {
        return $this->newsCover;
    }

    /**
     * @param mixed $newsCover
     */
    public function setNewsCover($newsCover)
    {
        $this->newsCover = $newsCover;
    }

    /**
     * @return mixed
     */
    public function getNewsStatus()
    {
        return $this->newsStatus;
    }

    /**
     * @param mixed $newsStatus
     */
    public function setNewsStatus($newsStatus)
    {
        $this->newsStatus = $newsStatus;
    }

    /**
     * @return mixed
     */
    public function getNewsNotificationApp()
    {
        return $this->newsNotificationApp;
    }

    /**
     * @param mixed $newsNotificationApp
     */
    public function setNewsNotificationApp($newsNotificationApp)
    {
        $this->newsNotificationApp = $newsNotificationApp;
    }

    /**
     * @return mixed
     */
    public function getNewsCounterView()
    {
        return $this->newsCounterView;
    }

    /**
     * @param mixed $newsCounterView
     */
    public function setNewsCounterView($newsCounterView)
    {
        $this->newsCounterView = $newsCounterView;
    }

    /**
     * @return mixed
     */
    public function getSystemUserIdFk()
    {
        return $this->systemUserIdFk;
    }

    /**
     * @param mixed $systemUserIdFk
     */
    public function setSystemUserIdFk($systemUserIdFk)
    {
        $this->systemUserIdFk = $systemUserIdFk;
    }

    /**
     * @return mixed
     */
    public function getSystemUserIdPermissionFk()
    {
        return $this->systemUserIdPermissionFk;
    }

    /**
     * @param mixed $systemUserIdPermissionFk
     */
    public function setSystemUserIdPermissionFk($systemUserIdPermissionFk)
    {
        $this->systemUserIdPermissionFk = $systemUserIdPermissionFk;
    }

    /**
     * @return mixed
     */
    public function getNewsDateInsert()
    {
        return $this->newsDateInsert;
    }

    /**
     * @param mixed $newsDateInsert
     */
    public function setNewsDateInsert($newsDateInsert)
    {
        $this->newsDateInsert = $newsDateInsert;
    }

    /**
     * @return mixed
     */
    public function getNewsDateUpdate()
    {
        return $this->newsDateUpdate;
    }

    /**
     * @param mixed $newsDateUpdate
     */
    public function setNewsDateUpdate($newsDateUpdate)
    {
        $this->newsDateUpdate = $newsDateUpdate;
    }

}