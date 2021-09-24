<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Form_submission {

    //database connection and table name
    private $conn;
    private $table_name = "form_submissions";

    //table properties
    public $fsubmission_id;
    public $form_id;
    public $std_id;
    public $fsubmission_date;
    public $fsubmission_remark;
    public $fsubmission_filename;
    public $fsubmission_email;                  //May 30, 2021 Aj.Ruchdee
    public $fsubmission_status;                 //May 20, 2021 Aj.Ruchdee
    public $academic_year;
    public $semester;
    public $form_name;                          //May 30, 2021 Aj.Ruchdee
    public $lecturer_email;                     //May 31, 2021 Aj.Ruchdee
    public $lecturer_type;                      //May 31, 2021 Aj.Ruchdee
    public $forward_email2;                     //May 31, 2021 Aj.Ruchdee
    public $forward_email3;                     //May 31, 2021 Aj.Ruchdee

    public function __construct($db) {
        $this->conn = $db;
    }

    //$act = 1, show only active status, $act = 0, show all
    function readall($act) {
        if ($act) {
            $query = "SELECT * FROM " . $this->table_name . " WHERE student_id = '" . $this->std_id . "' AND academic_year = '" . $this->academic_year . "' AND semester = '" . $this->semester . "' ORDER BY fsubmission_id DESC";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY fsubmission_id DESC";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read all for a specific academic year and semester
    //add condition - form_id
    function readforacyear_semester() {
        if ($this->form_id=="all") {
            $query = "SELECT * FROM " . $this->table_name . " WHERE academic_year = '" . $this->academic_year . "' AND semester = '" . $this->semester . "' ORDER BY fsubmission_id DESC";
        } else {
            $query = "SELECT * FROM " . $this->table_name . " WHERE form_id = " . $this->form_id . " AND academic_year = '" . $this->academic_year . "' AND semester = '" . $this->semester . "' ORDER BY fsubmission_id DESC";
        }
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE fsubmission_id = '" . $this->fsubmission_id . "'";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    //add new record
    function create(){
        //write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (form_id, student_id, fsubmission_date, fsubmission_remark, fsubmission_filename, fsubmission_email, fsubmission_status, academic_year, semester) VALUES (?,?,?,?,?,?,?,?,?)");
        //bind parameters
        mysqli_stmt_bind_param($stmt, 'sssssssss', $this->form_id, $this->std_id, $this->fsubmission_date, $this->fsubmission_remark, $this->fsubmission_filename, $this->fsubmission_email, $this->fsubmission_status, $this->academic_year, $this->semester);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }  //create()

    //update record
    function update(){
        $query = "UPDATE " . $this->table_name . " SET form_id = ?, fsubmission_remark = ?, fsubmission_filename = ?, fsubmission_email = ?, fsubmission_status = ? WHERE fsubmission_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'ssssss',  $this->form_id, $this->fsubmission_remark, $this->fsubmission_filename, $this->fsubmission_email, $this->fsubmission_status, $this->fsubmission_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    //delete record
    function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE fsubmission_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameter
        mysqli_stmt_bind_param($stmt, 's', $this->fsubmission_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    function DateThai($strDate) {
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("j", strtotime($strDate));
        $strTime = date("H:i:s", strtotime($strDate));
        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear $strTime";
    }

    //update status, May 20, 2021   Aj.Ruchdee
    function update_status(){
        $query = "UPDATE " . $this->table_name . " SET fsubmission_remark = ?, fsubmission_status = ? WHERE fsubmission_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'sss', $this->fsubmission_remark, $this->fsubmission_status, $this->fsubmission_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            return false;
        }
    }

    //send e-mail to inform student
    //May 30, 2021 Aj.Ruchdee
    function send_email_student() {
        include_once '../vendor/phpmailer/phpmailer/src/Exception.php';
        include_once '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
        include_once '../vendor/phpmailer/phpmailer/src/SMTP.php';

        // passing true in constructor enables exceptions in PHPMailer
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';

        try {
            // Server settings
            $mail->SMTPDebug = 0; // for detailed debug output
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            //$mail->SMTPSecure = 'ssl';
            $mail->Port = 587;
            //$mail->Port = 465;

            $mail->Username = 'edufmspsu@gmail.com'; // YOUR gmail email
            $mail->Password = 'edumgt123'; // YOUR gmail password

            // Sender and recipient settings
            $mail->setFrom('edufmspsu@gmail.com', 'งานจัดการศึกษา คณะวิทยาการจัดการ');
            $mail->addAddress($this->fsubmission_email, $this->std_id);
            
            switch ($this->fsubmission_status) {
                case '1':
                    $fstatus = "ได้รับเอกสารแล้ว";
                    break;
                case '2':
                    $fstatus = "กำลังดำเนินการ";
                    break;
                case '3':
                    $fstatus = "ติดต่อเจ้าหน้าที่ (074287825)";
                    break;
                case '4':
                    $fstatus = "อนุมัติ";
                    break;
                case '5':
                    $fstatus = "ไม่อนุมัติ";
                    break; 
            }
            $message = "เรียน รหัสนักศึกษา " . $this->std_id .  "<br><br>ขอแจ้งสถานะการส่งเอกสารออนไลน์ของท่าน <b>" . $fstatus . "</b> ส่งเมื่อวันที่ " . $this->DateThai($this->fsubmission_date) . " ประเภทเอกสาร " . $this->form_name . "<br><br>กรณีต้องการสอบถามข้อมูลเพิ่มเติม กรุณาติดต่อเจ้าหน้าที่ หมายเลขโทรศัพท์ 074 287 825<br><br>งานจัดการศึกษา คณะวิทยาการจัดการ";

            $message_plain = "ขอแจ้งสถานะการส่งเอกสารออนไลน์ของท่าน " . $fstatus . " ส่งเมื่อวันที่ " . $this->DateThai($this->fsubmission_date) . " ประเภทเอกสาร " . $this->form_id . " กรณีต้องการสอบถามข้อมูลเพิ่มเติม กรุณาติดต่อเจ้าหน้าที่ หมายเลขโทรศัพท์ 074 287 825";

            // Setting the email content
            $mail->IsHTML(true);
            $mail->Subject = "แจ้งสถานะเอกสารออนไลน์: รหัสนักศึกษา " . $this->std_id;
            $mail->Body = $message;
            $mail->AltBody = $message_plain;

            $mail->send();
            //echo "Email message sent.";
            return true;
        } catch (Exception $e) {
            //echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }

    //send email to inform staff
    function send_email_staff() {
        include_once '../vendor/phpmailer/phpmailer/src/Exception.php';
        include_once '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
        include_once '../vendor/phpmailer/phpmailer/src/SMTP.php';

        // passing true in constructor enables exceptions in PHPMailer
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';

        try {
            // Server settings
            $mail->SMTPDebug = 0; // for detailed debug output
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->Username = 'edufmspsu@gmail.com'; // YOUR gmail email
            $mail->Password = 'edumgt123'; // YOUR gmail password

            // Sender and recipient settings
            $mail->setFrom('edufmspsu@gmail.com', 'งานจัดการศึกษา คณะวิทยาการจัดการ');
            $mail->addAddress('suwat.a@psu.ac.th', 'เจ้าหน้าที่งานจัดการศึกษา');
            $mail->addCC('seri.si@psu.ac.th');
            
            switch ($this->fsubmission_status) {
                case '1':
                    $fstatus = "ได้รับเอกสารแล้ว";
                    break;
                case '2':
                    $fstatus = "กำลังดำเนินการ";
                    break;
                case '3':
                    $fstatus = "ติดต่อเจ้าหน้าที่ (074287825)";
                    break;
                case '4':
                    $fstatus = "อนุมัติ";
                    break;
                case '5':
                    $fstatus = "ไม่อนุมัติ";
                    break; 
            }
            $message = "เรียน เจ้าหน้าที่งานจัดการศึกษา  <br><br>มีการส่งเอกสารออนไลน์จาก รหัสนักศึกษา " . $this->std_id . " สถานะเอกสารออนไลน์ <b>" . $fstatus . "</b> ส่งเมื่อวันที่ " . $this->DateThai($this->fsubmission_date) . " ประเภทเอกสาร " . $this->form_name . "<br><br>ข้อความนี้เป็นข้อความอัตโนมัติจากระบบ FMS Square (https://square.fms.psu.ac.th/staff/login.php)";

            // Setting the email content
            $mail->IsHTML(true);
            $mail->Subject = "แจ้งเอกสารออนไลน์: รหัสนักศึกษา " . $this->std_id;
            $mail->Body = $message;

            $mail->send();
            //echo "Email message sent.";
            return true;
        } catch (Exception $e) {
            //echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }

    //send email to inform lecturer and other concerns
    function send_email_lecturer() {
        include_once '../vendor/phpmailer/phpmailer/src/Exception.php';
        include_once '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
        include_once '../vendor/phpmailer/phpmailer/src/SMTP.php';

        // passing true in constructor enables exceptions in PHPMailer
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';

        try {
            // Server settings
            $mail->SMTPDebug = 0; // for detailed debug output
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->Username = 'edufmspsu@gmail.com'; // YOUR gmail email
            $mail->Password = 'edumgt123'; // YOUR gmail password

            //เพิ่ม ผู้มีอำนาจอนุมัติ และ คณบดี 21/07/2021 Aj.Ruchdee
            switch ($this->lecturer_type) {
                case '1':
                    $ltype = "อาจารย์ที่ปรึกษา/ผู้ที่เกี่ยวข้อง";
                    break;
                case '2':
                    $ltype = "อาจารย์ผู้สอน/ผู้ที่เกี่ยวข้อง";
                    break;
                case '3':
                    $ltype = "หัวหน้าสาขาวิชา/ผู้ที่เกี่ยวข้อง";
                    break;
                case '4':
                    $ltype = "ผู้มีอำนาจอนุมัติ/ผู้ที่เกี่ยวข้อง";
                    break;
                case '5':
                    $ltype = "คณบดี/ผู้ที่เกี่ยวข้อง";
                    break;
            }

            // Sender and recipient settings
            $mail->setFrom('edufmspsu@gmail.com', 'งานจัดการศึกษา คณะวิทยาการจัดการ');
            $mail->addAddress($this->lecturer_email, $ltype);
            if ($this->forward_email2 <> '') {
                $mail->addCC($this->forward_email2);
                //$mail->addBCC("bcc@example.com");
            }
            if ($this->forward_email3 <> '') {
                $mail->addCC($this->forward_email3);
            }
            //Address to which recipient will reply
            $mail->addReplyTo("suwat.a@psu.ac.th", "งานจัดการศึกษา คณะวิทยาการจัดการ");
            
            switch ($this->fsubmission_status) {
                case '1':
                    $fstatus = "ได้รับเอกสารแล้ว";
                    break;
                case '2':
                    $fstatus = "กำลังดำเนินการ";
                    break;
                case '3':
                    $fstatus = "ติดต่อเจ้าหน้าที่ (074287825)";
                    break;
                case '4':
                    $fstatus = "อนุมัติ";
                    break;
                case '5':
                    $fstatus = "ไม่อนุมัติ";
                    break; 
            }
            $message = "เรียน " . $ltype . "<br><br>เอกสารออนไลน์จาก รหัสนักศึกษา " . $this->std_id . " สถานะเอกสารออนไลน์ <b>" . $fstatus . "</b> ส่งเมื่อวันที่ " . $this->DateThai($this->fsubmission_date) . " ประเภทเอกสาร " . $this->form_name . " รอการอนุมัติจากท่าน กรุณาตอบกลับผลการพิจารณาไปที่อีเมล suwat.a@psu.ac.th <br><br>กรณีต้องการสอบถามข้อมูลเพิ่มเติม กรุณาติดต่อหมายเลขโทรศัพท์ 074 287 825<br><br>ข้อความนี้เป็นข้อความอัตโนมัติจากระบบ FMS Square (https://square.fms.psu.ac.th)";

            // Setting the email content
            $mail->IsHTML(true);
            $mail->Subject = "แจ้งเอกสารออนไลน์: รหัสนักศึกษา " . $this->std_id;
            $mail->Body = $message;
            $mail->addAttachment($this->fsubmission_filename);

            $mail->send();
            //echo "Email message sent.";
            return true;
        } catch (Exception $e) {
            //echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }

}

?>