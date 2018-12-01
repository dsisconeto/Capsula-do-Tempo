<?php

/**
 * Class Framework
 */
class Framework
{

    private $imgFolder;
    private static $host;

    public function getHost()
    {
        if (!self::$host):
            $config = DjWork::getConfigs();
            self::$host = $config["sv_host"];
        endif;

        return self::$host;
    }

    public function setImgFolder($imgFolder, $folder = 1)
    {
        $this->imgFolder[$folder] = $imgFolder;
    }

    public function getImgFolderLg($img = false, $folder = 1, $host = false)
    {
        return $this->getImgFolderSize("lg", $img, $folder, $host);
    }

    public function getImgFolderMd($img = false, $folder = 1, $host = false)
    {
        return $this->getImgFolderSize("md", $img, $folder, $host);
    }

    public function getImgFolderSm($img = false, $folder = 1, $host = false)
    {
        return $this->getImgFolderSize("sm", $img, $folder, $host);
    }

    public function getImgFolderXs($img = false, $folder = 1, $host = false)
    {
        return $this->getImgFolderSize("xs", $img, $folder, $host);
    }

    public function getImgFolderXxs($img = false, $folder = 1, $host = false)
    {
        return $this->getImgFolderSize("xxs", $img, $folder, $host);
    }


    private function getImgFolderSize($size, $img = false, $folder = 1, $host = false)
    {
        $exp = $host ? DjWork::getHost() : "";

        $folder = $this->imgFolder[$folder];
        $exp .= "img/$folder/$size/";
        if ($img) {
            $exp .= $img;
        }
        return $exp;
    }


    public function imgExists($img, $imgFolder = 1)
    {

        $lg = file_exists($this->getImgFolderLg($img, $imgFolder));
        $md = file_exists($this->getImgFolderMd($img, $imgFolder));
        $sm = file_exists($this->getImgFolderSm($img, $imgFolder));
        $xs = file_exists($this->getImgFolderXs($img, $imgFolder));
        $xxs = file_exists($this->getImgFolderXxs($img, $imgFolder));


        return (strlen($img) >= 1) && ($lg && $md && $sm && $xs && $xxs);
    }


    public function imgDelete($img, $imgFolder = 1)
    {

        $lg = (strlen($img) >= 1) && file_exists($this->getImgFolderLg($img, $imgFolder));
        $md = (strlen($img) >= 1) && file_exists($this->getImgFolderMd($img, $imgFolder));
        $sm = (strlen($img) >= 1) && file_exists($this->getImgFolderSm($img, $imgFolder));
        $xs = (strlen($img) >= 1) && file_exists($this->getImgFolderXs($img, $imgFolder));
        $xxs = (strlen($img) >= 1) && file_exists($this->getImgFolderXxs($img, $imgFolder));
        $lg ? unlink($this->getImgFolderLg($img, $imgFolder)) : false;
        $md ? unlink($this->getImgFolderMd($img, $imgFolder)) : false;
        $sm ? unlink($this->getImgFolderSm($img, $imgFolder)) : false;
        $xs ? unlink($this->getImgFolderXs($img, $imgFolder)) : false;
        $xxs ? unlink($this->getImgFolderXxs($img, $imgFolder)) : false;

    }


    /**
     * @param $order
     * @return string
     */
    public function defineOrder($order)
    {
        if ($order == "DESC"):
            $order = "DESC ";
        elseif ($order == "desc"):
            $order = " DESC ";
        else:
            $order = " ASC";
        endif;

        return $order;
    }


    /**
     * @var
     */
    private $arrayMsg;
    /**
     * @var
     */
    private $returnMsg;

    /**
     * @param $msg
     * @param $boolean
     * @param $codeMsg
     * @param null $data
     *  deve ser setado as mensagens no contrutor da classe
     */


    public function setMsg($msg, $boolean, $codeMsg, $data = NULL)
    {
        $this->arrayMsg[$codeMsg]["msg"] = $msg;
        $this->arrayMsg[$codeMsg]["boolean"] = $boolean;
        $this->arrayMsg[$codeMsg]["data"] = $data;
    }

    /**
     * @return mixed
     */
    public function getReturn($json = false)
    {
        if ($json) {

            echo json_encode($this->returnMsg);
        }
        return $this->returnMsg;

    }

