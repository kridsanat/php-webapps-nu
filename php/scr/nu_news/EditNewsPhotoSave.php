<?php
@session_start();

ob_start();
$useradmin = $_SESSION["useradmin"];
if(empty($useradmin)) 
{
echo "<script>alert('Only Administrator');</script>";
header("Location: ../index.php");
exit();
}
require_once "../include/tdate.php";
require_once "../include/connectdb.php";

						  $sql="select * from useradmin where useradmin='$useradmin'";
						  $db_query=mysqli_query($connect, $sql);					
						  $result=mysqli_fetch_array($db_query);
						  $id=$result["id"];
						  $adminname=$result["name"];
						  $user_admin=$result["useradmin"];
						  $pass_admin=$result["passadmin"];
						  
						  
if($_FILES["newphoto"]["name"] != "")
{
$name=$_FILES['newphoto']['name'];
$tmp=$_FILES['newphoto']["tmp_name"];
$date_time=date("Y-m-d H:i:s");
$oldname=explode(".",$name);
$ext = "";
$ext = ".".$oldname[count($oldname)-1];
$photo_1 =date('YmdHis').$ext;
copy($tmp,"NEW/".$photo_1);
}else{
$photo_1 = "";
}				  
						  
						  
$postmessage = str_replace("\n","",$_POST['message']);
$sql_data = "update news set topic='$_POST[topic]',newphoto='$photo_1',message='$postmessage',dateregist='$e_date $etime' where id = '$_POST[idx]'";
mysqli_query($connect,$sql_data);
?>
<html>
<head>
<title><? echo "$headtxt"; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<!-- Fireworks MX Dreamweaver MX target.  Created Sat Apr 02 10:29:23 GMT+0700 (SE Asia Standard Time) 2011-->
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
        <font color="#003366" size="2">Complated</font>
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
