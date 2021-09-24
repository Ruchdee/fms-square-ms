<?php 

    include_once '../php/dbconnect.php';
    include_once '../php/tb_student_profile.php';
    include_once '../php/tb_moreless_request.php';

    //get connection
    $database = new Database();
    $db = $database->getConnection();
    $db_m = $database->getConnection_main();

    //pass connection to table
    $moreless_req = new Moreless_request($db);
    $student = new Studentp($db_m);

    $moreless_req->moreless_id = $_POST['moreless_id'];
    $result_req = $moreless_req->readall();

    $no = 0;

?>
<html>
    <head>
        <link href="../assets/extra-libs/datatables.net/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="../assets/extra-libs/datatables.net/css/buttons.dataTables.min.css" rel="stylesheet">
    </head>
    <body>
        <?php if (mysqli_num_rows($result_req) > 0) { ?>
            <div class="table-responsive">
                <table id="register_list" class="table table-sm display">
                    <thead class="header-item">
                        <th class="text-dark font-weight-bold text-center">#</th>
                        <th class="text-dark font-weight-bold text-center">รหัสนักศึกษา</th>
                        <th class="text-dark font-weight-bold">ชื่อ-นามสกุล</th>
                        <th class="text-dark font-weight-bold text-center">เกรดเฉลี่ยสะสม</th>
                        <th class="text-dark font-weight-bold text-center">ลงทะเบียนแล้ว</th>
                        <th class="text-dark font-weight-bold text-center">ต้องการลงทะเบียน</th>
                        <th class="text-dark font-weight-bold text-center">ประเภท</th>
                        <th class="text-dark font-weight-bold text-center">จำนวนหน่วยกิต</th>
                        <th class="text-dark font-weight-bold">เหตุผล</th>
                        <th class="text-dark font-weight-bold">วันที่บันทึก</th>
                    </thead>
                    <tbody>
                    <?php while ($row_req = mysqli_fetch_array($result_req)) { ?>
                        <?php 
                            $no += 1; 
                            //get student info
                            $student->student_id = $row_req['student_id'];
                            $result_student = $student->readone();
                            $row_student = mysqli_fetch_array($result_student);
                        ?>
                        <!-- row_req -->
                        <tr class="search-items">
                            <td class="text-center"><?php echo $no; ?></td>
                            <td class="text-center">
                                <span class="user-work"><?php echo $row_req['student_id']; ?></span>
                            </td>
                            <td>
                                <?php echo $row_student['title_name_thai'] . $row_student['stud_name_thai'] . " " . $row_student['stud_sname_thai']; ?>
                            </td>
                            <td class="text-center">
                                <span class="usr-email-addr"><?php echo $row_student['cum_gpa']; ?></span>
                            </td>
                            <td class="text-center">
                                <span class="usr-email-addr"><?php echo $row_req['registered_credits']; ?></span>
                            </td>
                            <td class="text-center">
                                <span class="usr-email-addr"><?php echo $row_req['alter_registered_credits']; ?></span>
                            </td>
                            <td class="text-center">
                                <span class="usr-email-addr">
                                    <?php if ($row_req['moreless_type']=='m') { echo "มากกว่ากำหนด"; } else { echo "น้อยกว่ากำหนด"; } ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="usr-email-addr"><?php echo $row_req['moreless_credits']; ?></span>
                            </td>
                            <td>
                                <span class="usr-email-addr"><?php echo $row_req['moreless_reason']; ?></span>
                            </td>
                            <td>
                                <span class="usr-email-addr"><?php echo $moreless_req->DateThai($row_req['registered_date']); ?></span>
                            </td>
                        </tr>
                        <!-- /.row_req -->
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div class="text-center text-primary">ไม่มีข้อมูลการลงทะเบียน</div>
        <?php } ?>

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
