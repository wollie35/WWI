<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

<?php
#cart.php - A simple shopping cart with add to cart, and remove links
//---------------------------
//initialize sessions
//Define the products and cost
$amounts = array("19.99", "10.99", "2.99");

include "includes/Functions.php";
$opTeHalenProducten = array(5, 6, 7,7,8,9,10);
$DB = DBconnectie();
$query = 'SELECT Stockitemname, Unitprice FROM stockitems WHERE StockitemID = ';

foreach ($opTeHalenProducten as $item)
{
    if($item == max($opTeHalenProducten))
    {
        $query .= $item;
    }

    else
    {
        $query .= $item . ' OR StockitemID = ';
    }
}

var_dump($query);
$stmt = $DB->prepare($query);

$stmt->execute();

$result = $stmt->fetchAll();
$x = 0;

echo '<table border="1px solid black">';
while ($x < count($result))
{
    ?>
    <tr>
        <th>Naam</th>
        <th>Prijs</th>
        <th>Hoeveelheid</th>
    </tr>
        <td><?= $result[$x][0] ?></td>
        <td><?= $result[$x][1] ?></td>
        <td><?= '<input type="number" value="1">' ?></td>
    <?php
    $x++;
}
echo '</table>';
?>
</body>
</html>