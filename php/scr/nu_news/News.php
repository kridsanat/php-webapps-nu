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
			<title><?php echo "$headtxt_web"; ?></title>
			<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
      <meta http-equiv="refresh" content="900;url=../logout.php" />
			<link href="" rel="" type="">
		</head>
<body bgcolor="#ffffff">
<div align="center"><font color="#990000" size="+1"><strong><font color="#333333" size="2"> 
  </font></strong></font>
  <table width="89%" border="0" align="center" cellpadding="1" cellspacing="1">
        <tr valign="top"> 
      <td width="57%"><? echo "<font size=2 color=#000000>$headtxt | </font><font size=2 color=#666666>$e_date $etime</font>"; ?><br>
        <div align="left"><font color="#000000" size="2">Presently Page :</font><font size="2"> 
          <font color="#333333"> 
          <strong>Add</strong></font>
		  
		</div></td>
		
		
		
		
     <td width="43%">


	  <div align="right"><font color="#000000" size="2">Wellcome</font>
		<font color="#6495ED" size="3"> 
          <b><? echo "$adminname"; ?></b> 
		</font>
		<font color="#333333" size="2"></font><font color="#333333" size="2"><br>
          <font color="#">[</font> <a href="ChangePass.php"><font color="#000033">Change password</font></a> 
          ] <a href="logout.php"><font color="#000033">Sign Out</font></a> </font></font>
		  
		  </div>
		  
	</td>
		  
		  
	

    </tr>
    <tr> 
      <td colspan="2"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#E9E9E6">
          <tr> 
            <td><div align="center"> 
                <table width="100%" border="1" cellspacing="1" cellpadding="1">
                  <tr> 
                    <td><div align="center"><br>
                        <table width="100%" border="0" cellspacing="1" cellpadding="1">
                          <tr> 
                            <td height="341"><div align="center"> 
                                <script language="JavaScript">
function checksearch()
{
      var news1 = document.webFormSearch.topic.value;
	  var news2 = document.webFormSearch.message.value;

  if( news1.length ==0)
           {
           alert("��س������Ǣ�͢��Ǵ��¤��");
           document.webFormSearch.topic.focus();           
           return false;
           }else if( news2.length ==0)
           {
           alert("��س������������´���Ǵ��¤��");
           document.webFormSearch.message.focus();           
           return false;
           }
         else
           return true;
}
</script>
                                <table width="700" border="0" align="center" cellpadding="1" cellspacing="1">
                                  <form method="post" action="NewsSave.php" enctype="multipart/form-data" name="webFormSearch" onSubmit="return checksearch()">
                                    <tr bgcolor="#FFFFFF"> 
                                      <td width="85" valign="top"> <div align="right"><font size="2">Titel:</div></td>
                                      <td><font size="3"> 
                                        <input name="topic" type="text" class="input" id="topic" size="120" value="Nutrition Profess | ">
                                        </font></td>
                                      
                                    </tr>
									<tr>
										<td align="right">
										<font size="3"> Picture:</font>
                                                
										</td>
										<td>
										<input name="newphoto" type="file" class="input" id="newphoto" size="40">
										</td>
									</tr>
                                    <tr bgcolor="#FFFFFF"> 
                                      <td rowspan="2" valign="top"> <div align="right"><font size="2">Detail:</font></div></td>
                                      <td width="469" rowspan="2"><font size="3"> 
<textarea name="message" cols="180" rows="30" class="input" id="message">
<div align="left">
<font color="#000000" face="tahoma" size="3">
<a href="." target="_blank" ></a>




</font>
</div>
</textarea>
                                      </font>
									  <br><br>
									  Update on :<input name="update" type="text" class="input" id="update" size="12" value='<? echo $e_date; ?>' maxlength="100" readonly> *Cannot edit !

									  
									  
									  </td>
                                    </tr>
									
									
                                    <tr bgcolor="#FFFFFF">
                                      <td width="29" class="input">
									  

									  
									  <p><br>
                                      </p>                                      </td>
                                      
                                    </tr>
                                    
                                    <tr bgcolor="#FFFFFF"> 
                                      <td valign="top">&nbsp;</td>
                                      <td><font size="3"> 
                                        <input name="submit" type="submit" class="submit" value="Submit" onClick="return confirm ('Sure ? ') ">
                                        </font></td>
                                      
                                    </tr>
                                  </form>
                                </table>
                              </div></td>
                          </tr>
                          <tr> 
                            <td></td>
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