    /**
     *
     */
    public function cleanReturnMsg()
    {
        $this->returnMsg = NULL;
    }


    /**
     * @param $codeMsg
     * @param null $data
     * @return bool
     *  esse metodo retonar a um array com a menssagem
     */
    public function setReturn($codeMsg, $data = NULL)
    {
        if (array_key_exists($codeMsg, $this->arrayMsg)):
            if (!is_null($data)):
                $this->arrayMsg[$codeMsg]["data"] = $data;
            endif;

            $count = count($this->returnMsg);
            if ($count > 0):
                $count++;
                $this->returnMsg[$count] = $this->arrayMsg[$codeMsg];
            else:
                $this->returnMsg[0] = $this->arrayMsg[$codeMsg];
            endif;

        endif;
    }


    /**
     * @param $array
     */
    public function printR($array)
    {

        echo "<pre>";
        print_r($array);
        echo "</pre>";
        echo "<br>";

    }


    public function dateAdvanced($dateTime, $Advanced)
    {

        $dateOk = explode(" ", $dateTime);

        if (isset($dateOk[0]) && isset($dateOk[1])) {
            $date = $dateOk[0];
            $time = $dateOk[1];
            $time = $dateOk[1];

            $dateEx = explode("-", $date);


            if (isset($dateEx[0]) && isset($dateEx[1]) && isset($dateEx[2])) {

                $dayMath = $Advanced + $dateEx[2];
                $monthMath = $dateEx[1];
                $yMath = $dateEx[0];

                if ($dayMath > 30) {
                    $monthMath++;
                    $dayMath -= 30;
                }

                if ($monthMath == 13) {
                    $yMath++;
                    $monthMath--;
                }


                $dateReturn = $yMath . "-" . $monthMath . "-" . $dayMath . " " . $time;

                return $dateReturn;
            } else {
                return false;
            }


        } else {
            return false;
        }


    }


    /**
     * @param $dateTime
     * @param $less
     * @return bool|string
     */
    public function dateLess($dateTime, $less)
    {
        $dateTime = explode(" ", $dateTime);

        if (isset($dateTime[0]) && isset($dateTime[1])):

            $date = $dateTime[0];
            $time = $dateTime[1];

            $date = explode("-", $date);

            if (isset($date[0]) && isset($date[1]) && isset($date[2])):
                $date[0] = intval($date[0]);
                $date[1] = intval($date[1]);
                $date[2] = intval($date[2]);

                if ($less < $date[2]):
                    // caso senha menos de trintas dias
                    /// ou seja menor que o tanto de dias já passados do mês
                    $date[2] = $date[2] - $less;

                else:

                    $lessDay = $less - $date[2];

                    $restDay = (30 - $lessDay);
                    if ($restDay == 0):
                        $restDay = 29;
                    endif;

                    $date[2] = $restDay;


                    if ($date[2] <= 9):
                        "0" . $date[2];
                    endif;


                    $restMo = $less / 30;
                    $restMo = intval($restMo);
                    if ($restMo < 1):
                        $restMo = 1;
                    endif;
                    $date[1] -= $restMo;

                    if ($date[1] <= 9):
                        "0" . $date[1];
                    endif;


                    if ($less > 360):
                        $rest3 = $less / 360;

                        $rest3 = intval($rest3);

                        if ($rest3 < 1):
                            $rest3 = 1;
                        endif;
                        $date[0] -= $rest3;
                    endif;

                endif;


                $dateOk = "{$date[0]}-{$date[1]}-{$date[2]}";

                return "$dateOk $time";
            else:
                return false;
            endif;
        else:
            return "Não é Datatime";
        endif;

    }


    ////
    //// validate
    ////

    /**
     * @param $phone
     * @param bool $NULL
     * @return bool
     * o formato esparado é (xx)xxxx-xxxx ou (xx)xxxxx-xxxx
     */
    function validatePhone($phone, $NULL = FALSE)
    {
        /* validar fone para tramento de dados
         *  false caso não seja um telefone
         */

        if (preg_match("/^\([0-9]{2}\)[0-9]{4}-[0-9]{4}/", $phone) || preg_match("/^\([0-9]{2}\)[0-9]{5}-[0-9]{4}/", $phone) || ($NULL == TRUE && $phone == NULL)):
            return true;
        else:
            return false;
        endif;
    }

