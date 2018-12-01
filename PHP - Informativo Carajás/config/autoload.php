<?php
sysLoadClass("DjWork");
sysLoadClass("Framework");
sysLoadClass("DjRequest");
sysLoadClass("DjRouter");
sysLoadClass("DjReturnMsg");
sysLoadClass("DjReturnMsg");
sysLoadClass("DjDataFilter");


sysLoadClass("dbConnection");
sysLoadClass("SystemLogin");
sysLoadClass("Expression");
sysLoadClass("Criteria");
sysLoadClass("Filter");
sysLoadClass("SqlInstruction");
sysLoadClass("SqlSelect");
sysLoadClass("SqlInsert");
sysLoadClass("SqlUpdate");
sysLoadClass("SqlDelete");
sysLoadClass("SystemUrl");
sysLoadClass("GeoRegion");

DjWork::sessionStart();

function dd($var, $exit = true)
{

    if (is_array($var) || is_object($var)) {
        echo "<pre>";
        print_r($var);
        echo "</pre>";

    } else {

        echo $var;
        echo "<br>";
    }
    if ($exit) {

        exit();

    }
}


function sysLoadClass($class)
{
    static $includes;

    if (!isset($includes[$class])) {

        $includes[$class] = true;

        if (file_exists("../src/core/action/" . $class . ".php")):
            require_once("../src/core/action/" . $class . ".php");
        // verificar // classes
        elseif (file_exists("../src/classes/" . $class . ".class.php")):
            require_once("../src/classes/" . $class . ".class.php");
/// verificar core
        elseif (file_exists("../src/core/" . $class . ".php")):
            require_once("../src/core/" . $class . ".php");
// verificar db
        elseif (file_exists("../src/classes/db/" . $class . ".class.php")):
            require_once("../src/classes/db/" . $class . ".class.php");
// verificar model
        elseif (file_exists("../src/core/model/" . $class . ".php")):
            require_once("../src/core/model/" . $class . ".php");

        /// carregando a
        else:
            echo "não foi encontrada a classe " . $class;
        endif;

    }
}


function asset($file)
{
    $config = DjWork::getConfigs();
    $host = $config["asset"];
    return "$host$file?v=" . $config["version"];

}

function host($file = "")
{
    if (substr($file, 0, 1) == "/") {
        $file = substr($file, 1);
    }
    $config = DjWork::getConfigs();
    $host = $config["sv_host"];
    return $host . $file;
}


function redirect($url_completa)
{
    header("location:$url_completa");
    exit();
}


function config($name)
{
    $config = include __DIR__ . "/config.php";

    return isset($config[$name]) ? $config[$name] : "";

}

function is_https()
{
    return isset($_SERVER["HTTPS"]);
}


?>