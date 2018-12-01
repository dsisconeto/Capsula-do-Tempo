<?php

namespace App\Controllers\Forms\Admin;

use App\Models\Company\Department;
use App\Models\Company\Email;
use App\Models\User\Login;
use DSisconeto\Simple\Form;
use DSisconeto\Simple\Request;
use Respect\Validation\Validator as respect;


class FormCompanyEmail extends Form
{


    public function __construct()
    {
        Login::validateForm(Request::cookie("jwt"), array(7));

    }

    public function register()
    {
        $this->setMsg("Não tem permissão ", false, 1);
        $this->setMsg("Email inválido", false, 2);
        $this->setMsg("Email Cadastrado com sucesso", true, 3);
        $this->setMsg("Erro ao cadastrar email", false, 4);

        $department = new Department();
        $email = new Email();
        if ($department->validateByUser(Request::post("company_department_id"))) {

            $email->setEmail(Request::post("company_email"));
            $email->department()->setId(Request::post("company_department_id"));

            if (!respect::email()->validate($email->getEmail())) {

                $this->setReturn(2);
            }


            if ($this->noError()) {

                $email->register() ? $this->setReturn(3) : $this->setReturn(4);
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

        $email = new Email();

        if ($email->validateByUser(Request::post("company_email_id"))) {

            $email->setId(Request::post("company_email_id"));


            $email->delete() ? $this->setReturn(5) : $this->setReturn(6);

        } else {
            $this->setReturn(1);
        }

        return $this->getReturn();
    }

}