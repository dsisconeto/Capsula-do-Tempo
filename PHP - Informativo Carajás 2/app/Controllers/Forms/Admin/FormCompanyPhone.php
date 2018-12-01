<?php

namespace App\Controllers\Forms\Admin;

use App\Models\Company\Department;
use App\Models\Company\Phone;
use App\Models\User\Login;
use DSisconeto\Simple\Form;
use DSisconeto\Simple\Request;
use Respect\Validation\Validator as respect;

class FormCompanyPhone extends Form
{


    public function __construct()
    {
        Login::validateForm(Request::cookie("jwt"), array(7));

    }

    public function register()
    {
        $this->setMsg("Não tem permissão", false, 1);
        $this->setMsg("Número do fone dever conter 8 ou 9 digitos", false, 2);
        $this->setMsg("Número do DD dever conter 2 digitos", false, 3);
        $this->setMsg("Fone cadastrado com sucesso", true, 4);
        $this->setMsg("Erro ao cadastrar fone", false, 5);


        $phoneNumber = Request::post("company_phone");
        $phoneDd = Request::post("company_phone_dd");
        $phoneType = Request::post("company_phone_type");
        $companyDepartmentId = Request::post("company_department_id");

        $department = new Department();
        $phone = new Phone();
        $phone->department()->setId($companyDepartmentId);
        if (!$phone->department()->getId()) {
            $this->setReturn(8);
        }

        if ($department->validateByUser($companyDepartmentId)) {

            $phone->setPhone($phoneNumber);
            $phone->setDd($phoneDd);
            $phone->setType($phoneType);


            if (!respect::length(8, 9)->validate($phone->getPhone())) {
                $this->setReturn(2);

            }

            if (!respect::length(2, 2)->validate($phone->getDd())) {
                $this->setReturn(3);

            }

            if ($this->noError()) {

                $phone->register() ? $this->setReturn(4) : $this->setReturn(5);

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

        $phone = new Phone();
        $companyPhoneId = Request::post("company_phone_id");
        if ($phone->validateByUser($companyPhoneId)) {

            $phone->setId($companyPhoneId);


            $phone->delete() ? $this->setReturn(6) : $this->setReturn(7);

        } else {

            $this->setReturn(1);
        }

        return $this->getReturn();

    }


}