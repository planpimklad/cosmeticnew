<?php
session_start();
include_once("connectdb.php"); // เชื่อมต่อฐานข้อมูล

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // แปลงเป็นจำนวนเต็มเพื่อป้องกัน SQL Injection

    // สร้าง SQL query เพื่อลบข้อมูลโดยใช้ c_id
    $sql = "DELETE FROM category WHERE c_id = $id";

    // ดำเนินการลบข้อมูล
    if (mysqli_query($conn, $sql)) {
        // หากลบสำเร็จ
        $_SESSION['message'] = "ลบข้อมูลเรียบร้อยแล้ว";
        header("Location: ./edit_category.php"); // Redirect ไปยังหน้า edit_category.php
        exit(); // หยุดการทำงานของโค้ดหลังจากการ redirect
    } else {
        // หากลบไม่สำเร็จ
        $_SESSION['message'] = "เกิดข้อผิดพลาดในการลบข้อมูล: " . mysqli_error($conn);
        header("Location: ./edit_category.php"); // Redirect กลับไปที่เดิมเพื่อแสดงข้อผิดพลาด
        exit();
    }
}

mysqli_close($conn); // ปิดการเชื่อมต่อฐานข้อมูล
?>
