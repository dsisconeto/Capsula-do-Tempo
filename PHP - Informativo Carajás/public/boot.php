<?php


require_once __DIR__ . "/../vendor/autoload.php";

require_once __DIR__ . "/../config/autoload.php";


if (config("env") == "prod" && !is_https()) {

    redirect(host($_SERVER["REQUEST_URI"]));
}


DjRouter::boot();

switch (DjRequest::get("boot")) {

    case "services":

        DjRouter::executeServices();
        break;


    case "controller":

        DjRouter::executeController();
        break;

    case "form":


        DjRouter::executeForm();
        break;
}

exit;
