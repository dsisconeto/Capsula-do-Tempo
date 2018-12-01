<?php
use Respect\Validation\Validator as respect;

sysLoadClass("SystemUser");
sysLoadClass("DjUploadImage");


class AdminFormSystemUser extends DjReturnMsg
{

    public function register()
    {
        $user = new SystemUser();
        $returnMsg = new DjReturnMsg();

        $login = SystemLogin::getLogin();

        if ($login->getSystemUserPermissionUserRegister()) {

            // setando msg de retorno
            $returnMsg->setMsg("Usuário não está logado no sistema, ou não tem permissão para cadastrar um novo usuário", false, 1);
            $returnMsg->setMsg("O nome deve conter entre 2 a 50 caracteres", false, 2);
            $returnMsg->setMsg("Email Invalido", false, 3);
            $returnMsg->setMsg("O login deve conter entre 2 a 20 caracteres", false, 4);
            $returnMsg->setMsg("O senha deve conter entre 2 a 20 caracteres", false, 5);
            $returnMsg->setMsg("Já existe um usuário com esse login", false, 6);
            $returnMsg->setMsg("Usuário cadastrado com sucesso", true, 7);
            $returnMsg->setMsg("Erro ao inserir usuario no banco de dados", false, 8);


            // setando dados do post
            $user->setSystemUserName(DjRequest::post("system_user_name", "string"));
            $user->setSystemUserDescription(DjRequest::post("system_user_description", "string"));
            $user->setSystemUserEmail(DjRequest::post("system_user_email", "string"));
            $user->setSystemUserLogin(DjRequest::post("system_user_login", "string"));
            $user->setSystemUserPassword(DjRequest::post("system_user_password", "string"));
            $user->setSystemUserPhoneNumber(DjRequest::post("system_user_phone_number", "string"));
            $user->setSystemUserStatus(1);
            /// verificando parceiro
            (DjRequest::post("partner_id", "int") && $user->getSystemUserPermissionPartner()) ? $user->setPartnerId(DjRequest::post("partner_id", "int")) : $user->setPartnerId($login->getPartnerId());


            // verificando permissões enviadas
            $login->getSystemUserPermissionNews() ? $user->setSystemUserPermissionNews(DjRequest::post("system_user_permission_news", "int", 0)) : $user->setSystemUserPermissionNews(0);
            $login->getSystemUserPermissionNewsCategory() ? $user->setSystemUserPermissionNewsCategory(DjRequest::post("system_user_permission_news_category", "int", 0)) : $user->setSystemUserPermissionNewsCategory(0);
            $login->getSystemUserPermissionNewsSuper() ? $user->setSystemUserPermissionNewsSuper(DjRequest::post("system_user_permission_news_super", "int", 0)) : $user->setSystemUserPermissionNewsSuper(0);
            $login->getSystemUserPermissionEvent() ? $user->setSystemUserPermissionEvent(DjRequest::post("system_user_permission_event", "int", 0)) : $user->setSystemUserPermissionEvent(0);
            $login->getSystemUserPermissionEventCategory() ? $user->setSystemUserPermissionEventCategory(DjRequest::post("system_user_permission_event_category", "int", 0)) : $user->setSystemUserPermissionEventCategory(0);
            $login->getSystemUserPermissionEventSuper() ? $user->setSystemUserPermissionEventSuper(DjRequest::post("system_user_permission_event_super", "int", 0)) : $user->setSystemUserPermissionEventSuper(0);
            $login->getSystemUserPermissionCompany() ? $user->setSystemUserPermissionCompany(DjRequest::post("system_user_permission_company", "int", 0)) : $user->setSystemUserPermissionCompany(0);
            $login->getSystemUserPermissionAds() ? $user->setSystemUserPermissionAds(DjRequest::post("system_user_permission_ads", "int", 0)) : $user->setSystemUserPermissionAds(0);
            $login->getSystemUserPermissionGeo() ? $user->setSystemUserPermissionGeo(DjRequest::post("system_user_permission_geo", "int", 0)) : $user->setSystemUserPermissionGeo(0);
            $login->getSystemUserPermissionPartner() ? $user->setSystemUserPermissionPartner(DjRequest::post("system_user_permission_partner", "int", 0)) : $user->setSystemUserPermissionPartner(0);
            $login->getSystemUserPermissionUserRegister() ? $user->setSystemUserPermissionUserRegister(DjRequest::post("system_user_permission_register_user", "int", 0)) : $user->setSystemUserPermissionUserRegister(0);
            $login->getSystemUserPermissionNewspaper() ? $user->setSystemUserPermissionNewspaper(DjRequest::post("system_user_permission_newspaper", "int", 0)) : $user->setSystemUserPermissionNewspaper(0);


            // inicio da validação dos dados
            if (!Respect::length(2, 50)->validate($user->getSystemUserName())) {
                $returnMsg->setReturn(2);

            }

            if (!Respect::email()->validate($user->getSystemUserEmail())) {
                $returnMsg->setReturn(3);
            }


            if (!Respect::length(2, 20)->validate($user->getSystemUserLogin())) {
                $returnMsg->setReturn(4);
            }
            if (!Respect::length(2, 20)->validate($user->getSystemUserPassword())) {
                $returnMsg->setReturn(5);
            }

            if (!Respect::length(8, 15)->validate($user->getSystemUserPhoneNumber())) {
                $user->setSystemUserPhoneNumber("");
            }

            // verificar se  login existe
            if ($user->issetLogin($user->getSystemUserLogin())) {

                $returnMsg->setReturn(6);

            }
            // fim  da validação


            if ($returnMsg->noError()) {

                $user->sqlInsert() ? $returnMsg->setReturn(7) : $returnMsg->setReturn(8);

            }

        } else {
            $returnMsg->setReturn(1);
        }


        return $returnMsg->getReturn();
    }