    /**
     * @param $cep
     * @return bool
     * o formato esperado é xx.xxx-xxx
     */
    function validateCep($cep)
    {
        /* validar fone para tramento de dados
         *  false caso não seja um telefone
         *
         */
        if (preg_match("/^[0-9]{2}.[0-9]{3}-[0-9]{3}/", $cep)):
            return true;
        else:
            return false;
        endif;
    }


    /**
     * @param $url
     * @return bool
     * espera uma url padrão http
     */
    function validateUrlHttp($url)
    {
        if (preg_match('|^http(s)?://[a-z0-9-]+(\.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url)):
            return true;
        else:
            return false;
        endif;
    }

    /**
     * @param $email
     * @param bool $null
     * @return bool
     */
    function validateEmail($email, $null = FALSE)
    {

        /*
         * validar email para tramento de dados
         *  false caso não seja um email
         *
         */
        $conta = "/^[a-zA-Z0-9\._-]+@";
        $domino = "[a-zA-Z0-9\._-]+.";
        $extensao = "([a-zA-Z]{2,4})/";
        $pattern = $conta . $domino . $extensao;
        if (preg_match($pattern, $email) || ($null == TRUE && $email == NULL))
            return true;
        else
            return false;
    }

    /**
     * @param $string
     * @param null $min
     * @param null $max
     * @return bool
     */
    function validateCounterString($string, $min = NULL, $max = NULL)
    {
        if (is_null($max) && !is_null($min)):

            return (strlen($string) >= $min);

        elseif (is_null($min) && !is_null($max)):

            return (strlen($string) <= $max);

        elseif (!is_null($min) && !is_null($max)):

            return (strlen($string) >= $min && strlen($string) <= $max);

        else:
            return true;
        endif;
    }


    ///////////
    ///////// function strings

    /**
     * @param $str
     * @return string
     */
    public function keyWords($str)
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

    /**
     * @param $dateBr
     * @param bool $datetime
     * @return bool|string
     */
    public function dateToEn($dateBr, $datetime = false)
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

    public static function getCurrentUrl()
    {

        $domain = $_SERVER['HTTP_HOST'];
        $url = "http://" . $domain . $_SERVER['REQUEST_URI'];

        return $url;


    }


    public static function convertType($var, $type)
    {
        $res = "";
        if ($type) {


            switch ($type) {

                case "string":
                    $res = strval($var);
                    $res = trim($res);
                    break;

                case "str":
                    $res = strval($var);
                    $res = trim($res);
                    break;

                case "int":
                    $res = intval($var);
                    break;

                case "float":
                    $res = floatval($var);

                    break;

                case "double":
                    $res = doubleval($var);
                    break;

                case "boolean":
                    $res = boolval($var);
                    break;

                case "file":
                    $res = $var;
                    break;

                case "array":
                    $res = is_array($var) ? $var : array();

                    break;

                default:
                    $res = $var;
                    break;
            }


            return $res;


        } else {

            return $var;
        }
    }

    /**
     * @param $dateEn
     * @param bool $datetimeReturn
     * @return bool|string
     */
    public function dateToBr($dateEn, $datetimeReturn = false)
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
     * @param $dateEn
     * @return bool|string
     */
    public function dateToViewBr($dateEn)
    {
        $data = explode(" ", $dateEn);
        if (isset($data[0]) && isset($data[1])):
            $date = explode("-", $data[0]);
            $time = $data[1];
        else:
            $date = explode("-", $dateEn);
        endif;


        if (isset($date[0]) && isset($date[1]) && isset($date[2])):

            $dateBr = $date[2] . " de " . $this->monthToBr($date[1]) . " de " . $date[0];

            if (isset($time)):

                $dateBr .= " ás " . substr($time, 0, 5);

            endif;


            return $dateBr;
        else:
            return false;
        endif;


    }


    /**
     * @param $numberMonth
     * @return string
     */
    public
    function monthToBr($numberMonth)
    {
        switch ($numberMonth) {
            case 1:
                return "Janeiro";
                break;
            case 2:
                return "Fevereiro";
                break;

            case 3:
                return "Março";
                break;

            case 4:
                return "Abril";
                break;

            case 5:
                return "Maio";
                break;

            case 6:
                return "Junho";
                break;

            case 7:
                return "Julho";
                break;
            case 8:
                return "Agosto";
                break;

            case 9:
                return "Setembro";
                break;

            case 10:
                return "Outubro";
                break;

            case 11:
                return "Novembro";
                break;
            case 12:
                return "Dezembro";
                break;

        }


    }


    /**
     * @param array $arrayMsgError
     * @return string
     */
    public
    function errorMsg(Array $arrayMsgError)
    {
        $msg = "<ul>";
        $count = count($arrayMsgError);
        for ($i = 0; $i <= $count; $i++):

            if (isset($arrayMsgError[$i])):

                $msg .= "<li>" . $arrayMsgError[$i]["msg"] . "</li>";

            endif;
        endfor;

        $msg .= "</ul>";
        return $msg;
    }


    /**
     * @param $page
     * @param $limitByPage
     * @param int $skip
     * @return string
     */
    public function paginate($page, $limitByPage, $skip = 0)
    {
        if ($skip) {

            $skip += 1;

        }

        $page = $page == 0 ? 1 : $page;

        $page -= 1;


        $limitStart = ($page * $limitByPage) + $skip;

        return "$limitStart, $limitByPage";

    }


    /**
     * @param $date
     * @param string $format
     * @return bool
     */
    function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }


    /**
     * @param $string
     * @return mixed|string
     */


    /**
     * @return mixed
     * retorna o ip do usuario
     */
    public
    function getIp()
    {
        return $_SERVER['REMOTE_ADDR'];
    }

    /**
     * @param $txt
     * @param $limit
     * @return mixed|string
     */
    function limitText($txt, $limit)
    {
        // retirando as tags HTML
        $texto = strip_tags($txt);

        //retirando os espaços especias $texto

        $texto = stripcslashes($texto);
        $texto = $this->removesBreak($texto);
        $contador = strlen($texto);
        if ($contador >= $limit) {
            // contando
            $texto = substr($texto, 0, strrpos(substr($texto, 0, $limit), ' ')) . '...';
            return $texto;
        } else {

            return $texto;
        }
    }

    /**
     * @param $texto
     * @return mixed
     */
    public function removesBreak($texto)
    {
        $texto = str_replace("\n", "", (trim($texto)));
        $texto = str_replace("\r", "", (trim($texto)));
        $texto = trim($texto);
        return $texto;
    }

    /**
     * @param $texto
     * @param bool $html
     * @return mixed|string
     */
    public
    function filterString($texto, $html = TRUE)
    {
        // retirando as tags HTML
        if ($html):
            $texto = strip_tags($texto);
        endif;
        $texto = $this->removesBreak($texto);
        // retirando os espaços especias $texto
        $texto = addslashes($texto);
        $texto = trim($texto);
        return $texto;
    }


///
/// is


    /**
     * @param $url
     * @return string
     */
    public
    function isUrlHttp($url)
    {
        if (substr($url, 0, 7) == "http://"):
            return $url;
        elseif (substr($url, 0, 8) == "https://"):
            return $url;
        else:
            return "http://" . $url;
        endif;
    }

    /**
     * @return bool
     */
    public
    function isAndroid()
    {
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        $android = strpos($agent, "android");

        return $android;
    }


    /**
     * @return bool
     */
    public
    function isMobileDevice()
    {
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);

        $iphone = strpos($agent, "iphone");
        $ipad = strpos($agent, "ipad");
        $android = strpos($agent, "android");
        $palmpre = strpos($agent, "webos");
        $berry = strpos($agent, "blackberry");
        $ipod = strpos($agent, "ipod");
        $symbian = strpos($agent, "symbian");

        return ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian);
    }


    /**
     * @return string
     */
    public
    function captureOs()
    {
        $useragent = $_SERVER['HTTP_USER_AGENT'];
        $useragent = strtolower($useragent);
        //check for (aaargh) most popular first
        //winxp
        if (strpos("$useragent", "iphone")) {
            return "iphone";
        } elseif (strpos("$useragent", "ipad")) {
            return "ipad";
        } elseif (strpos("$useragent", "android")) {
            return "android";
        } elseif (strpos("$useragent", "webos")) {
            return "webos";
        } elseif (strpos("$useragent", "blackberry")) {
            return "blackberry";
        } elseif (strpos("$useragent", "symbian")) {
            return "symbian";
        } elseif (strpos("$useragent", "ipod")) {
            return "ipod";
        } elseif (strpos("$useragent", "windows nt 5.1")) {
            return "windows nt 5.1";
        } elseif (strpos("$useragent", "windows nt 6.0") !== false) {
            return "windows nt 6.0";
        } elseif (strpos("$useragent", "windows nt 6.1") !== false) {
            return "windows nt 6.1";
        } elseif (strpos("$useragent", "windows 98") !== false) {
            return "windows 98";
        } elseif (strpos("$useragent", "windows nt 5.0") !== false) {
            return "windows nt 5.0";
        } elseif (strpos("$useragent", "windows nt 5.2") !== false) {
            return "windows nt 5.2";
        } elseif (strpos("$useragent", "windows nt") !== false) {
            return "windows nt";
        } elseif (strpos("$useragent", "win 9x 4.90") !== false && strpos("$useragent", "win me")) {
            return "win 9x 4.90";
        } elseif (strpos("$useragent", "win ce") !== false) {
            return "win ce";
        } elseif (strpos("$useragent", "win 9x 4.90") !== false) {
            return "win 9x 4.90";
        } elseif (strpos("$useragent", "iphone") !== false) {
            return "iphone";
        } elseif (strpos("$useragent", "mac os x") !== false) {
            return "mac os x";
        } elseif (strpos("$useragent", "macintosh") !== false) {
            return "macintosh";
        } elseif (strpos("$useragent", "linux") !== false) {
            return "linux";
        } elseif (strpos("$useragent", "freebsd") !== false) {
            return "freebsd";
        } elseif (strpos("$useragent", "symbian") !== false) {
            return "symbian";
        } else {
            return "none";
        }
    }

    function standardizeUrl($string)
    {

        $table = array(
            'Š' => 'S', 'š' => 's', 'Đ' => 'Dj', 'đ' => 'dj', 'Ž' => 'Z',
            'ž' => 'z', 'Č' => 'C', 'č' => 'c', 'Ć' => 'C', 'ć' => 'c',
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A',
            'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
            'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I',
            'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O',
            'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U',
            'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss',
            'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a',
            'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
            'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i',
            'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o',
            'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u',
            'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'ý' => 'y', 'þ' => 'b',
            'ÿ' => 'y', 'Ŕ' => 'R', 'ŕ' => 'r',
        );

        $string = trim($string);
        // Traduz os caracteres em $string, baseado no vetor $table
        $string = strtr($string, $table);
        // converte para minúsculo
        $string = strtolower($string);
        // remove caracteres indesejáveis (que não estão no padrão)
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        // Remove múltiplas ocorrências de hífens ou espaços
        $string = preg_replace("/[\s-]+/", " ", $string);
        // Transforma espaços e underscores em hífens
        $string = preg_replace("/[\s_]/", "-", $string);
        // retorna a string
        return $string;
    }


    /**
     * @return bool|string
     */
    public
    function currentTime()
    {
        return date("Y-m-d H:i:s");
    }

    public
    function currentStartDay()
    {

        return date("Y-m-d") . " 00:00:00";
    }


    public
    function currentEndDay()
    {

        return date("Y-m-d") . " 23:59:59";
    }


    public
    function formatPhone($dd, $phone, $type = false)
    {
        $sub1 = null;
        $sub2 = null;
        $phoneOk = "<small>$dd </small>";

        $len = strlen($phone);
        $phone = trim($phone);
        if ($len == 9) {
            $sub1 = substr($phone, 0, 5);
            $sub2 = substr($phone, 5, 9);

        } else {
            $sub1 = substr($phone, 0, 4);
            $sub2 = substr($phone, 4, 8);
        }

        $phoneOk .= "<b>$sub1-$sub2</b>";

        if ($type) {
            if ($type == 1) {
                $phoneOk .= " - Fixo";
            } else {

                $phoneOk .= " - Celular";
            }


        }

        return $phoneOk;
    }


    public
    static function returnSelect2Default($array, $arg, $print = true)
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

    public
    static function getEmbedGoogleMaps($embed)
    {
        preg_match_all("/embed\?pb\=(.+)\" width\=/", $embed, $preg);


        if (isset($preg[1][0])) {

            return $preg[1][0];

        } else {

            return "";
        }

    }

}
