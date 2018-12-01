<?php


class ModelSystemUser extends dbConnection
{
    private $systemUserId;
    private $partnerId;
    private $systemUserName;
    private $systemUserEmail;
    private $systemUserLogin;
    private $systemUserPassword;
    private $systemUserPhoneNumber;
    private $systemUserProfilePhoto;
    private $systemUserDescription;
    private $systemUserPermissionAds;
    private $systemUserPermissionEvent;
    private $systemUserPermissionEventCategory;
    private $systemUserPermissionEventSuper;
    private $systemUserPermissionNews;
    private $systemUserPermissionNewsCategory;
    private $systemUserPermissionNewsSuper;
    private $systemUserPermissionGeo;
    private $systemUserPermissionCompany;
    private $systemUserPermissionPartner;
    private $systemUserPermissionPartnerRegion;
    private $systemUserPermissionUserRegister;
    private $systemUserPermissionNewspaper;
    private $systemUserStatus;
    private $systemUserDateInsert;
    private $systemUserDateUpdate;
    private $systemUserIdRegister;
    private $systemUserCompany;

    /**
     * @return mixed
     */
    public function getSystemUserCompany()
    {
        return $this->systemUserCompany;
    }

    /**
     * @param mixed $systemUserCompany
     */
    public function setSystemUserCompany($systemUserCompany)
    {
        $this->systemUserCompany = DjDataFilter::filter($systemUserCompany, array("type" => "int"));
    }


    /**
     * @return mixed
     */
    public function getSystemUserIdRegister()
    {
        return $this->systemUserIdRegister;
    }

    /**
     * @param mixed $systemUserIdRegister
     */
    public function setSystemUserIdRegister($systemUserIdRegister)
    {
        $this->systemUserIdRegister = DjDataFilter::filter($systemUserIdRegister, array("type" => "int"));

    }

    /**
     * @return mixed
     */
    public function getSystemUserPermissionNewspaper()
    {
        return $this->systemUserPermissionNewspaper;
    }

    /**
     * @param mixed $systemUserPermissionNewspaper
     */
    public function setSystemUserPermissionNewspaper($systemUserPermissionNewspaper)
    {
        $this->systemUserPermissionNewspaper = DjDataFilter::filter($systemUserPermissionNewspaper, array("type" => "int"));
    }


    /**
     * @return mixed
     */
    public function getSystemUserPermissionPartnerRegion()
    {
        return $this->systemUserPermissionPartnerRegion;
    }

    /**
     * @param mixed $systemUserPermissionPartnerRegion
     */
    public function setSystemUserPermissionPartnerRegion($systemUserPermissionPartnerRegion)
    {
        $this->systemUserPermissionPartnerRegion = DjDataFilter::filter($systemUserPermissionPartnerRegion, array("type" => "int"));
    }

    /**
     * @return mixed
     */
    public function getSystemUserPermissionCompany()
    {
        return $this->systemUserPermissionCompany;
    }

    /**
     * @param mixed $systemUserPermissionCompany
     */
    public function setSystemUserPermissionCompany($systemUserPermissionCompany)
    {
        $this->systemUserPermissionCompany = $systemUserPermissionCompany;
    }

    /**
     * @return mixed
     */
    public function getSystemUserPermissionEventSuper()
    {
        return $this->systemUserPermissionEventSuper;
    }

    /**
     * @param mixed $systemUserPermissionEventSuper
     */
    public function setSystemUserPermissionEventSuper($systemUserPermissionEventSuper)
    {
        $this->systemUserPermissionEventSuper = $systemUserPermissionEventSuper;
    }

    /**
     * @return mixed
     */
    public function getSystemUserPermissionAds()
    {
        return $this->systemUserPermissionAds;
    }

