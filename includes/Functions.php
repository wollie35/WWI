<?php
/**
 * Created by PhpStorm.
 * User: Wolter van Donk
 * Date: 6-11-2018
 * Time: 11:44
 */
Function DBconnectie()
{
    try {
        $dbh = new PDO('mysql:host=127.0.0.1;dbname=wideworldimporters', 'root', '');
        return $dbh;
    } catch (PDOException $e) {
        return ("Error!: " . $e->getMessage() . "<br/>");
    }
}