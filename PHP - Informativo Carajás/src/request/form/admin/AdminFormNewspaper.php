<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 15/09/16
 * Time: 22:53
 */
sysLoadClass("Newspaper");
sysLoadClass("NewspaperPage");
sysLoadClass("GeoRegionUserPermission");

use Respect\Validation\Validator as respect;

class AdminFormNewspaper extends DjReturnMsg
{


    public function __construct()
    {
        $login = SystemLogin::getLogin();

        if ($login->validateLogIn() && $login->getSystemUserPermissionNewspaper()) {


        } else {

            exit();
        }

    }


    public function register()
    {
        $this->setMsg("A descrição deve conter no mínimo 5 caracteres");
        $this->setMsg("Jornal Cadastrado com sucesso", true);
        $this->setMsg("Erro ao Cadastrar Jornal");
        $this->setMsg("O usuário não tem permissão de cadastrar nessa cidade.");
        $this->setMsg("Data invalida");
        $this->setMsg("O jornal deve conter no mínimo 4 páginas");

        $newspaper = new Newspaper();
        $login = SystemLogin::getLogin();
        $relationUserRegion = New GeoRegionUserPermission();

        $newspaper->setNewspaperDescription(DjRequest::post("newspaper_description"));
        $newspaper->setNewspaperDrawing(DjRequest::post("newspaper_drawing"));
        $newspaper->setNewspaperEdition(DjRequest::post("newspaper_edition", "int", 0));
        $newspaper->setGeoRegionIdFk(DjRequest::post("geo_region_id"));
        $newspaper->setSystemUserIdFk($login->getSystemUserId());
        $newspaper->setNewspaperPublicationDate(DjRequest::post("newspaper_publication_date"));
        $newspaper->setNewspaperNumberOfPages(DjRequest::post("newspaper_number_of_pages", "int", 4));

        // verificar validade dos dados;
        if (!respect::length(5)->validate($newspaper->getNewspaperDescription())) {

            $this->setReturn(1);
        }

        if ($newspaper->getNewspaperNumberOfPages() < 4) {
            $this->setReturn(6);
        }

        if (!respect::date("Y-m-d")->validate($newspaper->getNewspaperPublicationDate())) {
            $this->setReturn(5);
        }

        if ($newspaper->getNewspaperEdition() == 0) {
            $newspaper->setNewspaperEdition(1);
        }

        if ($newspaper->getNewspaperDrawing() == 0) {
            $newspaper->setNewspaperDrawing(1);
        }


        if (!$relationUserRegion->validatePermission($newspaper->getGeoRegionIdFk(), "newspaper")) {
            $this->setReturn(4);
        }


        if ($this->noError()) {

            $newspaper->sqlInsert() ? $this->setReturn(2, $newspaper->lastId()) : $this->setReturn(3);

        }

        return $this->getReturn();

    }

    public function edit()
    {

        $this->setMsg("A descrição deve conter no mínimo 5 caracteres");
        $this->setMsg("Jornal Editado com sucesso", true);
        $this->setMsg("Erro ao Editar Jornal");
        $this->setMsg("O usuário não tem permissão de editar nessa cidade.");
        $this->setMsg("O usuário não tem permissão de editar desse Jornal");
        $this->setMsg("Data invalida");
        $this->setMsg("O jornal deve conter no mínimo 4 páginas");

        $newspaper = new Newspaper();
        $relationUserRegion = New GeoRegionUserPermission();

        $newspaper->setNewspaperId(DjRequest::post("newspaper_id", "int"));

        $newspaper->setNewspaperDescription(DjRequest::post("newspaper_description", "str"));
        $newspaper->setNewspaperDrawing(DjRequest::post("newspaper_drawing", "int"));
        $newspaper->setNewspaperEdition(DjRequest::post("newspaper_edition", "int", 0));
        $newspaper->setGeoRegionIdFk(DjRequest::post("geo_region_id", "int"));
        $newspaper->setNewspaperNumberOfPages(DjRequest::post("newspaper_number_of_pages", "int", 4));
        $newspaper->setNewspaperPublicationDate(DjRequest::post("newspaper_publication_date"));

        if ($newspaper->validateByUser($newspaper->getNewspaperId())) {


            // verificar validade dos dados;
            if (!respect::length(5)->validate($newspaper->getNewspaperDescription())) {

                $this->setReturn(1);
            }

            if (!respect::date("Y-m-d")->validate($newspaper->getNewspaperPublicationDate())) {
                $this->setReturn(6);
            }

            if ($newspaper->getNewspaperNumberOfPages() < 4) {
                $this->setReturn(7);
            }

            if ($newspaper->getNewspaperEdition() == 0) {
                $newspaper->setNewspaperEdition(1);
            }

            if ($newspaper->getNewspaperDrawing() == 0) {
                $newspaper->setNewspaperDrawing(1);
            }

            if (!$relationUserRegion->validatePermission($newspaper->getGeoRegionIdFk(), "newspaper")) {
                $this->setReturn(4);
            }


            if ($this->noError()) {

                $newspaper->sqlUpdate() ? $this->setReturn(2) : $this->setReturn(3);

            }
        }


        return $this->getReturn();

    }

    public function delete()
    {

        $this->setMsg("O usuário não tem permissão de deletar desse Jornal");
        $this->setMsg("Jornal foi deletado com sucesso", true);
        $this->setMsg("Erro ao deletar Jornal");
        $newspaper = new Newspaper();
        $page = new NewspaperPage();
        $newspaper->setNewspaperId(DjRequest::post("newspaper_id", "int", 0));

        if ($newspaper->validateByUser($newspaper->getNewspaperId())) {

            $page->deleteByNewspaper($newspaper->getNewspaperId());

            $newspaper->sqlDelete() ? $this->setReturn(2) : $this->setReturn(3);

        } else {
            $this->setReturn(1);
        }

        return $this->getReturn();
    }

    public function editStatus()
    {
        $this->setMsg("O usuário não tem permissão de editar o status desse Jornal");
        $this->setMsg("Jornal foi despublicado com sucesso", true);
        $this->setMsg("erro ao despublicar o Jornal");
        $this->setMsg("Para publicar o jornal, o mesmo deve conter no mínimo 4 páginas");
        $this->setMsg("Jornal foi publicado com sucesso", true);
        $this->setMsg("erro ao publicar o Jornal");

        $newspaper = new Newspaper();
        $page = new NewspaperPage();
        $newspaper->setNewspaperId(DjRequest::post("newspaper_id", "int", 0));

        if ($newspaper->validateByUser($newspaper->getNewspaperId())) {
            $newspaper->setNewsPaperStatus(DjRequest::post("newspaper_status", "int", 0));


            if ($newspaper->getNewsPaperStatus() == 3) {


                if ((count($page->selectByNewspaper($newspaper->getNewspaperId()))) < 4) {
                    $this->setReturn(4);
                }

                $newspaper->sqlPublication() ? $this->setReturn(5) : $this->setReturn(6);

            } else {

                $newspaper->sqlPublication() ? $this->setReturn(2) : $this->setReturn(3);
            }


        } else {

            $this->setReturn(1);

        }

        return $this->getReturn();
    }

}