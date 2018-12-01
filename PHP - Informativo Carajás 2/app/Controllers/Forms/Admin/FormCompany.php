<?php

namespace App\Controllers\Forms\Admin;

use App\Models\Company\Company;
use App\Models\Company\Phone;
use App\Models\User\Login;
use DSisconeto\Simple\DataFormat;
use DSisconeto\Simple\Form;
use DSisconeto\Simple\Request;
use DSisconeto\Simple\UploadImage;
use Respect\Validation\Validator as respect;

class FormCompany extends Form
{

    public function __construct()
    {

        Login::validateForm(Request::input("jwt", "str", ""), 7);

        if (Request::issetInput("company_id")) {
            $expression = (new Company())->validateByUser(Request::input("company_id", "int", 0));

            Login::exitForm($expression, "Não autorizado", false);

        }

    }

    public function registerComplete()
    {
        $this->setMsg("Não tem Permissão", false, 1);
        $this->setMsg("A Razão Social da empresa dever conter entre 2 á 150 digitos.", false, 2);
        $this->setMsg("O Nome Fantasia da empresa dever conter entre 2 á 150 digitos.", false, 3);
        $this->setMsg("Não é um CPF nem uum CNPJ valido.", false, 4);
        $this->setMsg("O endereço dever conter entre 5 á 150 digitos", false, 5);
        $this->setMsg("A descrição dever conter no minimo 10 digistos.", false, 6);
        $this->setMsg("Já existe uma Url igual.", false, 7);
        $this->setMsg("Empresa Cadastrada com Sucesso.", true, 8);
        $this->setMsg("Não foi possivel cadastrar empresa. Ocorreu Algum erro no banco de dados.", false, 9);
        $this->setMsg("Não foi possivel cadastrar empresa, aconteceu algum erro com a URL", false, 10);

        $company = new Company();
        $company->setName(Request::post("company_name"));
        $company->setFantasyName(Request::post("company_fantasy_name"));
        $company->setCnpjOrCpf(Request::post("company_cnpj_or_cpf"));
        $company->setAddress(Request::post("company_address", "str"));
        $company->setEmbed(DataFormat::embedMaps(Request::post("company_address_embed")));
        $company->setDescription(Request::post("company_description"));
        $company->url()->setUrl(Request::post("system_url_url"));
        $company->setLevel(Request::post("company_nivel"));
        $company->user()->setId(Login::user()->getId());
        $company->userRegister()->setId(Login::user()->getId());
        $company->setStatus(0);

        // validando nivel da empresa
        if ($company->getLevel() < 2) {

            $company->setLevel(2);

        } elseif ($company->getLevel() > 5) {
            $company->setLevel(5);
        }

        // validando nome da razão social da empresa
        if (!respect::length(2, 150)->validate($company->getName())) {
            // A Razão Social da empresa dever conter entre 2 á 150 digitos.
            $this->setReturn(2);

        }
        // valiando nome fantasia da empresa
        if (!respect::length(2, 150)->validate($company->getFantasyName())) {
            // O Nome Fantasia da empresa dever conter entre 2 á 150 digitos.
            $this->setReturn(3);
        }


        // valiando se é um CPF ou CNPJ
        if (!respect::length(null, 11)->validate($company->getCnpjOrCpf()) && !respect::length(null, 44)->validate($company->getCnpjOrCpf())) {
            // Não é um CPF nem uum CNPJ valido.
            $this->setReturn(4);
        }
        // valindo endereço
        if (!respect::length(5, 300)->validate($company->getAddress())) {
            // O endereço dever conter entre 5 á 300 digitos
            $this->setReturn(5);
        }


        // valindo descrição
        if (!respect::length(10)->validate($company->getDescription())) {
            // A descrição dever conter no minimo 10 digistos.
            $this->setReturn(6);
        }

        // validando url
        if (!respect::length(2)->validate($company->url()->getUrl())) {
            // não foi enviada um url via formulario
            $company->url()->setUrl($company->getFantasyName());

        } elseif ($company->url()->issetUrl($company->url()->getUrl())) {
            // Já existe uma URL
            // Já existe uma URL
            $this->setReturn(7);

        }
        // caso não exista msg de erro
        if ($this->noError()) {
            // cadastrando url

            $company->url()->setId($company->url()->register());
            // caso tenha cadastrato a url com sucesso

            if ($company->url()->getId()) {

                if ($company->register()) {
                    $this->setReturn(8);

                } else {
                    // Não foi possivel cadastrar empresa. Ocorreu Algum erro no banco de dados.
                    $this->setReturn(9);
                    //// caso der algum erro deletar url registrar
                    $company->url()->delete();
                }

            } else {
                //ERRO AO CADASTRAR URL
                // Não foi possivel cadastrar empresa, aconteceu algum erro com a URL ,
                $this->setReturn(10);

            }


        }


        return $this->getReturn();
    }

