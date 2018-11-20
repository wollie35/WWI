<?php
require_once "includes/Functions.php";
require_once "includes/init.php";
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
    //product toevoegen bestelling
    if (isset($_POST['addToCart']) != '') {
        if (!isset($_SESSION['bestelling'])) {
            $_SESSION['bestelling'] = array();
        }
        //Klik op toevoegen aan winkelmand (id)
        if (in_array($_POST['addToCart'], $_SESSION['bestelling'])) {
            echo displayModal('Informatie', 'Dit product staat al in de winkelmand, je kan de hoeveelheid aanpassen in de winkelmand', 'Sluit');
        } else {
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
                    <img src="includes/img/logo.png" alt="logo" style="width: 90%;">
                    <?php
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

                    $category = (new QueryBuilding('stockgroups', '', $rows))->selectRows()->fetchall();
                    $x = 0;
                    echo '<div class="list-group">';
                    //                  Laat alle categorien zien
                    while ($x < count($category)) {
                        ?>
                        <a href="showProductCategory.php?categoryId=<?= $category[$x][0] ?>" class="list-group-item"><?= $category[$x][1] ?></a>
                        <?php
                        $x++;
                    }

                    ?>
                </div>
            </div>
            <!-- /.col-lg-3 -->

            <div class="col-lg-9">
                <?php

                $categoryID = FILTER_INPUT(INPUT_GET, 'categoryId', FILTER_SANITIZE_STRING);
                $DB = DBconnectie();
                $query = 'SELECT S.StockItemID, S.StockItemName, S.UnitPrice, S.photo FROM (stockitems S INNER JOIN stockitemstockgroups SISG ON S.stockitemID = SISG.StockItemID) WHERE SISG.StockGroupID = ' . $categoryID;
                $sql = $DB->prepare($query);
                $sql->execute();

                $result = $sql->fetchAll();
                if (count($result) != 0){


//        VAR_DUMP($result);

                echo '<form method="POST">';
                $x = 0;
                while ($x < count($result)) {
                    ?>
                    <div class="square">
                        <a target="_blank" href="showProduct.php?productID=<?= $result[$x][0] ?>">
                            <img src="includes/img/<?=$result[$x][3]?>"  style="width: 245px; height: 246px;" alt="Fishman" class="fishman">
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
                        <input type="submit"  name="addToCart" dirname="" value="<?= $result[$x][0] ?>" class="btn btn-success"  />
                    </div>
                <?php
                $x++;
}
?>
            </form>
               <?php }else{
                    print "Er zijn geen producten gevonden.";
                }?>
                <br>
            </div>
            </div>
            <!-- /.container -->

            <!-- Footer -->
            <?= displayFooter();?>

            <!-- Bootstrap core JavaScript -->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    </body>

</html>
