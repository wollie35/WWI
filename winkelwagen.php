<?php
require_once "includes/Functions.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?= displayHeader();?>
    <link href="css/table.css" rel="stylesheet">
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
//Controleert of er iets in de winkelmand staat
if(!empty($_SESSION['bestelling'])) {

    if(!isset($_GET['number']))
    {
        $_GET['number']  = 1;
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
    foreach ($opTeHalenProducten as $item)
    {
        if ($item == max($opTeHalenProducten)) {
            $query .= $item;
        } else {
            $query .=  $item . ' OR StockitemID = ';
        }
    }
    //Prepare and execute
    $stmt = $DB->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();

    //Telt hoeveelheid resultaten
    $x = 0;
    echo '<table class="table">';
    while ($x < count($result)) {
        $arr = array($result[$x][0] => 1
        );
        ?>
        <tr>
            <th>Nummer</th>
            <th>Naam</th>
            <th>Prijs</th>
            <th>Hoeveelheid</th>
            <th>Totaalprijs</th>
        </tr>
        <?php //Leest de arrays uit en haalt de data deruit?>
        <td><?= $result[$x][0] ?></td>
        <td><?= $result[$x][1] ?></td>
        <td><?= $result[$x][2] ?></td>
        <form method="get" action="">
            <td><?= '<input type="number" name="number" id="number" value="1">' ?></td>
        </form>
        <td><?= '' ?></td>
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
