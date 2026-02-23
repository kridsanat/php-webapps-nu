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

// ดึงข้อมูลผู้ดูแล
$sql = "SELECT * FROM useradmin WHERE useradmin='$useradmin'";
$db_query = mysqli_query($connect, $sql);
$result = mysqli_fetch_array($db_query);
$id = $result["id"];
$adminname = $result["name"];
$user_admin = $result["useradmin"];
$pass_admin = $result["passadmin"];

// อัปโหลดรูปภาพ (ถ้ามี)
$photo_1 = "";
if ($_FILES["newphoto"]["name"] != "") {
    $name = $_FILES['newphoto']['name'];
    $tmp = $_FILES['newphoto']["tmp_name"];
    $oldname = explode(".", $name);
    $ext = "." . end($oldname);
    $photo_1 = date('YmdHis') . $ext;
    copy($tmp, "NEW/" . $photo_1);
}

// รับและ escape ข้อมูลจากฟอร์ม
$topic = mysqli_real_escape_string($connect, $_POST['topic']);
$message_raw = str_replace("\n", "<br>", $_POST['message']); // แปลง \n เป็น <br>
$postmessage = mysqli_real_escape_string($connect, $message_raw);
$regist_datetime = "$e_date $etime";

// สร้างคำสั่ง SQL
$insert = "
    INSERT INTO news (topic, newphoto, message, dateregist)
    VALUES ('$topic', '$photo_1', '$postmessage', '$regist_datetime')
";

// ทำการ insert
$result = mysqli_query($connect, $insert);
if (!$result) {
    die("Cannot Add Database: " . mysqli_error($connect));
}
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
