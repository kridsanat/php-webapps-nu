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

// ตรวจสอบผู้ใช้งาน
$sql = "SELECT * FROM useradmin WHERE useradmin='$useradmin'";
$db_query = mysqli_query($connect, $sql);					
$result = mysqli_fetch_array($db_query);
$id = $result["id"];
$adminname = $result["name"];

// อัปโหลดรูป
$photo_1 = "";
if ($_FILES["newphoto"]["name"] != "") {
    $name = $_FILES['newphoto']['name'];
    $tmp = $_FILES['newphoto']["tmp_name"];
    $ext = "." . pathinfo($name, PATHINFO_EXTENSION);
    $photo_1 = date('YmdHis') . $ext;
    copy($tmp, "NEW/" . $photo_1);
}

// อัปเดตเฉพาะรูปถ้ามีรูปใหม่
if (!empty($photo_1)) {
    $idx = intval($_POST['idx']);
    $sql_data = "UPDATE news SET newphoto='$photo_1', dateregist='$e_date $etime' WHERE id='$idx'";
    mysqli_query($connect, $sql_data);
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
