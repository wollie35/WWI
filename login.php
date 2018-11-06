<?php
/**
 * Created by PhpStorm.
 * User: Wolter van Donk
 * Date: 6-11-2018
 * Time: 11:38
 */
?>
<!DOCTYPE html>


<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <?php
    include "includes/Functions.php";
    $array = array(5, 6,7,8,9,10);

    $DB = DBconnectie();
    $query = 'SELECT * FROM stockitems WHERE StockitemID = ';

    foreach ($array as $item)
    {
        if($item == max($array))
        {
            $query .= $item;
        }

        else
        {
            $query .= $item . ' OR StockitemID = ';
        }
    }

    $stmt = $DB->prepare($query);

    var_dump($query);
    $stmt->execute();

    $result = $stmt->fetchAll();
    $x = 0;
    while($x < count($result))
    {
        echo $result[$x][0] . " heeft als waarde " . $result[$x][1] . "</br>";
        $x++;
    }

    ?>
</html>