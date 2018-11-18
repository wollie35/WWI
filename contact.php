<?php
require_once "includes/init.php";
require_once "includes/Functions.php";

session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?= displayHeader(); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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

    <div class="col-lg-9">

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-info">
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
