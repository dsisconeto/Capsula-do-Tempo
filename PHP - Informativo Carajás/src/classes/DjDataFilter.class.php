<?php

class DjDataFilter
{


    public static function filter($var, $config)
    {

        if (isset($config["type"])) {


            switch ($config["type"]) {

                case "string":

                    $return = strval($var);

                    $return = (isset($config["tags"])) && $config["tags"] == false ? $return : strip_tags($return);

                    $return = (isset($config["max"])) && is_int($config["max"]) && $config["max"] > 0 ? substr($return, 0, $config["max"]) : $return;

                    $return = (isset($config["trim"])) && $config["trim"] == false ? $return : trim($return);

                    $return = (isset($config["tabs"])) && $config["tabs"] == false ? $return : str_replace("\r", "", $return);

                    $return = (isset($config["break"])) && $config["break"] == false ? $return : str_replace("\n", "", $return);

                    $return = (isset($config["slashes"])) && $config["slashes"] == false ? $return : addslashes($return);

                    return $return;

                    break;

                case "str":

                    $return = strval($var);

                    $return = (isset($config["tags"])) && $config["tags"] == false ? $return : strip_tags($return);

                    $return = (isset($config["max"])) && is_int($config["max"]) && $config["max"] > 0 ? substr($return, 0, $config["max"]) : $return;

                    $return = (isset($config["trim"])) && $config["trim"] == false ? $return : trim($return);

                    $return = (isset($config["tabs"])) && $config["tabs"] == false ? $return : str_replace("\r", "", $return);

                    $return = (isset($config["break"])) && $config["break"] == false ? $return : str_replace("\n", "", $return);

                    $return = (isset($config["slashes"])) && $config["slashes"] == false ? $return : addslashes($return);

                    return $return;

                    break;

                case "int":


                    return intval($var);

                    break;

                case "float":
                    return floatval($var);

                    break;

                case "double":
                    return doubleval($var);
                    break;

                case "boolean":
                    return boolval($var);
                    break;

                case "date":

                    return $var;

                    break;

                default:

                    return null;

                    break;

            }


        } else {

            return null;
        }
    }


    public static function standardizeString($string)
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


}

