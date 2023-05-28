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
<STYLE TYPE="TEXT/CSS">
A:link {
text-decoration:none;
}
A:visited {
text-decoration:none;
}
.test{
    height:50px;
    width:200px;
}
</STYLE>
</head>
<body bgcolor="#ffffff">
<div align="center"><font color="#990000" size="+1"><strong><font color="#333333" size="2"> 
  </font></strong></font>
  <table width="89%" border="0" align="center" cellpadding="1" cellspacing="1">


<tr> 
<td colspan="2">


	  
	  
	  
	  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#E9E9E6">
	  
          <tr> 
            <td><div align="center"> 
                <table width="100%" border="0" cellspacing="1" cellpadding="1">
                  <tr> 
                    <td><div align="center"><br>
                        <table width="100%" border="0" cellspacing="1" cellpadding="1">
						<tr>
						<td>
						
		<style type="text/css">
			@media print{
				#hid{
					display: none; /* ��͹  */
				}
			}
		</style>
		
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<button id="hid" onclick="window.print();" class="btn btn-primary"> PRINT </button>
		
		<button id="hid" class="btn btn-default"> <a href="nu_ssds.php">BLACK</a> </button>
		
						</td>
						</tr>
    
                          <tr> 
                            <td><table width="100%" border="0" cellspacing="1" cellpadding="1">
							
                                <tr> 
                                  <td><div align="center"> 
                                      <table width="1000" border="0" cellspacing="0" cellpadding="0">

										
                                        <tr class="jobscss">
                                          <td bgcolor="#FFFFFF">
										  
<?
$numproducts ="select * from nu_ssds";
$query_select=mysqli_query($connect,$numproducts);
$numall=mysqli_num_rows($query_select);
?>									
										
										  &nbsp;</td>
                                        </tr>
                                        
                                        <tr class="jobscss"> 
                                          <td bgcolor="#FFFFFF"> 
										   <table  width="100%" border="0" cellspacing="1" cellpadding="1">
										  <tr >
													<td >
													<img src="../images/DIT-Logo-Original.png" alt="ź������" width="" height="50" border="0" >
													<br>
													<br>
													</td>
												</tr>
											</table>	
											
										   <table  width="100%" border="0" cellspacing="1" cellpadding="1">
												
                                              <tr bgcolor="#191970"> 
												<td width="5%"><div align="ledt"><strong><font face="tahoma" color="#FFFFFF" size="2">&nbsp;&nbsp;No.</font></strong></div></td>
                                                <td width="5%"><div align="ledt"><strong><font face="tahoma" color="#FFFFFF" size="2" >&nbsp;&nbsp;Qty.</font></strong></div></td>
												<td width="65%"><div align="ledt"><strong><font face="tahoma" color="#FFFFFF" size="2">&nbsp;&nbsp;Name</font></strong></div></td>
												<td width="25%"><div align="ledt"><strong><font face="tahoma" color="#FFFFFF" size="2">&nbsp;&nbsp;Update</font></strong></div></td>
												
                                              </tr>
                                            </table>
										  <br>

											
                                            <?php
$page = isset($_GET['page']) ? $_GET['page'] : '';

$select_type="select * from nu_ssds  order by infono asc";
$query_select=mysqli_query($connect,$select_type);
$num_rows=mysqli_num_rows($query_select);

if($num_rows<1){
echo "<br><br><center><font color=#666666 face=tahoma size=2><b>�ѧ����ա�����������Ť��</b></font></center>";
}else{
		$select="select * from nu_ssds  order by infono asc";
		$q_ry = mysqli_query($connect,$select);
	 	$num_rows=mysqli_num_rows($q_ry);
  		$pagesize=100;
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
$sql_select_mem="Select * From nu_ssds  order by infono asc limit $goto,$pagesize";
		$fect=mysqli_query($connect,$sql_select_mem);
		if(!$fect)
		{
		("�Դ��Ͱҹ�����������".mysqli_error());
		exit;
		}

	  $bgcount=0;
	while($rows=mysqli_fetch_array($fect))
	{
$idx =$rows["id"];
$info1 =$rows["info1"];
$info2 =$rows["info2"];
$info3 =$rows["info3"];
$info4 =$rows["info4"];
$info5 =$rows["info5"];
$info6 =$rows["info6"];
$status =$rows["status"];
$infono =$rows["infono"];
$bgcount=$bgcount+1;
$bgmod=$bgcount%2;
if($bgmod==0){
	$bgcolor="#E9E9E8";
}else{
	$bgcolor="#FFFFFF";
}
	?>
	


											
                                            <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                              <tr bgcolor="#AFEEEE"> 
											  
											  
											  
											  
												<td bgcolor="#FFFFFF" width="5%" >
												<font size="2"><?php echo "$infono"; ?></font>
												</td>
												
												
												
												<td width="5%" bgcolor='#FFFFFF' align="right">
												
											
												
						<?php
						
			
			
						if ($info1 == 0)
					  {
					  echo "<font face=tahoma size=2 color=#FF0000><b>Out of stock</b></font>&nbsp;&nbsp;";
						}else if ($info1 < 4)
					  {
					  echo "<b><font face=tahoma size=2 color=#FF4500>$info1</font> &nbsp;&nbsp;</b> ";
						}else
					  {
					  echo "<b><font face=tahoma size=2 color=#>$info1</font> &nbsp;&nbsp;</b>";
						}
						
			
						
						?>			
						
						
						
								
												</td>
											  
												<td bgcolor="#FFFFFF" width="65%">
												
											
												
											
												
												&nbsp;<?php echo "<font face=tahoma size=2 color=#000000 ><B>$info4</B></font>"; ?>
												
												
												<font face="tahoma" size="2" color="blue">
												
												Exp. <?php echo "$info5"; ?>
												
												</font>
												
												</td>  
												
												
												
                                                <!--td width="5%" bgcolor='#FFF8DC' align="right" >
												&nbsp;< echo "<font face=tahoma size=2 color=#27408B><b>$info2: </b></font>"; ?>
												</td>--->
												
												<td width="25%" bgcolor='#FFFFFF'>
												&nbsp;<font face="tahoma" size="2" color="#">Update: </font>
												<?php echo "<font face=tahoma size=2 color=#CC3333	><b>$info3</b></font>"; ?>
											
												</td>
                                                
                                                

											
											
											
                                            
																						
											 
											</tr>
										
                                            </table>
											

											
											
											
                                            <?php
}
}
?>
                                          </td>
										 
                                        </tr>
                                        <tr class="jobscss"> 
                                          <td height="19">&nbsp;</td>
                                        </tr>
										  
										
										<!--  
                                        <tr class="jobscss"> 
                                          <td align="center" ><br><strong><span class="maekhawtom"><font color="#990000" size="2">
										 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										  Page : </font></span></strong> <font color="#999999" size="2"><span class="maekhawtom"> 
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
                                            </span></font><font color="#FFFFFF" size="2"><span class="maekhawtom"> 
                                            </span></font></td>
                                        </tr>
										-->
                                        <tr> 
                                          <td><div align="center"></div></td>
                                        </tr>
										
                                      </table>
                                    </div></td>
                                </tr>
                              </table></td>
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

  </table>
  
</div>
</body>
</html>
