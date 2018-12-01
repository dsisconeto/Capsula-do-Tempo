<?php


namespace App\Controllers\Forms\Admin;

use App\Models\User\Login;
use App\Models\User\User;
use DSisconeto\Simple\Form;
use DSisconeto\Simple\Request;
use DSisconeto\Simple\UploadImage;
use Respect\Validation\Validator as respect;

class FormSystemUser extends Form
{

    public function __construct()
    {

        Login::validateForm(Request::cookie("jwt"), array(9));
    }

    public function register()
    {
        $user = new User();
        // setando msg de retorno
        $this->setMsg("Usuário não está logado no sistema, ou não tem permissão para cadastrar um novo usuário", false, 1);
        $this->setMsg("O nome deve conter entre 2 a 50 caracteres", false, 2);
        $this->setMsg("Email Invalido", false, 3);
        $this->setMsg("O login deve conter entre 2 a 20 caracteres", false, 4);
        $this->setMsg("O senha deve conter entre 2 a 20 caracteres", false, 5);
        $this->setMsg("Já existe um usuário com esse login", false, 6);
        $this->setMsg("Usuário cadastrado com sucesso", true, 7);
        $this->setMsg("Erro ao inserir usuario no banco de dados", false, 8);


        // setando dados do post
        $user->setName(Request::post("system_user_name", "string"));
        $user->setDescription(Request::post("system_user_description", "string"));
        $user->setEmail(Request::post("system_user_email", "string"));
        $user->setLogin(Request::post("system_user_login", "string"));
        $user->setPassword(Request::post("system_user_password", "string"));
        $user->setPhoneNumber(Request::post("system_user_phone_number", "string"));
        $user->setStatus(1);
        /// verificando parceiro
        (Request::post("partner_id", "int") && $user->getPermissionPartner()) ? $user->setPartnerId(Request::post("partner_id", "int")) : $user->setPartnerId(Login::user()->getPartnerId());


        // verificando permissões enviadas
        Login::user()->getPermissionNews() ? $user->setPermissionNews(Request::post("system_user_permission_news", "int", 0)) : $user->setPermissionNews(0);
        Login::user()->getPermissionNewsCategory() ? $user->setPermissionNewsCategory(Request::post("system_user_permission_news_category", "int", 0)) : $user->setPermissionNewsCategory(0);
        Login::user()->getPermissionNewsSuper() ? $user->setPermissionNewsSuper(Request::post("system_user_permission_news_super", "int", 0)) : $user->setPermissionNewsSuper(0);
        Login::user()->getPermissionEvent() ? $user->setPermissionEvent(Request::post("system_user_permission_event", "int", 0)) : $user->setPermissionEvent(0);
        Login::user()->getPermissionEventCategory() ? $user->setSystemUserPermissionEventSuper(Request::post("system_user_permission_event_category", "int", 0)) : $user->setSystemUserPermissionEventSuper(0);
        Login::user()->getSystemUserPermissionEventSuper() ? $user->setSystemUserPermissionEventSuper(Request::post("system_user_permission_event_super", "int", 0)) : $user->setSystemUserPermissionEventSuper(0);
        Login::user()->getPermissionCompany() ? $user->setPermissionCompany(Request::post("system_user_permission_company", "int", 0)) : $user->setPermissionCompany(0);
        Login::user()->getPermissionAds() ? $user->setPermissionAds(Request::post("system_user_permission_ads", "int", 0)) : $user->setPermissionAds(0);
        Login::user()->getPermissionGeo() ? $user->setPermissionGeo(Request::post("system_user_permission_geo", "int", 0)) : $user->setPermissionGeo(0);
        Login::user()->getPermissionPartner() ? $user->setPermissionPartner(Request::post("system_user_permission_partner", "int", 0)) : $user->setPermissionPartner(0);
        Login::user()->getPermissionUserRegister() ? $user->setPermissionUserRegister(Request::post("system_user_permission_register_user", "int", 0)) : $user->setPermissionUserRegister(0);
        Login::user()->getPermissionNewspaper() ? $user->setPermissionNewspaper(Request::post("system_user_permission_newspaper", "int", 0)) : $user->setPermissionNewspaper(0);


        // inicio da validação dos dados
        if (!Respect::length(2, 50)->validate($user->getName())) {
            $this->setReturn(2);

        }

        if (!Respect::email()->validate($user->getEmail())) {
            $this->setReturn(3);
        }


        if (!Respect::length(2, 20)->validate($user->getLogin())) {
            $this->setReturn(4);
        }
        if (!Respect::length(2, 20)->validate($user->getPassword())) {
            $this->setReturn(5);
        }

        if (!Respect::length(8, 15)->validate($user->getPhoneNumber())) {
            $user->setPhoneNumber("");
        }

        // verificar se  login existe
        if ($user->issetLogin()) {

            $this->setReturn(6);

        }
        // fim  da validação


        if ($this->noError()) {

            $user->register() ? $this->setReturn(7) : $this->setReturn(8);

        }


        return $this->getReturn();
    }


