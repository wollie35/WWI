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

<?php
//Hetzelfde als in index.php, voor het toevoegen van het item
if (isset($_POST['addToCart']) != '') {
    if (!isset($_SESSION['bestelling'])) {
        $_SESSION['bestelling'] = array();
    }
    //Klik op toevoegen aan winkelmand (id)
    if (in_array(filter_input(INPUT_GET, 'productID', FILTER_SANITIZE_STRING), $_SESSION['bestelling'])) {
        echo displayModal('Informatie', 'Dit product staat al in de winkelmand, je kan de hoeveelheid aanpassen in de winkelmand', 'Sluit');
    } else {
        $_POST['addToCart'] = '';
        $_SESSION['bestelling'][] = filter_input(INPUT_GET, 'productID', FILTER_SANITIZE_STRING);
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
        <?php
        $db = DBconnectie();
        $stockitemId = filter_input(INPUT_GET, 'productID', FILTER_SANITIZE_STRING);
        $query = 'SELECT stockItemPhotoPath FROM stockitemphoto WHERE stockitemId = :stockitemId ORDER BY stockItemPhotoMain DESC';
        $sql = $db->prepare($query);
        $sql->bindParam(":stockitemId", $stockitemId);
        $sql->execute();

        $sql = $sql->fetchAll();
        ?>

        <div id="demo" class="carousel slide" data-ride="carousel" style="width: 45%;">
            <ul class="carousel-indicators" style="width: 50%;">
                <?php
                $y = 0;
                while ($y < count($sql)) {
                    if ($y == 0) {
                        echo '<li data-target="#demo" data-slide-to="0" class="active"></li>';
                    } else {
                        echo '<li data-target="#demo" data-slide-to="0"></li>';
                    }
                    $y++;
                }
                ?>
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner float-left" style="width:300px; height: 300px;">

                <?php
                $y = 0;
                while ($y < count($sql)) {
                    if ($y == 0) {
                        echo '<div class="carousel-item active">
                              <img id="showProductSlide" src="includes/img/' . $sql[$y][0] . '" width="100%" ">
                                </div>';
                    }
                    if ($y != 0) {
                        echo '<div class="carousel-item">
                              <img id="showProductSlide" src="includes/img/' . $sql[$y][0] . '" width="100%">
                                </div>';
                    }
                    $y++;
                }
                ?>
                <!---->
                <!--                    <div class="carousel-item active">-->
                <!--                        <img src="la.jpg" alt="Los Angeles">-->
                <!--                    </div>-->
                <!--                    <div class="carousel-item">-->
                <!--                        <img src="chicago.jpg" alt="Chicago">-->
                <!--                    </div>-->
                <!--                    <div class="carousel-item">-->
                <!--                        <img src="ny.jpg" alt="New York">-->
                <!--                    </div>-->
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>



        <?php




        $filter = filter_input(INPUT_GET, 'productID', FILTER_SANITIZE_STRING);
        $rows = array('ST.StockItemID', 'ST.StockItemName', 'ST.UnitPrice', 'SU.SupplierName', 'ST.LeadTimeDays', 'ST.MarketingComments', 'ST.video');
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
        //                Haalt alle producten op en laat ze in een tabel zien
        ?>
        <iframe width="369.6" height="207.9" src="<?=$selectedProduct[$x][6]?>" frameborder="0" class="float-right" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<?php
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
            </tr>
            <tr>
                <td><?= $selectedProduct[$x][1] ?></td>
                <td><?= $selectedProduct[$x][2] ?></td>
                <td><?= $selectedProduct[$x][3] ?></td>
                <td><?= $selectedProduct[$x][4] . ' dagen' ?></td>
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
        <form method="POST">
            <input type="submit" class="btn btn-success" name="addToCart" dirname="" value="Voeg toe aan winkelmand"  />
            <form>

    </div>
    <br>
    <!-- /.container -->

    <!-- Footer -->
    <?= displayFooter(); ?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
