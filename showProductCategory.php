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
                $categoryID = FILTER_INPUT(INPUT_GET, 'categoryId', FILTER_SANITIZE_STRING);
                $DB = DBconnectie();
                $query = 'SELECT S.StockItemID, S.StockItemName, S.UnitPrice FROM (stockitems S INNER JOIN stockitemstockgroups SISG ON S.stockitemID = SISG.StockItemID) WHERE SISG.StockGroupID = ' . $categoryID;
                $sql = $DB->prepare($query);
                $sql->execute();

                $result = $sql->fetchAll();
//        VAR_DUMP($result);
                $x = 0;
                while ($x < count($result)) {
                    ?>
                    <div class="square">
                        <a target="_blank" href="showProduct.php?productID=<?= $result[$x][1] ?>">
                            <img src="includes/img/fishcycle.PNG"  alt="Fishman" class="fishman" ">
                        </a>

    <?= "&euro; " . $result[$x][2] . "</br>" ?>
                        <!-- Limiteerd strlengte voor passen vakjes-->
                        <?php
                        if (strlen($result[$x][1]) > 25) {
                            echo substr($result[$x][1], 0, 25);
                            echo '...';
                        } else {
                            echo $result[$x][1];
                        }
                        ?>
                        <input type="submit"  name="addToCart" dirname="" value="<?= $result[$x][0] ?>"  />
                    </div>
    <?php
    $x++;
}
?>
                <?php
                //product toevoegen bestelling
                if (isset($_GET['addToCart']) != '') {
                    if (!isset($_SESSION['bestelling'])) {
                        $_SESSION['bestelling'] = array();
                    }
                    //Klik op toevoegen aan winkelmand (id)
                    if (in_array($_GET['addToCart'], $_SESSION['bestelling'])) {
                        echo displayModal('Informatie', 'Dit product staat al in de winkelmand, je kan de hoeveelheid aanpassen in de winkelmand', 'Sluit');
                    } else {
                        $_GET['addToCart'] = '';
                        $_SESSION['bestelling'][] = filter_input(INPUT_GET, 'addToCart', FILTER_SANITIZE_STRING);
                        //gebruiken voor tellen winkelmand
                        $_SESSION['countBestelling'] = count($_SESSION['bestelling']);
                    }

                    //print_r($_SESSION['bestelling']);
                }
                ?>
            </div>
            <!-- /.container -->

            <!-- Footer -->
            <?= displayFooter();?>

            <!-- Bootstrap core JavaScript -->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    </body>

</html>
