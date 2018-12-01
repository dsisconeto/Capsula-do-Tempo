<?php


namespace App\Controllers\Forms\Admin;

use App\Models\Company\Company;
use App\Models\Company\Gallery;
use App\Models\User\Login;
use DSisconeto\Simple\Form;
use DSisconeto\Simple\Request;
use DSisconeto\Simple\UploadImage;

class FormCompanyGallery extends Form
{

    public function __construct()
    {
        Login::validateForm(Request::cookie("jwt"), array(7));

    }


    public function register()
    {
        $this->setMsg("Não tem permissão.", false, 1);
        $this->setMsg("Imagem não encontrada no servidor.", false, 2);
        $this->setMsg("Imagem cadastrada com sucesso.", false, 3);
        $this->setMsg("Não foi possivel cadastrar imagem.", false, 4);

        $gallery = new Gallery();
        $company = new Company();


        $company_gallery_file = Request::post("company_gallery_file");
        $companyId = Request::post("company_id");

        if ($company->validateByUser($companyId)) {

            $res = UploadImage::uploadBase64($company_gallery_file, "company_gallery", 1200, 900);

            if ($gallery->imgExists($res["name"])) {

                $gallery->setFile($res["name"]);
                $gallery->company()->setId($companyId);
                $gallery->setOrder($gallery->lastOrder($companyId));


                if ($gallery->register()) {

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

        $companyGalleryId = Request::post("company_gallery_id");

        $gallery = new Gallery();

        if ($gallery->validateByUser($companyGalleryId)) {

            $gallery->load($companyGalleryId);


            if ($gallery->delete()) {

                $this->setReturn(5);
                $gallery->imgDelete($gallery->getFile());

            } else {

                $this->setReturn(6);

            }


        } else {

            $this->setReturn(1);
        }

        return $this->getReturn();
    }


}