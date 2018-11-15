<?php
require_once "includes/Functions.php";
session_start();
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
        <?php
        if (isset($_POST['winkelmandLeegmaken'])) {
            unset($_SESSION['bestelling']);
            $_SESSION['countBestelling'] = 0;
        }
        ?>
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


                Beste <?php
                print (filter_input(INPUT_POST, "voornaam", FILTER_SANITIZE_STRING));
                print (" ");
                print (filter_input(INPUT_POST, "achternaam", FILTER_SANITIZE_STRING));
                ?>
                uw betaling is gelukt en de bestelling is geplaats.
                <br>
                Uw bestelling wordt geleverd op: <?php
                print ("<br>");
                print (filter_input(INPUT_POST, "address", FILTER_SANITIZE_STRING));
                print ("<br>");
                print (filter_input(INPUT_POST, "postcode", FILTER_SANITIZE_STRING));
                print ("<br>");
                print (filter_input(INPUT_POST, "woonplaats", FILTER_SANITIZE_STRING));
                ?>

                <br>
                Bedankt voor het winkelen bij Wide World Importers!

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






