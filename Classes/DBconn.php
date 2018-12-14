<?php

class DBconn
{
    /** Properties */
    private $conn;

    /** Constructor */
    public function __construct()
    {
        //deze wordt standaard gedraaid wanneer de class wordt geladen (dat is niet nodig voor en DB connectie)
    }

    /** Methods */
    /** Connectie met de database word hier geopend */
    public function openConnection()
    {
        //Uit de config haalt die de dbname, gebruikersnaam, en wachtwoord op
        include_once "Includes/config.php";
        //Probeert een verbinding te leggen, anders geeft een melding van de foutmelding
        try {
            $this->conn = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, USERNAME, PASSWORD);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }

    /** De connectie met de database word hier afgesloten. */
    public function CloseConnection()
    {
        return $this->conn = null;
    }


    /** Getters en setters */
    // wanneer de functie get conn wordt opgevraagd geeft die de connectie
    public function getConn()
    {
        return $this->conn;
    }
    public function setConn($conn)
    {
        $this->conn = $conn;
    }
}

?>