    public function registerSimple()
    {

        $this->setMsg("Não tem Permissão", false, 1);
        $this->setMsg("O Nome Fantasia da empresa dever conter entre 2 á 150 digitos.", false, 3);
        $this->setMsg("O endereço dever conter entre 5 á 300 digitos", false, 5);
        $this->setMsg("Empresa Cadastrada com Sucesso.", true, 8);
        $this->setMsg("Não foi possivel cadastrar empresa. Ocorreu Algum erro no banco de dados.", false, 9);
        $this->setMsg("Não foi possivel cadastrar empresa, aconteceu algum erro com a URL", false, 10);

        $company = new Company();
        $company->setFantasyName(Request::post("company_fantasy_name", "str", ""));
        $company->setAddress(Request::post("company_address", "str", ""));

        $company->setLevel(1);
        $company->user()->setId(Login::user()->getId());
        $company->userRegister()->setId(Login::user()->getId());
        $company->setStatus(0);
        $company->url()->setUrl($company->getFantasyName() . time());


        // valiando nome fantasia da empresa
        if (!respect::length(2, 150)->validate($company->getFantasyName())) {
            // O Nome Fantasia da empresa dever conter entre 2 á 300 digitos.
            $this->setReturn(3);
        }

        // valindo endereço
        if (!respect::length(5, 300)->validate($company->getAddress())) {
            // O endereço dever conter entre 5 á 300 digitos
            $this->setMsg("O endereço dever conter entre 5 á 300 digitos", false, 5);

            $this->setReturn(5);
        }


        // caso não exista msg de erro

        if ($this->noError()) {
            // cadastrando url
            $company->url()->setId($company->url()->register());

            // caso tenha cadastrato a url com sucesso

            if ($company->url()->getId()) {

                if ($company->register()) {

                    $this->setReturn(8);

                } else {
                    // Não foi possivel cadastrar empresa. Ocorreu Algum erro no banco de dados.
                    $this->setReturn(9);
                    //// caso der algum erro deletar url registrar
                    $company->url()->delete();
                }

            } else {
                //ERRO AO CADASTRAR URL
                // Não foi possivel cadastrar empresa, aconteceu algum erro com a URL ,
                $this->setReturn(10);

            }


        }


        return $this->getReturn();
    }


    public function editSimple()
    {
        $this->setMsg("Não tem Permissão", false, 1);
        $this->setMsg("O Nome Fantasia da empresa dever conter entre 2 á 150 digitos.", false, 2);
        $this->setMsg("O endereço dever conter entre 5 á 300 digitos", false, 3);
        $this->setMsg("Empresa Edita com sucesso", true, 4);
        $this->setMsg("Não foi possivel editar empresa", false, 5);

        $company = new Company();

        if ($company->validateByUser(Request::post("company_id"))) {

            $company->setFantasyName(Request::post("company_fantasy_name"));
            $company->setAddress(Request::post("company_address", "str"));


            // valiando nome fantasia da empresa
            if (!respect::length(2, 150)->validate($company->getFantasyName())) {
                // O Nome Fantasia da empresa dever conter entre 2 á 150 digitos.
                $this->setReturn(2);
            }


            // valindo endereço
            if (!respect::length(5, 300)->validate($company->getAddress())) {
                // O endereço dever conter entre 5 á 300 digitos
                $this->setReturn(3);
            }

            // caso não exista msg de erro
            if ($this->noError()) {
                // caso tenha cadastrato a url com sucesso

                if ($company->edit()) {

                    $this->setReturn(4);

                } else {
                    // Não foi possivel cadastrar empresa. Ocorreu Algum erro no banco de dados.
                    $this->setReturn(5);
                    //// caso der algum erro deletar url registrar
                }

            }

        } else {

            // não tem permissão de login
            $this->setReturn(1);

        }

        return $this->getReturn();
    }


