<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 30/08/16
 * Time: 18:04
 */

sysLoadClass("CompanyDepartment");
use Respect\Validation\Validator as respect;

class AdminFormCompanyDepartment extends DjReturnMsg
{


    public function register()
    {
        $this->setMsg("Não tem permissão", false, 1);
        $this->setMsg("O nome do departamento dever conter entre 2 a 30 digitos", false, 2);
        $this->setMsg("Departamento cadastrado com sucesso", true, 3);
        $this->setMsg("Erro ao cadastrar departamento", false, 4);

        $department = new CompanyDepartment();

        $company = new Company();


        if ($company->validateByUser(DjRequest::post("company_id"))) {

            $department->setCompanyIdFk(DjRequest::post("company_id"));
            $department->setCompanyDepartmentName(DjRequest::post("company_department_name"));

            if (!respect::length(2, 30)->validate($department->getCompanyDepartmentName())) {


                $this->setReturn(2);

            } else {
                $department->sqlInsert() ? $this->setReturn(3) : $this->setReturn(4);
            }


        } else {
            $this->setReturn(1);
        }

        return $this->getReturn();
    }


    public function delete()
    {
        $this->setMsg("Não tem permissão", false, 1);
        $this->setMsg("Departamento deletado com sucesso", true, 5);
        $this->setMsg("Erro ao deletar departamento", false, 6);

        $department = new CompanyDepartment();

        if ($department->validateByUser(DjRequest::post("company_department_id"))) {

            $department->setCompanyDepartmentId(DjRequest::post("company_department_id"));

            $department->sqlDelete() ? $this->setReturn(5) : $this->setReturn(6);

        } else {

            $this->setReturn(1);


        }

        return $this->getReturn();
    }

}