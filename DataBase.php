<?php
/*
Singlton design pattern
*/
class DataBase{
    private $connection;
    private static $instance;
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "ShobraOrg2";

    public static function getInstance() {
        if(!self::$instance) { // If no instance then make one
            self::$instance = new self();
        }
        return self::$instance;
    }


    private function __construct() {
        $this->connection = new mysqli($this->host, $this->username,
            $this->password, $this->database);

        // Error handling
        if(mysqli_connect_error()) {
            trigger_error("Failed to connect to MySQL: " . mysql_connect_error(),
                E_USER_ERROR);
        }
    }


    public function getConnection() {
        return $this->connection;
    }

    public static function ExcuteQuery($query): bool{
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $sql_query = $query;
        if(mysqli_query($conn,$sql_query)) {
            return true;
        }
        else
        {
            echo("Error description: " . $conn -> error);
            return false;
        }
    }

    public static function ExcuteRetreiveQuery($query) : bool|array
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $sql_query = $query;
        $foundRows=Array();
        if( $results= mysqli_query($mysqli,$sql_query)) {
            while($row=mysqli_fetch_array($results))
            {
                array_push($foundRows,$row);
            }
            return $foundRows;
        }
        else
        {
            echo("Error description: " . $mysqli -> error);
            return false;
        }
    }

    public static function ExcuteIdQuery($query): bool|int
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $sql_query = $query;
        $foundRows=Array();
        if(mysqli_query($mysqli,$sql_query)) {
            $last_id = mysqli_insert_id($mysqli);
            return $last_id;
        }
        else
        {
            echo("Error description: " . $mysqli -> error);
            return false;
        }
    }


}

//$arr=Database::ExcuteQuery("INSERT INTO userids (id,title) VALUES ('5','Sayed')");

?>