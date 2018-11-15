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
                <form method="POST" action="bestellingAfronden.php">
                    Voornaam:<input type="text" name="voornaam" class="form-control">
                    <br>
                    Achternaam:<input type="text" name="achternaam" class="form-control">
                    <br>
                    Address:<input type="text" name="address" class="form-control" value="">
                    <br>
                    Postcode:<input type="text" name="postcode" class="form-control" value="">
                    <br>
                    Woonplaats:<input type="text" name="woonplaats" class="form-control" value="">
                    <br>
                    Telefoonnummer:<input type="text" name="telefoonnummer" class="form-control" value="">
                    <br>
                    Email:<input type="text" name="email" class="form-control" value="">
                    <br>
                    <br>
                    <br>
                    <select id="CreditCardType" name="CreditCardType" class="form-control">
                        <option value="5">ABN BRAMBO</option>
                        <option value="6">ING</option>
                        <option value="7">BUNQ</option>
                        <option value="8">KNAB</option>
                        <option value="8">RABO BANK</option>
                        <option value="8">SNS BANK</option>
                    </select>
                    <br>
                    Rekeningnummer:<input type="text" name="rekeningnummer" class="form-control" value="">
                    <br>
                    Pasnummer:<input type="text" name="pasnummer" class="form-control" value="">
                    <br>
                    <input type="submit" value="Bestelling afronden">
                </form>
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






