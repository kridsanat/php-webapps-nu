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
    echo "<script>alert('ไม่ได้เลือกรูปใหม่ หรือเกิดข้อผิดพลาดในการอัปโหลด');window.location.href='EditNews.php?NewsID=$idx';</script>";
    exit();
}
?>
<html>
<head>
<?php echo "$fav"; ?>
<title><?php echo "$headtxt"; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="refresh" content="900;url=../logout.php" />
<meta http-equiv="refresh" content="3;URL=newmain.php">
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#ffffff">
<div align="center">
    <table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr>
            <td>
                <div align="center">
                    <br><br>
                    <img src="../images/ajax-loader.gif">
                    <br><br>
                    <font color="#003366" size="2">Completed: รูปภาพอัปเดตแล้ว</font>
                    <br><br>
                    <font size="2">Please Wait...</font>
                    <br><br><br><br><br>
                </div>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
