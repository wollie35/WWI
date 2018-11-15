<?php
include_once("Classes/DBconn.php");

//Deze class voert het selecten, updaten en verwijderen van DB gegevens uit
class QueryBuilding extends DBconn
{
    /** Properties */
    private $_tableName;
    private $_rows;
    private $_options;

    /** Constructor */
    public function __construct($tableName, $options = "", $rows = "")
    {
        $this->openConnection();
        $this->setTableName($tableName);
        $this->setRows($rows);
        $this->setOptions($options);
    }

    /** Methods */
    /**Selecteer de benodigde rijen */
    public function selectRows($limit = 0, $max = 0)
    {
        //Geef de getters een eigen variable voor gebruikersgemak
        $tableName = $this->getTableName();
        $rows = $this->getRows();
        $options = $this->getOptions();
        $x = 0;

        //var_dump($options);
        //De query stmt
        $query = "SELECT ";
        //Voor elke rij (elke waarde meegegeven in de array) zet een , neer tot de laatste
        foreach ($rows as $key) {
            $x++;
            if ($x != count($rows)) {
                if ($max == 1) {
                    $query .= "" . $key . ",  ";
                } else {
                    $query .= $key . ",  ";
                }

            } else {
                if ($max == 1) {
                    $query .= "max(" . $key . ") ";
                } else {
                    $query .= $key . " ";
                }

            }
        }

        //De query stmt wordt verlengd, met de FROM tableName WHERE
        $query .= "FROM ";
        if ($options != "") {
            foreach ($options as $value) {
                    if ($value['jointype'] != "") {
                    $query .= '(';
                }
            }
        }

        $query .= $tableName;

        if ($options != '') {

            foreach ($options as $value) {
                if ($value['jointype'] != "") {

                    $query .= " " . $value['jointype'] . " JOIN " . $value['jointable'] . ' ON ' . $value['joinvalue1'] . ' = ' . $value['joinvalue2'] . ')';
                }
            }

            $query .= " WHERE ";
            //Voor elke option (dus bijv WHERE userName(name) =(symbol) jan-peter(value) AND(syntax) 2e rij, lees de meegestuurde array uit en voer uit
            //Let op, de 2e value['name'] is eigenlijk de value, maar ivm met bindparam gebruiken we hier gewoon de naam (regel 54 word de parameter gebind)
            foreach ($options as $value) {
                if ($value['name'] && $value['symbol'] && $value['value'] != "") {
                    $query .= $value['name'] . " " . $value['symbol'] . " '" . $value['value'] . "' " . $value['syntax'] . " ";
                }
            }

            if ($limit != 0) {
                $query .= ' LIMIT ' . $limit['page'] . ',' . $max . '';
            }
        }
        //prepare querystmt
        $stmt = $this->getConn()->prepare($query);
//        var_dump($query);

        $stmt->execute();
        //stuur de geëxecute stmt uit.
        return $stmt;
    }

    /**Past de rij die jij wilt aanpassen aan in de database */
    public function updateRows()
    {
        //Geef de getters een eigen variable voor gebruikersgemak
        $tableName = $this->getTableName();
        $options = $this->getOptions();

        //De query stmt
        $query = "UPDATE " . $tableName . " SET ";

        //Voor elke option (dus bijv SET userEmail(name) =(symbol) example@gmail.com(value), 2e rij (syntax) ), lees de meegestuurde array uit en voer uit
        foreach ($options as $value) {
            $query .= $value['name'] . " " . $value['symbol'] . " :" . $value['name'] . " " . $value['syntax'] . " ";
        }

        //prepare sql statement
        $stmt = $this->getConn()->prepare($query);

        foreach ($options as $value) {
            //Bindparam de name aan de gekoppelde value
            $stmt->bindParam(":" . $value['name'], $value['value']);
            //echo "Parameter" .' ' . $value['name'] .' ' . 'heeft als waarde' .' ' . $value['value'] . '</br>';
        }
        echo "</br>";

        var_dump($query);
        //Execute de stmt
        $stmt->execute();
        return $stmt;
    }

    /** voegt een nieuwe rij toe in de database */
    public function insertRows()
    {
        //Geef de getters een eigen variable voor gebruikersgemak
        $tableName = $this->getTableName();
        $options = $this->getOptions();
        $x = 0;
        //De query stmt
        $query = "INSERT INTO " . $tableName . " (";

        //Voor elke option (dus bijv INSERT INTO users(userName(name), etc), lees de meegestuurde array uit en voer uit
        //Ook de options array gecount zodat bij de laatste option en afsluitende ) bij komt
        foreach ($options as $key) {
            $x++;
            if ($x != count($options)) {
                $query .= $key['name'] . ",  ";
            } else {
                $query .= $key['name'] . ") ";
            }
        }


        $x = 0;
        //De query wordt verlengd voor de values
        $query .= " VALUES (";

        //Voor elke option (dus bijv INSERT INTO users(userName(name), etc) VALUES(jan-peter(value)), lees de meegestuurde array uit en voer uit
        //Ook de options array gecount zodat bij de laatste option en afsluitende ) bij komt
        //Let op de key['name'] is eigenlijk de value, die wordt op met bindparam hier iets verder onder gebonden
        foreach ($options as $key) {
            $x++;
            if ($x != count($options)) {
                $query .= ":" . $key['name'] . ",  ";
            } else {
                $query .= ":" . $key['name'] . ") ";
            }
        }
        //Prepare query stmt
        $stmt = $this->getConn()->prepare($query);

        //Bindparam de name aan de gekoppelde value
        foreach ($options as $value) {
            $stmt->bindParam(":" . $value['name'], $value['value']);
//            echo "Parameter" . ' ' . $value['name'] . ' ' . 'heeft als waarde' . ' ' . $value['value'] . '</br>';
        }

        var_dump($query);
        //Execute de stmt
        $stmt->execute();
    }

    /** verwijdert een of meerdere rijen uit de datbase */
    public function deleteRows()
    {
        //Geef de getters een eigen variable voor gebruikersgemak
        $tableName = $this->getTableName();
        $options = $this->getOptions();

        //Voor elke option (dus bijv DELETE FROM users WHERE userId(name) = :userId, lees de meegestuurde array uit en voer uit
        //Bindparam(:userId, 5); (hetzelfde als bij alle bovenstaande functies)
        $query = "";
        $query .= "DELETE FROM " . $tableName . " WHERE ";

        foreach ($options as $value) {
            $query .= $value['name'] . " = :" . $value['name'] . ' ' . $value['syntax'] . " ";
        }

        //prepare query stmt
        $stmt = $this->getConn()->prepare($query);

        //Bindparam de name aan de gekoppelde value
        foreach ($options as $value) {
            $stmt->bindParam(":" . $value['name'], $value['value']);
            // echo "Parameter" . ' ' . $value['name'] . ' ' . 'heeft als waarde' . ' ' . $value['value'] . '</br>';
        }
        //var_dump($query);
        //Execute de stmt
        $stmt->execute();
    }

    /** Getters en setters */
    public function getTableName()
    {
        return $this->_tableName;
    }
    public function setTableName($tableName)
    {
        $this->_tableName = $tableName;
    }
    public function getRows()
    {
        return $this->_rows;
    }
    public function setRows($rows)
    {
        $this->_rows = $rows;
    }
    public function getOptions()
    {
        return $this->_options;
    }
    public function setOptions($options)
    {
        $this->_options = $options;
    }
}