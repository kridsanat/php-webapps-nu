<?php
@session_start();
ob_start();

// เช็คสิทธิ์ผู้ดูแลระบบ
$useradmin = $_SESSION["useradmin"];
if (empty($useradmin)) {
    echo "<script>alert('Only Administrator');</script>";
    header("Location: ../index.php");
    exit();
}

// เชื่อมต่อฐานข้อมูล
require_once "../include/tdate.php";
require_once "../include/connectdb.php";

// ดึงข้อมูลผู้ดูแลระบบ
$sql = "SELECT * FROM useradmin WHERE useradmin='$useradmin'";
$db_query = mysqli_query($connect, $sql);
$result = mysqli_fetch_array($db_query);
$id = $result["id"];
$adminname = $result["name"];
$user_admin = $result["useradmin"];
$pass_admin = $result["passadmin"];

// รับค่าจากฟอร์มและ escape ค่า
$topic = mysqli_real_escape_string($connect, $_POST['topic']);
$message_raw = $_POST['message'];
$postmessage = mysqli_real_escape_string($connect, str_replace("\n", "", $message_raw));
$idx = intval($_POST['idx']); // ป้องกัน SQL injection จาก id

// สร้างวันที่
$regist_datetime = "$e_date $etime";

// อัปเดตข้อมูลข่าว
$sql_data = "
    UPDATE news 
    SET topic='$topic', 
        message='$postmessage', 
        dateregist='$regist_datetime' 
    WHERE id='$idx'
";
mysqli_query($connect, $sql_data);
?>

<html>
<head>
    <?php echo "$fav"; ?>
    <title><?php echo "$headtxt"; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=tis-620">
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
                        <font color="#003366" size="2">Completed</font>
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
