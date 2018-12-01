<?php

namespace App\Controllers\Forms\Admin;

use App\Models\Company\Company;
use App\Models\Company\SocialNetwork;
use DSisconeto\Simple\Form;
use DSisconeto\Simple\Request;
use App\Models\User\Login;
use Respect\Validation\Validator as respect;

class FormCompanySocialNetwork extends Form
{

    public function __construct()
    {
        Login::validateForm(Request::cookie("jwt"), array(7));

    }


    public function register()
    {
        $this->setMsg("Não tem permissão", false, 1);
        $this->setMsg("O link da rede social dever conter entre 1 a 600 digitos", false, 2);
        $this->setMsg("Rede social cadastrada com sucesso.", true, 3);
        $this->setMsg("Erro ao tentar cadastrar rede social", false, 4);

        $company = new Company();
        $social = new SocialNetwork();


        $companyId = Request::post("company_id");
        $systemSocialNetworkIdFk = Request::post("system_social_network_id");
        $companySocialNetworkLink = Request::post("company_social_network_link");


        if ($company->validateByUser($companyId)) {
            $social->company()->setId($companyId);
            $social->socialNetwork()->setId($systemSocialNetworkIdFk);
            $social->setLink($companySocialNetworkLink);

            if (!respect::length(1, 600)->validate($social->getLink())) {
                $this->setReturn(2);

            } else {

                $social->register() ? $this->setReturn(3) : $this->setReturn(4);
            }


        } else {
            $this->setReturn(1);

        }

        return $this->getReturn();
    }


    public function delete()
    {
        $this->setMsg("Não tem permissão", false, 1);
        $this->setMsg("Rede social deletada com sucesso.", true, 6);
        $this->setMsg("Erro ao tentar deeltar rede social", false, 7);

        $companySocialNetworkId = Request::post("system_social_network_id");
        $social = new SocialNetwork();

        if ($social->validateByUser($companySocialNetworkId)) {

            $social->setId($companySocialNetworkId);


            $social->delete() ? $this->setReturn(6) : $this->setReturn(7);

        } else {
            $this->setReturn(1);
        }


        return $this->getReturn();


    }

}