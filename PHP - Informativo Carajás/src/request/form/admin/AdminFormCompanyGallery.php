<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 30/08/16
 * Time: 18:16
 */
sysLoadClass("CompanyGallery");
sysLoadClass("DjUploadImage");

class AdminFormCompanyGallery extends DjReturnMsg
{


    public function register()
    {
        $this->setMsg("Não tem permissão.", false, 1);
        $this->setMsg("Imagem não encontrada no servidor.", false, 2);
        $this->setMsg("Imagem cadastrada com sucesso.", false, 3);
        $this->setMsg("Não foi possivel cadastrar imagem.", false, 4);

        $gallery = new CompanyGallery();
        $company = new Company();


        $company_gallery_file = DjRequest::post("company_gallery_file");
        $companyId = DjRequest::post("company_id");


        if ($company->validateByUser($companyId)) {
            $res = DjUploadImage::uploadBase64($company_gallery_file, "company_gallery", 1200, 900);

            if ($gallery->imgExists($res["name"])) {

                $gallery->setCompanyGalleryFile($res["name"]);
                $gallery->setCompanyIdFk($companyId);
                $gallery->setCompanyGalleryOrder($gallery->lastOrder($companyId));


                if ($gallery->sqlInsert()) {

                    $this->setReturn(3);

                } else {
                    $this->setReturn(4);
                    $gallery->imgDelete($res["name"]);

                }

            } else {


                $this->setReturn(2);
            }


        } else {
            // Não tem permissão
            $this->setReturn(1);

        }

        return $this->getReturn();

    }

    public function delete()
    {
        $this->setMsg("Não tem permissão.", false, 1);
        $this->setMsg("Imagem deleta com sucesso.", true, 5);
        $this->setMsg("Erro ao deletar Imagem.", false, 6);

        $companyGalleryId = DjRequest::post("company_gallery_id");

        $gallery = new CompanyGallery();

        if ($gallery->validateByUser($companyGalleryId)) {

            $gallery->sqlLoad($companyGalleryId);


            if ($gallery->sqlDelete()) {

                $this->setReturn(5);
                $gallery->imgDelete($gallery->getCompanyGalleryFile());

            } else {

                $this->setReturn(6);

            }


        } else {

            $this->setReturn(1);
        }

        return $this->getReturn();
    }


}