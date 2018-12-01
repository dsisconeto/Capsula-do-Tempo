<?php


namespace App\Models\Company;

use DSisconeto\Simple\Model;
use DSisconeto\Simple\GetData;

class Department extends Model
{

    private $id;
    private $company;
    private $name;
    private $dataInsert;
    private $dataUpdate;

    public function __construct()
    {
        $this->setTable("company_department");
        $this->setPrimaryKey("company_department_id");
    }


    public function register()
    {
        $sql = $this->sqlInsert();


        $sql->setRowData("company_id_fk", $this->company()->getId());
        $sql->setRowData("company_department_name", $this->getName());
        $sql->setRowData("company_department_date_insert", GetData::getCurrentTime());

        return $sql->execute();

    }

    public function edit()
    {
        $sql = $this->sqlUpdate();
        $criteria = $this->criteria();

        $criteria->add($this->filter('company_department_id', '=', "{$this->getId()}"));

        $sql->setRowData("company_department_name", $this->getName());
        $sql->setRowData("company_department_date_update", GetData::getCurrentTime());

        $sql->setCriteria($criteria);

        return $sql->execute();

    }





    public function load($id)
    {
        $sql = $this->sqlSelect();
        $criteria = $this->criteria();

        $criteria->add($this->filter('company_department_id', '=', $id));
        $criteria->setProperty("limit", 1);

        $sql->addColumn("*");
        $sql->setJoin("company_department", "company", "company_id_fk", "company_id");
        $sql->setCriteria($criteria);
        $res = $sql->execute();

        if ($res):
            $res = $res[0];
            $this->setId($res["company_department_id"]);
            $this->company()->setId($res["company_id_fk"]);
            $this->setName($res["company_department_name"]);
            $this->setDataInsert($res["company_department_date_insert"]);
            $this->setDataUpdate($res["company_department_date_update"]);
        endif;

        return $res;
    }


    public function validateByUser($companyDepartmentId)
    {


        $sql = $this->sqlSelect();
        $criteria = $this->criteria();
        $criteria->add($this->filter('company_department_id', '=', $companyDepartmentId));
        $criteria->setProperty("limit", 1);

        $sql->addColumn("company_id_fk");
        $sql->setCriteria($criteria);
        $sql->setJoin("company_department", "company", "company_id_fk", "company_id");

        $res = $sql->execute();


        return $res ? $this->company()->validateByUser($res[0]["company_id_fk"]) : false;

    }


    /**
     * @return mixed
     */
    public
    function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public
    function setId($id)
    {
        $this->id = $id;
    }

    public
    function company()
    {
        $this->company = $this->company ? $this->company : new Company();
        return $this->company;
    }


    /**
     * @return mixed
     */
    public
    function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public
    function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public
    function getDataInsert()
    {
        return $this->dataInsert;
    }

    /**
     * @param mixed $dataInsert
     */
    public
    function setDataInsert($dataInsert)
    {
        $this->dataInsert = $dataInsert;
    }

    /**
     * @return mixed
     */
    public
    function getDataUpdate()
    {
        return $this->dataUpdate;
    }

    /**
     * @param mixed $dataUpdate
     */
    public
    function setDataUpdate($dataUpdate)
    {
        $this->dataUpdate = $dataUpdate;
    }


}