    /**
     * @param mixed $systemUserPermissionAds
     */
    public function setSystemUserPermissionAds($systemUserPermissionAds)
    {
        $this->systemUserPermissionAds = DjDataFilter::filter($systemUserPermissionAds, array("type" => "int"));
    }

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
        $this->systemUserId = DjDataFilter::filter($systemUserId, array("type" => "int"));
    }

    /**
     * @return mixed
     */
    public function getPartnerId()
    {
        return $this->partnerId;
    }

    /**
     * @param mixed $partnerId
     */
    public function setPartnerId($partnerId)
    {
        $this->partnerId = DjDataFilter::filter($partnerId, array("type" => "int"));
    }

    /**
     * @return mixed
     */
    public function getSystemUserName()
    {
        return $this->systemUserName;
    }

    /**
     * @param mixed $systemUserName
     */
    public function setSystemUserName($systemUserName)
    {
        $this->systemUserName = DjDataFilter::filter($systemUserName, array("type" => "string", "max" => 50));
    }

    /**
     * @return mixed
     */
    public function getSystemUserEmail()
    {
        return $this->systemUserEmail;
    }

    /**
     * @param mixed $systemUserEmail
     */
    public function setSystemUserEmail($systemUserEmail)
    {

        $this->systemUserEmail = DjDataFilter::filter($systemUserEmail, array("type" => "string", "max" => 300));

    }

    /**
     * @return mixed
     */
    public function getSystemUserLogin()
    {
        return $this->systemUserLogin;
    }

    /**
     * @param mixed $systemUserLogin
     */
    public function setSystemUserLogin($systemUserLogin)
    {
        $this->systemUserLogin = DjDataFilter::filter($systemUserLogin, array("type" => "string", "tags" => false, "slashes" => false, "max" => 300));
    }

    /**
     * @return mixed
     */
    public function getSystemUserPassword()
    {
        return $this->systemUserPassword;
    }

    /**
     * @param mixed $systemUserPassword
     */
    public function setSystemUserPassword($systemUserPassword)
    {
        $this->systemUserPassword = DjDataFilter::filter($systemUserPassword, array("type" => "string", "tags" => false, "slashes" => false, "max" => 300));
    }

    /**
     * @return mixed
     */
    public function getSystemUserPhoneNumber()
    {
        return $this->systemUserPhoneNumber;
    }

    /**
     * @param mixed $systemUserPhoneNumber
     */
    public function setSystemUserPhoneNumber($systemUserPhoneNumber)
    {
        $this->systemUserPhoneNumber = DjDataFilter::filter($systemUserPhoneNumber, array("type" => "string", "max" => 15));
    }

    /**
     * @return mixed
     */
    public function getSystemUserProfilePhoto()
    {

            return $this->systemUserProfilePhoto;


    }

    /**
     * @param mixed $systemUserProfilePhoto
     */
    public function setSystemUserProfilePhoto($systemUserProfilePhoto)
    {
        $this->systemUserProfilePhoto = DjDataFilter::filter($systemUserProfilePhoto, array("type" => "string", "max" => 300));
    }

    /**
     * @return mixed
     */
    public function getSystemUserDescription()
    {
        return $this->systemUserDescription;
    }

    /**
     * @param mixed $systemUserDescription
     */
    public function setSystemUserDescription($systemUserDescription)
    {
        $this->systemUserDescription = DjDataFilter::filter($systemUserDescription, array("type" => "string", "max" => 600));
    }

    /**
     * @return mixed
     */
    public function getSystemUserStatus()
    {
        return $this->systemUserStatus;
    }

    /**
     * @param mixed $systemUserStatus
     */
    public function setSystemUserStatus($systemUserStatus)
    {
        $this->systemUserStatus = DjDataFilter::filter($systemUserStatus, array("type" => "int"));
    }

    /**
     * @return mixed
     */
    public function getSystemUserPermissionEvent()
    {
        return $this->systemUserPermissionEvent;
    }

    /**
     * @param mixed $systemUserPermissionEvent
     */
    public function setSystemUserPermissionEvent($systemUserPermissionEvent)
    {
        $this->systemUserPermissionEvent = DjDataFilter::filter($systemUserPermissionEvent, array("type" => "int"));
    }

    /**
     * @return mixed
     */
    public function getSystemUserPermissionEventCategory()
    {
        return $this->systemUserPermissionEventCategory;
    }

    /**
     * @param mixed $systemUserPermissionEventCategory
     */
    public function setSystemUserPermissionEventCategory($systemUserPermissionEventCategory)
    {
        $this->systemUserPermissionEventCategory = DjDataFilter::filter($systemUserPermissionEventCategory, array("type" => "int"));
    }

    /**
     * @return mixed
     */
    public function getSystemUserPermissionNews()
    {
        return $this->systemUserPermissionNews;
    }

    /**
     * @param mixed $systemUserPermissionNews
     */
    public function setSystemUserPermissionNews($systemUserPermissionNews)
    {


        $this->systemUserPermissionNews = DjDataFilter::filter($systemUserPermissionNews, array("type" => "int"));

    }

    /**
     * @return mixed
     */
    public function getSystemUserPermissionNewsCategory()
    {
        return $this->systemUserPermissionNewsCategory;
    }

    /**
     * @param mixed $systemUserPermissionNewsCategory
     */
    public function setSystemUserPermissionNewsCategory($systemUserPermissionNewsCategory)
    {
        $this->systemUserPermissionNewsCategory = DjDataFilter::filter($systemUserPermissionNewsCategory, array("type" => "int"));
    }

    /**
     * @return mixed
     */
    public function getSystemUserPermissionNewsSuper()
    {
        return $this->systemUserPermissionNewsSuper;
    }

    /**
     * @param mixed $systemUserPermissionNewsSuper
     */
    public function setSystemUserPermissionNewsSuper($systemUserPermissionNewsSuper)
    {
        $this->systemUserPermissionNewsSuper = DjDataFilter::filter($systemUserPermissionNewsSuper, array("type" => "int"));
    }


    /**
     * @return mixed
     */
    public function getSystemUserPermissionGeo()
    {
        return $this->systemUserPermissionGeo;
    }

    /**
     * @param mixed $systemUserPermissionGeo
     */
    public function setSystemUserPermissionGeo($systemUserPermissionGeo)
    {
        $this->systemUserPermissionGeo = DjDataFilter::filter($systemUserPermissionGeo, array("type" => "int"));
    }

    /**
     * @return mixed
     */
    public function getSystemUserPermissionPartner()
    {
        return $this->systemUserPermissionPartner;
    }

    /**
     * @param mixed $systemUserPermissionPartner
     */
    public function setSystemUserPermissionPartner($systemUserPermissionPartner)
    {
        $this->systemUserPermissionPartner = DjDataFilter::filter($systemUserPermissionPartner, array("type" => "int"));
    }

    /**
     * @return mixed
     */
    public function getSystemUserPermissionUserRegister()
    {
        return $this->systemUserPermissionUserRegister;
    }

    /**
     * @param mixed $systemUserPermissionUserRegister
     */
    public function setSystemUserPermissionUserRegister($systemUserPermissionUserRegister)
    {
        $this->systemUserPermissionUserRegister = DjDataFilter::filter($systemUserPermissionUserRegister, array("type" => "int"));
    }

    /**
     * @return mixed
     */
    public function getSystemUserDateInsert()
    {
        return $this->systemUserDateInsert;
    }

    /**
     * @param mixed $systemUserDateInsert
     */
    public function setSystemUserDateInsert($systemUserDateInsert)
    {
        $this->systemUserDateInsert = DjDataFilter::filter($systemUserDateInsert, array("type" => "date"));
    }

    /**
     * @return mixed
     */
    public function getSystemUserDateUpdate()
    {
        return $this->systemUserDateUpdate;
    }

    /**
     * @param mixed $systemUserDateUpdate
     */
    public function setSystemUserDateUpdate($systemUserDateUpdate)
    {
        $this->systemUserDateUpdate = DjDataFilter::filter($systemUserDateUpdate, array("type" => "date"));
    }


}