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
require_once "include/tdate.php";
require_once "include/connectdb.php";

						  $sql="select * from useradmin where useradmin='$useradmin'";
						  $db_query=mysqli_query($connect, $sql);					
						  $result=mysqli_fetch_array($db_query);
						  $id=$result["id"];
						  $adminname=$result["name"];
						  $user_admin=$result["useradmin"];
						  $pass_admin=$result["passadmin"];



?>
<!--refresh หน้าเพจ-->
<SCRIPT language="JavaScript">
function timerefresh(t)
{

if(t==0)
{
window.location.reload();
}
else
{
t--;
}
window.setTimeout("timerefresh('"+t+"')",1000)
}

timerefresh(60);
</script>
<!--refresh หน้าเพจ-->



<!--ปุ่ม-->
<style>
.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #f4511e;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 28px;
  padding: 20px;
  width: 200px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}
</style>
<!--จบ ส่วน ปุ่ม-->


<html>

		<head>
			<title><?php echo "$headtxt_web"; ?></title>
			<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
			<link href="" rel="" type="">
		</head>
<body>

		<!-- ส่วนหัว -->
		<TABLE width="90%" border="0" align="center" cellpadding="1" cellspacing="1">
		  
			<tr valign="center"> 
			
			
				<td width="60%">
			
						<?php echo "<font size=2 color=#000080>$headtxt | </font><font size=2 color=#666666>$e_date $etime</font>"; ?>
		
						<br>
		
						<div align="left">
			
							<font color="#000000" size="2">Presently Page :</font><font size="2"> 
				
							<font color="#333333"><strong>MAIN PAGE</strong></font>

						</div>
			
				</td>
				
				
				<!--
				<td width="40%" valign="center" >
				<div >
				<font face="tahoma" color="#000000" size="2"><img src="images/warning.gif" width="" >
				
				ข้อความตรงกลางบนหัวหน้าเว็บ
				
				</font>
				</div>
				</td>
				-->

				<td width="40%">

							<DIV align="right">

								<font color="#000000" size="+1" face="tahoma">
										<img src="../images/icon_emoticon.gif" alt="" width="" height="" border="0" >
										<b>Wellcome</b> : 
								</font>
		
								<font color="#6495ED" size="3" face="tahoma"><b><?php echo "$adminname"; ?></b></font>
								
								<BR>

								<font color="#">[</font> <a href="../ChangePass.php"><font color="#000033"><u>Change password</u></font></a> ] 
								<a href="../logout.php"><font color="#000033"><b><u>Sign Out</u></b></font></a> </font></font>
			
							</DIV>
				</td>
			</tr>
			
			
			<tr>

				<td colspan="2" >

	
				</td>	

			</tr>
		

	
			
		</TABLE>
		<!-- ส่วนหัว จบ-->


		<!-- ส่วนกลาง -->
		<TABLE width="90%" border="0" align="center" cellpadding="1" cellspacing="1">
		  
			<tr valign="center"> 
			
			

                <td align=left width=100%>

                            <br>
			                <br>
			            
                            <font face="tahoma" color="#000033" size="2">
                            <a href="nu_sys\nu_ssds.php" style="text-decoration: none;" >
                                <b>
                                <button class="button" style="vertical-align:middle"><span>Licenses.</span></button>
                                </b>
                            </a>
                            </font>
                        
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            <font face="tahoma" color="#000033" size="2">
                            <a href="XXXXXXXXX.php" style="text-decoration: none;" >
                                <b>
                                <button class="button" style="vertical-align:middle"><span>Empty.</span></button>
                                </b>
                            </a>
                            </font>
                        
                            <br>
                            <br>

			
				</td>
            </tr>
        </TABLE>

</body>
</html>