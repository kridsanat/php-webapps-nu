<?php
// Start session and output buffering
@session_start();
ob_start();

// Check if user is logged in as administrator
$useradmin = $_SESSION["useradmin"];
if(empty($useradmin)) {
    echo "<script>alert('Only Administrator');</script>";
    header("Location: ../index.php");
    exit();
}

// Include necessary files
require_once "../include/tdate.php";
require_once "../include/connectdb.php";

// Retrieve user information
$sql = "SELECT * FROM useradmin WHERE useradmin=?";
$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, "s", $useradmin);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check if user is valid
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

// Sanitize and validate input
$topic = htmlspecialchars($_POST['topic']);
$message = htmlspecialchars($_POST['message']);
$idx = $_POST['idx'];

// Update database record
$sql_data = "UPDATE news SET topic=?, message=?, dateregist=? WHERE id=?";
$stmt = mysqli_prepare($connect, $sql_data);
mysqli_stmt_bind_param($stmt, "sssi", $topic, $message, "$e_date $etime", $idx);
$result = mysqli_stmt_execute($stmt);

if(!$result) {
    die("Cannot Update Database: " . mysqli_error($connect));
}
?>

<html>
<head>
    <title><?php echo htmlspecialchars($headtxt); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=tis-620">
    <meta http-equiv="refresh" content="900;url=../logout.php" />
    <!-- Add appropriate links to CSS and other resources -->
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
