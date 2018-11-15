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

                <?php
//Controleert of er iets in de winkelmand staat
                if (!empty($_SESSION['bestelling'])) {

                    if (!isset($_GET['number'])) {
                        $_GET['number'] = 1;
                    }

                    $opTeHalenProducten = array();
                    //Leg de databaseconnectie aan
                    $DB = DBconnectie();
                    $y = 0;
                    //Telt hoeveel items er in de bestelling staan
                    while ($y < count($_SESSION['bestelling'])) {
                        //Voeg geselecteerde producten toe aan een nieuwe array
                        $opTeHalenProducten[] = $_SESSION['bestelling'][$y];
                        $y++;
                    }

                    //Sorteert de array of alfabet
                    $sortOpTeHalenProducten = sort($opTeHalenProducten);

                    //Select statement voor ophalen Nummer, naam en prijs
                    $query = 'SELECT StockitemId, Stockitemname, Unitprice FROM stockitems WHERE StockitemID = ';

                    //Doorloopt de array en controlleert of OR nodig is of niet
                    foreach ($opTeHalenProducten as $item) {
                        if ($item == max($opTeHalenProducten)) {
                            $query .= $item;
                        } else {
                            $query .= $item . ' OR StockitemID = ';
                        }
                    }
                    //Prepare and execute
                    $stmt = $DB->prepare($query);
                    $stmt->execute();
                    $result = $stmt->fetchAll();

                    $array = array();

                    //Telt hoeveelheid resultaten
                    $x = 0;

                    while ($x < count($result)) {
                        $array[] = array("ID" => $result[$x][0], "Name" => $result[$x][1], "Price" => $result[$x][2], "Quantity" => 1);
                        $x++;
                    }

                    $_SESSION['array'] = $array;
                    ?>
                    <form method="post">
                        <input type="submit" class="float-right  btn btn-info" name="winkelmandLeegmaken" value="Winkelmand leegmaken">

                    </form>
                    <?php
                    $y = 0;
                    echo '<form action="#" method="post" id="cart">';
                     echo '<table class="table">';
                    ?>
                            <th>Nummer</th>
                            <th>Naam</th>
                            <th>Hoeveelheid</th>
                            <th>Prijs</th>
                <?php

                while ($y < count($array)) {
                ?>
                <tr>
                    <?php //Leest de arrays uit en haalt de data deruit ?>
                    <tr>
                        <td><?= $array[$y]["ID"] ?></td>
                        <td><?= $array[$y]["Name"] ?></td>
                        <td><input type="number" value="1" name="qty" class="qty" /></td>
                        <td><?= $array[$y]["Price"] . " EURO" ?></td>
                    </tr>
                    <?php
                    $y++;
                    }
                ?>
                    </table>
                    <div>
                        <button class="btn btn-success col-md-3" style="color: white;" id="calc">Totaal prijs berekenen</button>
                        <span id="subtotal"></span>
                    </div>
                    <br>
                    <a class="btn bg-success col-md-3"  style="color: white;" href="bestellingPlaatsen.php">Afrekenen</a>
                </form>
                <?php
                    javaScriptCart();
                } else {
                    echo 'Sorry maar je winkelmand blijkt leeg te zijn!';
                    echo ' <img src="includes/img/sad.jpg"  alt="saad" class="sad" ">';
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
