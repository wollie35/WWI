<?php
require_once "includes/Functions.php";
session_start();
//Maak de winkelmand leeg als de bestelling is afgerond
unset($_SESSION["bestelling"]);
unset($_SESSION["countBestelling"]);
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <?= displayHeader(); ?>
        <link href="css/table.css" rel="stylesheet">
    </head>

    <body>
        <!-- Navigation -->
        <?= displayNavBar(); ?>

        <!-- Page Content -->
        <div class="container">

            <div class="row">
                <div class="col-lg-3">
                </div>
            </div>
            <!-- /.col-lg-3 -->

            <div class="col-lg-9">

<!--                Dit laat de klantinformatie zien die is ingevuld-->
                Beste <?php
                print (filter_input(INPUT_POST, "voornaam", FILTER_SANITIZE_STRING));
                print (" ");
                print (filter_input(INPUT_POST, "achternaam", FILTER_SANITIZE_STRING));
                ?>
                uw betaling is gelukt en de bestelling is geplaats.
                <br>
                Uw bestelling wordt geleverd op: <?php
                print ("<br>");
                print (filter_input(INPUT_POST, "adres", FILTER_SANITIZE_STRING));
                print ("<br>");
                print (filter_input(INPUT_POST, "postcode", FILTER_SANITIZE_STRING));
                print ("<br>");
                print (filter_input(INPUT_POST, "woonplaats", FILTER_SANITIZE_STRING));
                ?>

                <br>
                Bedankt voor het winkelen bij Wide World Importers!
                <br>
                <form method="post" action="index.php">
                    <input type="submit" value="Terug naar hoofdpagina" class="btn btn-info">

                    </div>
                    <!-- /.container -->

                    <!-- Footer -->
                    <footer class="py-5 bg-dark">
                        <div class="container">
                            <p class="m-0 text-center text-white">Copyright &copy; Wide World Importers 2018</p>
                        </div>
                        <!-- /.container -->
                    </footer>

                    <!-- Bootstrap core JavaScript -->
                    <script src="vendor/jquery/jquery.min.js"></script>
                    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                    </body>

                    </html>






