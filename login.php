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
                                            <input type="text" required name="username" id="username" class="form-control input-sm" placeholder="Gebruikersnaam">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="password" required name="password" id="password" class="form-control input-sm" placeholder="Wachtwoord">
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" name="login" value="Inloggen" class="btn btn-info btn-block">
                                <div class="form-group text-center">
                                    <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                                    <label for="remember">Gegevens onthouden</label>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="text-center">
                                                <a href="https://phpoll.com/recover" tabindex="5" class="forgot-password">Wachtwoord vergeten?</a>
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
        if (isset($_POST["login"])) {
            if ($_POST["password"] == $_POST["passwordConfirmed"]) {
                $db = DBconnectie();

                $query = 'SELECT * FROM users';
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
