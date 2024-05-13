<?php
@session_start();
ob_start();

$useradmin = $_SESSION["useradmin"];
if(empty($useradmin)) {
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

if($result && $result->num_rows > 0) {
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

$postmessage = str_replace("\n", "", $_POST['message']);
$sql_data = "UPDATE news SET topic=?, message=?, dateregist=? WHERE id=?";
$stmt = mysqli_prepare($connect, $sql_data);
mysqli_stmt_bind_param($stmt, "sssi", $_POST['topic'], $postmessage, "$e_date $etime", $_POST['idx']);
$result = mysqli_stmt_execute($stmt);

if(!$result) {
    die("Cannot Update Database: " . mysqli_error($connect)); // Display SQL error
}
?>
