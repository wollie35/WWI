<?php
require_once "includes/init.php";
session_start();
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
        <a class="navbar-brand" href="#">Wide World      Importers</a>
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
        </div>
    </div>
    <!-- /.col-lg-3 -->

    <div class="col-lg-9">
        <img src="includes/img/usb_launcher.PNG"  alt="Banana-Gun" style="width: 150px">
        <?php

        $filter = filter_input(INPUT_GET, 'productID', FILTER_SANITIZE_STRING);
        $rows = array('ST.StockItemName, ST.UnitPrice', 'SU.SupplierName', 'ST.LeadTimeDays', 'ST.MarketingComments');
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
        echo '<table border="1px">';
        while ($x < count($selectedProduct))
        {

            ?>
            <tr>
                <th>Naam</th>
                <th>Prijs</th>
                <th>Leverancier</th>
                <th>Verwachte levertijd</th>
                <th>Opmerking leverancier</th>
            </tr>
            <tr>
                <td><?=$selectedProduct[$x][0]?></td>
                <td><?=$selectedProduct[$x][1]?></td>
                <td><?=$selectedProduct[$x][2]?></td>
                <td><?=$selectedProduct[$x][3]?></td>
            </tr>
            <?PHP
            echo '</br><th> Naam: ';
            echo '<tr>';
            echo '<td>' . $selectedProduct[$x][0] . '</td>';
            echo '</th>';
            echo '<th> Prijs: ';
            echo '<td>' . $selectedProduct[$x][1] . '</td>';
            echo '</th>';
            echo '<th> Leverancier: ';
            echo '<td>' . $selectedProduct[$x][2] . '</td>';
            echo '</th>';
            echo '<th> Verwachte levertijd: ';
            echo '<td>' . $selectedProduct[$x][3] . '</td>';
            echo '</th>';
            echo '</tr>';
            echo '<th>Opmerking van leverancier: </th>';
            if(!empty($selectedProduct[$x][4]))
            {
                echo $selectedProduct[$x][4] . "</br>";
            }
            else
            {
                echo "X</br>";
            }
            $calculation = $selectedProduct[$x][1] / 5;
            $x = 0;
             echo 'Rating:';
            while($x < number_format($calculation , 0))
            {
                if($x <= 4)
                {
                    echo '&#11088';
                    $x++;
                }
                else
                {
                    $x++;
                }
            }
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
