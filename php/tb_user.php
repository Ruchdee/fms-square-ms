<?php 
class User {

    //database connection and table name
    private $conn;
    private $table_name = "users";

    //table properties
    public $user_id;
    public $user_name;
    public $user_type;
    public $user_img;
    public $user_status;
    public $created_by;
    public $created_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    //read all records 
    //$act = 1, show only active status, $act = 0, show all
    function readall($act) {
        if ($act) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE user_status = 1 ORDER BY user_id DESC";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY user_id DESC";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = '" . $this->user_id . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one record according to user type
    function readonewithtype(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = '" . $this->user_id . "' AND user_type = '" . $this->user_type . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //add new record
    function create(){
        //write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (user_id, user_name, user_type, user_img, user_status, created_by, created_date) VALUES (?,?,?,?,?,?,?)");
        //bind parameters
        mysqli_stmt_bind_param($stmt, 'sssssss', $this->user_id, $this->user_name, $this->user_type, $this->user_img, $this->user_status, $this->created_by, $this->created_date);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //create()

    //update record
    function update(){
        $query = "UPDATE " . $this->table_name . " SET user_name = ?, user_type = ?, user_img = ?, user_status = ? WHERE user_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'sssss', $this->user_name, $this->user_type, $this->user_img, $this->user_status, $this->user_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    //delete record
    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE user_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameter
        mysqli_stmt_bind_param($stmt, 's', $this->user_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    //get user profile image
    function get_user_img($user){
        $query = " SELECT * FROM " .$this->table_name. " WHERE user_id = '".$user."' ";
        $result = mysqli_query($this->conn,$query);
        foreach ($result as $row){
           if(empty($row['user_img'])){
               return $_SESSION['profile_img_a'];
           }else{
               return $_SESSION['user_img'];
           }
        }
    }
}
?>