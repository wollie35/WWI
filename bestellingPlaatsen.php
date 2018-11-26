<?php
require_once "includes/Functions.php";
session_start();
if(!isset($_SESSION['id']))
{
    $_SESSION['id'] = -1;
}
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
            <?php
            $DB = DBconnectie();
            $query = 'SELECT UserFirstname, UserLastName, UserAdres, UserPostal, UserCity, UserPhone, UserEmail, UserIBAN, UserPasnr FROM usersdetails WHERE UserId = '.$_SESSION['id'] ;
            $sql = $DB->prepare($query);

            $sql->execute();

            $sql = $sql->fetchAll();

            if(count($sql) > 0)
            {
                ?>
                <div class="col-lg-9">
                    <form method="POST" action="bestellingAfronden.php">
                        <br>
                        <span id="Betalen" class="badge badge-pill badge-secondary">Gegevens: </span>
                        Voornaam:<input type="text" name="voornaam" value="<?= $sql[0][0] ?>" class="form-control">
                        <br>
                        Achternaam:<input type="text" name="achternaam" value="<?= $sql[0][1] ?>" class="form-control">
                        <br>
                        Adres:<input type="text" name="adres" value="<?= $sql[0][2] ?>" class="form-control" value="">
                        <br>
                        Postcode:<input type="text" name="postcode" value="<?= $sql[0][3] ?>" class="form-control" value="">
                        <br>
                        Woonplaats:<input type="text" name="woonplaats" value="<?= $sql[0][4] ?>" class="form-control" value="">
                        <br>
                        Telefoonnummer:<input type="text" name="telefoonnummer" value="<?= $sql[0][5] ?>" class="form-control" value="">
                        <br>
                        Email:<input type="text" name="email" value="<?= $sql[0][6] ?>" class="form-control" value="">
                        <br>
                        <span id="Betalen" class="badge badge-pill badge-secondary">Betalen: </span>
                        <br>
                        <br>
                        Bank:<select id="CreditCardType" name="CreditCardType"class="form-control">
                            <option selected>Selecteer uw bank</option>
                            <option value="5">ABN AMRO</option>
                            <option value="6">BUNQ</option>
                            <option value="7">ING</option>
                            <option value="8">KNAB</option>
                            <option value="8">RABOBANK</option>
                            <option value="8">SNS BANK</option>
                            <option value="8">VAN LANSCHOT</option>
                        </select>
                        <br>
                        Rekeningnummer:<input type="text" name="rekeningnummer" value="<?= $sql[0][7] ?>" class="form-control" value="">
                        <br>
                        Pasnummer:<input type="text" name="pasnummer" value="<?= $sql[0][8] ?>" class="form-control" value="">
                        <br>
                        <input type="submit" value="Bestelling afronden" class="btn btn-success float-right">


                        <a href="index.php" class="btn btn-secondary float-left"> Verder winkelen </a><br>
                    </form>
                    <br>
                </div>
                <?php
            }
            else
            {
                if($_SESSION['id'] != -1)
                {
                    echo 'U heeft uw gegevens nog niet van te voren ingevuld, dit kan u doen op de <a href="myDetails.php">mijn gegevens</a> pagina.';
                }
                ?>
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
                            <option selected>Selecteer uw bank</option>
                            <option value="5">ABN AMRO</option>
                            <option value="6">BUNQ</option>
                            <option value="7">ING</option>
                            <option value="8">KNAB</option>
                            <option value="8">RABOBANK</option>
                            <option value="8">SNS BANK</option>
                            <option value="8">VAN LANSCHOT</option>
                        </select>
                        <br>
                        Rekeningnummer:<input type="text" name="rekeningnummer" class="form-control" value="">
                        <br>
                        Pasnummer:<input type="text" name="pasnummer" class="form-control" value="">
                        <br>
                        <input type="submit" value="Bestelling afronden" class="btn btn-success float-right">


                        <a href="index.php" class="btn btn-secondary float-left"> Verder winkelen </a><br>
                    </form>
                    <br>
                </div>
                <?php
            }
            ?>

            <!--Formulier voor het invullen van klantgegevens -->

            <!-- /.container -->

            <!-- Footer -->
            <?= displayFooter();?>

            <!-- Bootstrap core JavaScript -->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    </body>

</html>






