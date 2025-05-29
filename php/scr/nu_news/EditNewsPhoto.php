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

$sql = "SELECT * FROM useradmin WHERE useradmin='$useradmin'";
$db_query = mysqli_query($connect, $sql);					
$result = mysqli_fetch_array($db_query);
$adminname = $result["name"];

$newsID = intval($_GET['NewsID']);
$sql_1 = "SELECT * FROM news WHERE id = '$newsID'";
$db_query = mysqli_query($connect, $sql_1);
$result1 = mysqli_fetch_array($db_query);

$idxx     = $result1['id'];
$topic    = $result1['topic'];
$newphoto = $result1['newphoto'];
$message  = $result1['message'];
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>เปลี่ยนรูปภาพข่าว</title>
    <meta http-equiv="refresh" content="900;url=../logout.php" />
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#ffffff">
<div align="center">
  <table width="800" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
      <td colspan="2" align="center">
        <h3>🖼️ เปลี่ยนเฉพาะรูปภาพข่าว</h3>
        <a href="newmain.php"><font face="tahoma" size="2" color="#0099CC">⬅ กลับหน้าหลัก</font></a>
        <br><br>
        <form method="post" action="EditNewsPhotoSave.php" enctype="multipart/form-data">
          <table border="0" cellpadding="5" cellspacing="0">
            <tr>
              <td align="right"><b>รูปเดิม:</b></td>
              <td>
                <?php
                  if (!empty($newphoto)) {
                      echo "<img src='NEW/$newphoto' width='120' border='1'><br><br>";
                  } else {
                      echo "<i>ไม่มีรูปเดิม</i><br><br>";
                  }
                ?>
              </td>
            </tr>
            <tr>
              <td align="right"><b>เลือกรูปใหม่:</b></td>
              <td><input type="file" name="newphoto" class="input" id="newphoto" size="40"></td>
            </tr>
            <tr>
              <td colspan="2" align="center">
                <br>
                <input type="hidden" name="idx" value="<?php echo $idxx; ?>">
                <input type="submit" name="submit" value="เปลี่ยนรูปภาพ" onclick="return confirm('ยืนยันการเปลี่ยนรูปภาพ?')">
                &nbsp;&nbsp;
                <a href="newmain.php"><font face="tahoma">ยกเลิก</font></a>
              </td>
            </tr>
          </table>
        </form>
        <br><font color="red">* หน้านี้สำหรับเปลี่ยนเฉพาะรูปภาพเท่านั้น ข้อความจะไม่ถูกเปลี่ยน</font>
      </td>
    </tr>
  </table>
</div>
</body>
</html>
