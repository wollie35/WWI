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
                <br>
                <style>
                    div.mapouter {
                        text-align: left;
                    </style>

                    <!-- map met locatie -->
                    <div class="mapouter" >
                        <div class="gmap_canvas">
                            <iframe width="500" height="400" id="gmap_canvas"
                                    src="https://maps.google.com/maps?q=Windesheim%20Zwolle&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                            </iframe>

                        </div>
                        <style>.mapouter{text-align:right;height:500px;width:400px;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:400px;}</style>
                    </div>
                    <!-- map met locatie -->
                    <style>
                        div.a {
                            text-align: right;
                        </style>
                        <div class="a">
                            <h3>contact:</h3>
                            <p>
                                Wide World Importers<br>
                                Campus 2<br>
                                8017 CA Zwolle<br>
                                KvK-Nummer: 53815033 <br>
                                Info@WWI.com<br>
                            </p>
                        </div>
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