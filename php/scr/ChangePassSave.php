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
require_once "include/tdate.php";
require_once "include/connectdb.php";

						  $sql="select * from useradmin where useradmin='$useradmin'";
						  $db_query=mysqli_query($connect,$sql);
						  $result=mysqli_fetch_array($db_query);
						  $id=$result[id];
						  $adminname=$result["name"];
						  $user_admin=$result["useradmin"];
						  $pass_admin=$result["passadmin"];
						  
$newpass_md5 = md5("$_POST[newpass]");
$sql_pass = "update useradmin set passadmin ='$newpass_md5' where id = '$_POST[idx]'";
mysqli_query($connect,$sql_pass);
?>
<html>
<head>
<title><?PHP echo "$headtxt"; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<!-- Fireworks MX Dreamweaver MX target.  Created Sat Apr 02 10:29:23 GMT+0700 (SE Asia Standard Time) 2011-->
<link href="../css/style.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="3;URL=logout.php">
</head>
<body bgcolor="#ffffff">
<div align="center"><font color="#990000" size="+1"><strong><font color="#333333" size="2"> 
  </font></strong></font>
  <table width="89%" border="0" align="center" cellpadding="1" cellspacing="1">

    <tr> 
      <td colspan="2"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#E9E9E6">
          <tr> 
            <td><div align="center"> 
                <table width="100%" border="0" cellspacing="1" cellpadding="1">
                  <tr> 
                    <td><div align="center"><br>
                        <br>
                        <br>
                        <br>
         <font color="#003366" size="2">Chaned the password complated</font><font size="2"><br>
                        System will be Logout for you can re-sign<br>
                        Wait... </font><font size="2"><br>
                        </font><br>
                        <br>
                        <br>
                        <br>
                      </div></td>
                  </tr>
                </table>
              </div></td>
          </tr>
        </table></td>
    </tr>

  </table>
  
</div>
</body>
</html>