    public function edit()
    {
        $user = new User();



        if (Login::user()->getPermissionUserRegister()) {

            // setando msg de retorno
            $this->setMsg("Usuário não está logado no sistema, ou não tem permissão para cadastrar um novo usuário", false, 1);
            $this->setMsg("O nome deve conter entre 2 a 50 caracteres", false, 2);
            $this->setMsg("Email Invalido", false, 3);
            $this->setMsg("O login deve conter entre 2 a 20 caracteres", false, 4);
            $this->setMsg("O senha deve conter entre 2 a 20 caracteres", false, 5);
            $this->setMsg("Já existe um usuário com esse login", false, 6);
            $this->setMsg("Usuário editado com sucesso", true, 7);
            $this->setMsg("Erro ao editar usuario no banco de dados", false, 8);


            // setando dados do post
            $user->setId(Request::post("system_user_id", "int", 0));
            $user->setName(Request::post("system_user_name", "string"));
            $user->setDescription(Request::post("system_user_description", "string"));
            $user->setEmail(Request::post("system_user_email", "string"));
            $user->setLogin(Request::post("system_user_login", "string", ""));
            $user->setPassword(Request::post("system_user_password", "string", ""));
            $user->setPhoneNumber(Request::post("system_user_phone_number", "string"));
            $user->setStatus(1);

            // verificando permissões enviadas
            Login::user()->getPermissionNews() ? $user->setPermissionNews(Request::post("system_user_permission_news", "int", 0)) : $user->setPermissionNews(0);
            Login::user()->getPermissionNewsCategory() ? $user->setPermissionNewsCategory(Request::post("system_user_permission_news_category", "int", 0)) : $user->setPermissionNewsCategory(0);
            Login::user()->getPermissionNewsSuper() ? $user->setPermissionNewsSuper(Request::post("system_user_permission_news_super", "int", 0)) : $user->setPermissionNewsSuper(0);
            Login::user()->getPermissionEvent() ? $user->setPermissionEvent(Request::post("system_user_permission_event", "int", 0)) : $user->setPermissionEvent(0);
            Login::user()->getPermissionEventCategory() ? $user->setSystemUserPermissionEventSuper(Request::post("system_user_permission_event_category", "int", 0)) : $user->setSystemUserPermissionEventSuper(0);
            Login::user()->getSystemUserPermissionEventSuper() ? $user->setSystemUserPermissionEventSuper(Request::post("system_user_permission_event_super", "int", 0)) : $user->setSystemUserPermissionEventSuper(0);
            Login::user()->getPermissionCompany() ? $user->setPermissionCompany(Request::post("system_user_permission_company", "int", 0)) : $user->setPermissionCompany(0);
            Login::user()->getPermissionAds() ? $user->setPermissionAds(Request::post("system_user_permission_ads", "int", 0)) : $user->setPermissionAds(0);
            Login::user()->getPermissionGeo() ? $user->setPermissionGeo(Request::post("system_user_permission_geo", "int", 0)) : $user->setPermissionGeo(0);
            Login::user()->getPermissionPartner() ? $user->setPermissionPartner(Request::post("system_user_permission_partner", "int", 0)) : $user->setPermissionPartner(0);
            Login::user()->getPermissionUserRegister() ? $user->setPermissionUserRegister(Request::post("system_user_permission_register_user", "int", 0)) : $user->setPermissionUserRegister(0);
            Login::user()->getPermissionNewspaper() ? $user->setPermissionNewspaper(Request::post("system_user_permission_newspaper", "int", 0)) : $user->setPermissionNewspaper(0);
            // inicio da validação dos dados
            if (!Respect::length(2, 50)->validate($user->getName())) {
                $this->setReturn(2);

            }

            if (!Respect::email()->validate($user->getEmail())) {
                $this->setReturn(3);
            }


            if (!Respect::length(0)->validate($user->getLogin()) && !Respect::length(2, 20)->validate($user->getLogin())) {
                $this->setReturn(4);
            }
            if (!Respect::length(0)->validate($user->getPassword()) && !Respect::length(2, 20)->validate($user->getPassword())) {
                $this->setReturn(5);
            }

            if (!Respect::length(8, 15)->validate($user->getPhoneNumber())) {
                $user->setPhoneNumber("");
            }

            // verificar se  login existe

            if ((!Respect::length(0)->validate($user->getLogin())) && $user->issetLogin()) {

                $this->setReturn(6);

            }
            // fim  da validação


            if ($this->noError()) {

                $user->edit() ? $this->setReturn(7) : $this->setReturn(8);

            }

        } else {
            $this->setReturn(1);
        }


        return $this->getReturn();
    }


    public function editPhoto()
    {
        $this->setMsg("Não está logado, ou não tem permissão", false, 1);
        $this->setMsg("Imagem não encontra no sistema de arquivos", false, 18);
        $this->setMsg("Erro ao cadastrar no banco de dados", false, 19);
        $this->setMsg("Foto do Usuário atulizada com sucesso", true, 20);

        $user = new User();


        // separando nome da imagem do destino
        $cover = Request::post("system_user_profile_photo");


        if ($user->load(Request::post("system_user_id"))) {

            $user2 = $user;


            // movendo para pastar certar e criando thumbnail
            $res = UploadImage::croppicFinish($cover, "sys-avatar", 160, 160);


            if ($user->imgExists($res["name"])) {

                $cover = $res["name"];

                $capaAntiga = $user2->getProfilePhoto();

                $user->setProfilePhoto($cover);

                if ($user->editPhoto()) {

                    $this->setReturn(20);

                    $user->imgDelete($capaAntiga);
                } else {
                    $this->setReturn(19);
                    $user->imgDelete($cover);
                }


            } else {
                $user->imgDelete($cover);
                $this->setReturn(18);
            }


        } else {
            Core::deleteImgTemp($cover);

            $this->setReturn(1);
        }


        return $this->getReturn();

    }
}