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

$sql = "SELECT * FROM useradmin WHERE useradmin=?";
$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, "s", $useradmin);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && $result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $id = $row["id"];
    $adminname = $row["name"];
    $user_admin = $row["useradmin"];
    $pass_admin = $row["passadmin"];
} else {
    echo "<script>alert('Invalid User');</script>";
    header("Location: ../index.php");
    exit();
}

$photo_1 = "";
if (isset($_FILES["newphoto"]["name"]) && $_FILES["newphoto"]["name"] != "") {
    $name = $_FILES['newphoto']['name'];
    $tmp = $_FILES['newphoto']['tmp_name'];
    $date_time = date("Y-m-d H:i:s");
    $oldname = explode(".", $name);
    $ext = "." . end($oldname);
    $photo_1 = date('YmdHis') . $ext;
    move_uploaded_file($tmp, "NEW/" . $photo_1);
}

$postmessage = str_replace("\n", "<br>", $_POST['message']);

$sql = "INSERT INTO news (topic, newphoto, message, dateregist) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, "ssss", $topic, $newphoto, $message, $datetime);

// Escape special characters in the input data
$topic = mysqli_real_escape_string($connect, $_POST['topic']);
$newphoto = mysqli_real_escape_string($connect, $photo_1);
$message = mysqli_real_escape_string($connect, $postmessage);
$datetime = mysqli_real_escape_string($connect, "$e_date $etime");

$result = mysqli_stmt_execute($stmt);

if (!$result) {
    die("Cannot Add Database: " . mysqli_error($connect));
}
?>

<html>
<head>
    <title><?php echo htmlspecialchars($headtxt); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=tis-620">

    <!-- Remove one of the meta refresh tags if not necessary -->
    <meta http-equiv="refresh" content="900;url=../logout.php">

    <link href="css/style.css" rel="stylesheet" type="text/css">
    <meta http-equiv="refresh" content="3;URL=newmain.php">
</head>
<body bgcolor="#ffffff">
<div align="center">
    <table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr>
            <td>
                <div align="center">
                    <br>
                    <br>
                    <img src="../images/ajax-loader.gif" width="" height="">
                    <br>
                    <br>
                    <font color="#003366" size="2">Completed</font>
                    <br>
                    <br>
                    <font size="2">Please Wait...</font>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
