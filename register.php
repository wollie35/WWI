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

            <div class="col-lg-9">
                <form method="post">
                    <input type="text" required name="username" placeholder="Gebruikersnaam"><br>
                    <input type="email" required name="email" placeholder="E-mailadres"><br>
                    <input type="password" required name="password" placeholder="Wachtwoord"><br>
                    <input type="password" required name="passwordConfirmed" placeholder="Bevestig wachtwoord"><br>
                    <input type="submit" name="register" value="test">

                </form>
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
