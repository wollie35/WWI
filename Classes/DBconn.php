<?php

class DBconn
{
    /** Properties */
    private $conn;

    /** Constructor */
    public function __construct()
    {

    }

    /** Methods */
    /** Connectie met de database word hier geopend */
    public function openConnection()
    {
        include_once "Includes/config.php";
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