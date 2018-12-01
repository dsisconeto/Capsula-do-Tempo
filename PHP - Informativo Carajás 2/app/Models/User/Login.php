<?php

namespace App\Models\User;

use DSisconeto\Simple\DataBase\SQL\Criteria;
use DSisconeto\Simple\DataBase\SQL\Filter;
use DSisconeto\Simple\DataBase\SQL\Select;
use DSisconeto\Simple\GetData;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;

class Login
{

    private static $login;


    private function __construct()
    {
    }


    public static function login($login, $password)
    {
        $sql = new Select();
        $cri = new Criteria();
        // adicionadno as colunas que serão buscadas
        $sql->setEntity("system_user");

        $sql->addColumn("system_user_id");

        // criando criterios de login
        $cri->add(new Filter("system_user_login", "=", md5($login)));
        $cri->add(new Filter("system_user_password", "=", md5($password)));
        $cri->add(new Filter("system_user_status", "=", 1));
        $cri->setProperty("limit", 1);


        $sql->setCriteria($cri);

        $result = $sql->execute();

        if ($result):

            Login::user()->load($result[0]["system_user_id"]);
            $permission = array();
            for ($i = 1; $i <= Login::User()->getPermissionNumber(); $i++) {

                $permission[$i] = Login::User()->getPermission($i);
            }

            $signer = new Sha256();

            $token = (new Builder())->setIssuer(GetData::getConfig("HOST_MAIN"))// Configures the issuer (iss claim)
            ->setId(hash("sha256", Login::user()->getId() . GetData::getConfig("KEY")))// Configures the id (jti claim), replicating as a header item
            ->setIssuedAt(time())// Configures the time that the token was issue (iat claim)
            ->setNotBefore(time() - 1)// Configures the time that the token can be used (nbf claim)
            ->setExpiration(time() + 86400)// Configures the expiration time of the token (nbf claim)
            ->set("user_permission", $permission)
                ->set('user_id', Login::user()->getId())
                ->sign($signer, GetData::getConfig("KEY"))// creates a signature using "testing" as key
                ->getToken(); // Retrieves the generated token

            return $token;
        endif;

        return false;
    }


    public static function validate($tokenUser)
    {
        try {
            $signer = new Sha256();
            $token = (new Parser())->parse((string)$tokenUser); // Parses from a string

            $data = new ValidationData(); // It will use the current time to validate (iat, nbf and exp)


            $data->setIssuer(GetData::getConfig("HOST_MAIN"));

            $data->setId(hash("sha256", $token->getClaim("user_id") . GetData::getConfig("KEY")));

            Login::user()->setId($token->getClaim("user_id"));

            $permission = $token->getClaim("user_permission");

            for ($i = 1; $i <= Login::user()->getPermissionNumber(); $i++) {

                Login::user()->setPermission($permission->$i, $i);

            }


            return ($token->validate($data) && $token->verify($signer, GetData::getConfig("KEY")));

        } catch (\Exception $e) {
            return false;
        }
    }


    public static function verifyPermission($permission = array())
    {
        if ($permission) {


            if (is_array($permission)) {

                $count = count($permission);
                for ($i = 0; $i < $count; $i++) {

                    if ((isset($permission[$i]))) {

                        if (!Login::user()->getPermission($permission[$i])) {
                            return false;
                        }
                    } else {
                        return false;
                    }

                }

            } else {

                return Login::user()->getPermission($permission);
            }
        }

        return true;
    }


    public static function validateView($token, $permission = array())
    {

        if ((!Login::validate($token)) || !Login::verifyPermission($permission)) {

            $host = GetData::getHostMain();
            $router = $host . GetData::getCurrentUrl();
            header("location:{$host}login/?continue=$router&logout");
            exit();

        }

    }

    public static function validateForm($token, $permission = false)
    {
        $expression = (Login::validate($token)) && Login::verifyPermission($permission);

        self::exitForm($expression, "Não está logado");
    }

    public static function validateServices($token, $permission = false)
    {

        self::exitServices((!Login::validate($token)) || !Login::verifyPermission($permission));
    }

    public static function exitServices($expression)
    {
        if ($expression) {
            $json["boolean"] = false;
            $json["items"] = array();
            $json["count"] = 0;
            echo json_encode($json);
            exit();
        }
    }

    public static function exitForm($expression, $msg, $bool = false)
    {
        if (!$expression) {
            $json[0]["boolean"] = $bool;
            $json[0]["msg"] = $msg;
            $json[0]["data"] = false;
            echo json_encode($json);
            exit();
        }
    }


    /**
     * @return User
     */
    public static function user()
    {

        if (is_null(self::$login)) {

            self::$login = new User();

            return self::$login;
        } else {

            return self::$login;
        }
    }


}