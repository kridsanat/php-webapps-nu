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

if($_FILES["ssdsphoto"]["name"] != "")
{
$name=$_FILES['ssdsphoto']['name'];
$tmp=$_FILES['ssdsphoto']["tmp_name"];
$date_time=date("Y-m-d H:i:s");
$oldname=explode(".",$name);
$ext = "";
$ext = ".".$oldname[count($oldname)-1];
$photo_3 =date('YmdHsi').$ext;
copy($tmp,"../pic/".$photo_3);
}else{
$photo_3 = "";
}



$insert="INSERT INTO nu_ssds 
(
info1, info2, info3, info4, info5, info6, ssdsprice, ssdsphoto, status, infono
) values ( 
'$_POST[info1]',
'$_POST[info2]',
'$_POST[info3]',
'$_POST[info4]',
'$_POST[info5]',
'$_POST[info6]',
'$_POST[ssdsprice]',
'$photo_3',
'$_POST[status]',
'$_POST[infono]')";

$result = mysqli_query($connect, $insert);
if (!$result) {
    die("Cannot Add Database: " . mysqli_error($connect));
}

?>
<html>
<head>
<title><?PHP echo "$headtxt_web"; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">

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
