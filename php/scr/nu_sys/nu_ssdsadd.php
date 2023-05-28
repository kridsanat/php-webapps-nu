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
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#ffffff">
<div align="center"><font color="#990000" size="+1"><strong><font color="#333333" size="2"> 
  </font></strong></font>
  <table width="89%" border="0" align="center" cellpadding="1" cellspacing="1">
  
<tr valign="top"> 
      <td width="57%"><?php echo "<font size=2 color=#000000>$headtxt | </font><font size=2 color=#666666>$e_date $etime</font>"; ?><br>
        <div align="left"><font color="#000000" size="2">Presently Page :</font><font size="2"> 
          <font color="#333333"> 
          <strong></strong></font>
		  
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
                            <td><div align="center"> 
                                <script language="JavaScript">
function checkprd()
{
    var prd1 = document.webFormprd.accname.value;
	  var prd2 = document.webFormprd.bankname.value;
	  var prd3 = document.webFormprd.accno.value;
	  var prd4 = document.webFormprd.branch.value;

  if( prd1.length ==0)
           {
           alert("กรุณาใส่ชื่อบัญชีด้วยค่ะ");
           document.webFormprd.accname.focus();           
           return false;
           }else   if( prd2.length ==0)
           {
           alert("กรุณาใส่ชื่อธนาคารด้วยค่ะ");
           document.webFormprd.bankname.focus();           
           return false;
           }else   if( prd3.length ==0)
           {
           alert("กรุณาใส่เลขที่บัญชีด้วยค่ะ");
           document.webFormprd.accno.focus();           
           return false;
           }else   if( prd4.length ==0)
           {
           alert("กรุณาใส่ชื่อสาขาด้วยค่ะ");
           document.webFormprd.branch.focus();           
           return false;
           }
         else
           return true;
}
</script>
                                <table width="1000" height="19" border="0" cellpadding="1" cellspacing="1">
                                  
								  <form method="post" action="nu_ssdssave.php" enctype="multipart/form-data" name="webFormSearch" onSubmit="return checksearch()">
								  
                                    <tr bgcolor="#FFFFFF"> 
                                      <td align="center" ><font size="2" color="#333333"><strong> 
                                        </strong></font></td>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF"> 
                                      <td> <div align="right"><font size="2">xxxxx
                                          :</font></div></td>
                                      <td><font size="3"> 
									  
                                        <input name="ssdsphoto" type="file" class="input" id="ssdsphoto" size="40">
										
                                        </font></td>
                                    </tr>									
									<tr bgcolor="#FFFFFF"> 
                                      <td> <div align="right"><font size="2">Name 
                                          :</font></div></td>
                                      <td><font size="3"> 
                                        <input name="info4" type="text" class="input" id="info4" size="100" maxlength="100">
                                        </font></td>
                                    </tr>
									<tr bgcolor="#FFFFFF"> 
                                      <td> <div align="right"><font size="2">No.
                                          :</font></div></td>
                                      <td><font size="3"> 
                                        <input name="infono" type="text" class="input" id="infono" size="5" >
                                        </font></td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF"> 
                                      <td width="160"> <div align="right"><font size="2">Qty.
                                          :</font></div></td>
                                      <td width="501"><font size="3"> 
                                        <input name="info1" type="text" id="info1" class="input" size="5">
                                        </font></td>
                                    </tr>
									
                                    <tr bgcolor="#FFFFFF"> 
                                      <td width="160"> <div align="right"><font size="2">Unit Price  
                                          :</font></div></td>
                                      <td width="501"><font size="3"> 
                                        <input name="ssdsprice" type="text" id="ssdsprice" class="input" size="5">
                                        </font></td>
                                    </tr>                                    
																		
									<tr bgcolor="#FFFFFF"> 
                                      <td> <div align="right"><font size="2">Exp. 
                                          :</font></div></td>
                                      <td><font size="3"> 
                                        <input name="info5" type="text" class="input" id="info5" size="50" maxlength="100">
                                        </font></td>
                                    </tr>

									<tr bgcolor="#FFFFFF"> 
                                      <td> <div align="right"><font size="2">Remark
                                          :</font></div></td>
                                      <td><font size="3"> 
                                        <textarea name="info6" type="text" id="" id="info6"  cols="80" rows="10"></textarea>
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
                                        <input name="info3" type="text" class="input" id="info3" size="15" value='<?php echo $e_date; ?> <?php echo $etime; ?>' maxlength="100" readonly> *Cannot edit!
										
                                        </font></td>
                                    </tr>
									
									
									


									
                              
									
                                    <tr bgcolor="#FFFFFF"> 
                                      <td> <div align="right"><font size="2">Status 
                                          :</font></div></td>
                                      <td> <select name="status" class="input" id="status">
                                         
                                          <option value="Active">Active</option>
                                          <option value="Deactive">Inactive</option>
                                        </select></td>
                                    </tr>
                                    <tr bgcolor="#FFFFFF"> 
                                      <td>&nbsp;</td>
                                      <td> <input name="submit" type="submit" class="submit" value="Add"  onClick="return confirm ('Sure ? ') ">
									  &nbsp;&nbsp;&nbsp;&nbsp;<a href="nu_ssds.php"><font face="tahoma" >Cancel</font></a>
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
