<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 30/08/16
 * Time: 18:20
 */

sysLoadClass("CompanyPhone");
use Respect\Validation\Validator as respect;

class AdminFormCompanyPhone extends DjReturnMsg
{
    public function register()
    {
        $this->setMsg("Não tem permissão", false, 1);
        $this->setMsg("Número do fone dever conter 8 ou 9 digitos", false, 2);
        $this->setMsg("Número do DD dever conter 2 digitos", false, 3);
        $this->setMsg("Fone cadastrado com sucesso", true, 4);
        $this->setMsg("Erro ao cadastrar fone", false, 5);


        $phoneNumber = DjRequest::post("company_phone");
        $phoneDd = DjRequest::post("company_phone_dd");
        $phoneType = DjRequest::post("company_phone_type");
        $companyDepartmentId = DjRequest::post("company_department_id");

        $department = new CompanyDepartment();
        $phone = new CompanyPhone();
        $phone->setCompanyDepartmentIdFk($companyDepartmentId);
        if (!$phone->getCompanyDepartmentIdFk()) {
            $phone->setReturn(8);
        }

        if ($department->validateByUser($companyDepartmentId)) {

            $phone->setCompanyPhone($phoneNumber);
            $phone->setCompanyPhoneDd($phoneDd);
            $phone->setCompanyPhoneType($phoneType);


            if (!respect::length(8, 9)->validate($phone->getCompanyPhone())) {
                $this->setReturn(2);

            }

            if (!respect::length(2, 2)->validate($phone->getCompanyPhoneDd())) {
                $this->setReturn(3);

            }

            if ($this->noError()) {

                $phone->sqlInsert() ? $this->setReturn(4) : $this->setReturn(5);

            }


        } else {


            $this->setReturn(1);

        }

        return $this->getReturn();
    }



    public function delete()
    {
        $this->setMsg("Não tem permissão", false, 1);
        $this->setMsg("Fone deletado com sucesso", true, 6);
        $this->setMsg("Erro ao deletar fone", false, 7);
        $this->setMsg("Selecione o departamento.", false, 7);

        $phone = new CompanyPhone();
        $companyPhoneId =  DjRequest::post("company_phone_id");
        if ($phone->validateByUser($companyPhoneId)) {

            $phone->setCompanyPhoneId($companyPhoneId);


            $phone->sqlDelete() ? $this->setReturn(6) : $this->setReturn(7);

        } else {

            $this->setReturn(1);
        }

        return $this->getReturn();

    }



}