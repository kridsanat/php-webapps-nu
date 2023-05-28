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
?>
<html>
<head>
<title><?php echo "$headtxt"; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<!-- Fireworks MX Dreamweaver MX target.  Created Sat Apr 02 10:29:23 GMT+0700 (SE Asia Standard Time) 2011-->
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#ffffff">



<div align="center"><font color="#990000" size="+1"><strong><font color="#333333" size="2"></font></strong></font>
  <br><br>
  
  <table width="30%" border="0" align="left" cellpadding="1" cellspacing="1">

    <tr> 
      <td colspan="2"><table width="" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#E9E9E6">
          <tr> 
            <td><div align="center"> 
				
                <table width="" border="0" cellspacing="1" cellpadding="1">
                  <tr> 
                    <td><div align="center"><br>
                        <table width="" border="0" cellspacing="1" cellpadding="1">
                          <tr> 
                            <td><div align="center"><font color="#003366" size="2">
                        <?php
						  $sql_1="select * from useradmin where useradmin = '$useradmin'";
						  $db_query=mysqli_query($connect,$sql_1);
						  $result1=mysqli_fetch_array($db_query);
						  $idx=$result1["id"];
						  $pass1=$result1["passadmin"];
						?>
                                </font> 
                                <table width="" border="0" align="center" cellpadding="1" cellspacing="1">
                                  <form method="post" action="ChangePassSave.php">
                                    <tr> 
                                      <td width="117"><div align="right"><font color="#666666" size="2">Old Password 
                                           :</font></div></td>
                                      <td width=""><font color="#666666" size="2"><?php echo "$pass1"; ?></font></td>
                                    </tr>
                                    <tr> 
                                      <td><div align="right"><font color="#666666" size="2">New Password
                                          : </font></div></td>
                                      <td><font color="#666666" size="2"> 
                                        <input name=newpass type=password class="input" id=newpass size=18>
                                        <input type="hidden" name=idx id=idx value=<?php echo "$idx"; ?>>
                                        </font></td>
                                    </tr>
                                    <tr> 
                                      <td><font color="#990000" size="3">&nbsp;</font></td>
                                      <td><font color="#666666" size="3"> 
                                        <input name="submit" type=submit value=Submit class="submit" onClick="return confirm ('Sure ? ') ">
                                        </font></td>
                                    </tr>
                                  </form>
                                </table>
                              </div></td>
                          </tr>
                        </table>
                        <br>
                        <br>
                      </div></td>
                  </tr>
                </table>
              </div></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td colspan="2"><div align="center"><br>
          <?PHP echo "<font size=2 color=#666666>$buttomtxt</font>"; ?> </div></td>
    </tr>
  </table>
  
</div>
</body>
</html>
