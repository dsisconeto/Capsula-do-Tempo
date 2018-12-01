<?php


namespace App\Controllers\Forms\Admin;

use App\Models\Geo\RegionUserPermission;
use App\Models\Newspaper\Newspaper;
use App\Models\Newspaper\Page;
use App\Models\User\Login;
use DSisconeto\Simple\Form;
use DSisconeto\Simple\Request;
use Respect\Validation\Validator as respect;

class FormNewspaper extends Form
{

    public function __construct()
    {
        Login::validateForm(Request::cookie("jwt"), array(10));
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
        $relationUserRegion = New RegionUserPermission();

        $newspaper->setDescription(Request::post("newspaper_description"));
        $newspaper->setDrawing(Request::post("newspaper_drawing"));
        $newspaper->setEdition(Request::post("newspaper_edition", "int", 0));
        $newspaper->region()->setId(Request::post("geo_region_id"));
        $newspaper->user()->setId(Login::user()->getId());
        $newspaper->setPublicationDate(Request::post("newspaper_publication_date"));
        $newspaper->setNumberOfPages(Request::post("newspaper_number_of_pages", "int", 4));

        // verificar validade dos dados;
        if (!respect::length(5)->validate($newspaper->getDescription())) {

            $this->setReturn(1);
        }

        if ($newspaper->getNumberOfPages() < 4) {
            $this->setReturn(6);
        }

        if (!respect::date("Y-m-d")->validate($newspaper->getPublicationDate())) {
            $this->setReturn(5);
        }

        if ($newspaper->getEdition() == 0) {
            $newspaper->setEdition(1);
        }

        if ($newspaper->getDrawing() == 0) {
            $newspaper->setDrawing(1);
        }


        if (!$relationUserRegion->validatePermission($newspaper->region()->getId(), "newspaper")) {
            $this->setReturn(4);
        }


        if ($this->noError()) {

            $newspaper->register() ? $this->setReturn(2, $newspaper->lastId()) : $this->setReturn(3);

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
        $relationUserRegion = New RegionUserPermission();

        $newspaper->setId(Request::post("newspaper_id", "int"));

        $newspaper->setDescription(Request::post("newspaper_description", "str"));
        $newspaper->setDrawing(Request::post("newspaper_drawing", "int"));
        $newspaper->setEdition(Request::post("newspaper_edition", "int", 0));
        $newspaper->region()->setId(Request::post("geo_region_id", "int"));
        $newspaper->setNumberOfPages(Request::post("newspaper_number_of_pages", "int", 4));
        $newspaper->setPublicationDate(Request::post("newspaper_publication_date"));

        if ($newspaper->validateByUser($newspaper->getId())) {


            // verificar validade dos dados;
            if (!respect::length(5)->validate($newspaper->getDescription())) {

                $this->setReturn(1);
            }

            if (!respect::date("Y-m-d")->validate($newspaper->getPublicationDate())) {
                $this->setReturn(6);
            }

            if ($newspaper->getNumberOfPages() < 4) {
                $this->setReturn(7);
            }

            if ($newspaper->getEdition() == 0) {
                $newspaper->setEdition(1);
            }

            if ($newspaper->getDrawing() == 0) {
                $newspaper->setDrawing(1);
            }

            if (!$relationUserRegion->validatePermission($newspaper->region()->getId(), "newspaper")) {
                $this->setReturn(4);
            }


            if ($this->noError()) {

                $newspaper->edit() ? $this->setReturn(2) : $this->setReturn(3);

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
        $page = new Page();
        $newspaper->setId(Request::post("newspaper_id", "int", 0));

        if ($newspaper->validateByUser($newspaper->getId())) {

            $page->deleteByNewspaper($newspaper->getId());

            $newspaper->delete() ? $this->setReturn(2) : $this->setReturn(3);

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
        $page = new Page();
        $newspaper->setId(Request::post("newspaper_id", "int", 0));

        if ($newspaper->validateByUser($newspaper->getId())) {
            $newspaper->setStatus(Request::post("newspaper_status", "int", 0));


            if ($newspaper->getStatus() == 3) {


                if ((count($page->selectByNewspaper($newspaper->getId()))) < 4) {
                    $this->setReturn(4);
                }

                $newspaper->editStatus() ? $this->setReturn(5) : $this->setReturn(6);

            } else {

                $newspaper->editStatus() ? $this->setReturn(2) : $this->setReturn(3);
            }


        } else {

            $this->setReturn(1);

        }

        return $this->getReturn();
    }

}