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
						  
						  
@unlink("../pic/$_GET[ssdsphoto]");
$sql_del = "delete from nu_ssds where id = '$_GET[SerID]'";
$db_query=mysqli_query($connect,$sql_del);
?>
<html>
<head>
<title><? echo "$headtxt_web"; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<!-- Fireworks MX Dreamweaver MX target.  Created Sat Apr 02 10:29:23 GMT+0700 (SE Asia Standard Time) 2011-->
<link href="css/style.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="3;URL=nu_ssds.php">
</head>
<body bgcolor="#ffffff">
<div align="center"> 

            <table width="100%" border="0" cellspacing="1" cellpadding="1">
                <tr> 
                    <td>
						<div align="center">
						
						<br>
                        <br>
                        <br>
                        <br>
         <font color="#003366" size="2">Complated</font>
						<br> 
		 <font size="2">Plese Wait...</font>
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
