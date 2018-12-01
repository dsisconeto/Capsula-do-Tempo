<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 30/08/16
 * Time: 17:54
 */

sysLoadClass("CompanyEmail");

use Respect\Validation\Validator as respect;


class AdminFormCompanyEmail extends DjReturnMsg
{

    public function register()
    {
        $this->setMsg("Não tem permissão ", false, 1);
        $this->setMsg("Email inválido", false, 2);
        $this->setMsg("Email Cadastrado com sucesso", true, 3);
        $this->setMsg("Erro ao cadastrar email", false, 4);

        $department = new CompanyDepartment();
        $email = new CompanyEmail();
        if ($department->validateByUser(DjRequest::post("company_department_id"))) {

            $email->setCompanyEmail(DjRequest::post("company_email"));
            $email->setCompanyDepartmentIdFk(DjRequest::post("company_department_id"));

            if (!respect::email()->validate($email->getCompanyEmail())) {

                $this->setReturn(2);
            }


            if ($this->noError()) {

                $email->sqlInsert() ? $this->setReturn(3) : $this->setReturn(4);
            }


        } else {

            $this->setReturn(1);
        }

        return $this->getReturn();
    }


    public function delete()
    {
        $this->setMsg("Não tem permissão ", false, 1);
        $this->setMsg("Email deletado com sucesso", true, 5);
        $this->setMsg("Erro ao deletar email", false, 6);

        $email = new CompanyEmail();

        if ($email->validateByUser(DjRequest::post("company_email_id"))) {

            $email->setCompanyEmail(DjRequest::post("company_email_id"));


            $email->sqlDelete() ? $this->setReturn(5) : $this->setReturn(6);

        } else {
            $this->setReturn(1);
        }

        return $this->getReturn();
    }

}