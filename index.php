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
        if (isset($_GET['addToCart']) != '')
        {
            if(!isset($_SESSION['bestelling']))
            {
                $_SESSION['bestelling'] = array();
            }
            //Klik op toevoegen aan winkelmand (id)
            if(in_array($_GET['addToCart'], $_SESSION['bestelling']))
            {
                displayModal('Informatie', 'Dit product staat al in de winkelwagen, U kan de hoeveelheid van het product in de winkelwagen aanpassen', 'Sluit');
            }
            else
            {
            $_GET['addToCart'] = '';
                $_SESSION['bestelling'][] = filter_input(INPUT_GET, 'addToCart', FILTER_SANITIZE_STRING);
                //gebruiken voor tellen winkelmand
                $_SESSION['countBestelling'] = count($_SESSION['bestelling']);
            }

            //print_r($_SESSION['bestelling']);
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
                         <input type="search" class="form-control" name="zoeken"  placeholder="Search..." value='<?php
                         if (isset($_SESSION['zoekOpdracht']))
                         {
                             echo $_SESSION['zoekOpdracht'];
                         }
                         ?>'>
                    <input type="submit" class="btn btn-info" name="submitZoeken">
                    </form>
                    </br>
                    <?php
                    if (isset($_POST['submitZoeken']))
                    {
                        $_SESSION['zoekOpdracht'] = $_POST['zoeken'];
                        $_GET['pageNumber'] = 1;
                    }

                    ?>
                    <script>
                        function handle(e){
                            if(e.keyCode === 13){
                                e.preventDefault(); // Ensure it is only this code that rusn
                                <?php
                                $_SESSION['zoekOpdracht'] = $_POST['zoeken'];
                                $_GET['pageNumber'] = 1;
                                ?>
                            }
                        }
                    </script>
                    <?php

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
//Show categories
                    while ($x < count($user)) {
                        ?>
                        <a href="?categoryId=<?= $user[$x][0] ?>" class="list-group-item"><?= $user[$x][1] ?></a>
                        <?php
                        $x++;
                    }

                    //In progress
                    if ($_GET['categoryId'] != 0) {
                        $rows = array('S.StockItemName');
                        $where = array(
                            array(
                                'name' => 'SISG.StockGroupID',
                                'symbol' => '=',
                                'value' => FILTER_INPUT(INPUT_GET, 'categoryId', FILTER_SANITIZE_STRING),
                                'jointype' => 'INNER',
                                'jointable' => 'stockitemstockgroups SISG',
                                'joinvalue1' => 'S.stockitemID',
                                'joinvalue2' => 'SISG.StockItemID',
                                'syntax' => '',
                            )
                        );

                        $category = (new QueryBuilding('stockitems S', $where, $rows))->selectRows()->fetchall();
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

                if (!isset($_SESSION['zoekOpdracht']))
                {
                    $where = array(
                        array(
                            'name' => 'StockItemID',
                            'symbol' => '>',
                            'value' => ($_GET['pageNumber'] - 1) * 15,
                            'jointype' => '',
                            'jointable' => '',
                            'joinvalue1' => '',
                            'joinvalue2' => '',
                            'syntax' => 'AND',
                        ),
                        array(
                            'name' => 'StockItemID',
                            'symbol' => '<=',
                            'value' => $_GET['pageNumber'] * 15,
                            'jointype' => '',
                            'jointable' => '',
                            'joinvalue1' => '',
                            'joinvalue2' => '',
                            'syntax' => '',
                        )
                    );
                }
                else {
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

                $y = 0;
                ?>
                <form method="get">
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
                            <input type="submit"  name="addToCart" dirname="" value="<?= $allProducts[$y][0] ?>"  />
                        </div>
                        <?php
                        $y++;
                    }
                    ?>
                </form>
                <nav>
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
