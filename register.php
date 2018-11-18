<?php
require_once "includes/Functions.php";
session_start();
//Zelfde als login, marie claire heeft deze gemaakt
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <?= displayHeader(); ?>
        <link href="css/table.css" rel="stylesheet">
    </head>
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
            <div class="container" >
                <div class="row centered-form" style="margin-left: 30%">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Registreren</h3>
                        </div>
                        <div class="panel-body">
                            <form method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" required name="username" id="username" class="form-control input-sm" placeholder="Gebruikersnaam">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="email" required name="email" id="email" class="form-control input-sm" placeholder="E-mailadres">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="password" required name="password" id="password" class="form-control input-sm" placeholder="Wachtwoord">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="password" required name="passwordConfirmed" id="passwordConfirmed" class="form-control input-sm" placeholder="Bevestig wachtwoord">
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" name="register" value="Registreren" class="btn btn-info btn-block">

                            </form>

                        </div>
                    </div>

                </div>
            </div>
            <?php
            if (isset($_POST["register"])) {
                if ($_POST["password"] == $_POST["passwordConfirmed"]) {
                    $db = DBconnectie();

                    $query = 'INSERT INTO users (username, email, password) VALUES (:username, :email, :password)';
                    $sql = $db->prepare($query);
                    $sql->bindParam(":username", $_POST["username"]);
                    $sql->bindParam(":email", $_POST["email"]);
                    $sql->bindParam(":password", $_POST["password"]);
                    var_dump($query);
                    $sql->execute();
                } else {
                    print("De wachtwoorden komen niet overeen");
                }
            }
            ?>
        </div>
        <!-- /.container -->
    <br>
        <!-- Footer -->
        <?= displayFooter();?>

        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    </body>

</html>
