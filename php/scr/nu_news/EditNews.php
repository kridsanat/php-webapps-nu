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
?>
<html>
<head>
<?php echo "$fav"; ?>
<title><? echo "$headtxt"; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">


<!-- Fireworks MX Dreamweaver MX target.  Created Sat Apr 02 10:29:23 GMT+0700 (SE Asia Standard Time) 2011-->
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#ffffff">
<div align="center"><font color="#990000" size="+1"><strong><font color="#333333" size="2"> 
  </font></strong></font>
  <table width="89%" border="0" align="center" cellpadding="1" cellspacing="1">
  

    <tr> 
      <td colspan="2"><table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#E9E9E6">
          <tr> 
            <td><div align="center"> 
                <table width="100%" border="0" cellspacing="1" cellpadding="1">
                  <tr> 
                    <td><div align="center"><br>
                        <table width="100%" border="0" cellspacing="1" cellpadding="1">
                          <tr> 
                            <td><div align="center"> <font color="#003366" size="2"> 
                                <?php
						  $sql_1="select * from news where id = '$_GET[NewsID]'";
						  $db_query=mysqli_query($connect,$sql_1);
						  $result1=mysqli_fetch_array($db_query);
						  $idxx  =$result1['id'];
						  $topic  =$result1['topic'];
						  $newphoto  =$result1['newphoto'];
						  $message  =$result1['message'];
						?>
                                </font> 
                                <table width="636" border="0" align="center" cellpadding="1" cellspacing="1">
                                  <form method="post" action="EditNewsSave.php" enctype="multipart/form-data">
                                    <tr bgcolor="#FFFFFF"> 
                                      <td width="151" valign="top"> <div align="right"><font size="2">Titel 
                                          :</font></div></td>
                                      <td width="558"><font size="3"> 
                                        <input name="topic" type="text" class="input" id="topic" size="120" value='<? echo $topic; ?>'>
                                        <input type="hidden" name="idx" value=<? echo "$idxx"; ?>>
                                        </font></td>
                                    </tr>
									<tr>
										<td align="right">
										<font size="3"> Picture:</font>
                                                
										</td>
										<td>
										<br>

                <?php 
							  if ($newphoto >= 100){
							  echo "<img src=NEW/$newphoto width=55 height=55 border=1 >
							  
							  ";
							  }
								else{
								echo "";	
								}
							  ?>
										<br>
										
										<a href="EditNewsPhoto.php?NewsID=<? echo "$idxx"; ?>">Change Picture</a>
										<br>
										<br>
										</td>
									</tr>
                                    <tr bgcolor="#FFFFFF"> 
                                      <td valign="top"> <div align="right"><font size="2">Detail:</font></div></td>
                                      <td><font size="3"> 
                                        <textarea name="message" cols="180" rows="30" class="input" id="message"><? echo "$message"; ?></textarea>
                                        </font>
										<br><br>
									  Update on :<input name="update" type="text" class="input" id="update" size="12" value='<? echo $e_date; ?>' maxlength="100" readonly> *Cannot edit !
										<br><br>
										</td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF"> 
                                      <td valign="top">&nbsp;</td>
                                      <td><font size="3">
                                        <input name="submit" type="submit" class="submit" value="Submit" onClick="return confirm ('Sure ? ') ">
										&nbsp;&nbsp;&nbsp;&nbsp;<a href="newmain.php"><font face="tahoma" >Cancel</font></a>
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
          <? echo "<font size=2 color=#666666>$buttomtxt</font>"; ?> </div></td>
    </tr>
  </table>
  
</div>
</body>
</html>
