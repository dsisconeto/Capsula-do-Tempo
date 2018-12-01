<?php

/**
 * Created by PhpStorm.
 * User: dejai
 * Date: 23/08/2016
 * Time: 04:07
 */
class DjRequest
{


    public static function cookie($cookieName, $type = false, $valueDefault = "")
    {
        return self::requestInput($cookieName, "cookie", $type, $valueDefault);

    }

    public static function post($postName, $type = false, $valueDefault = "")
    {
        return self::requestInput($postName, "post", $type, $valueDefault);

    }


    public static function get($getName, $type = false, $valueDefault = "")
    {

        return self::requestInput($getName, "get", $type, $valueDefault);

    }

    public static function session($getName, $type = false, $valueDefault = "")
    {
        return self::requestInput($getName, "session", $type, $valueDefault);

    }

    public static function file($getName)
    {

        return self::requestInput($getName, "file", "", "");
    }


    private static function requestInput($name, $method, $dataType = false, $valueDefault = null)
    {

        $method = strtolower($method);

        switch ($method) {

            case "post":
                $method = $_POST;
                break;

            case "get":
                $method = $_GET;
                break;


            case "file":


                $method = $_FILES;

                break;

            case "cookie":
                $method = $_COOKIE;
                break;

            case "session":
                DjWork::sessionStart();
                $method = $_SESSION;
                break;

        }

        if (isset($method[$name])) {

            $data = $method[$name];


            $data = Framework::convertType($data, $dataType);

            return $data;

        } else {

            return $valueDefault;

        }

    }


    public static function requestInputOther($name, $dataType = false)
    {

        if (self::get($name, $dataType)) {

            return self::get($name, $dataType);

        } elseif (self::post($name, $dataType)) {

            return self::post($name, $dataType);

        } else {

            return self::cookie($name, $dataType);
        }


    }

    public static function setGet($name, $value)
    {
        if ($name && $value || (is_numeric($value))) {

            $_GET["$name"] = $value;

            return $_GET["$name"];

        } else {

            return null;
        }
    }


    public static function setSession($name, $value)
    {

        DjWork::sessionStart();
        if ($name && $value || (is_numeric($value))) {

            $_SESSION["$name"] = $value;

            return $_SESSION["$name"];

        } else {

            return null;
        }

    }

    public static function setPost($name, $value)
    {

        if ($name && $value || (is_numeric($value))) {

            $_POST["$name"] = $value;

            return $_POST["$name"];

        } else {

            return null;
        }
    }


    public static function issetGet($name)
    {
        return self::issetRequest($name, "get");
    }

    public static function issetPost($name)
    {
        return self::issetRequest($name, "post");
    }

    public static function issetCookie($name)
    {

        return self::issetRequest($name, "cookie");

    }

    private static function issetRequest($name, $method)
    {
        switch ($method) {

            case "post":
                $method = $_POST;
                break;

            case "get":
                $method = $_GET;
                break;

            case "cookie":
                $method = $_COOKIE;
                break;

            case "session":
                DjWork::sessionStart();
                $method = $_SESSION;
                break;


        }

        return isset($method[$name]) ? true : false;
    }


}