    public function edit()
    {
        $user = new SystemUser();
        $returnMsg = new DjReturnMsg();

        $login = SystemLogin::getLogin();

        if ($login->getSystemUserPermissionUserRegister()) {

            // setando msg de retorno
            $returnMsg->setMsg("Usuário não está logado no sistema, ou não tem permissão para cadastrar um novo usuário", false, 1);
            $returnMsg->setMsg("O nome deve conter entre 2 a 50 caracteres", false, 2);
            $returnMsg->setMsg("Email Invalido", false, 3);
            $returnMsg->setMsg("O login deve conter entre 2 a 20 caracteres", false, 4);
            $returnMsg->setMsg("O senha deve conter entre 2 a 20 caracteres", false, 5);
            $returnMsg->setMsg("Já existe um usuário com esse login", false, 6);
            $returnMsg->setMsg("Usuário editado com sucesso", true, 7);
            $returnMsg->setMsg("Erro ao editar usuario no banco de dados", false, 8);


            // setando dados do post
            $user->setSystemUserId(DjRequest::post("system_user_id", "int", 0));
            $user->setSystemUserName(DjRequest::post("system_user_name", "string"));
            $user->setSystemUserDescription(DjRequest::post("system_user_description", "string"));
            $user->setSystemUserEmail(DjRequest::post("system_user_email", "string"));
            $user->setSystemUserLogin(DjRequest::post("system_user_login", "string", ""));
            $user->setSystemUserPassword(DjRequest::post("system_user_password", "string", ""));
            $user->setSystemUserPhoneNumber(DjRequest::post("system_user_phone_number", "string"));
            $user->setSystemUserStatus(1);

            // verificando permissões enviadas
            $login->getSystemUserPermissionNews() ? $user->setSystemUserPermissionNews(DjRequest::post("system_user_permission_news", "int", 0)) : $user->setSystemUserPermissionNews(0);
            $login->getSystemUserPermissionNewsCategory() ? $user->setSystemUserPermissionNewsCategory(DjRequest::post("system_user_permission_news_category", "int", 0)) : $user->setSystemUserPermissionNewsCategory(0);
            $login->getSystemUserPermissionNewsSuper() ? $user->setSystemUserPermissionNewsSuper(DjRequest::post("system_user_permission_news_super", "int", 0)) : $user->setSystemUserPermissionNewsSuper(0);
            $login->getSystemUserPermissionEvent() ? $user->setSystemUserPermissionEvent(DjRequest::post("system_user_permission_event", "int", 0)) : $user->setSystemUserPermissionEvent(0);
            $login->getSystemUserPermissionEventCategory() ? $user->setSystemUserPermissionEventCategory(DjRequest::post("system_user_permission_event_category", "int", 0)) : $user->setSystemUserPermissionEventCategory(0);
            $login->getSystemUserPermissionEventSuper() ? $user->setSystemUserPermissionEventSuper(DjRequest::post("system_user_permission_event_super", "int", 0)) : $user->setSystemUserPermissionEventSuper(0);
            $login->getSystemUserPermissionCompany() ? $user->setSystemUserPermissionCompany(DjRequest::post("system_user_permission_company", "int", 0)) : $user->setSystemUserPermissionCompany(0);
            $login->getSystemUserPermissionAds() ? $user->setSystemUserPermissionAds(DjRequest::post("system_user_permission_ads", "int", 0)) : $user->setSystemUserPermissionAds(0);
            $login->getSystemUserPermissionGeo() ? $user->setSystemUserPermissionGeo(DjRequest::post("system_user_permission_geo", "int", 0)) : $user->setSystemUserPermissionGeo(0);
            $login->getSystemUserPermissionPartner() ? $user->setSystemUserPermissionPartner(DjRequest::post("system_user_permission_partner", "int", 0)) : $user->setSystemUserPermissionPartner(0);
            $login->getSystemUserPermissionUserRegister() ? $user->setSystemUserPermissionUserRegister(DjRequest::post("system_user_permission_register_user", "int", 0)) : $user->setSystemUserPermissionUserRegister(0);
            $login->getSystemUserPermissionNewspaper() ? $user->setSystemUserPermissionNewspaper(DjRequest::post("system_user_permission_newspaper", "int", 0)) : $user->setSystemUserPermissionNewspaper(0);
            // inicio da validação dos dados
            if (!Respect::length(2, 50)->validate($user->getSystemUserName())) {
                $returnMsg->setReturn(2);

            }

            if (!Respect::email()->validate($user->getSystemUserEmail())) {
                $returnMsg->setReturn(3);
            }


            if (!Respect::length(0)->validate($user->getSystemUserLogin()) && !Respect::length(2, 20)->validate($user->getSystemUserLogin())) {
                $returnMsg->setReturn(4);
            }
            if (!Respect::length(0)->validate($user->getSystemUserPassword()) && !Respect::length(2, 20)->validate($user->getSystemUserPassword())) {
                $returnMsg->setReturn(5);
            }

            if (!Respect::length(8, 15)->validate($user->getSystemUserPhoneNumber())) {
                $user->setSystemUserPhoneNumber("");
            }

            // verificar se  login existe
            if ((!Respect::length(0)->validate($user->getSystemUserLogin())) && $user->issetLogin($user->getSystemUserLogin())) {

                $returnMsg->setReturn(6);

            }
            // fim  da validação


            if ($returnMsg->noError()) {

                $user->sqlUpdate() ? $returnMsg->setReturn(7) : $returnMsg->setReturn(8);

            }

        } else {
            $returnMsg->setReturn(1);
        }


        return $returnMsg->getReturn();
    }


    public function editPhoto()
    {
        $this->setMsg("Não está logado, ou não tem permissão", false, 1);
        $this->setMsg("Imagem não encontra no sistema de arquivos", false, 18);
        $this->setMsg("Erro ao cadastrar no banco de dados", false, 19);
        $this->setMsg("Foto do Usuário atulizada com sucesso", true, 20);

        $user = new SystemUser();


        // separando nome da imagem do destino
        $cover = DjRequest::post("system_user_profile_photo");


        if ($user->sqlLoad(DjRequest::post("system_user_id"))) {

            $user2 = $user;


            // movendo para pastar certar e criando thumbnail
            $res = DjUploadImage::croppicFinish($cover, "sys-avatar", 160, 160);


            if ($user->imgExists($res["name"])) {

                $cover = $res["name"];

                $capaAntiga = $user2->getSystemUserProfilePhoto();

                $user->setSystemUserProfilePhoto($cover);

                if ($user->sqlUpdatePhoto()) {

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
            DjWork::deleteImgTemp($cover);

            $this->setReturn(1);
        }


        return $this->getReturn();

    }
}