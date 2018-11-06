<?php
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

$stmt = $DB->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll();

session_start();
$y = 0;
while($y < count($_SESSION['bestelling']))
{
    echo $_SESSION['bestelling'][$y];
    $y++;
}

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