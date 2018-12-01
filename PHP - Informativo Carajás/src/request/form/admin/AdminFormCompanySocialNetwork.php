<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 30/08/16
 * Time: 18:44
 */

sysLoadClass("CompanySocialNetwork");
use Respect\Validation\Validator as respect;

class AdminFormCompanySocialNetwork extends DjReturnMsg
{


    public function register()
    {
        $this->setMsg("Não tem permissão", false, 1);
        $this->setMsg("O link da rede social dever conter entre 1 a 600 digitos", false, 2);
        $this->setMsg("Rede social cadastrada com sucesso.", true, 3);
        $this->setMsg("Erro ao tentar cadastrar rede social", false, 4);

        $company = new Company();
        $social = new CompanySocialNetwork();


        $companyId = DjRequest::post("company_id");
        $systemSocialNetworkIdFk = DjRequest::post("system_social_network_id");
        $companySocialNetworkLink = DjRequest::post("company_social_network_link");


        if ($company->validateByUser($companyId)) {
            $social->setCompanyIdFk($companyId);
            $social->setSystemSocialNetworkIdFk($systemSocialNetworkIdFk);
            $social->setCompanySocialNetworkLink($companySocialNetworkLink);

            if (!respect::length(1, 600)->validate($social->getCompanySocialNetworkLink())) {
                $this->setReturn(2);

            } else {

                $social->sqlInsert() ? $this->setReturn(3) : $this->setReturn(4);
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

        $companySocialNetworkId = DjRequest::post("system_social_network_id");
        $social = new CompanySocialNetwork();

        if ($social->validateByUser($companySocialNetworkId)) {

            $social->setCompanySocialNetworkId($companySocialNetworkId);


            $social->sqlDelete() ? $this->setReturn(6) : $this->setReturn(7);

        } else {
            $this->setReturn(1);
        }


        return $this->getReturn();


    }

}