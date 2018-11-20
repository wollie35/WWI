<?php
/**
 * Created by PhpStorm.
 * User: Wolter van Donk
 * Date: 20-11-2018
 * Time: 15:56
 */

session_start();
session_destroy();

header('Location: index.php');
?>