    public function editComplete()
    {
        $this->setMsg("Não tem Permissão", false, 1);
        $this->setMsg("A Razão Social da empresa dever conter entre 2 á 150 digitos.", false, 2);
        $this->setMsg("O Nome Fantasia da empresa dever conter entre 2 á 150 digitos.", false, 3);
        $this->setMsg("Não é um CPF nem uum CNPJ valido.", false, 4);
        $this->setMsg("O endereço dever conter entre 5 á 300 digitos", false, 5);
        $this->setMsg("A descrição dever conter no minimo 10 digistos.", false, 6);
        $this->setMsg("Empresa Edita com sucesso", true, 7);
        $this->setMsg("Não foi possivel editar empresa", false, 8);

        $company = new Company();


        if ($company->validateByUser(Request::post("company_id"))) {


            // usuario de empresa não podem editar essas informações
            $company->setName(Request::post("company_name"));
            $company->setCnpjOrCpf(Request::post("company_cnpj_or_cpf"));
            $company->url()->setUrl(Request::post("system_url_url"));
            $company->setLevel(Request::post("company_nivel"));


            // validando nivel da empresa
            if ($company->getLevel() < 2) {
                $company->setLevel(2);
            } elseif ($company->getLevel() > 5) {
                $company->setLevel(5);
            }

            // validando nome da razão social da empresa
            if (!respect::length(2, 150)->validate($company->getName())) {
                // A Razão Social da empresa dever conter entre 2 á 150 digitos.
                $this->setReturn(2);
            }

            // valiando se é um CPF ou CNPJ
            if (!respect::length(null, 11)->validate($company->getCnpjOrCpf()) && !respect::length(null, 44)->validate($company->getCnpjOrCpf())) {
                // Não é um CPF nem uum CNPJ valido.
                $this->setReturn(4);
            }

            // validando url
            if (!respect::length(2)->validate($company->url()->getUrl())) {
                // não foi enviada um url via formulario
                $company->url()->setUrl($company->getFantasyName());
                $company->url()->edit();

            } else {
                $company->url()->edit();
            }

        }

        $company->setFantasyName(Request::post("company_fantasy_name"));
        $company->setAddress(Request::post("company_address", "str"));
        $company->setEmbed(DataFormat::embedMaps(Request::post("company_address_embed")));
        $company->setDescription(Request::post("company_description"));


        // valiando nome fantasia da empresa
        if (!respect::length(2, 150)->validate($company->getFantasyName())) {
            // O Nome Fantasia da empresa dever conter entre 2 á 150 digitos.
            $this->setReturn(3);
        }


        // valindo endereço
        if (!respect::length(5, 300)->validate($company->getAddress())) {
            // O endereço dever conter entre 5 á 300 digitos
            $this->setReturn(5);
        }


        // valindo descrição
        if (!respect::length(10)->validate($company->getDescription())) {
            // A descrição dever conter no minimo 10 digistos.
            $this->setReturn(6);
        }


        // caso não exista msg de erro
        if ($this->noError()) {
            // caso tenha cadastrato a url com sucesso

            if ($company->edit()) {

                $this->setReturn(7);

            } else {
                // Não foi possivel cadastrar empresa. Ocorreu Algum erro no banco de dados.
                $this->setReturn(8);
                //// caso der algum erro deletar url registrar

            }


        }


        return $this->getReturn();
    }

