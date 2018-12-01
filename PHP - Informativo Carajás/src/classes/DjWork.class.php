<?php

/**
 * Created by PhpStorm.
 * User: dsisconeto
 * Date: 27/08/16
 * Time: 14:44
 */
class DjWork
{
    private static $host;

    public static function currentTime()
    {
        return date("Y-m-d H:i:s");
    }

    private static function getConfig()
    {
        return include __DIR__ . "/../../config/config.php";
    }


    public static function getConfigs()
    {
        return include __DIR__ . "/../../config/config.php";
    }

    public static function getHost()
    {
        if (!self::$host):
            $config = self::getConfig();
            self::$host = $config["sv_host"];
        endif;

        return self::$host;

    }

    public static function existsTempImg($img)
    {

        return ($img && file_exists("img/temp/$img"));
    }


    public static function select2($array, $arg, $print = true)
    {

        $count = 0;
        $json = array();

        if ($array) {

            foreach ($array as $key):

                $json[$count]["id"] = $key[$arg["id"]];
                $json[$count]["text"] = $key[$arg["text"]];
                $count++;

            endforeach;
        }

        if ($print) {

            echo json_encode($json);

            exit();

        } else {

            return $json;
        }


    }

    public static function crawlerDetect()
    {
        $USER_AGENT = strtolower($_SERVER['HTTP_USER_AGENT']);

        $crawlers = array(
            array('booglebot', 'Google'),
            array('booglebot-images', 'Google Imagem'),
            array(' adsbot-google', 'Google AdWord'),
            array('mediapartners-google', 'Google Ads'),
            array('slurp', 'Yahoo'),
            array('bingbot', 'Bing')
        );

        foreach ($crawlers as $c) {
            if (stristr($USER_AGENT, $c[0])) {
                return ($c[1]);
            }
        }

        return false;
    }


    public static function captureOs()
    {
        $USER_AGENT = strtolower($_SERVER['HTTP_USER_AGENT']);
        $os = array(
            array('iphone', 'iphone'),
            array('ipad', 'ipad'),
            array('android', 'android'),
            array('webos', 'webos'),
            array('blackberry', 'blackberry'),
            array('symbian', 'symbian'),
            array('ipod', 'ipod'),
            array('windows nt 5.1', 'windows nt 5.1'),
            array('windows nt 6.0', 'windows nt 6.0'),
            array('windows nt 6.1', 'windows nt 6.1'),
            array('windows 98', 'windows 98'),
            array('windows nt 5.0', 'windows nt 5.0'),
            array('windows nt 5.2', 'windows nt 5.2'),
            array('windows nt', 'windows nt'),
            array('win 9x 4.90', 'win 9x 4.90'),
            array('win ce', 'win ce'),
            array('win 9x 4.90', 'win 9x 4.90'),
            array('mac os x', 'mac os x'),
            array('macintosh', 'macintosh'),
            array('linux', 'linux'),
            array('freebsd', 'freebsd'),
            array('macintosh', 'macintosh'),
        );

        foreach ($os as $s) {
            if (stristr($USER_AGENT, $s[0])) {
                return ($s[1]);
            }
        }

        return false;
    }


    public static function dateToBr($dateEn, $datetimeReturn = false)
    {
        try {
            $data = explode(" ", $dateEn);

            if (isset($data[0]) && isset($data[1])):
                $date = explode("-", $data[0]);
                $time = $data[1];
            else:
                $date = explode("-", $dateEn);
            endif;

            if (isset($date[2]) && isset($date[1]) && isset($date[0])) {

                $dateBr = $date[2] . "/" . $date[1] . "/" . $date[0];

                if ($datetimeReturn) {

                    if ((isset($time)) && $time):

                        $dateBr .= " " . $time;

                    else:
                        $dateBr .= " 00:00:00";
                    endif;
                }

            } else {
                return false;
            }

            return $dateBr;


        } catch (Exception $e) {

            return false;
        }

    }


    /**
     * @param $page
     * @param $limitByPage
     * @param int $skip
     * @return string
     */
    public static function paginate($page, $limitByPage, $skip = 0)
    {
        if ($skip) {
            $skip += 1;
        }
        $page = $page == 0 ? 1 : $page;
        $page -= 1;
        $limitStart = ($page * $limitByPage) + $skip;
        return "$limitStart, $limitByPage";
    }


    public static function dateToEn($dateBr, $datetime = false)
    {
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




    public static function currentUrl()
    {
        $domain = $_SERVER['HTTP_HOST'];
        $protocolo = (isset($_SERVER["HTTPS"])) && $_SERVER["HTTPS"] == "on" ? 'https' : 'http';

        $url = $protocolo . "://" . $domain . $_SERVER['REQUEST_URI'];
        return $url;
    }


    /**
     * @param $str
     * @return string
     */
    public static function keyWords($str)
    {

        $str = str_replace(array('.', ',', '!'), array('', '', ''), $str);
        $str = trim($str);
        $str = stripcslashes($str);
        $str = explode(" ", $str);

        $str = array_unique($str);

        foreach ($str as $key) {

            if (strlen($key) > 2):
                if (!isset($words)):
                    $words = $key . ",";

                else:
                    $words .= $key . ",";
                endif;
            endif;
        }

        return $words;
    }


    public static function sessionStart()
    {

        try {
            if (!isset($_SESSION)) {
                session_name(md5('session_name_mega_ic' . $_SERVER['REMOTE_ADDR']));
                session_start();
            }
        } catch (Exception $e) {

            echo "Não é um navegador\n";
        }

    }

    public static function deleteImgTemp($img)
    {
        $file = "img/temp/" . $img;

        if (strlen($img) > 1 && $img && file_exists($file)) {
            unlink($file);
        }

    }


}