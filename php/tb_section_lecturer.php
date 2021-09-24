<?php 
class Section_lecturer {

    //database connection and table name
    private $conn;
    private $table_name = "section_lecturer";

    //table properties
    public $lecturer_id;
    public $lecturer_order;
    public $section_offer_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    function readall() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY lecturer_id, lecturer_order";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE lecturer_id = '" . $this->lecturer_id . "' AND lecturer_order = '1'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one by section_offer_id
    function readonebysection_offer_id(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE section_offer_id = '" . $this->section_offer_id . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

}
?>