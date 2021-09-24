<?php
class Database{

    private $host = "localhost";
    private $user = "root";
    private $passwd = "";
    //fms server
    // private $user = "sq20mgtg2";
    // private $passwd = "Sq20T.*836.gth";


    //connect to SQUARE database
    private $db_name = "fms_square_db";
    public $conn;

    //connect to main database
    private $db_name_m = "fms_main_db";
    public $conn_m;

    // get SQUARE connection
    public function getConnection(){
        $this->conn = null;
        try{
            $this->conn = mysqli_connect($this->host, $this->user, $this->passwd, $this->db_name);
            //$this->conn = new mysqli($this->host, $this->user, $this->passwd, $this->db_name);
            mysqli_set_charset($this->conn, "utf8");
        }catch(Exception $exception){
            //echo "Connection error: " . $exception.getMessage();
            echo "Connection error:" .$connect->connect_error;
        }
        return $this->conn;
    }

    // close SQUARE connection
    public function closeConnection(){
        mysqli_close($this->conn);
    }

    // get main connection
    public function getConnection_main(){
        $this->conn = null;
        try{
            $this->conn_m = mysqli_connect($this->host, $this->user, $this->passwd, $this->db_name_m);
            //$this->conn_m = new mysqli($this->host, $this->user, $this->passwd, $this->db_name_m);
            mysqli_set_charset($this->conn_m, "utf8");
        }catch(Exception $exception){
            //echo "Connection error: " . $exception.getMessage();
            echo "Connection error:" .$connect->connect_error;
        }
        return $this->conn_m;
    }

    // close main connection
    public function closeConnection_main(){
        mysqli_close($this->conn_m);
    }
}

?>
