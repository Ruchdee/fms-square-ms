<?php
    $txt1 = "";
    $txt2 = "งานพัฒนานักศึกษาและส่งเสริมการทำงาน :คณะวิทยาการจัดการ";
    $txt3 = "เทคนิคการเขียน Resume ให้ปังและโดนใจนายจ้าง วันที่ 17 กันยายน 2564 ระหว่างเวลา 13.30-16.30 น";
    //$test = substr(htmlspecialchars(trim(strip_tags($txt))), 0, 100);
    $test = strlen(htmlspecialchars(trim(strip_tags($txt3))));
    echo $test;
?>
