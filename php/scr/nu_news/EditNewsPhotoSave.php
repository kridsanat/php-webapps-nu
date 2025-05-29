<?php
@session_start();
ob_start();

$useradmin = $_SESSION["useradmin"];
if (empty($useradmin)) {
    echo "<script>alert('Only Administrator');</script>";
    header("Location: ../index.php");
    exit();
}

require_once "../include/tdate.php";
require_once "../include/connectdb.php";

// ตรวจสอบสิทธิ์
$sql = "SELECT * FROM useradmin WHERE useradmin='$useradmin'";
$db_query = mysqli_query($connect, $sql);
$result = mysqli_fetch_array($db_query);
$id = $result["id"];
$adminname = $result["name"];

// ตรวจสอบการส่งค่ามา
$idx = isset($_POST['idx']) ? intval($_POST['idx']) : 0;
if ($idx <= 0) {
    die("ไม่พบข้อมูลข่าวที่ต้องการแก้ไข");
}

// เตรียมชื่อไฟล์ใหม่ถ้ามีการอัปโหลด
$photo_1 = "";
if (isset($_FILES["newphoto"]) && $_FILES["newphoto"]["error"] === UPLOAD_ERR_OK) {
    $name = $_FILES['newphoto']['name'];
    $tmp = $_FILES['newphoto']['tmp_name'];
    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    $photo_1 = date('YmdHis') . "." . $ext;

    // ตรวจสอบว่าอัปโหลดได้จริงไหม
    if (move_uploaded_file($tmp, "NEW/" . $photo_1)) {
        // อัปเดตเฉพาะ newphoto
        $sql_update = "UPDATE news SET newphoto='$photo_1', dateregist='$e_date $etime' WHERE id='$idx'";
        $result = mysqli_query($connect, $sql_update);
        if (!$result) {
            die("อัปเดตรูปล้มเหลว: " . mysqli_error($connect));
        }
    } else {
        die("ไม่สามารถย้ายไฟล์ไปยังโฟลเดอร์ NEW/");
    }
} else {
    echo "<s
