<?php

/**
 * Created by PhpStorm.
 * User: Wolter van Donk
 * Date: 6-11-2018
 * Time: 11:44
 */
Function DBconnectie() {
    try {
        $dbh = new PDO('mysql:host=127.0.0.1;dbname=wideworldimporters', 'root', '');
        return $dbh;
    } catch (PDOException $e) {
        return ("Error!: " . $e->getMessage() . "<br/>");
    }
}

Function displayHeader() {
    $result = '
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Wide World Importers</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="css/main.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="css/shop-item.css" rel="stylesheet">
    ';

    return $result;
}

Function displayNavBar() {
    $result = '<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">Wide World Importers</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Inloggen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="winkelwagen.php">Winkelmand (' . $_SESSION['countBestelling'] . ')</a>
                </li>
            </ul>
        </div>
    </div>
</nav>';
    return $result;
}
