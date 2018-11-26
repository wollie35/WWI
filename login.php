<?php
require_once "includes/Functions.php";
session_start();
//Marie claire heeft deze gemaakt, leerzaam als zij het kan uitleggen
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?= displayHeader(); ?>
    <link href="css/table.css" rel="stylesheet">
</head>

<body>
<?php

if (isset($_POST["login"])) {
    $db = DBconnectie();
    $username = "'" . $_POST['username'] . "'";

    $query = 'SELECT id, username, password FROM users WHERE username = ' . $username;
    $sql = $db->prepare($query);
//            var_dump($query);
    $sql->execute();


    $sql = $sql->fetchAll();

    if (count($sql) == 1) {
        if ($sql[0][2] == $_POST['password']) {
            ?>
            <meta http-equiv="refresh" content="0; url=index.php">
            <?php
            $_SESSION['username'] = $_POST['username'];
                $_SESSION['id'] = $sql[0][0];
//                echo $_SESSION['id'];
        } else {
            echo displayModal("Foutmelding", "De combinatie van gebruikersnaam en e-mailadres is niet geldig", "Sluit");

        }
    } else {
        echo displayModal("Foutmelding", "De combinatie van gebruikersnaam en e-mailadres is niet geldig", "Sluit");
    }
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
    <div class="container">
        <div class="row centered-form" style="margin-left: 40%">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Inloggen</h3>
                </div>
                <div class="panel-body">
                    <form method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" required name="username" id="username"
                                           class="form-control input-sm" placeholder="Gebruikersnaam">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="password" required name="password" id="password"
                                           class="form-control input-sm" placeholder="Wachtwoord">
                                </div>
                            </div>
                        </div>
                        <input type="submit" name="login" value="Inloggen" class="btn btn-info btn-block">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="text-center">
                                        Heb je nog geen account? Registreer dan <a href="register.php" tabindex="5"
                                                                                   class="forgot-password">hier</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

?>
</div>
<!-- /.container -->

<!-- Footer -->
<?= displayFooter(); ?>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
