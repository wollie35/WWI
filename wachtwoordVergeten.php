
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
                <div class="row centered-form" style="margin-left: 30%">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Wachtwoord vergeten?</h3>
                        </div>
                        <div class="panel-body">
                            <form method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" required name="email" id="email" class="form-control input-sm" placeholder="E-mailadres">
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" name="verzenden" value="Verzenden" class="btn btn-info btn-block">

                            </form>

                        </div>
                    </div>

                </div>
            </div>
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
