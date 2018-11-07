<?php
require_once "includes/Functions.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?= displayHeader();?>

</head>

<body>

<!-- Navigation -->
<?=displayNavBar();?>

<!-- Page Content -->
<div class="container">

    <div class="row">
        <div class="col-lg-3">
        </div>
    </div>
    <!-- /.col-lg-3 -->

    <div class="col-lg-9">

<?php
if(!empty($_SESSION['bestelling'])) {

    $opTeHalenProducten = array();
    $DB = DBconnectie();
    $y = 0;
    while ($y < count($_SESSION['bestelling'])) {
        $opTeHalenProducten[$y] = $_SESSION['bestelling'][$y];
        $y++;
    }

    $sortOpTeHalenProducten = sort($opTeHalenProducten);

    $query = 'SELECT StockitemId, Stockitemname, Unitprice FROM stockitems WHERE StockitemID = ';

    foreach ($opTeHalenProducten as $item) {
        if ($item == max($opTeHalenProducten)) {
            $query .= $item;
        } else {
            $query .= $item . ' OR StockitemID = ';
        }
    }
    $stmt = $DB->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();


    $x = 0;

    echo '<table border="1px solid black">';
    while ($x < count($result)) {
        ?>
        <tr>
            <th>Nummer</th>
            <th>Naam</th>
            <th>Prijs</th>
            <th>Hoeveelheid</th>
        </tr>
        <td><?= $result[$x][0] ?></td>
        <td><?= $result[$x][1] ?></td>
        <td><?= $result[$x][2] ?></td>
        <td><?= '<input type="number" value="1">' ?></td>
        <?php
        $x++;
    }
    echo '</table>';
}
else
{
    echo 'Sorry maar je winkelmand blijkt leeg te zijn!';
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
