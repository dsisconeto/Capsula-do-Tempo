<?php

fInclude("config/define.php");
fInclude("config/functions.php");

function __autoload($class) { fInclude("class/$class.php"); }