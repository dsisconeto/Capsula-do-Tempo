<?php

namespace App\Controllers\Forms\Admin;

use App\Models\Company\Company;
use App\Models\Company\Department;
use App\Models\User\Login;
use DSisconeto\Simple\Form;
use DSisconeto\Simple\Request;
use Respect\Validation\Validator as respect;

class FormCompanyDepartment extends Form
{


    public function __construct()
    {
        Login::validateForm(Request::cookie("jwt"), array(7));

    }

    public function register()
    {
        $this->setMsg("Não tem permissão", false, 1);
        $this->setMsg("O nome do departamento dever conter entre 2 a 30 digitos", false, 2);
        $this->setMsg("Departamento cadastrado com sucesso", true, 3);
        $this->setMsg("Erro ao cadastrar departamento", false, 4);

        $department = new Department();

        $company = new Company();


        if ($company->validateByUser(Request::post("company_id"))) {

            $department->company()->setId(Request::post("company_id"));
            $department->setName(Request::post("company_department_name"));

            if (!respect::length(2, 30)->validate($department->getName())) {


                $this->setReturn(2);

            } else {
                $department->register() ? $this->setReturn(3) : $this->setReturn(4);
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

        $department = new Department();

        if ($department->validateByUser(Request::post("company_department_id"))) {

            $department->setId(Request::post("company_department_id"));

            $department->delete() ? $this->setReturn(5) : $this->setReturn(6);

        } else {

            $this->setReturn(1);


        }

        return $this->getReturn();
    }

}