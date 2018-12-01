<?php

namespace App\Models\Company;

use DSisconeto\Simple\Model;
use DSisconeto\Simple\GetData;

class Email extends Model
{

    private $id;
    private $email;
    private $department;
    private $dataInsert;
    private $dataUpdate;


    public function __construct()
    {
        $this->setTable("company_email");
        $this->setPrimaryKey("company_email_id");
    }

    public function register()
    {
        $sql = $this->sqlInsert();

        $sql->setRowData("company_department_id_fk", $this->department()->getId());
        $sql->setRowData("company_email", $this->getEmail());
        $sql->setRowData("company_email_date_insert", GetData::getCurrentTime());

        return $sql->execute();
    }


    public function edit()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();

        $criteria->add($this->filter('company_email_id', '=', "{$this->getId()}"));

        $sql->setCriteria($criteria);

        $sql->setRowData("company_email", $this->getEmail());
        $sql->setRowData("company_email_date_update", GetData::getCurrentTime());

        return $sql->execute();
    }



    public function selectAll()
    {

        $sql = $this->sqlSelect();

        $sql->setJoin("company_email", "company_department", "company_department_id_fk", "company_department_id");
        $sql->setJoin("company_department", "company", "company_id_fk", "company_id");

        $sql->addColumn("*");

        return $sql->execute();
    }


    public function load($id)
    {
        $sql = $this->sqlSelect();
        $criteria = $this->criteria();

        $criteria->add($this->filter('company_email_id', '=', $id));
        $criteria->setProperty("limit", 1);
        $sql->addColumn("*");
        $sql->setCriteria($criteria);
        $sql->setJoin("company_email", "company_department", "company_department_id_fk", "company_department_id");
        $sql->setJoin("company_department", "company", "company_id_fk", "company_id");


        $result = $sql->execute();

        if ($result):
            $res = $result[0];
            $this->setId($res["company_email_id"]);
            $this->setEmail($res["company_email"]);
            $this->department()->setId($res["company_department_id_fk"]);
            $this->department()->company()->setId($res["company_id"]);
            $this->setDataUpdate($res["company_email_date_update"]);
            $this->setDataInsert($res["company_email_date_insert"]);

        endif;

        return $result;
    }

    public function validateByUser($id)
    {
        $this->load($id);
        return $validate = $this->department()->company()->validateByUser($this->department()->company()->getId());
    }


    public function selectByCompany($companyId)
    {
        $sql = $this->sqlSelect();
        $cri = $this->criteria();
        $result = array();
        $count = 0;

        $sql->setJoin("company_email", "company_department", "company_department_id_fk", "company_department_id");

        $cri->add($this->filter("company_department.company_id_fk", "=", $companyId));

        $sql->addColumn("company_email_id");
        $sql->addColumn("company_email");
        $sql->addColumn("company_department_name");
        $sql->setCriteria($cri);
        $res = $sql->execute();

        if ($res) {

            foreach ($res as $key) {
                $result[$count]["company_email_id"] = $key["company_email_id"];
                $result[$count]["company_email"] = "{$key["company_department_name"]}: " . $key["company_email"];
                $count++;
            }
        }


        return $result;


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