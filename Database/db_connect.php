<?php

/**
 * A class file to connect to database
 */
class DB_CONNECT {

    private $con;
    private $db;

    // constructor
    function __construct() {
        // connecting to database
        $this->db = $this->connect();
    }

    // destructor
    function __destruct() {
        // closing db connection
        $this->close();
    }

    /**
     * Function to connect with database
     */
    function connect() {
        // import database connection variables
        require_once __DIR__ . '/db_config.php';

        // Connecting to mysql database
        $this->con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysql_error());

        // Selecing database
        $dbb = mysqli_select_db($this->con,DB_DATABASE) or die(mysql_error()) or die(mysql_error());

        $conn = $this->con;

        // returing connection cursor
        return $conn;
    }

    function getDb() {
        return $this->db;
    }

    /**
     * Function to close db connection
     */
    function close() {
        // closing db connection
        mysqli_close($this->con);
    }

}

?>