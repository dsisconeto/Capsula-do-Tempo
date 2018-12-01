<?php

namespace App\Controllers\Forms\Admin;
use App\Models\Company\RelationshipSegment;
use App\Models\User\Login;
use DSisconeto\Simple\Form;
use DSisconeto\Simple\Request;


class FormCompanySegment extends Form
{


    public function __construct()
    {
        Login::validateForm(Request::cookie("jwt"), array(7));

    }

    public function relationshipWithCompany()
    {
        $this->setMsg("Não tem permissão", false, 1);
        $this->setMsg("Relação já existe", false, 2);
        $this->setMsg("Cadastrado com sucesso", true, 3);
        $this->setMsg("Não foi possivel cadastrar", false, 4);

        $companySegmentRelation = new RelationshipSegment();
        $companySegmentId = Request::post("company_segment_id");
        $companyId = Request::post("company_id");

        if ($companySegmentRelation->validateByUser($companyId)) {


            if ($companySegmentRelation->issetRelation($companySegmentId, $companyId)) {

                $this->setReturn(2);
            } else {

                $companySegmentRelation->company()->setId($companyId);
                $companySegmentRelation->segment()->setId($companySegmentId);

                if ($companySegmentRelation->register()) {

                    $this->setReturn(3);


                } else {

                    $this->setReturn(4);
                }


            }


        } else {
            $this->setReturn(1);
        }


        return $this->getReturn();

    }


    public function deleteRelationshipWithCompany()
    {
        $companySegmentId = Request::post("company_segment_id");
        $companyId = Request::post("company_id");

        $this->setMsg("Não tem permissão", false, 1);
        $this->setMsg("Relação de Segmento com Empresa deletado com sucesso", true, 5);
        $this->setMsg("Não foi possivel deletar relação de  Segmento com Empresa", false, 6);
        $companySegmentRelation = new RelationshipSegment();


        if ($companySegmentRelation->validateByUser($companyId)) {

            $companySegmentRelation->company()->setId($companyId);
            $companySegmentRelation->segment()->setId($companySegmentId);

            if ($companySegmentRelation->delete()) {

                $this->setReturn(5);

            } else {

                $this->setReturn(6);
            }


        } else {
            $this->setReturn(1);
        }


        return $this->getReturn();
    }

}