<?php
require_once("config.php");

function myAutoLoad($strClass)
{
    require_once(classPath() . '/' . $strClass . '.php');
}

spl_autoload_register("myAutoLoad");

?>