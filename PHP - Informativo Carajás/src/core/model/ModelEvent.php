<?php

/**
 * Created by PhpStorm.
 * User: dejair
 * Date: 03/04/16
 * Time: 17:51
 */
abstract class ModelEvent extends dbConnection
{

    /**
     * @var
     */
    private $id;
    /**
     * @var
     */
    private $name;
    /**
     * @var
     */
    private $description;
    /**
     * @var
     */
    private $eventLocal;
    /**
     * @var
     */
    private $date;
    /**
     * @var
     */
    private $roof;
    /**
     * @var
     */
    private $roofCover;
    /**
     * @var
     */
    private $cover;
    /**
     * @var
     */
    private $category;
    /**
     * @var
     */
    private $address;
    /**
     * @var
     */
    private $addressMaps;
    /**
     * @var
     */
    private $eventStatus;
    /**
     * @var
     */
    private $systemUserId;
    /**
     * @var
     */
    private $url;
    private $systemUrlIdFk;
    /**
     * @var
     */
    private $systemUserIdPermission;
    /**
     * @var
     */
    private $dateInsert;
    /**
     * @var
     */
    private $dateUpdate;
    /**
     * @var
     */
    private $counterView;

    private $session;

    private $region;

    /**
     * @return SystemUrl
     */
    public function url()
    {
        if (!$this->url) {
            $this->url = new SystemUrl();
        }
        return $this->url;
    }

    /**
     * @return GeoRegion
     */
    public function region()
    {
        if (!$this->region) {
            $this->region = new GeoRegion();
        }
        return $this->region;
    }

    /**
     * @param mixed $geoCity
     */

    /**
     * @return mixed
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @param mixed $session
     */
    public function setSession($session)
    {
        $this->session = $session;
    }

    /**
     * @return mixed
     */
    public function getRoofCover()
    {
        return $this->roofCover;
    }

    /**
     * @param mixed $roofCover
     */
    public function setRoofCover($roofCover)
    {
        $this->roofCover = $roofCover;
    }


    /**
     * @return mixed
     */
    public function getRoof()
    {
        return $this->roof;
    }

    /**
     * @param mixed $roof
     */
    public function setRoof($roof)
    {
        $this->roof = $roof;
    }

    /**
     * @return mixed
     */
    public function getCounterView()
    {
        return $this->counterView;
    }

    /**
     * @param mixed $counterView
     */
    public function setCounterView($counterView)
    {
        $this->counterView = $counterView;
    }

    /**
     * @return mixed
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * @param mixed $cover
     */
    public function setCover($cover)
    {
        $this->cover = $cover;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getEventLocal()
    {
        return $this->eventLocal;
    }

    /**
     * @param mixed $eventLocal
     */
    public function setEventLocal($eventLocal)
    {
        $this->eventLocal = $eventLocal;
    }

    /**
     * @return mixed
     */
    public function getDate($addT = false)
    {

        if ($addT) {

            return $this->date = str_replace(" ", "T", $this->date);

        } else {
            return $this->date;
        }

    }

    /**
     * @param mixed $eventDate
     */
    public function setDate($eventDate, $removeT = false)
    {
        if ($removeT) {
            $this->date = str_replace("T", " ", $eventDate);
            if (strlen($this->date) == 16) {

                $this->date .= ":00";
            }


        } else {
            $this->date = $eventDate;
        }
    }

    /**
     * @return EventCategory
     */
    public function category()
    {

        if (!$this->category) {

            $this->category = new EventCategory();
        }

        return $this->category;
    }


    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getAddressMaps()
    {
        return $this->addressMaps;
    }

    /**
     * @param mixed $addressMaps
     */
    public function setAddressMaps($addressMaps)
    {
        $this->addressMaps = $addressMaps;
    }

    /**
     * @return mixed
     */
    public function getEventStatus()
    {
        return $this->eventStatus;
    }

    /**
     * @param mixed $eventStatus
     */
    public function setEventStatus($eventStatus)
    {
        $this->eventStatus = $eventStatus;
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
        $this->systemUserId = $systemUserId;
    }

    /**
     * @return mixed
     */
    public function getSystemUserIdPermission()
    {
        return $this->systemUserIdPermission;
    }

    /**
     * @param mixed $systemUserIdPermission
     */
    public function setSystemUserIdPermission($systemUserIdPermission)
    {
        $this->systemUserIdPermission = $systemUserIdPermission;
    }

    /**
     * @return mixed
     */
    public function getDateInsert()
    {
        return $this->dateInsert;
    }

    /**
     * @param mixed $dateInsert
     */
    public function setDateInsert($dateInsert)
    {
        $this->dateInsert = $dateInsert;
    }

    /**
     * @return mixed
     */
    public function getDateUpdate()
    {
        return $this->dateUpdate;
    }

    /**
     * @param mixed $dateUpdate
     */
    public function setDateUpdate($dateUpdate)
    {
        $this->dateUpdate = $dateUpdate;
    }


}