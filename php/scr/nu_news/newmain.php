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





<html>

		<head>
			<title><?php echo "$headtxt_web"; ?></title>
			<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
			<meta http-equiv="refresh" content="900;url=../logout.php" />
			<link href="" rel="" type="">
		</head>

<body bgcolor="#ffffff">

		<!-- ส่วนหัว -->
		<TABLE width="90%" border="0" align="center" cellpadding="1" cellspacing="1">
		  
			<tr valign="center"> 
			
			
				<td width="40%">
			
						<?php echo "<font size=4 color=#000080>$headtxt | $e_date $etime</font>"; ?>
		
						<br>
		
						<div align="left">
			
						<font color="#000000" size="4">Presently Page : <strong>MAIN PAGE</strong></font>

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

				<td width="60%">

							<DIV align="right">

								<font color="#000000" size="6" face="tahoma">
										
										<b>WELLCOME</b> : 
								</font>
		
								<font color="#6495ED" size="6" face="tahoma"><b><?php echo "$adminname"; ?></b></font>
								
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
			

<br>
<br>	

<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#E9E9E6">
			<tr>
				<td>
				<a href="../main.php"  style="text-decoration: none;" >
				<font face="tahoma" color="#000033" size="4"><< BACK </font>
				</a>
				<br>
				<br>
				</td>
			</tr>	
</table>
<br>
<br>	

	  <table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#E9E9E6">
          
	  		
	 
	 
	 	 <tr> 
            <td><div align="center"> 
                <table width="100%" border="0" cellspacing="1" cellpadding="1">
                  <tr> 
                    <td><div align="center"><br>
                        <table width="100%" border="0" cellspacing="1" cellpadding="1">
                          <tr> 
                            <td><div align="center"> <font color="#003366" size="2"> 
                                </font>
                                <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                  <tr> 
                                    <td>
									
							


									

									
							
                                      </div>
									  
									  </td>
									  
                                  </tr>
                                  <tr> 
                             <td><table align="center" width="90%" border="0" cellspacing="1" cellpadding="1">
                                        <tr> 
                                          <td>
										  
<?php
$numproducts ="select * from news";
$query_select=mysqli_query($connect, $numproducts);
$numall=mysqli_num_rows($query_select);
?>
       										  
										  
										  
										  </td>
                                        </tr>
    
                                        <tr>
                                          <td><div align="left"><font size="2" color="#333333">
										  
										

										  
										  <a href="News.php"><font face="tahoma" color="#000033" size="2"><u>add</u><br></font></a>
						
										  
										  
                                        </tr>
                                        <tr>
                                       
                                        </tr>
                                        <tr> 
                                          <td>
                                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
											  
											<br><br> 
											&nbsp;
											<strong>Total:<font color="#FF0000"> <?php echo "$numall"; ?></font> Manual</strong></font></div></td>
										  
										  
										  
										  
                        <tr class="jobscss">
                          <td bgcolor="#FFFFFF">
						  
						  <br>
						  
						  
<?php
$page = isset($_GET['page']) ? $_GET['page'] : '';

$select_type="select * from news order by id DESC ";
$query_select=mysqli_query($connect,$select_type);
$num_rows=mysqli_num_rows($query_select);

if($num_rows<1){
echo "<br><br><center><font color=#666666 face=tahoma size=2><b>�ѧ����ա�����������Ť�Ѻ</b></font></center>";
}else{
		$select="select * from news  order by id DESC ";
		$q_ry = mysqli_query($connect,$select);
	 	$num_rows=mysqli_num_rows($q_ry);
  		$pagesize=10000;
		$rt=$num_rows%$pagesize;
		if($rt!=0)
			{
				$totalpage=floor($num_rows/$pagesize)+1;
			}
		else
			{
				$totalpage=floor($num_rows/$pagesize);
				$toppic_id=1;
			}
		if(empty($page))
			{
				$page=1;
			}
		mysqli_free_result($q_ry);
		$goto=($page-1)*$pagesize;
$sql_select_mem="Select * From news  order by id DESC limit $goto,$pagesize";
		$fect=mysqli_query($connect,$sql_select_mem);
		if(!$fect)
		{
		("�Դ��Ͱҹ�����������".mysqli_error());
		exit;
		}

	  $bgcount=0;
	while($rows=mysqli_fetch_array($fect))
	{
$idxxx =$rows['id'];
$topic  =$rows['topic'];
$message = $rows['message'];
$dateregist=$rows['dateregist'];
$bgcount=$bgcount+1;
$bgmod=$bgcount%2;
if($bgmod==0){
	$bgcolor="#E9E9E8";
}else{
	$bgcolor="#FFFFFF";
}
	?>
	
	
                              <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                <tr>
                                  <td width="85%" height="">
                                    
                                    <div align="left">
									

									<a href="ShowNews-user.php?NewsID=<?php echo "$idxxx"; ?>" style="text-decoration:none" >
									<img src="../images/Detail.gif" width="" >
									</a>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="ShowNews.php?NewsID=<?php echo "$idxxx"; ?>" style="text-decoration:none" >

									<img src="../images/DsM_explorer.gif" width="" >
									&nbsp;&nbsp;<font color="#" face="tahoma" size="2"><u><?php echo "$topic"; ?></u></font>
									</a>
									
									</div>
									
									</td>
									
									<td width="15%" align="left">
									<font color="#" face="tahoma" size="2"><b>Update: </b><?php echo "$dateregist"; ?></font>
									</td>
								
								</tr>
								<tr> 
                                     <td colspan="2"><hr width="100%"></td>
                                </tr>
                              </table>
                            <?php
}
}
?>                          </td>
                        </tr>
                        <tr class="jobscss">
                          <td bgcolor="#FFFFFF">&nbsp;</td>
                        </tr>
                        <tr>
                          <td>
                          
                          
                            <div align="left"><strong><span class="maekhawtom"><font color="#990000" size="2">Page 
                              :</font></span></strong> <font color="#999999" size="2"><span class="maekhawtom">
    <?php 
	for($i=1;$i<$page;$i++)
	{
	echo"[<a href='$PHP_SELF?page=$i'><font size=2 color='#000000'>$i</font></a>]";
	}
	echo"[<font size=2 color=#000000><b><font size=2 color='#FF00000'>$page</font></b></font>]";
	for($i=$page+1;$i<=$totalpage;$i++)
	{
	echo"[<a href='$PHP_SELF?page=$i'><font size=2 color='#000000'>$i</font></a>]";
	}
	?>
                              </span></font><font color="#FFFFFF" size="2"><span class="maekhawtom"> </span></font></div>
							  
							  <br><br><br><br>
							  </td>
                        </tr>
                      </table>
                                            </div></td>
                                        </tr>
                                    </table></td>
                                  </tr>
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
