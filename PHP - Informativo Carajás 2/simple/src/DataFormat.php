<?php

namespace DSisconeto\Simple;

class DataFormat
{

    public static function embedMaps($embed)
    {
        preg_match_all("/embed\?pb\=(.+)\" width\=/", $embed, $preg);

        if (isset($preg[1][0])) {

            return $preg[1][0];

        } else {

            return "";
        }

    }

    public static function select2($array, $arg, $print = true)
    {

        $count = 0;
        $json = array();

        if ($array && $arg) {

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


    public static function monthToBr($numberMonth)
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

            case 5:
                return "Maio";
            case 6:
                return "Junho";

            case 7:
                return "Julho";
            case 8:
                return "Agosto";

            case 9:
                return "Setembro";

            case 10:
                return "Outubro";
            case 11:
                return "Novembro";

            case 12:
                return "Dezembro";

            default:
                return "";
        }


    }

    public static function convertType($var, $type)
    {
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


    public static function dateToViewBr($dateEn)
    {
        $data = explode(" ", $dateEn);
        if (isset($data[0]) && isset($data[1])):
            $date = explode("-", $data[0]);
            $time = $data[1];
        else:
            $date = explode("-", $dateEn);
        endif;


        if (isset($date[0]) && isset($date[1]) && isset($date[2])):

            $dateBr = $date[2] . " de " . self::monthToBr($date[1]) . " de " . $date[0];

            if (isset($time)):

                $dateBr .= " ás " . substr($time, 0, 5);

            endif;


            return $dateBr;
        else:
            return false;
        endif;


    }


    public static function dateLess($dateTime, $less)
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
                        $date[2] = "0" . $date[2];
                    endif;


                    $restMo = $less / 30;
                    $restMo = intval($restMo);
                    if ($restMo < 1):
                        $restMo = 1;
                    endif;
                    $date[1] -= $restMo;

                    if ($date[1] <= 9):
                        $date[1] = "0" . $date[1];
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

    public static function standardizeUrl($string)
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
            'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'þ' => 'b',
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


    public static function phone($dd, $phone, $type = false)
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


    public static function keyWords($str, $returnArray = false)
    {
        $str = strtolower($str);
        $words = "";
        $search = array('.', ',', '!', "?", '\'', '@', '#', '$', '%', '¨', '&', '*', '(', ')', '-', '_', '+', '_', '=',
            '\\', '|', '<', '>', ':', ';', '/', '{', '}', '[', ']', '´', '`', '~', '^', 'º', 'ª',
        );

        $count = count($search);
        $replace = array();
        for ($i = 0; $i < $count; $i++) {
            $replace[] = "";
        }

        $str = str_replace($search, $replace, $str);


        $str = trim($str);
        $str = stripcslashes($str);
        $str = explode(" ", $str);

        $str = array_unique($str);
        if ($returnArray) {
            return $str;
        }
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


        } catch (\Exception $e) {

            return false;
        }

    }


    public static function limitText($txt, $limit)
    {
        // retirando as tags HTML
        $texto = strip_tags($txt);

        //retirando os espaços especias $texto

        $texto = stripcslashes($texto);
        $texto = self::removesBreak($texto);
        $contador = strlen($texto);
        if ($contador >= $limit) {
            // contando
            $texto = substr($texto, 0, strrpos(substr($texto, 0, $limit), ' ')) . '...';
            return $texto;
        } else {

            return $texto;
        }
    }

    public static function removesBreak($texto)
    {
        $texto = str_replace("\n", "", (trim($texto)));
        $texto = str_replace("\r", "", (trim($texto)));
        $texto = trim($texto);
        return $texto;
    }


    public static function dateAdvanced($dateTime, $Advanced)
    {

        $dateOk = explode(" ", $dateTime);

        if (isset($dateOk[0]) && isset($dateOk[1])) {
            $date = $dateOk[0];
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

}