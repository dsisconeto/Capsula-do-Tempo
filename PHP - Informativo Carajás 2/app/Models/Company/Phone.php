<?php

namespace App\Models\Company;

use DSisconeto\Simple\GetData;
use DSisconeto\Simple\DataFormat;
use DSisconeto\Simple\Model;

class Phone extends Model
{


    private $id;
    private $department;
    private $phone;
    private $dd;
    private $type;
    private $dataInsert;
    private $dataUpdate;


    public function __construct()
    {
        $this->setTable("company_phone");
        $this->setPrimaryKey("company_phone_id");
    }

    public function register()
    {
        $sql = $this->sqlInsert();

        $sql->setRowData("company_department_id_fk", $this->department()->getId());
        $sql->setRowData("company_phone", $this->getPhone());
        $sql->setRowData("company_phone_dd", $this->getDd());
        $sql->setRowData("company_phone_type", $this->getType());
        $sql->setRowData("company_phone_date_insert", GetData::getCurrentTime());

        return $sql->execute();
    }

    public function edit()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();
        $sql->setEntity('company_phone');
        $criteria->add($this->filter('company_phone_id', '=', "{$this->getId()}"));

        $sql->setCriteria($criteria);

        $sql->setRowData("company_phone", $this->getPhone());
        $sql->setRowData("company_department_id_fk", $this->department()->getId());
        $sql->setRowData("company_phone_date_update", GetData::getCurrentTime());

        return $sql->execute();

    }


    public function selectAll()
    {
        $sql = $this->sqlSelect();

        $sql->addColumn("*");

        $sql->setJoin("company_phone", "company_department", "company_department_id_fk", "company_department_id");
        $sql->setJoin("company_department", "company", "company_id_fk", "company_id");


        return $sql->execute();
    }

    public function load($id)
    {
        $sql = $this->sqlSelect();
        $criteria = $this->criteria();

        $criteria->add($this->filter('company_phone_id', '=', $id));
        $criteria->setProperty("limit", 1);


        $sql->setJoin("company_phone", "company_department", "company_department_id_fk", "company_department_id");
        $sql->setJoin("company_department", "company", "company_id_fk", "company_id");
$sql->setCriteria($criteria);
        $sql->addColumn("*");

        $res = $sql->execute();

        if ($res):
            $res = $res[0];
            $this->setId($res["company_phone_id"]);
            $this->department()->company()->setId($res["company_id"]);
            $this->department()->setId($res["company_department_id_fk"]);
            $this->setPhone($res["company_phone"]);

            $this->setDataInsert($res["company_phone_date_insert"]);
            $this->setDataUpdate($res["company_phone_date_update"]);
        endif;

        return $res;
    }


    public function validateByUser($companyPhoneId)
    {
        $this->load($companyPhoneId);
        return $this->department()->company()->validateByUser($this->department()->company()->getId());
    }

    public function selectByCompany($companyId)
    {
        $sql = $this->sqlSelect();
        $cri = $this->criteria();
        $result = array();
        $count = 0;

        $cri->add($this->filter("company_department.company_id_fk", "=", $companyId));

        $sql->setJoin("company_phone", "company_department", "company_department_id_fk", "company_department_id");
        $sql->setJoin("company_department", "company", "company_id_fk", "company_id");

        $sql->addColumn("company_phone_id");
        $sql->addColumn("company_phone");
        $sql->addColumn("company_department_name");
        $sql->addColumn("company_phone_dd");
        $sql->addColumn("company_phone");
        $sql->addColumn("company_phone_type");

        $sql->setCriteria($cri);
        $res = $sql->execute();

        if ($res) {
            foreach ($res as $key) {
                $result[$count]["company_phone_id"] = $key["company_phone_id"];
                $result[$count]["company_phone"] = $key["company_department_name"] . ": " . DataFormat::phone($key["company_phone_dd"], $key["company_phone"], $key["company_phone_type"]);
                $count++;
            }
        }


        return $result;


    }


    /**
     * @return mixed
     */
    public function getDd()
    {
        return $this->dd;
    }

    /**
     * @param mixed $dd
     */
    public function setDd($dd)
    {
        $this->dd = $dd;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {

        if ($type == 1) {

            $this->type = 1;

        } else {
            $this->type = 2;
        }

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
     * @return Department
     */
    public function department()
    {

        $this->department = $this->department ? $this->department : new Department();

        return $this->department;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getDataInsert()
    {
        return $this->dataInsert;
    }

    /**
     * @param mixed $dataInsert
     */
    public function setDataInsert($dataInsert)
    {
        $this->dataInsert = $dataInsert;
    }

    /**
     * @return mixed
     */
    public function getDataUpdate()
    {
        return $this->dataUpdate;
    }

    /**
     * @param mixed $dataUpdate
     */
    public function setDataUpdate($dataUpdate)
    {
        $this->dataUpdate = $dataUpdate;
    }


}