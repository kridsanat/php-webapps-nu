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
			<meta http-equiv="refresh" content="8900;url=../logout.php" />
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
			
						<font color="#000000" size="4">Presently Page : <strong>.....</strong></font>

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

<table width="90%" border="0" align="center" cellspacing="1" cellpadding="1">

			<tr>
				<td>
				<a href="../main.php"  style="text-decoration: none;" >
				<font face="tahoma" color="#000033" size="4"><< BACK </font>
				</a>
				<br>
				<br>
				</td>
			</tr>


    		<tr class=""> 
       	 		<td bgcolor="#FFFFFF"> 

<?php
	$numproducts ="select * from nu_sup";
	$query_select=mysqli_query($connect, $numproducts);
	$numall=mysqli_num_rows($query_select);
?>																											  

<a href="nu_supadd.php">
	<font face="tahoma" color="#000033" size="4">

		<u><i>Create New</i></u>

	</font>
</a>

&nbsp;

<br>
<br>								  
									 
<?PHP

$page = isset($_GET['page']) ? $_GET['page'] : '';

$select_type="select * from nu_sup order by infono, info4, info1 asc";
$query_select=mysqli_query($connect, $select_type);
$num_rows=mysqli_num_rows($query_select);

if($num_rows<1){
echo "<br><br><center><font color=#666666 face=tahoma size=2><b>No item</b></font></center>";
}else{
		$select="select * from nu_sup order by infono, info4, info1 asc";
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
$sql_select_mem="Select * From nu_sup order by infono, info4, info1 asc limit $goto,$pagesize";
		$fect=mysqli_query($connect,$sql_select_mem);
		if(!$fect)
		{
		("ติดต่อฐานข้อมูลไม่ได้".mysqli_error());
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
$supprice =$rows["supprice"];
$supphoto =$rows["supphoto"];
$status =$rows["status"];
$infono =$rows["infono"];
if (is_numeric($info1) && is_numeric($supprice)) {
    $total = $supprice * $info1;
    $sum += $total;
    // Rest of the code
} else {
    // Handle the case when the values are not numeric
}
$bgcount=$bgcount+1;
$bgmod=$bgcount%2;
if($bgmod==0){
	$bgcolor="#E9E9E8";
}else{
	$bgcolor="#FFFFFF";
}		

?>
	

<form method="post" action="nu_supedit.php?SerID=<?php echo "$idx"; ?>">


    <table width="100%" border="1" cellspacing="1" cellpadding="1" align="center">
                    
			<tr bgcolor="#AFEEEE" > 


								

												
								
								
												

								<td bgcolor="#FFFFFF" width="2%" valign="center"  >

										<a href="<?php echo "../pic/$supphoto"; ?>" rel="lightbox" target="_blank" style="text-decoration: none;" >
												
										<?php
							 			 if ($supphoto >= 100)
							  			{
							 			echo "<img src=../pic/$supphoto width=30 height=30 border=1 >";
							 			}else
										{
										echo "<font face= 'tahoma' color='' size='2'>N/A</font>";	
									    }
							 			 ?>
		
									</a>
												
												

										
			<?php
			
			if ($infono == 'IIS')
			  {
			  	echo "<td bgcolor='#4682B4' width='10%' ><font face= 'tahoma' color='#FFFACD' size='+1'><b>&nbsp;&nbsp;IIS</b></font></td>";
			}else if ($infono == 'XAMPP')
			  {
				echo "<td bgcolor='#3CB371' width='10%' ><font face= 'tahoma' color='#FFFACD' size='+1'><b>&nbsp;&nbsp;XAMPP</b></font></td>";
			}else if ($infono == 'CLOUD')
			{
			  echo "<td bgcolor='#99CCFF' width='10%' ><font face= 'tahoma' color='#FFFACD' size='+1'><b>&nbsp;&nbsp;Apache.linux</b></font></td>";
			}else if ($infono == 'Apache.linux')
			{
			  echo "<td bgcolor='#66CCCC' width='10%' ><font face= 'tahoma' color='#FFFACD' size='+1'><b>&nbsp;&nbsp;Apache.linux</b></font></td>";
			}else if ($infono == 'Apache.linux')
			{
			  echo "<td bgcolor='#B0C4DE' width='10%' ><font face= 'tahoma' color='#FFFACD' size='+1'><b>&nbsp;&nbsp;Site.Nirvana</b></font></td>";
			}else if ($infono == 'Site.UM')
			{
			  echo "<td bgcolor='#8FBC8F' width='10%' ><font face= 'tahoma' color='#FFFACD' size='+1'><b>&nbsp;&nbsp;Site.UM</b></font></td>";
			}else if ($infono == 'Site.WHN')
			{
			  echo "<td bgcolor='#B03060' width='10%' ><font face= 'tahoma' color='#FFFACD' size='+1'><b>&nbsp;&nbsp;Site.WHN</b></font></td>";
			}else if ($infono == 'Site.Bangpoo')
			{
			  echo "<td bgcolor='#B03060' width='10%' ><font face= 'tahoma' color='#FFFACD' size='+1'><b>&nbsp;&nbsp;Site.Bangpoo</b></font></td>";
			}else
			  {
				echo "<td bgcolor='#66CCCC' width='10%' ><font face= 'tahoma' color='#FFFACD' size='+1'><b>&nbsp;&nbsp;$infono</b></font></td>";
			}
			
			
						
			?>
																		
											
							

												
												
												
									<?php
									if ($status == "Active")
					 				{
									  echo "<td width='1%' align='center' bgcolor='red'></td>";
									}else if ($status == "Deactive")
									{
									  echo "<td width='1%' align='center' bgcolor='green'></td>";
									}						
									?>
						
						
												
						
												
												
								<td bgcolor="#F5F5F5" width="30%" valign="top" >
											
									
								&nbsp;<input name='submit' type='submit' class='submit' value='Edit' >&nbsp;
								<i><?php echo "<font face=tahoma size=4 color=#000000 >$info4 </font>"; ?></i>
									

								&nbsp;&nbsp;

									<font face="tahoma" size="2" color="#3e3d36">
										&nbsp;SSL cert - Preroid Expire : &nbsp;<b><?php echo "$info5"; ?></b>												
									</font>
											<br>
											
								</td>
                                              
		 
								<td width="20%" bgcolor='#AFEEEE' align="left">
								&nbsp;&nbsp;	
								<?php echo "<font face=tahoma size=4 color=#000000 >$info1 </font>"; ?>	
								&nbsp;						
								<textarea name="info6" type="text" id="" id="info6" cols="10" rows="1" readonly><?php echo $info6; ?></textarea>
								</td>	
					
				
								<td width="20%" bgcolor='#AFEEEE' align="left" >
								
								<a href="nu_delsup.php?SerID=<?php echo "$idx"; ?>" onclick="return confirm('Are you sure?')" ><img src="../images/icon_close.jpg" alt="ลบข้อมูล" width="" height="" border="0" ></a></div>
			

								

								&nbsp;<?php echo "<font face=tahoma size=2 color=#27408B><b> $info2</b></font>"; ?>

								&nbsp;<font face="tahoma" size="2" color="#"></font>
								<?php echo "<font face=tahoma size=2 color=#	><b>$info3</b></font>"; ?>
								
								
											
								</td>



								<!--
								<td width="6%" bgcolor='#AFEEEE' align="right">						
	
								&nbsp;<?php echo "<font face=tahoma size=4 color=#000000 >$supprice </font>"; ?>			
								

								</td>												
								-->				
												

											
											
                                        
											
	
			</tr>
											
    </table>
	
</form>
																						
											
<?php
}
}
?>
												
                                        
										  
										
										  
                                        <tr class="jobscss"> 
                                          <td>
										  
											<strong><span class="maekhawtom"><font color="#990000" size="2">Page 
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

                                            </span></font><font color="#FFFFFF" size="2"><span class="maekhawtom"> 
                                            </span></font>

											</td>
										</tr>	
			</td>
		</tr>

</table>
                                  

  

</body>
</html>
