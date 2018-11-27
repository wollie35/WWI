<?php
require_once "includes/Functions.php";
session_start();
CheckLogIn(TRUE);
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


    <!-- /.col-lg-3 -->

    <div class="col-lg-9">

        <?php
        $db = Dbconnectie();
        $query = 'SELECT UserFirstname, UserLastName, UserAdres, UserPostal, UserCity, UserPhone, UserEmail, UserIBAN, UserPasnr, UserId FROM usersdetails WHERE UserId = '.$_SESSION['id'] ;
        $sql2 = $db->prepare($query);

        $sql2->execute();
        $sql2 = $sql2->fetchAll();

        if(isset($_POST['submit']))
        {
            if(count($sql2) == 0)
            {

                $query = 'INSERT INTO usersdetails (UserFirstname, UserLastName, UserAdres, UserPostal, UserCity, UserPhone, UserEmail, UserIBAN, UserPasnr, UserId) 
                     VALUES (:UserFirstname, :UserLastName, :UserAdres, :UserPostal, :UserCity, :UserPhone, :UserEmail, :UserIBAN, :UserPasnr, :UserId)';
                $sql = $db->prepare($query);
                $sql->bindParam(":UserFirstname", $_POST["voornaam"]);
                $sql->bindParam(":UserLastName", $_POST["achternaam"]);
                $sql->bindParam(":UserAdres", $_POST["adres"]);
                $sql->bindParam(":UserPostal", $_POST["postcode"]);
                $sql->bindParam(":UserCity", $_POST["woonplaats"]);
                $sql->bindParam(":UserPhone", $_POST["telefoonnummer"]);
                $sql->bindParam(":UserEmail", $_POST["email"]);
                $sql->bindParam(":UserIBAN", $_POST["rekeningnummer"]);
                $sql->bindParam(":UserPasnr", $_POST["pasnummer"]);
                $sql->bindParam(":UserId", $_SESSION['id']);
                $sql->execute();
            }
            else
            {

                $test = "'" . 'test' . "'";
                $query3 = 'UPDATE usersdetails SET UserFirstname = :UserFirstname, UserLastName = :UserLastName, UserAdres = :UserAdres, UserPostal = :UserPostal, UserCity = :UserCity, 
            UserPhone = :UserPhone, UserEmail = :UserEmail, UserIBAN = :UserIBAN, UserPasnr = :UserPasnr WHERE UserId = :UserId';
                $sql3 = $db->prepare($query3);
                $sql3->bindParam(":UserFirstname", $_POST["voornaam"]);
                $sql3->bindParam(":UserLastName", $_POST["achternaam"]);
                $sql3->bindParam(":UserAdres", $_POST["adres"]);
                $sql3->bindParam(":UserPostal", $_POST["postcode"]);
                $sql3->bindParam(":UserCity", $_POST["woonplaats"]);
                $sql3->bindParam(":UserPhone", $_POST["telefoonnummer"]);
                $sql3->bindParam(":UserEmail", $_POST["email"]);
                $sql3->bindParam(":UserIBAN", $_POST["rekeningnummer"]);
                $sql3->bindParam(":UserPasnr", $_POST["pasnummer"]);
                $sql3->bindParam(":UserId", $_SESSION['id']);
                $sql3->execute();
            }

        }

        $query = 'SELECT UserFirstname, UserLastName, UserAdres, UserPostal, UserCity, UserPhone, UserEmail, UserIBAN, UserPasnr, UserId FROM usersdetails WHERE UserId = '.$_SESSION['id'] ;
        $sql4 = $db->prepare($query);

        $sql4->execute();
        $sql4 = $sql4->fetchAll();
        if(count($sql4) > 0)
        {
            ?>
            <form method="POST">
                <br>
                <span id="Betalen" class="badge badge-pill badge-secondary">Gegevens: </span>
                Voornaam:<input type="text" value="<?= $sql4[0][0]?>" name="voornaam" class="form-control">
                <br>
                Achternaam:<input type="text" value="<?= $sql4[0][1]?>" name="achternaam" class="form-control">
                <br>
                Adres:<input type="text" name="adres" value="<?= $sql4[0][2]?>" class="form-control" value="">
                <br>
                Postcode:<input type="text" name="postcode" value="<?= $sql4[0][3]?>" class="form-control" value="">
                <br>
                Woonplaats:<input type="text" name="woonplaats" value="<?= $sql4[0][4]?>" class="form-control" value="">
                <br>
                Telefoonnummer:<input type="text" name="telefoonnummer" value="<?= $sql4[0][5]?>" class="form-control" value="">
                <br>
                Email:<input type="text" name="email" value="<?= $sql4[0][6]?>" class="form-control" value="">
                <br>
                <span id="Betalen" class="badge badge-pill badge-secondary">Betalen: </span>
                <br>
                Rekeningnummer:<input type="text" value="<?= $sql4[0][7]?>" name="rekeningnummer" class="form-control" value="">
                <br>
                Pasnummer:<input type="text" value="<?= $sql4[0][8]?>" name="pasnummer" class="form-control" value="">
                <br>
                <input type="submit" name="submit" value="Gegevens opslaan" class="btn btn-success float-right">
            </form>
            <br>
            <?php
        }
        else
        {
            ?>
            <form method="POST">
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
                Rekeningnummer:<input type="text" name="rekeningnummer" class="form-control" value="">
                <br>
                Pasnummer:<input type="text" name="pasnummer" class="form-control" value="">
                <br>
                <input type="submit" name="submit" value="Gegevens opslaan" class="btn btn-success float-right">
            </form>
            <br>
            <?php
        }




        ?>

    </div>

    <!-- /.container -->

    <!-- Footer -->
    <br>

    <?= displayFooter();?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
