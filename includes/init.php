<?php
//Haalt het pad op naar de classes map
require_once("config.php");

//Dit is een functie die automatisch de class laad bijn het noemen van een class
//dus bijvoorbeeld class test: test(); zorgt ervoor dat automatisch  een require "Classes/test.php"; wordt gedaan
function myAutoLoad($strClass)
{
    require_once(classPath() . '/' . $strClass . '.php');
}

spl_autoload_register("myAutoLoad");

?>