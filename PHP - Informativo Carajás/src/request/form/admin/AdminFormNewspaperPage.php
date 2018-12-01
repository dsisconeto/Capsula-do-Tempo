<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 18/09/16
 * Time: 23:58
 */
sysLoadClass("Newspaper");
sysLoadClass("NewspaperPage");
sysLoadClass("DjUploadImage");

class AdminFormNewspaperPage extends DjReturnMsg
{

    public function __construct()
    {


        $login = SystemLogin::getLogin();
        if (!$login->validateLogIn() || !$login->getSystemUserPermissionNewspaper()) {

            exit();
        }


    }

    public function upload()
    {

        $this->setMsg("Não tem permissão para fazer upload de páginas nesse jornal.", false, 1);
        $this->setMsg("Não foi encontrado a imagem nos arquivos", false, 2);
        $this->setMsg("Página cadastrada com sucesso", true, 3);
        $this->setMsg("Erro ao cadastrar Página.", false, 4);
        $this->setMsg("");
        $newspaper = new Newspaper();
        $page = new NewspaperPage();
        $page->setNewspaperIdFk(DjRequest::post("newspaper_id", "int", 0));



        if ($newspaper->validateByUser($page->getNewspaperIdFk())) {


            $res = DjUploadImage::uploadBase64(DjRequest::post("image_base64"), "newspaper_page", 1000, 1391);


            if ((isset($res["name"])) && $page->imgExists($res["name"])) {

                $page->setNewspaperFile($res["name"]);
                $page->setNewspaperNumber($page->lastPage($page->getNewspaperIdFk()));

                if ($page->sqlInsert()) {

                    $this->setReturn(3);
                } else {

                    $page->imgDelete($page->getNewspaperFile());
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

        $page = new NewspaperPage();
        $data["success"] = 0;
        $data["error"] = 0;
        $data["permission"] = 0;

        $i = 0;

        foreach (DjRequest::post("page") as $key) {

            if ($page->validateByUser($key)) {

                $page->setNewspaperNumber($i);
                $page->setNewspaperPageId($key);
                $page->sqlUpdate() ? $data["success"]++ : $data["error"]++;
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
        $pageId = DjRequest::post("newspaper_page_id", "int", 0);
        $page = new NewspaperPage();

        if ($page->validateByUser($pageId)) {


            if ($page->sqlDelete()) {

                $this->setReturn(2);
                $page->imgDelete($page->getNewspaperFile());

            } else {
                $this->setReturn(3);

            }


        } else {

            $this->setReturn(1);


        }


        return $this->getReturn();
    }


}