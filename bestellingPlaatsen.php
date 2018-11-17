<?php
require_once "includes/Functions.php";
session_start();
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
<!--Formulier voor het invullen van klantgegevens -->
            <div class="col-lg-9">
                <form method="POST" action="bestellingAfronden.php">
                    <br>
                    <span id="Betalen" class="badge badge-pill badge-secondary">Gegevens: </span>
                    Voornaam:<input type="text" name="voornaam" class="form-control">
                    <br>
                    Achternaam:<input type="text" name="achternaam" class="form-control">
                    <br>
                    Adres:<input type="text" name="adres" class="form-control" value="">
                    <br>
                    Postcode:<input type="text" name="postcode" class="form-control" value="">
                    <br>
                    Woonplaats:<input type="text" name="woonplaats" class="form-control" value="">
                    <br>
                    Telefoonnummer:<input type="text" name="telefoonnummer" class="form-control" value="">
                    <br>
                    Email:<input type="text" name="email" class="form-control" value="">
                    <br>
                    <span id="Betalen" class="badge badge-pill badge-secondary">Betalen: </span>
                    <br>
                    <br>
                    Bank:<select id="CreditCardType" name="CreditCardType" class="form-control">
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
                    <input type="submit" value="Bestelling afronden" class="btn btn-info ">


                    <a href="index.php" class="btn btn-info float-right"> verder winkelen </a>
                </form>
                <br>
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






