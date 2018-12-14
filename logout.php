<?php
/**
 * Created by PhpStorm.
 * User: Wolter van Donk
 * Date: 20-11-2018
 * Time: 15:56
 */
session_start();
session_destroy();
session_start();
$_SESSION['loggedOut'] = true;

header('Location: index.php');
?>