<?php


namespace App\Controllers\Forms\Admin;

use App\Models\Newspaper\Newspaper;
use App\Models\Newspaper\Page;
use App\Models\User\Login;
use DSisconeto\Simple\Form;
use DSisconeto\Simple\Request;
use DSisconeto\Simple\UploadImage;

class FormNewspaperPage extends Form
{
    public function __construct()
    {
        Login::validateForm(Request::cookie("jwt"), array(10));
    }


    public function upload()
    {

        $this->setMsg("Não tem permissão para fazer upload de páginas nesse jornal.", false, 1);
        $this->setMsg("Não foi encontrado a imagem nos arquivos", false, 2);
        $this->setMsg("Página cadastrada com sucesso", true, 3);
        $this->setMsg("Erro ao cadastrar Página.", false, 4);
        $this->setMsg("");
        $newspaper = new Newspaper();
        $page = new Page();
        $page->newspaper()->setId(Request::post("newspaper_id", "int", 0));


        if ($newspaper->validateByUser($page->newspaper()->getId())) {


            $res = UploadImage::uploadBase64(Request::post("image_base64"), "newspaper_page", 1000, 1391);


            if ((isset($res["name"])) && $page->imgExists($res["name"])) {

                $page->setFile($res["name"]);
                $page->setNumber($page->lastPage($page->newspaper()->getId()));

                if ($page->register()) {

                    $this->setReturn(3);
                } else {

                    $page->imgDelete($page->getFile());
                    $this->setReturn(4);
                };


            } else {

                $this->setReturn(2);
            }


        } else {
            $this->setReturn(1);

        }


        return $this->getReturn();
    }


    public function serializeOrder()
    {
        $this->setMsg("ordenação feitta", true, 5);

        $page = new Page();
        $data["success"] = 0;
        $data["error"] = 0;
        $data["permission"] = 0;

        $i = 0;

        foreach (Request::post("page") as $key) {

            if ($page->validateByUser($key)) {

                $page->setNumber($i);
                $page->setId($key);
                $page->edit() ? $data["success"]++ : $data["error"]++;
                $i++;
            } else {
                $data["permission"]++;

            }

        }

        $this->setReturn(5, $data);


        return $this->getReturn();
    }

    public function delete()
    {

        $this->setMsg("Não tem permissão para deletar página nesse jornal", false, 1);
        $this->setMsg("Página deleta com sucesso", true, 2);
        $this->setMsg("Erro ao deletar página", false, 3);
        $pageId = Request::post("newspaper_page_id", "int", 0);
        $page = new Page();

        if ($page->validateByUser($pageId)) {


            if ($page->delete()) {

                $this->setReturn(2);
                $page->imgDelete($page->getFile());

            } else {
                $this->setReturn(3);

            }


        } else {

            $this->setReturn(1);


        }


        return $this->getReturn();
    }


}