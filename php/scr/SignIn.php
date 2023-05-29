<?php
require_once "include/connectdb.php";
$admin_pass = md5($_POST["passadmin"]);
		//$sql = "SELECT * FROM useradmin WHERE useradmin='".$_POST[useradmin]."' and passadmin='".$_POST[passadmin]."'";
		$sql = "select * from useradmin where useradmin = '$_POST[useradmin]' and passadmin = '$admin_pass'";
		$dbquery = mysqli_query($connect, $sql); 
		$num_rows = mysqli_num_rows($dbquery);
		$rowLogin = mysqli_fetch_array($dbquery);

if ($num_rows == 1) {
    session_start();
    $_SESSION['useradmin'] = $rowLogin['useradmin'];
    echo "<meta http-equiv='refresh' content='0;URL=main.php'>";
} else {
    echo "<meta http-equiv='Content-Type' content='text/html; charset=tis-620' />";
    echo "<script language='javascript'>alert('Username or password is not correct');</script>";
    echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
    exit();
}
	
?>
