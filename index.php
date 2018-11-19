<?php
require_once "includes/init.php";
require_once "includes/Functions.php";
session_start();

if (empty($_GET['categoryId'])) {
    $_GET['categoryId'] = 0;
}
if (!isset($_GET['pageNumber'])) {
    $_GET['pageNumber'] = 1;
}
if (!isset($_SESSION['zoekOpdracht'])) {
    $_SESSION['zoekOpdracht'] = '';
}
if (!isset($_SESSION['countBestelling'])) {
    $_SESSION['countBestelling'] = '';
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <?= displayHeader(); ?>
    </head>

    <body>
        <?php
        //product toevoegen bestelling
        if (isset($_POST['addToCart']) != '') {
            if (!isset($_SESSION['bestelling'])) {
                $_SESSION['bestelling'] = array();
            }
            //Klik op toevoegen aan winkelmand (id)
            if (in_array($_POST['addToCart'], $_SESSION['bestelling'])) {
                //Als het item al in de winkelmand zit, laad een modal zien
                $_POST['addToCart'] = '';
                echo displayModal('Informatie', 'Dit product staat al in de winkelmand, je kan de hoeveelheid aanpassen in de winkelmand', 'Sluit');
            }
            //Zit die niet in de winkelmand, voeg m toe
            else {
                $_SESSION['bestelling'][] = $_POST['addToCart'];
                $_POST['addToCart'] = '';
                //gebruiken voor tellen winkelmand
                $_SESSION['countBestelling'] = count($_SESSION['bestelling']);
            }
        }
        ?>

        <!-- Navigation -->
        <?= displayNavBar() ?>

        <!-- Page Content -->
        <div class="container">

            <div class="row">

                <div class="col-lg-3">
                    <!--<h1 class="my-4">Wide World Importers</h1>-->
                    <img src="includes/img/logo.png" alt="logo" style="width: 90%;">
                    <form method="post">
                        <!--                        De zoekknop (als die al een keer is ingevuld, zet de zoekopdracht erin-->
                        <input type="search" class="form-control" name="zoeken"  placeholder="Zoeken..." value='<?php
                        if (isset($_SESSION['zoekOpdracht'])) {
                            echo $_SESSION['zoekOpdracht'];
                        }
                        ?>'>
                        <input type="submit" class="btn btn-info" name="submitZoeken" value="Zoek product">
                    </form>
                    </br>
                    <?php
//                    Als je op zoeken drukt maak een sessie aan, zo onthoud die de zoekopdracht
                    if (isset($_POST['submitZoeken'])) {
                        $_SESSION['zoekOpdracht'] = $_POST['zoeken'];
                        //Zet hert paginanummer automatisch op 1
                        $_GET['pageNumber'] = 1;
                    }
//rows voor query
                    $rows = array('StockGroupID, StockGroupName');
//Where statement voor query
                    $where = array(
                        array(
                            'name' => '',
                            'symbol' => '',
                            'value' => '',
                            'jointype' => '',
                            'jointable' => '',
                            'joinvalue1' => '',
                            'joinvalue2' => '',
                            'syntax' => '',
                        )
                    );

                    $user = (new QueryBuilding('stockgroups', '', $rows))->selectRows()->fetchall();
                    $x = 0;
                    echo '<div class="list-group">';
//                  Laat alle categorien zien
                    while ($x < count($user)) {
                        ?>
                        <a href="showProductCategory.php?categoryId=<?= $user[$x][0] ?>" class="list-group-item"><?= $user[$x][1] ?></a>
                        <?php
                        $x++;
                    }
                    ?>
                </div>
            </div>
            <!-- /.col-lg-3 -->

            <div class="col-lg-9">
                <?php
//SELECTEER alle waardes voor tellen paginas
                $rows = array('count(*)');
                $countAllProducts = (new QueryBuilding('stockitems', '', $rows))->selectRows()->fetchall();

                $x = 15;
//Deel totaal aan objecten / 15
                $aantalPaginas = $countAllProducts[0][0] / $x;
//Rond getal af op 0 decimalen (1.4 wordt 1)
                $aantalPaginas = (number_format($aantalPaginas, 0));

                $rows = array('StockItemID', 'StockItemName, UnitPrice');
//Controleer of zoekopdracht gevuld

                if (!isset($_SESSION['zoekOpdracht'])) {
                    $where = array(
                        array(
                            'name' => 'StockItemID',
                            'symbol' => '!=',
                            'value' => 0,
                            'jointype' => '',
                            'jointable' => '',
                            'joinvalue1' => '',
                            'joinvalue2' => '',
                            'syntax' => '',
                        )
                    );
                } else {
                    $where = array(
                        array(
                            'name' => 'StockItemName',
                            'symbol' => 'LIKE',
                            'value' => '%' . $_SESSION['zoekOpdracht'] . '%',
                            'jointype' => '',
                            'jointable' => '',
                            'joinvalue1' => '',
                            'joinvalue2' => '',
                            'syntax' => '',
                        )
                    );
                }

                $allProducts = (new QueryBuilding('stockitems', $where, $rows))->selectRows(array('page' => ($_GET['pageNumber'] - 1) * 15), '15')->fetchall();
//Tel de producten
                if (empty(count($allProducts))) {
                    echo "Er zijn geen resultaten gevonden!";
                } else {
                    echo "Er zijn " . count($allProducts) . " resultaten gevonden op deze pagina!";
                }

                $rows = array('count(*)');
                $where = array(
                    array(
                        'name' => 'StockItemName',
                        'symbol' => 'LIKE',
                        'value' => '%' . $_SESSION['zoekOpdracht'] . '%',
                        'jointype' => '',
                        'jointable' => '',
                        'joinvalue1' => '',
                        'joinvalue2' => '',
                        'syntax' => '',
                    )
                );
                $countAllSearchProducts = (new QueryBuilding('stockitems', $where, $rows))->selectRows()->fetchall();
                $x = 15;
//Overruled aantalpaginas tellingen
                $aantalPaginas = $countAllSearchProducts[0][0] / $x;
                $aantalPaginas = (number_format($aantalPaginas, 0));
//De bovenstaande 2 regels berekenen hoeveel paginas er moeten komen

                $y = 0;
                ?>
                <!--                Dit laat alle producten zien in-->
                <form method="POST">
                    <?php
                    while ($y < count($allProducts)) {
                        //Allproducts (0 = ID, 1 = naam, 2 = Prijs)
                        ?>
                        <div class="square">
                            <a target="_blank" href="showProduct.php?productID=<?= $allProducts[$y][0] ?>">
                                <img src="includes/img/fishcycle.PNG"  alt="Fishman" class="fishman" ">
                            </a>

                            <?= "&euro; " . $allProducts[$y][2] . "</br>" ?>
                            <!-- Limiteerd strlengte voor passen vakjes-->
                            <?php
                            if (strlen($allProducts[$y][1]) > 30) {
                                echo substr($allProducts[$y][1], 0, 30);
                                echo '...';
                            } else {
                                echo $allProducts[$y][1];
                            }
                            ?>
                            <input type="submit"  name="addToCart" dirname=""  value="<?= $allProducts[$y][0] ?>" class="btn btn-info"  />
                        </div>
                        <?php
                        $y++;
                    }
                    ?>
                </form>
                <nav>
                    <!--                    Dit maakt paginanummers aan gebaseerd op de eerder aangegeven aantalpaginas-->
                    <div class="pagination">
                        <?php
                        $ap = 1;
                        while ($ap < $aantalPaginas + 1) {
                            if (filter_input(INPUT_GET, 'pageNumber', FILTER_SANITIZE_STRING) == $ap) {
                                $color = 'red';
                            } else {
                                $color = '';
                            }
                            echo '<li class="page-item"><a class="page-link" style="color: ' . $color . '" href="?pageNumber=' . $ap . '">' . $ap . '</a></li>';
                            $ap++;
                        }
                        ?>
                    </div>
                    </ul>
                </nav>
                <!-- /.card -->

            </div>
            <!-- /.col-lg-9 -->

        </div>

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <?= displayFooter(); ?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
