<?php

namespace App\Models\User;


use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\GetData;
use DSisconeto\Simple\Model;

class User extends Model
{
    private $id;
    private $name;
    private $email;
    private $login;
    private $password;
    private $phoneNumber;
    private $profilePhoto;
    private $description;
    private $status;
    private $dateInsert;
    private $dateUpdate;
    private $userRegister;
    private $userCompany;
    private $permission;
    private $permissionNumber = 12;


    public function __construct()
    {
        $this->setTable("system_user");
        $this->setPrimaryKey("system_user_id");
        $this->setImgFolder("sys-avatar");

    }


    public function register()
    {
        $sql = $this->sqlInsert();
        $sql->setRowData("system_user_name", $this->getName());
        $sql->setRowData("system_user_email", $this->getEmail());
        $sql->setRowData("system_user_login", md5($this->getLogin()));
        $sql->setRowData("system_user_password", md5($this->getPassword()));
        $sql->setRowData("system_user_phone_number", $this->getPhoneNumber());
        $sql->setRowData("system_user_description", $this->getDescription());
        for ($i = 1; $i <= $this->permissionNumber; $i++) {
            $sql->setRowData("permission_$i", $this->getPermission($i));
        }
        $sql->setRowData("system_user_id_register", $this->getUserRegister());
        $sql->setRowData("system_user_status", $this->getStatus());
        $sql->setRowData("system_user_date_insert", GetData::getCurrentTime());
        $sql->setRowData("system_user_id_register", $this->getUserRegister());
        return $sql->execute();
    }


    public function edit()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter($this->getPrimaryKey(), '=', $this->getId()));


        $sql->setRowData("system_user_name", $this->getName());
        $sql->setRowData("system_user_email", $this->getEmail());
        $sql->setRowData("system_user_phone_number", $this->getPhoneNumber());
        $sql->setRowData("system_user_description", $this->getDescription());

        for ($i = 1; $i <= $this->permissionNumber; $i++) {
            $sql->setRowData("permission_$i", $this->getPermission($i));
        }

        $sql->setRowData("system_user_status", $this->getStatus());
        $sql->setRowData("system_user_date_update", GetData::getCurrentTime());


        $sql->setCriteria($criteria);
        return $sql->execute();
    }


    public function editPhoto()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $criteria->add($this->filter('system_user_id', '=', $this->getId()));
        $sql->setRowData("system_user_profile_photo", $this->getProfilePhoto());
        $sql->setRowData("system_user_date_update", GetData::getCurrentTime());
        $sql->setCriteria($criteria);
        return $sql->execute();
    }


    public function editPassword()
    {

        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();

        $criteria->add($this->filter('system_user_id', '=', $this->getId()));

        $sql->setRowData("system_user_password", md5($this->getPassword()));
        $sql->setRowData("system_user_date_update", GetData::getCurrentTime());

        $sql->setCriteria($criteria);

        return $sql->execute();

    }


    public function editLogin()
    {

        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $sql->setEntity('system_user');

        $criteria->add($this->filter('system_user_id', '=', $this->getId()));

        $sql->setRowData("system_user_login", md5($this->getLogin()));
        $sql->setRowData("system_user_date_update", GetData::getCurrentTime());

        $sql->setCriteria($criteria);

        return $sql->execute();

    }


    public function select($criteria = NULL, $col = NULL)
    {
        $sql = $this->sqlSelect();

        $col ? $sql->addColumn($col) : $sql->addColumn("*");
        $criteria ? $sql->setCriteria($criteria) : NULL;


        return $sql->execute();
    }


    public function load($id)
    {
        $this->setId($id);
        $res = $this->selectPrimaryKey();
        if ($res) {
            $res = $res[0];
            // carregar dados

            $this->setId($res["system_user_id"]);

            $this->setName($res["system_user_name"]);
            $this->setEmail($res["system_user_email"]);
            $this->setLogin($res["system_user_login"]);
            $this->setPassword($res["system_user_password"]);
            $this->setPhoneNumber($res["system_user_phone_number"]);
            $this->setProfilePhoto($res["system_user_profile_photo"]);
            $this->setDescription($res["system_user_description"]);

            for ($i = 1; $i <= $this->permissionNumber; $i++) {
                $this->setPermission($res["permission_$i"], $i);
            }
            $this->setStatus($res["system_user_status"]);
            $this->setDateInsert($res["system_user_date_insert"]);
            $this->setDateUpdate($res["system_user_date_update"]);
            $this->setUserRegister($res["system_user_id_register"]);
            $this->setUserCompany($res["system_user_company"]);

        }

        return $res;
    }


    public function issetLogin()
    {
        $criteria = $this->criteria();
        $criteria->add($this->filter("system_user_login", "=", md5($this->getLogin())));
        return $this->select($criteria);
    }



    public function validateUserManager($userId)
    {

        $cri = $this->criteria();
        if ($userId == Login::user()->getId()) {

            $cri->add($this->filter("system_user_id", "=", Login::user()->getId()));

        } else {

            $cri->add($this->filter("system_user_id_register", "=", Login::user()->getId()));

        }

        $col[] = "system_user_id";

        return boolval($this->Select($cri, $col));
    }


    /**
     * @return mixed
     */
    public function getUserCompany()
    {
        return $this->userCompany;
    }

    /**
     * @param mixed $userCompany
     */
    public function setUserCompany($userCompany)
    {
        $this->userCompany = $userCompany;
    }


    /**
     * @return mixed
     */
    public function getUserRegister()
    {
        return $this->userRegister;
    }

    /**
     * @param mixed $userRegister
     */
    public function setUserRegister($userRegister)
    {
        $this->userRegister = $userRegister;

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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {

        $this->email = $email;

    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param mixed $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return mixed
     */
    public function getProfilePhoto()
    {

        return $this->profilePhoto;


    }

    /**
     * @param mixed $profilePhoto
     */
    public function setProfilePhoto($profilePhoto)
    {
        $this->profilePhoto = $profilePhoto;
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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
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


    public function getPermission($index)
    {
        if (!isset($this->permission[$index])) {
            return $this->permission[$index] = 0;
        }

        return $this->permission[$index];
    }

    /**
     * @param mixed $permission
     */
    public function setPermission($permission, $index)
    {
        $this->permission[$index] = $permission;
    }

    /**
     * @return int
     */
    public function getPermissionNumber()
    {
        return $this->permissionNumber;
    }


}
