<?php
require_once "includes/init.php";
require_once "includes/Functions.php";

session_start();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <?= displayHeader(); ?>
    </head>

    <body>
        <?php
        if (isset($_POST['addToCart']) != '') {
            if (!isset($_SESSION['bestelling'])) {
                $_SESSION['bestelling'] = array();
            }
            //Klik op toevoegen aan winkelmand (id)
            if (in_array($_POST['addToCart'], $_SESSION['bestelling'])) {
                echo displayModal('Informatie', 'Dit product staat al in de winkelmand, je kan de hoeveelheid aanpassen in de winkelmand', 'Sluit');
            } else {
                $_POST['addToCart'] = '';
                $_SESSION['bestelling'][] = filter_input(INPUT_POST, 'addToCart', FILTER_SANITIZE_STRING);
                //gebruiken voor tellen winkelmand
                $_SESSION['countBestelling'] = count($_SESSION['bestelling']);
            }

            //print_r($_SESSION['bestelling']);
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
                <img src="includes/img/fishcycle.PNG"  alt="Banana-Gun" style="width: 150px">
                <?php
                $filter = filter_input(INPUT_GET, 'productID', FILTER_SANITIZE_STRING);
                $rows = array('ST.StockItemID', 'ST.StockItemName', 'ST.UnitPrice', 'SU.SupplierName', 'ST.LeadTimeDays', 'ST.MarketingComments');
                $where = array(
                    array(
                        'name' => 'ST.StockItemID',
                        'symbol' => '=',
                        'value' => $filter,
                        'jointype' => 'INNER',
                        'jointable' => 'suppliers SU',
                        'joinvalue1' => 'ST.supplierID',
                        'joinvalue2' => 'SU.supplierID',
                        'syntax' => '',
                    )
                );

                $selectedProduct = (new QueryBuilding('stockitems ST', $where, $rows))->selectRows()->fetchall();

                $x = 0;
                echo '<table class="table">';
                while ($x < count($selectedProduct)) {
                    ?>
                    <tr>
                        <th>Naam</th>
                        <th>Prijs</th>
                        <th>Leverancier</th>
                        <th>Verwachte levertijd</th>
                        <th>Opmerking leverancier</th>
                        <th>Rating</th>
                        <th> <form method="POST">
                                <input type="submit"  name="addToCart" dirname="" value="<?= $selectedProduct[$x][0] ?>"  />
                                <form></th>
                                    </tr>
                                    <tr>
                                        <td><?= $selectedProduct[$x][1] ?></td>
                                        <td><?= $selectedProduct[$x][2] ?></td>
                                        <td><?= $selectedProduct[$x][3] ?></td>
                                        <td><?= $selectedProduct[$x][4] ?></td>
                                        <td><?php
                                            if (!empty($selectedProduct[$x][5])) {
                                                echo $selectedProduct[$x][5] . "</br>";
                                            } else {
                                                echo "X</br>";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $calculation = $selectedProduct[$x][2] / 5;
                                            $x = 0;
                                            while ($x < number_format($calculation, 0)) {
                                                if ($x <= 4) {
                                                    echo '&#11088';
                                                    $x++;
                                                } else {
                                                    $x++;
                                                }
                                            }
                                            ?></td>

                                    </tr>


                                    <?PHP
                                }
                                echo '</table>';
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
