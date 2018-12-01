<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 30/08/16
 * Time: 17:24
 */

use Respect\Validation\Validator as respect;

sysLoadClass("Company");
sysLoadClass("DjUploadImage");
sysLoadClass("SystemUrl");


class AdminFormCompany extends DjReturnMsg
{

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
        $login = SystemLogin::getLogin();
        $systemUrl = new SystemUrl();

        if ($login->validateLogIn() && $login->getSystemUserPermissionCompany()) {


            $company->setCompanyName(DjRequest::post("company_name"));
            $company->setCompanyFantasyName(DjRequest::post("company_fantasy_name"));
            $company->setCompanyCnpjOrCpf(DjRequest::post("company_cnpj_or_cpf"));
            $company->setCompanyAddress(DjRequest::post("company_address", "str"));
            $company->setCompanyAddressEmbed(Framework::getEmbedGoogleMaps(DjRequest::post("company_address_embed")));
            $company->setCompanyDescription(DjRequest::post("company_description"));
            $systemUrl->setUrl(DjRequest::post("system_url_url"));
            $company->setCompanyNivel(DjRequest::post("company_nivel"));
            $company->setCompanySystemUserIdFk($login->getSystemUserId());
            $company->setCompanySystemUserIdRegisterFk($login->getSystemUserId());
            $company->setCompanyStatus(0);

            // validando nivel da empresa
            if ($company->getCompanyNivel() < 2) {

                $company->setCompanyNivel(2);

            } elseif ($company->getCompanyNivel() > 5) {
                $company->setCompanyNivel(5);
            }

            // validando nome da razão social da empresa
            if (!respect::length(2, 150)->validate($company->getCompanyName())) {
                // A Razão Social da empresa dever conter entre 2 á 150 digitos.
                $this->setReturn(2);

            }
            // valiando nome fantasia da empresa
            if (!respect::length(2, 150)->validate($company->getCompanyFantasyName())) {
                // O Nome Fantasia da empresa dever conter entre 2 á 150 digitos.
                $this->setReturn(3);
            }


            // valiando se é um CPF ou CNPJ
            if (!respect::length(null, 11)->validate($company->getCompanyCnpjOrCpf()) && !respect::length(null, 44)->validate($company->getCompanyCnpjOrCpf())) {
                // Não é um CPF nem uum CNPJ valido.
                $this->setReturn(4);
            }
            // valindo endereço
            if (!respect::length(5, 300)->validate($company->getCompanyAddress())) {
                // O endereço dever conter entre 5 á 300 digitos
                $this->setReturn(5);
            }


            // valindo descrição
            if (!respect::length(10)->validate($company->getCompanyDescription())) {
                // A descrição dever conter no minimo 10 digistos.
                $this->setReturn(6);
            }

            // validando url
            if (!respect::length(2)->validate($systemUrl->getUrl())) {
                // não foi enviada um url via formulario
                $systemUrl->setUrl($company->getCompanyFantasyName());

            } elseif ($systemUrl->issetUrl($systemUrl->getUrl())) {
                // Já existe uma URL
                // Já existe uma URL
                $this->setReturn(7);

            }
            // caso não exista msg de erro
            if ($this->noError()) {
                // cadastrando url
                $company->setSystemUrlIdFk($systemUrl->register($systemUrl->getUrl(), 2));
                // caso tenha cadastrato a url com sucesso

                if ($company->getSystemUrlIdFk()) {

                    if ($company->sqlInsert()) {
                        $this->setReturn(8);

                    } else {
                        // Não foi possivel cadastrar empresa. Ocorreu Algum erro no banco de dados.
                        $this->setReturn(9);
                        //// caso der algum erro deletar url registrar
                        $systemUrl->delete($company->getSystemUrlIdFk());
                    }

                } else {
                    //ERRO AO CADASTRAR URL
                    // Não foi possivel cadastrar empresa, aconteceu algum erro com a URL ,
                    $this->setReturn(10);

                }


            }


        } else {
            // não tem permissão de login
            $this->setReturn(1);

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

        $login = SystemLogin::getLogin();
        $systemUrl = new SystemUrl();
        $company = new Company();


        if ($login->validateLogIn() && $login->getSystemUserPermissionCompany()) {

            $company->setCompanyFantasyName(DjRequest::post("company_fantasy_name", "string"));
            $company->setCompanyAddress(DjRequest::post("company_address", "str"));

            $company->setCompanyNivel(1);
            $company->setCompanySystemUserIdFk($login->getSystemUserId());
            $company->setCompanySystemUserIdRegisterFk($login->getSystemUserId());
            $company->setCompanyStatus(0);
            $systemUrl->setUrl($company->getCompanyFantasyName() . time());


            // valiando nome fantasia da empresa
            if (!respect::length(2, 150)->validate($company->getCompanyFantasyName())) {
                // O Nome Fantasia da empresa dever conter entre 2 á 300 digitos.
                $this->setReturn(3);
            }

            // valindo endereço
            if (!respect::length(5, 300)->validate($company->getCompanyAddress())) {
                // O endereço dever conter entre 5 á 300 digitos
                $this->setMsg("O endereço dever conter entre 5 á 300 digitos", false, 5);

                $this->setReturn(5);
            }


            // caso não exista msg de erro

            if ($this->noError()) {
                // cadastrando url
                $company->setSystemUrlIdFk($systemUrl->register($systemUrl->getUrl(), 2));
                // caso tenha cadastrato a url com sucesso

                if ($company->getSystemUrlIdFk()) {

                    if ($company->sqlInsert()) {

                        $this->setReturn(8);

                    } else {
                        // Não foi possivel cadastrar empresa. Ocorreu Algum erro no banco de dados.
                        $this->setReturn(9);
                        //// caso der algum erro deletar url registrar
                        $systemUrl->delete($company->getSystemUrlIdFk());
                    }

                } else {
                    //ERRO AO CADASTRAR URL
                    // Não foi possivel cadastrar empresa, aconteceu algum erro com a URL ,
                    $this->setReturn(10);

                }


            }


        } else {
            // não tem permissão de login
            $this->setReturn(1);

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

        if ($company->validateByUser(DjRequest::post("company_id"))) {

            $company->setCompanyFantasyName(DjRequest::post("company_fantasy_name"));
            $company->setCompanyAddress(DjRequest::post("company_address", "str"));


            // valiando nome fantasia da empresa
            if (!respect::length(2, 150)->validate($company->getCompanyFantasyName())) {
                // O Nome Fantasia da empresa dever conter entre 2 á 150 digitos.
                $this->setReturn(2);
            }


            // valindo endereço
            if (!respect::length(5, 300)->validate($company->getCompanyAddress())) {
                // O endereço dever conter entre 5 á 300 digitos
                $this->setReturn(3);
            }

            // caso não exista msg de erro
            if ($this->noError()) {
                // caso tenha cadastrato a url com sucesso

                if ($company->sqlUpdate()) {

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
        $systemUrl = new SystemUrl();
        $login = SystemLogin::getLogin();

        if ($company->validateByUser(DjRequest::post("company_id"))) {


            if ($login->getSystemUserPermissionCompany() && !$login->getSystemUserCompany()) {
                // usuario de empresa não podem editar essas informações
                $company->setCompanyName(DjRequest::post("company_name"));
                $company->setCompanyCnpjOrCpf(DjRequest::post("company_cnpj_or_cpf"));
                $systemUrl->setUrl(DjRequest::post("system_url_url"));
                $company->setCompanyNivel(DjRequest::post("company_nivel"));


                // validando nivel da empresa
                if ($company->getCompanyNivel() < 2) {
                    $company->setCompanyNivel(2);
                } elseif ($company->getCompanyNivel() > 5) {
                    $company->setCompanyNivel(5);
                }

                // validando nome da razão social da empresa
                if (!respect::length(2, 150)->validate($company->getCompanyName())) {
                    // A Razão Social da empresa dever conter entre 2 á 150 digitos.
                    $this->setReturn(2);
                }

                // valiando se é um CPF ou CNPJ
                if (!respect::length(null, 11)->validate($company->getCompanyCnpjOrCpf()) && !respect::length(null, 44)->validate($company->getCompanyCnpjOrCpf())) {
                    // Não é um CPF nem uum CNPJ valido.
                    $this->setReturn(4);
                }

                // validando url
                if (!respect::length(2)->validate($systemUrl->getUrl())) {
                    // não foi enviada um url via formulario
                    $systemUrl->edit($company->getSystemUrlIdFk(), $company->getCompanyFantasyName());
                } else {

                    $systemUrl->edit($company->getSystemUrlIdFk(), $systemUrl->getUrl());
                }

            }

            $company->setCompanyFantasyName(DjRequest::post("company_fantasy_name"));
            $company->setCompanyAddress(DjRequest::post("company_address", "str"));
            $company->setCompanyAddressEmbed(Framework::getEmbedGoogleMaps(DjRequest::post("company_address_embed")));
            $company->setCompanyDescription(DjRequest::post("company_description"));


            // valiando nome fantasia da empresa
            if (!respect::length(2, 150)->validate($company->getCompanyFantasyName())) {
                // O Nome Fantasia da empresa dever conter entre 2 á 150 digitos.
                $this->setReturn(3);
            }


            // valindo endereço
            if (!respect::length(5, 300)->validate($company->getCompanyAddress())) {
                // O endereço dever conter entre 5 á 300 digitos
                $this->setReturn(5);
            }


            // valindo descrição
            if (!respect::length(10)->validate($company->getCompanyDescription())) {
                // A descrição dever conter no minimo 10 digistos.
                $this->setReturn(6);
            }


            // caso não exista msg de erro
            if ($this->noError()) {
                // caso tenha cadastrato a url com sucesso

                if ($company->sqlUpdate()) {

                    $this->setReturn(7);

                } else {
                    // Não foi possivel cadastrar empresa. Ocorreu Algum erro no banco de dados.
                    $this->setReturn(8);
                    //// caso der algum erro deletar url registrar

                }


            }

        } else {
            // não tem permissão de login
            $this->setReturn(1);

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

        $phone = new CompanyPhone();
        $company = new Company();


        if ($company->validateByUser(DjRequest::post("company_id"))) {

            $company->setCompanyId(DjRequest::post("company_id"));

            if (DjRequest::post("company_status") == 1) {

                $company->sqlLoad($company->getCompanyId());

                // caso seja um empresa premium
                if ($company->getCompanyNivel() >= 2) {
                    // verificando se capa existe
                    if (!$company->imgExists($company->getCompanyCover(), 2)) {
                        $this->setReturn(2);
                    }
                    // verificando se a logo existe
                    if (!$company->imgExists($company->getCompanyLogo())) {
                        $this->setReturn(3);
                    }
                    // vericando se tem pelomenos um telefone cadastrado
                    if (!$phone->selectByCompany($company->getCompanyId())) {
                        $this->setReturn(4);
                    }


                } else {

                    // caso a empresa seja simples
                    // vericando se tem pelomenos um telefone cadastrado
                    if (!$phone->selectByCompany($company->getCompanyId())) {
                        $this->setReturn(4);
                    }
                }


                if ($this->noError()) {

                    $company->setCompanyStatus(1);
                    $company->sqlUpdateStatus() ? $this->setReturn(5) : $this->setReturn(6);
                }


            } else {

                $company->setCompanyStatus(0);
                $company->sqlUpdateStatus() ? $this->setReturn(7) : $this->setReturn(6);
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


        $companyLogo = DjRequest::file("company_logo");
        $companyId = DjRequest::post("company_id");

        $company = new Company();
        $companyMain = new Company();
        $company->sqlLoad($companyId);
        // validando usuario
        if ($companyMain->validateByUser($companyId)) {
            /// fazendo upload

            $image = DjUploadImage::upload($companyLogo, "company_logo", 400, 250);

            if ($image) {

                $companyMain->setCompanyLogo($image["name"]);
                // conferindo se a imagem existe nos arquivos
                if (!$companyMain->imgExists($companyMain->getCompanyLogo())) {

                    $this->setReturn(13);

                } else {

                    if ($companyMain->sqlUpdateLogo()) {

                        $this->setReturn(14);


                        if ($company->getCompanyLogo() && $company->getCompanyLogo() != $companyMain->getCompanyLogo()) {

                            $company->imgDelete($company->getCompanyLogo());
                        }

                    } else {
                        $this->setReturn(15);
                        $companyMain->imgDelete($companyMain->getCompanyLogo());
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

        $companyCover = DjRequest::file("company_cover");
        $companyId = DjRequest::post("company_id");

        $company = new Company();
        $companyMain = new Company();
        $company->sqlLoad($companyId);
        // validando usuario
        if ($companyMain->validateByUser($companyId)) {
            /// fazendo upload


            $image = DjUploadImage::upload($companyCover, "company_cover", 1600, 400);

            if ($image) {

                $companyMain->setCompanyCover($image["name"]);
                // conferindo se a imagem existe nos arquivos
                if (!$companyMain->imgExists($companyMain->getCompanyCover(), 2)) {

                    $this->setReturn(13);

                } else {

                    if ($companyMain->sqlUpdateCover()) {

                        $this->setReturn(16);


                        if ($company->getCompanyCover() && $company->getCompanyCover() != $companyMain->getCompanyCover()) {

                            $company->imgDelete($company->getCompanyCover(), 2);
                        }

                    } else {

                        $this->setReturn(17);
                        $companyMain->imgDelete($companyMain->getCompanyCover(), 2);

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