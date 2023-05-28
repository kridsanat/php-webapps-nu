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
?>
<html>
<head>
<title><?php echo "$headtxt_web"; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<!-- Fireworks MX Dreamweaver MX target.  Created Sat Apr 02 10:29:23 GMT+0700 (SE Asia Standard Time) 2011-->
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#ffffff">
<div align="center"><font color="#990000" size="+1"><strong><font color="#333333" size="2"> 
  </font></strong></font>
  <table width="89%" border="0" align="center" cellpadding="1" cellspacing="1">
  
<tr valign="top"> 
      <td width="57%"><?php echo "<font size=2 color=#000000>$headtxt | </font><font size=2 color=#666666>$e_date $etime</font>"; ?><br>
        <div align="left"><font color="#000000" size="2">Presently Page :</font><font size="2"> 
          <font color="#333333"> 
          <strong>EDIT</strong></font>
		  
		</div></td>
		
		
		
		
     <td width="43%">


	  <div align="right"><font color="#000000" size="2">Wellcome</font>
		<font color="#6495ED" size="3"> 
          <b><?php echo "$adminname"; ?></b> 
		</font>
		<font color="#333333" size="2"></font><font color="#333333" size="2"><br>
          <font color="#">[</font> <a href="../ChangePass.php"><font color="#000033">Change password</font></a> 
          ] <a href="../logout.php"><font color="#000033">Sign Out</font></a> </font></font>
		  
		  </div>
		  
	</td>
		  
		  
	

</tr>
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
$ssdsprice =$result1['ssdsprice'];
$ssdsphoto =$result1['ssdsphoto'];
$status =$result1['status'];
$infono =$result1['infono'];
?>
                                </font> 
                                <table width="1000" height="19" border="0" cellpadding="1" cellspacing="1">
                               
								  <form method="post" action="nu_ssdseditsave.php" enctype="multipart/form-data" name="webFormSearch" onSubmit="return checksearch()">
                                    <tr bgcolor="#FFFFFF"> 
                                      <td> <div align="right"><font size="2">Update Picture
                                          :</font></div></td>
                                      <td>
									  <?php echo "<img src=../pic/$ssdsphoto width=55 height=55 border=1 >"; ?>
									  <br>
									  <a href="nu_ssdseditphoto.php?SerID=<?php echo "$idx"; ?>" >Change Picture</a>
									  
									  
									  </td>
 
                                    </tr>									  
									<tr bgcolor="#FFFFFF"> 
                                      <td> <div align="right"><font size="2">Name
                                          :</font></div></td>
                                      <td><font size="3"> 
                                        <input name="info4" type="text" class="input" id="info4" size="100" value='<?php echo $info4; ?>' maxlength="100">
                                        </font></td>
                                    </tr>
									<tr bgcolor="#FFFFFF"> 
                                      <td width="140"> <div align="right"><font size="2">No. 
                                          :</font></div></td>
                                      <td width="428"><font size="3"> 
                                        <input name="infono" type="text"  id="infono" class="input" value='<?php echo "$infono"; ?>' size="5">
                                        
                                        </font></td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF"> 
                                      <td width="140"> <div align="right"><font size="2">Qty. 
                                          :</font></div></td>
                                      <td width="428"><font size="3"> 
                                        <input name="info1" type="text"  id="info1" class="input" value='<?php echo "$info1"; ?>' size="5">
                                        <input type="hidden" name="idx" value="<?php echo "$idx"; ?>" >
                                        </font></td>
                                    </tr>
									
                                    <tr bgcolor="#FFFFFF"> 
                                      <td width="160"> <div align="right"><font size="2">Unit Price 
                                          :</font></div></td>
                                      <td width="501"><font size="3"> 
                                        <input name="ssdsprice" type="text" id="ssdsprice" class="input" size="5" value='<?php echo "$ssdsprice"; ?>'>
                                        </font></td>
                                    </tr>   									
									 <tr bgcolor="#FFFFFF"> 
                                      <td> <div align="right"><font size="2">Exp.
                                          :</font></div></td>
                                      <td><font size="3"> 
                                        <input name="info5" type="text" class="input" id="info5" value='<?php echo $info5; ?>' size="50">
                                        </font></td>
                                    </tr>
								  
									<tr bgcolor="#FFFFFF"> 
                                      <td> <div align="right"><font size="2">Remark
                                          :</font></div></td>
                                      <td><font size="3"> 
                                        
										<textarea name="info6" type="text" id="" id="info6"  cols="80" rows="10"><?php echo $info6; ?></textarea>
                                        </font></td>
                                    </tr>									
									
                                    <tr bgcolor="#FFFFFF"> 
                                      <td> <div align="right"><font size="2">User
                                          :</font></div></td>
                                      <td><font size="3"> 
                                        
										<input name="info2" type="text" class="input" id="info2" size="40" value="<?php echo "$adminname"; ?>" readonly> *Cannot edit!
                                        </font></td>
                                    </tr>
                                    
									
                                   
									

								

																
									<tr bgcolor="#FFFFFF"> 
                                      <td> <div align="right"><font size="2">Update on
                                          :</font></div></td>
                                      <td><font size="3"> 
                                        <input name="info3" type="text" class="input" id="info3" size="15" value='<?php echo $e_date; ?> <?php echo $etime; ?>' maxlength="100" readonly >*Cannot edit !
                                        </font></td>
                                    </tr>
	
                                    <tr bgcolor="#FFFFFF"> 
                                      <td> <div align="right"><font size="2">Status 
                                          :</font></div></td>
                                      <td> 
                                        <?php
					  if ($status == "Active")
					  {
					  echo "
						<select name=status class=input id=sstatus>
                          
                          <option value=Active  selected>Active</option>
                          <option value=Deactive>Inactive</option>
                        </select>";
						}else if ($status == "Deactive")
					  {
					  echo "
						<select name=status class=input id=sstatus>
                          
                          <option value=Active>Active</option>
                          <option value=Deactive  selected>Inactive</option>
                        </select>";
						}
						?>
                                      </td>
                                    </tr>
	
									
									<tr bgcolor="#FFFFFF"> 
                                      <td>&nbsp;</td>
                                      <td> &nbsp;</td>
                                    </tr>

									
									<tr bgcolor="#FFFFFF"> 
                                      <td>&nbsp;</td>
                                      <td> <input name="submit" type="submit" class="submit" value="Submit" onClick="return confirm ('Sure ? ') ">
									  
									  &nbsp;&nbsp;&nbsp;&nbsp;<a href="nu_ssds.php"><font face="tahoma" color="#000033" size="2">Cancel</font></a>
									  </td>
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
          <?php echo "<font size=2 color=#666666>$buttomtxt</font>"; ?> </div></td>
    </tr>
  </table>
  
</div>
</body>
</html>
