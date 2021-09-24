<?php 

    include_once '../php/dbconnect.php';
    include_once '../php/tb_student_profile.php';
    include_once '../php/tb_survey_register.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();
    $db_m = $database->getConnection_main();

    //pass connection to table
    $survey_register = new Survey_register($db);
    $student = new Studentp($db_m);

    $survey_register->survey_id = $_POST['survey_id'];
    $result_register = $survey_register->readall();

    $no = 0;

?>
<html>
    <head>
        <link href="../assets/extra-libs/datatables.net/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="../assets/extra-libs/datatables.net/css/buttons.dataTables.min.css" rel="stylesheet">
    </head>
    <body>
        <?php if (mysqli_num_rows($result_register) > 0) { ?>
            <div class="table-responsive">
                <!-- <table class="table table-sm table-striped display" id="alt_pagination" style="width:100%"> -->
                <table id="register_list" class="table table-sm display">
                    <thead class="header-item">
                        <th class="text-dark font-weight-bold">#</th>
                        <th class="text-dark font-weight-bold">รหัสนักศึกษา</th>
                        <th class="text-dark font-weight-bold">ชื่อ-นามสกุล</th>
                        <th class="text-dark font-weight-bold">รหัสวิชา 1</th>
                        <th class="text-dark font-weight-bold">รหัสวิชา 2</th>
                        <th class="text-dark font-weight-bold">รหัสวิชา 3</th>
                        <th class="text-dark font-weight-bold">รหัสวิชา 4</th>
                        <th class="text-dark font-weight-bold">รหัสวิชา 5</th>
                        <th class="text-dark font-weight-bold">รหัสวิชา 6</th>
                        <th class="text-dark font-weight-bold">หมายเหตุ</th>
                    </thead>
                    <tbody>
                    <?php while ($row_register = mysqli_fetch_array($result_register)) { ?>
                        <?php 
                            $no += 1; 
                            //get student info
                            $student->student_id = $row_register['student_id'];
                            $result_student = $student->readone();
                            $row_student = mysqli_fetch_array($result_student);
                        ?>
                        <!-- row_register -->
                        <tr class="search-items">
                            <td><?php echo $no; ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="user-work"><?php echo $row_register['student_id']; ?></span>
                                </div>
                            </td>
                            <td>
                                <?php echo $row_student['title_name_thai'] . $row_student['stud_name_thai'] . " " . $row_student['stud_sname_thai']; ?>
                            </td>
                            <td>
                                <span class="usr-email-addr"><?php echo $row_register['course_code1']; ?></span>
                            </td>
                            <td>
                                <span class="usr-email-addr"><?php echo $row_register['course_code2']; ?></span>
                            </td>
                            <td>
                                <span class="usr-email-addr"><?php echo $row_register['course_code3']; ?></span>
                            </td>
                            <td>
                                <span class="usr-email-addr"><?php echo $row_register['course_code4']; ?></span>
                            </td>
                            <td>
                                <span class="usr-email-addr"><?php echo $row_register['course_code5']; ?></span>
                            </td>
                            <td>
                                <span class="usr-email-addr"><?php echo $row_register['course_code6']; ?></span>
                            </td>
                            <td>
                                <span class="usr-email-addr"><?php echo $row_register['remark']; ?></span>
                            </td>
                        </tr>
                        <!-- /.row_register -->
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div class="text-center text-primary">ไม่มีข้อมูลการลงทะเบียน</div>
        <?php } ?>

        <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
        <script src="../dist/js/pages/datatable/jquery.dataTables.min.js"></script>
        <script src="../dist/js/pages/datatable/dataTables.buttons.min.js"></script>
        <script src="../dist/js/pages/datatable/jszip.min.js"></script>
        <script src="../dist/js/pages/datatable/pdfmake.min.js"></script>
        <script src="../dist/js/pages/datatable/vfs_fonts.js"></script>
        <script src="../dist/js/pages/datatable/buttons.html5.min.js"></script>
        <script src="../dist/js/pages/datatable/buttons.print.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#register_list').DataTable( {
                    dom: 'Bfrtip',
                    buttons: [
                        'copy',
                        'excel',
                        'csv',
                        'print'
                    ]
                });
            });
        </script>
        
    </body>
</html>
