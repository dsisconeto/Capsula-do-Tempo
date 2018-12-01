<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 30/08/16
 * Time: 18:28
 */


sysLoadClass("CompanyRelationshipSegment");


class AdminFormCompanySegment extends DjReturnMsg
{


    public function relationshipWithCompany()
    {
        $this->setMsg("Não tem permissão", false, 1);
        $this->setMsg("Relação já existe", false, 2);
        $this->setMsg("Cadastrado com sucesso", true, 3);
        $this->setMsg("Não foi possivel cadastrar", false, 4);

        $companySegmentRelation = new CompanyRelationshipSegment();
        $companySegmentId = DjRequest::post("company_segment_id");
        $companyId = DjRequest::post("company_id");

        if ($companySegmentRelation->validateByUser($companyId)) {


            if ($companySegmentRelation->issetRelation($companySegmentId, $companyId)) {

                $this->setReturn(2);
            } else {

                $companySegmentRelation->setCompanyIdFk($companyId);
                $companySegmentRelation->setCompanySegmentIdFk($companySegmentId);

                if ($companySegmentRelation->sqlInsert()) {

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
        $companySegmentId = DjRequest::post("company_segment_id");
        $companyId = DjRequest::post("company_id");

        $this->setMsg("Não tem permissão", false, 1);
        $this->setMsg("Relação de Segmento com Empresa deletado com sucesso", true, 5);
        $this->setMsg("Não foi possivel deletar relação de  Segmento com Empresa", false, 6);
        $companySegmentRelation = new CompanyRelationshipSegment();


        if ($companySegmentRelation->validateByUser($companyId)) {


            $companySegmentRelation->setCompanyIdFk($companyId);
            $companySegmentRelation->setCompanySegmentIdFk($companySegmentId);

            if ($companySegmentRelation->sqlDelete()) {

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