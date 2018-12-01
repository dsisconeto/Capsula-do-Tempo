<?php
/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 08/05/17
 * Time: 03:14
 */

namespace DSisconeto\Simple;


class GetData
{
    private static $config;

    public static function getConfig($name)
    {
        // retorna uma variavel de configuração
        try {
            if (!self::$config) {
                self::$config = require("../config.php");

            }

            return self::$config[$name];
        } catch (\Exception $e) {
            echo "Verifique o arquivo de configuração";
            exit();
        }
    }

    public static function getHostMain()
    {
        return self::getConfig("HOST_MAIN");
    }

    public static function getHostImage()
    {
        return self::getConfig("HOST_IMAGE");
    }

    public static function getHostForm()
    {
        return self::getConfig("HOST_FORM");
    }

    public static function getHostServices()
    {
        return self::getConfig("HOST_SERVICES");
    }

    public static function getCurrentTime()
    {
        // captura a datetime do sistema
        return date("Y-m-d H:i:s");
    }

    public function getUserAgent()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }

    public static function getOs()
    {
        $USER_AGENT = strtolower($_SERVER['HTTP_USER_AGENT']);
        $os = array(
            array('ios', 'ios'),
            array('iphone', 'iphone'),
            array('ipad', 'ipad'),
            array('android', 'android'),
            array('webos', 'webos'),
            array('blackberry', 'blackberry'),
            array('symbian', 'symbian'),
            array('ipod', 'ipod'),
            array('windows', 'windows'),
            array('win', 'windows'),
            array('mac', 'mac os x'),
            array('macintosh', 'mac os x'),
            array('linux', 'linux'),
            array('freebsd', 'freebsd'),
        );

        foreach ($os as $s) {
            if (stristr($USER_AGENT, $s[0])) {
                return ($s[1]);
            }
        }

        return false;
    }


    public static function getDateToEn($dateBr, $datetime = false)
    {
        // transforma uma data america em br
        $data = explode(" ", $dateBr);
        if (isset($data[0]) && isset($data[1])):
            $date = explode("/", $data[0]);
            $time = $data[1];
        else:
            $date = explode("/", $dateBr);
        endif;


        if (isset($date[0]) && isset($date[1]) && isset($date[2])):

            $dateEn = $date[2] . "-" . $date[1] . "-" . $date[0];

            if ($datetime):

                if (isset($time)):
                    $dateEn .= " " . $time;
                else:
                    $dateEn .= " 00:00:00";
                endif;
            endif;

            return $dateEn;
        else:
            return false;
        endif;
    }

    public static function getIp()
    {
        return $_SERVER['REMOTE_ADDR'];
    }

    public static function getIsMobile()
    {
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $agent = strtolower($_SERVER['HTTP_USER_AGENT']);

            $iphone = strpos($agent, "iphone");
            $ipad = strpos($agent, "ipad");
            $android = strpos($agent, "android");
            $palmpre = strpos($agent, "webos");
            $berry = strpos($agent, "blackberry");
            $ipod = strpos($agent, "ipod");
            $symbian = strpos($agent, "symbian");

            return ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian);
        } else {
            return false;
        }
    }


    public static function getCurrentUrl()
    {
        $domain = $_SERVER['HTTP_HOST'];
        $protocolo = (isset($_SERVER["HTTPS"])) && $_SERVER["HTTPS"] == "on" ? 'https' : 'http';

        return $protocolo . "://" . $domain . $_SERVER['REQUEST_URI'];

    }

    public static function getCurrentStartDay()
    {

        return date("Y-m-d") . " 00:00:00";
    }


}