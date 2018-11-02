<?php
require_once "includes/init.php";
session_start();

if(empty($_GET['categoryId']))
{
    $_GET['categoryId'] = 0;
}
if(!isset($_GET['pageNumber']))
{
    $_GET['pageNumber'] = 1;
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Wide World Importers</title>

        <!-- Bootstrap core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <link href="css/main.css" rel="stylesheet">


        <!-- Custom styles for this template -->
        <link href="css/shop-item.css" rel="stylesheet">

    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">Word Wide Importers</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Inloggen</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container">

            <div class="row">

                <div class="col-lg-3">
                    <h1 class="my-4">Wide World Importers</h1>
                    <?php
                    $rows = array('StockGroupID, StockGroupName');
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

                    //Select userEmail,userPassword, userRights, userFName, userLName
                    $user = (new QueryBuilding('stockgroups', '', $rows))->selectRows()->fetchall();
                    $x = 0;
                    echo '<div class="list-group">';
                    while ($x < count($user)) {
                        ?>
                        <a href="?categoryId=<?= $user[$x][0] ?>" class="list-group-item"><?= $user[$x][1] ?></a>
                        <?php
                        $x++;
                    }

                    if ($_GET['categoryId'] != 0) {
                        $rows = array('S.StockItemName');
                        $where = array(
                            array(
                                'name' => 'SISG.StockGroupID',
                                'symbol' => '=',
                                'value' => $_GET['categoryId'],
                                'jointype' => 'INNER',
                                'jointable' => 'stockitemstockgroups SISG',
                                'joinvalue1' => 'S.stockitemID',
                                'joinvalue2' => 'SISG.StockItemID',
                                'syntax' => '',
                            )
                        );

                        //Select userEmail,userPassword, userRights, userFName, userLName
                        $category = (new QueryBuilding('stockitems S', $where, $rows))->selectRows()->fetchall();
                    }
                    ?>
                </div>
            </div>
            <!-- /.col-lg-3 -->

            <div class="col-lg-9">
                <form method="post">
                    <input type="search" name="zoeken" placeholder="Zoek je product!">
                    <input type="submit" name="submitZoeken">
                </form>

                <?php
                if (isset($_POST['submitZoeken'])) {
                    $rows = array('StockItemName');
                    $where = array(
                        array(
                            'name' => 'StockItemName',
                            'symbol' => 'LIKE',
                            'value' => '%' . $_POST['zoeken'] . '%',
                            'jointype' => '',
                            'jointable' => '',
                            'joinvalue1' => '',
                            'joinvalue2' => '',
                            'syntax' => '',
                        )
                    );

                    //Select userEmail,userPassword, userRights, userFName, userLName
                    $search = (new QueryBuilding('stockitems', $where, $rows))->selectRows()->fetchall();
                    $countSeach = count($search) - 1;
                    if (empty($search)) {
                        echo "Er zijn geen resultaten gevonden!";
                    } else {
                        echo "Er zijn " . $countSeach . " resultaten gevonden!";
                    }
                }
                ?>

                <form method="post">
                    <input type="submit" class="btn btn-primary" name="bestellingAfronden" value="bestellingaronden">
                </form>

                <form method="post">
                    <input type="submit" class="btn btn-danger" name="winkelmandLeegmaken" value="winkelmand leegmaken">
                </form>
                <?php
                if(isset($_POST['winkelmandLeegmaken']))
                {
                    unset($_SESSION['bestelling']);
                }

                $rows = array('count(*)');
                $countAllProducts = (new QueryBuilding('stockitems', '', $rows))->selectRows()->fetchall();

                $x = 48;
                $aantalPaginas = $countAllProducts[0][0] / $x;
                $aantalPaginas = (number_format($aantalPaginas, 0));

                $rows = array('StockItemID','StockItemName, UnitPrice');
                $where = array(
                    array(
                        'name' => 'StockItemID',
                        'symbol' => '>',
                        'value' => ($_GET['pageNumber'] - 1) * 48,
                        'jointype' => '',
                        'jointable' => '',
                        'joinvalue1' => '',
                        'joinvalue2' => '',
                        'syntax' => 'AND',
                    ),

                    array(
                        'name' => 'StockItemID',
                        'symbol' => '<=',
                        'value' => $_GET['pageNumber'] * 48,
                        'jointype' => '',
                        'jointable' => '',
                        'joinvalue1' => '',
                        'joinvalue2' => '',
                        'syntax' => '',
                    ),

                );

                $allProducts = (new QueryBuilding('stockitems', $where, $rows))->selectRows()->fetchall();
                 $y = 0;
                ?>
                <form method="get">
                <?php
                while ($y < count($allProducts))
                {
                    ?>
                <div class="square">
                    <a target="_blank" href="showProduct.php?productID=<?=$allProducts[$y][0]?>">
                     <img src="includes/img/usb_launcher.PNG"  alt="Banana-Gun" style="width: 150px">
                    </a>

                    <?='</br>' . $allProducts[$y][2]?>
                    <?php if (strlen($allProducts[$y][1]) > 40)
                    {
                        echo substr($allProducts[$y][1], 0, 40);
                        echo '...';
                    }
                    else
                    {
                        echo $allProducts[$y][1];
                    }
                    ?>
                        <input type="submit"  name="addToCart" dirname="" value="<?=$allProducts[$y][0]?>"  />
                    </div>
                    <?php
                    $y++;
                }


                    if(isset($_GET['addToCart'])) {
                        $bestellingen = array();
                        $_SESSION['bestelling'][] = filter_input(INPUT_GET, 'addToCart', FILTER_SANITIZE_STRING);
                        unset($_GET['addToCart']);

                    }
                    if(isset($_POST['bestellingAfronden']))
                    {
                        print_r($_SESSION['bestelling']);
                    }



                ?>
                </form>
                <nav>
                    <div class="pagination">
                        <?php
                        $ap = 1;
                        while($ap < $aantalPaginas + 1)
                        {
                           echo '<li class="page-item"><a  class="page-link" href="?pageNumber='.$ap.'">' .$ap. '</a></li>';
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
