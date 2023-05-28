<?PHP
@session_start();
ob_start();
$useradmin = $_SESSION["useradmin"];
if(empty($useradmin)) 
{
echo "<script>alert('Only Administrator');</script>";
header("Location: index.php");
exit();
}
require_once "../include/tdate.php";
require_once "../include/connectdb.php";

						  $sql="select * from useradmin where useradmin='$useradmin'";
						  $db_query=mysqli_query($connect,$sql);
						  $result=mysqli_fetch_array($db_query);
						  $id=$result['id'];
						  $adminname=$result["name"];
						  $user_admin=$result["useradmin"];
						  $pass_admin=$result["passadmin"];



$sql_data = "update nu_ssds set info1='$_POST[info1]',info2='$_POST[info2]',info3='$_POST[info3]',info4 = '$_POST[info4]',info5='$_POST[info5]',info6='$_POST[info6]',ssdsprice='$_POST[ssdsprice]',status='$_POST[status]',infono='$_POST[infono]' where id = '$_POST[idx]'";
mysqli_query($connect,$sql_data);

?>



<html>
<head>
<title><?php echo "$headtxt_web"; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<!-- Fireworks MX Dreamweaver MX target.  Created Sat Apr 02 10:29:23 GMT+0700 (SE Asia Standard Time) 2011-->
<link href="css/style.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="3;URL=nu_ssds.php">
</head>
<body bgcolor="#ffffff">

<?php
$sql_1="select * from nu_ssds where id = '$_GET[SerID]'";
$db_query=mysqli_query($connect,$sql_1);
$result1=mysqli_fetch_array($db_query);
$idx =$result1['id'];
$info1 =$result1['info1'];
$info2 =$result1['info2'];
$info3 =$result1['info3'];
$info4 =$result1['info4'];
$info5 =$result1['info5'];
$info6 =$result1['info6'];
$status =$result1['status'];
?>

<?php echo "$info1"; ?>
<?php echo "$info2"; ?>
<?php echo "$info3"; ?>
<?php echo "$info4"; ?>
<?php echo "$info5"; ?>
<?php echo "$info6"; ?>
<?php echo "$ststus"; ?>

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
         <font color="#003366" size="2">Complated ~</font>
						<br> 
		 <font size="2">Wait...</font>
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