    public function updateStatus()
    {
        $this->setMsg("Não tem Permissão", false, 1);
        $this->setMsg("Precisamos de uma capa para empreasa", false, 2);
        $this->setMsg("Precisamos de um logotipo para empreasa", false, 3);
        $this->setMsg("Precisamos de um telefone", false, 4);
        $this->setMsg("Empresa Ativada com sucesso", true, 5);
        $this->setMsg("Erro ao alterar status", false, 6);
        $this->setMsg("Empresa desativada com sucesso", true, 7);

        $phone = new Phone();
        $company = new Company();


        if ($company->validateByUser(Request::post("company_id"))) {

            $company->setId(Request::post("company_id"));

            if (Request::post("company_status") == 1) {

                $company->load($company->getId());

                // caso seja um empresa premium
                if ($company->getLevel() >= 2) {
                    // verificando se capa existe
                    if (!$company->imgExists($company->getCover(), 2)) {
                        $this->setReturn(2);
                    }
                    // verificando se a logo existe
                    if (!$company->imgExists($company->getLogo())) {
                        $this->setReturn(3);
                    }
                    // vericando se tem pelomenos um telefone cadastrado
                    if (!$phone->selectByCompany($company->getId())) {
                        $this->setReturn(4);
                    }


                } else {

                    // caso a empresa seja simples
                    // vericando se tem pelomenos um telefone cadastrado
                    if (!$phone->selectByCompany($company->getId())) {
                        $this->setReturn(4);
                    }
                }


                if ($this->noError()) {

                    $company->setStatus(1);
                    $company->editStatus() ? $this->setReturn(5) : $this->setReturn(6);
                }


            } else {

                $company->setStatus(0);
                $company->editStatus() ? $this->setReturn(7) : $this->setReturn(6);
            }


        } else {

            $this->setReturn(1);
        }

        return $this->getReturn();
    }


    public function uploadLogo()
    {
        $this->setMsg("Não tem Permissão", false, 1);
        $this->setMsg("Imagem não encontrada no servidor.", false, 13);
        $this->setMsg("Upload do logo efetuado com sucesso.", true, 14);
        $this->setMsg("Erro ao fazer upload do logo.", false, 15);


        $companyLogo = Request::file("company_logo");
        $companyId = Request::post("company_id");

        $company = new Company();
        $companyMain = new Company();
        $company->load($companyId);
        // validando usuario
        if ($companyMain->validateByUser($companyId)) {
            /// fazendo upload

            $image = UploadImage::upload($companyLogo, "company_logo", 400, 250);

            if ($image) {

                $companyMain->setLogo($image["name"]);
                // conferindo se a imagem existe nos arquivos
                if (!$companyMain->imgExists($companyMain->getLogo())) {

                    $this->setReturn(13);

                } else {

                    if ($companyMain->editLogo()) {

                        $this->setReturn(14);


                        if ($company->getLogo() && $company->getLogo() != $companyMain->getLogo()) {

                            $company->imgDelete($company->getLogo());
                        }

                    } else {
                        $this->setReturn(15);
                        $companyMain->imgDelete($companyMain->getLogo());
                    }


                }


            } else {
                $this->setReturn(15);
            }


        } else {
            $this->setReturn(1);
        }

        return $this->getReturn();
    }


    public function uploadCover()
    {

        $this->setMsg("Não tem Permissão", false, 1);
        $this->setMsg("Upload da capa efetuado com sucesso.", true, 16);
        $this->setMsg("Erro ao fazer upload da capa.", false, 17);

        $companyCover = Request::file("company_cover");
        $companyId = Request::post("company_id");

        $company = new Company();
        $companyMain = new Company();
        $company->load($companyId);
        // validando usuario
        if ($companyMain->validateByUser($companyId)) {
            /// fazendo upload


            $image = UploadImage::upload($companyCover, "company_cover", 1600, 400);

            if ($image) {

                $companyMain->setCover($image["name"]);
                // conferindo se a imagem existe nos arquivos
                if (!$companyMain->imgExists($companyMain->getCover(), 2)) {

                    $this->setReturn(13);

                } else {

                    if ($companyMain->editCover()) {

                        $this->setReturn(16);


                        if ($company->getCover() && $company->getCover() != $companyMain->getCover()) {

                            $company->imgDelete($company->getCover(), 2);
                        }

                    } else {

                        $this->setReturn(17);
                        $companyMain->imgDelete($companyMain->getCover(), 2);

                    }


                }


            } else {
                return $image;
            }


        } else {
            $this->setReturn(1);
        }

        return $this->getReturn();
    }


}