<?php 
    include_once 'tb_student_profile.php';
    include_once 'tb_user.php';

class Message_list{
    //database connection
    private $conn;
    private $conn_m;
    private $table_name = 'messages';

    //table variable
    public $msg_text;
    public $msg_type;
    public $from_user_id;
    public $to_user_id;
    public $msg_read;
    public $msg_date;
    public $academic_year;
    public $semester;
    public $majors;

    public function __construct($db, $db_m) {
        $this->conn = $db;
        $this->conn_m = $db_m;
    }

    // check user is exist or not
    function check_user(){
        $user = new User($this->conn);
        $user->user_id = $this->to_user_id;
        $users = $user->readone();
        
        $student = new Studentp($this->conn_m);
        $student->student_id = $this->to_user_id;
        $students = $student->readone();
        
        if (mysqli_num_rows($users)>0 || mysqli_num_rows($students)>0){
            return true;
        } else {
            return false;
        }
    }

    //insert chat
    function chat_message(){
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (msg_text, msg_type, from_user_id, to_user_id, msg_read, msg_date, academic_year, semester) VALUES (?,?,?,?,?,?,?,?)");

        mysqli_stmt_bind_param($stmt, 'ssssssss', $this->msg_text, $this->msg_type, $this->from_user_id, $this->to_user_id, $this->msg_read, $this->msg_date, $this->academic_year, $this->semester);
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    //send group chat
    function group_chat_message(){
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " .$this->table_name. " (msg_text, msg_type, from_user_id, to_user_id, msg_read, msg_date, academic_year, semester) VALUES (?,?,?,?,?,?,?,?)");

        foreach($this->to_user_id as $userid){
            mysqli_stmt_bind_param($stmt, 'ssssssss', $this->msg_text, $this->msg_type, $this->from_user_id, $userid, $this->msg_read, $this->msg_date, $this->academic_year, $this->semester);
            mysqli_stmt_execute($stmt);
        }
    }

    //get current user
    function get_current_user(){
       $query = "SELECT * FROM " .$this->table_name. " m1 WHERE msg_id IN (SELECT MAX(m2.msg_id) FROM " .$this->table_name. " m2 WHERE m2.from_user_id = '".$this->from_user_id."' OR m2.to_user_id = '".$this->from_user_id."' GROUP BY (IF(m2.from_user_id = '".$this->from_user_id."', m2.to_user_id,m2.from_user_id))) ORDER BY msg_date DESC LIMIT 30";

        $result = mysqli_query($this->conn, $query);

        // return $result;
        $output = "";
        While($row = mysqli_fetch_array($result)){
            if ($row['from_user_id'] == $this->from_user_id){ 
               $user = $row['to_user_id']; 
            } else { 
                $user = $row['from_user_id'];
            }
            if($this->from_user_id == $row['to_user_id']){
                $output .='<a href="#" class="chat-user message-item start_chat" id="chat_user_1" data-user-id="'.$user.'">
                <span class="user-img"> 
                    <img src="'.$this->get_profile_img($user).'" alt="user" class="rounded-circle"> 
                    <span class="profile-status online pull-right"></span> 
                </span>
                <div class="mail-contnet">
                    <h5 class="message-title" data-username="Pavan kumar">'.$user.'</h5> 
                    <span class="mail-desc">'.$row['msg_text'].'</span> <span class="time">'.$row['msg_date'].'</span> 
                </div></a>';
            } else {
                $output .=' <a href="#" class="chat-user message-item start_chat" id="chat_user_1" data-user-id="'.$user.'">
                <span class="user-img"> 
                    <img src="'.$this->get_profile_img($user).'" alt="user" class="rounded-circle"> 
                    <span class="profile-status online pull-right"></span> 
                </span>
                <div class="mail-contnet">
                    <h5 class="message-title" data-username="Pavan kumar">'.$user.'</h5> 
                    <span class="mail-desc">YOU: '.$row['msg_text'].'</span> <span class="time">'.$row['msg_date'].'</span> 
                </div></a>';
            }
        }
        return $output;
    }

    //user chat history
    function get_chat_history(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE from_user_id = '".$this->from_user_id."'
        AND to_user_id = '".$this->to_user_id."' OR from_user_id = '".$this->to_user_id."' AND to_user_id = '".$this->from_user_id."' ";

        $output = "";
        if ($result = mysqli_query($this->conn, $query)){
            foreach($result as $row){
                if($row['from_user_id'] != $this->from_user_id){
                    $output .= '<li class="chat-item">
                        <div class="chat-img"><img src="'.$this->get_profile_img($this->to_user_id).'" alt="user"></div>
                        <div class="chat-content">
                            <div class="box bg-light-success">
                            <h5 class="font-medium">'.$row['from_user_id'].'</h5>
                            <p class="font-light mb-0">'.$row['msg_text'].'</p>
                            <div class="chat-time">'.$row['msg_date'].'</div>
                            </div>
                        </div>
                    </li>';
                } else {
                    $output .= '<li class="odd chat-item">
                        <div class="chat-content">
                            <div class="box bg-light-success">
                            <h5 class="font-medium">'.$row['from_user_id'].'</h5>
                            <p class="font-light mb-0">'.$row['msg_text'].'</p>
                            <div class="chat-time">'.$row['msg_date'].'</div>
                            </div>
                        </div>
                        <div class="chat-img"><img src="'.$_SESSION['profile_img'].'" alt="user"></div>
                    </li>';
                }
            }
        }
        return $output;       
    }
    
    //count unread message
    function show_notify_red_dot(){
        $query = "SELECT msg_read FROM " .$this->table_name. " WHERE to_user_id = '".$this->to_user_id."' AND msg_read = 0";
        $result = mysqli_query($this->conn,$query);
        $count = mysqli_num_rows($result);
        $output = '';
        if ($count > 0) {
            $output .= '<span class="heartbit"></span>
            <span class="point"></span>';
        }
        return $output;
    }

    //count unread message
    function count_unread_message(){
        $query = "SELECT msg_read FROM " .$this->table_name. " WHERE to_user_id = '".$this->to_user_id."' AND msg_read = 0";
        $result = mysqli_query($this->conn,$query);
        $count = mysqli_num_rows($result);
        $output = '';
        if ($count > 0){
            $output .= 'You have '.$count.' messages';
        }
        return $output;
    }
    
    //update if user read message
    function update_read_message(){
        $query = " UPDATE " .$this->table_name. " SET msg_read = 1 WHERE from_user_id = '".$this->from_user_id."' AND to_user_id = '".$this->to_user_id."' ";
        $result = mysqli_query($this->conn,$query);
        return $result;
    }
    
    //notify last 4 chat
    function notify_last4_chat(){
        $query = "SELECT * FROM " .$this->table_name . " WHERE to_user_id = '".$this->to_user_id."' AND msg_read = 0 ORDER BY msg_date LIMIT 4";
        $result = mysqli_query($this->conn,$query);
        $output = '';
        if (mysqli_num_rows($result) > 0){
            foreach($result as $row){
                $output .= '<a href="javascript:void(0)" class="message-item">
                <span class="user-img"><img src="'.$this->get_profile_img($row['from_user_id']).'" alt="user" class="rounded-circle"> <span class="profile-status online pull-right"></span></span>
                <span class="mail-contnet">
                    <h5 class="message-title">'.$row['from_user_id'].'</h5> <span class="mail-desc" style="overflow:hidden" >'.$row['msg_text'].'</span> <span class="time">'.$row['msg_date'].'</span>
                </span></a>';
            }
        } else {
            $output .= '<a href="javascript:void(0)" class="message-item" disabled>
            <span class="mail-contnet text-center">
              YOU HAVE NO NEW MESSAGE
                </span></a>';
        }
        return $output;
    }

    //get profile img
    function get_profile_img($user){
        $std_id = $user;
        $student = new Studentp($this->conn_m);
        $std_img = $student->get_student_img($std_id);
        if ($std_img) {
            return $std_img;
        } else {
            $user_id = $user;
            $user = new User($this->conn);
            $user_img = $user->get_user_img($user_id);
            return $user_img;
        }
    }

}

?>