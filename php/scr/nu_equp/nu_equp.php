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
			<link href="" rel="" type="">
		</head>

<body bgcolor="#ffffff">

		<!-- ส่วนหัว -->
		<TABLE width="90%" border="0" align="center" cellpadding="1" cellspacing="1">
		  
			<tr valign="center"> 
			
			
				<td width="60%">
			
						<?php echo "<font size=2 color=#000080>$headtxt | </font><font size=2 color=#666666>$e_date $etime</font>"; ?>
		
						<br>
		
						<div align="left">
			
							<font color="#000000" size="2">Presently Page :</font><font size="2"> 
				
							<font color="#333333"><strong>Stock</strong></font>

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
	$numproducts ="select * from nu_equps";
	$query_select=mysqli_query($connect, $numproducts);
	$numall=mysqli_num_rows($query_select);
?>																											  

<a href="nu_equpadd.php">
	<font face="tahoma" color="#000033" size="4">

		<u><i>Create New</i></u>

	</font>
</a>

&nbsp;

<br>
<br>

<?php 
$sql_select_mem = "SELECT * FROM nu_equps";
$fect = mysqli_query($connect, $sql_select_mem);
if (!$fect) {
    die("ติดต่อฐานข้อมูลไม่ได้" . mysqli_error());
    exit;
}

$sum = 0;
$bgcount = 0;

while ($rows = mysqli_fetch_array($fect)) {
    $info1 = $rows["info1"];
    $equpprice = $rows["equpprice"];
	if (is_numeric($info1) && is_numeric($equpprice)) {
		$total = $equpprice * $info1;
		$sum += $total;
		// Rest of the code
	} else {
		// Handle the case when the values are not numeric
	}
}

echo "SUM: <b>" . number_format($sum, 2, '.', ',') . "</b>&nbsp;THB.";
?>
<br>

<br>
<br>								  
									 
<?PHP

$page = isset($_GET['page']) ? $_GET['page'] : '';

$select_type="select * from nu_equps order by infono, info4 asc";
$query_select=mysqli_query($connect, $select_type);
$num_rows=mysqli_num_rows($query_select);

if($num_rows<1){
echo "<br><br><center><font color=#666666 face=tahoma size=2><b>No item</b></font></center>";
}else{
		$select="select * from nu_equps order by infono, info4 asc";
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
$sql_select_mem="Select * From nu_equps order by infono, info4 asc limit $goto,$pagesize";
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
$equpprice =$rows["equpprice"];
$equpphoto =$rows["equpphoto"];
$status =$rows["status"];
$infono =$rows["infono"];
if (is_numeric($info1) && is_numeric($equpprice)) {
    $total = $equpprice * $info1;
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
	

<form method="post" action="nu_equpedit.php?SerID=<?php echo "$idx"; ?>">


    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                    
			<tr bgcolor="#AFEEEE" > 



								<td width="3%" bgcolor='#AFEEEE' align="right">
																		
									<?php
			
									if ($info1 == 0)
					  				{
					  				echo "<b><font face=tahoma size=1 color=#>Qty.<br></font><font face=tahoma size=2 color=#B8860B>0</font></b>";
									}else if ($info1 < 4)
					  				{
					 				echo "<b><font face=tahoma size=1 color=#>Qty.<br></font> <font face=tahoma size=2 color=#B8860B>$info1</font></b> ";
									}else
					  				{
									echo "<b><font face=tahoma size=1 color=#>Qty.<br></font> <font face=tahoma size=2 color=#B8860B>$info1</font></b>";
									}
						
									?>	
						
						
								</td>	
					
				
								<td width="6%" bgcolor='#AFEEEE' align="right" >

									<?php
						
			
									if ($equpprice == 0) {
  									echo "<font face=tahoma size=1 color=#><b>Unit/Price</b><br></font><font face=tahoma size=2 color=#FF0000><b>-</b></font>";
									} else if ($equpprice >= 1) {
 									 $formattedPrice = number_format($equpprice, 2, '.', ',');
 									 echo "<font face=tahoma size=1 color=#><b>Unit/Price</b><br></font> <font face=tahoma size=2 color=#000000>$formattedPrice</font>";
									}
									?>	
											
								</td>




								<td width="6%" bgcolor='#AFEEEE' align="right">						
	

									<font face=tahoma size=2 color=#><b>&nbsp;Total&nbsp;</b><br></font> <font face=tahoma size=2 color=#000000>
									<span >
											<?php echo number_format($total, 2, '.', ','); ?>&nbsp;
									</span>
									
									</font>


								</td>
												
								
								
												

								<td bgcolor="#FFFFFF" width="3%" valign="middle"  >

										<a href="<?php echo "../pic/$equpphoto"; ?>" rel="lightbox" target="_blank" >
												
										<?php
							 			 if ($equpphoto >= 100)
							  			{
							 			echo "<img src=../pic/$equpphoto width=35 height=35 border=1 >";
							 			}else
										{
										echo "&nbsp;&nbsp;No Pic";	
									    }
							 			 ?>
		
									</a>
												
												
								</td>	
												

										
			<?php
			
			if ($infono == 'HQ')
			  {
			  	echo "<td bgcolor='#009933' width='8%' ><font size='+1'><b>&nbsp;&nbsp;HQ</b></font></td>";
			}else if ($infono == 'TIP9')
			  {
				echo "<td bgcolor='#339999' width='8%' ><font size='+1'><b>&nbsp;&nbsp;TIP9</b></font></td>";
			}else if ($infono == 'CLOUD')
			{
			  echo "<td bgcolor='#99CCFF' width='8%' ><font size='+1'><b>&nbsp;&nbsp;CLOUD</b></font></td>";
			}else
			  {
				echo "<td bgcolor='#FFFFCC' width='8%' ><font size='+1'><b>&nbsp;&nbsp;$infono</b></font></td>";
			}

			?>
									
									
											
												
								<td width="3%" bgcolor='#FFFFFF' align="center">  
									<input name="submit" type="submit" class="submit" value="Edit" >
								</td>
												
												
												
									<?php
									if ($status == "Active")
					 				{
									  echo "<td width='0.3%' align='center' bgcolor='33FF99'></td>";
									}else if ($status == "Deactive")
									{
									  echo "<td width='0.3%' align='center' bgcolor='#FF3300'></td>";
									}						
									?>
						
						
												
						
												
												
								<td bgcolor="#F5F5F5" width="49%" >
											
									
									&nbsp;<?php echo "<font face=tahoma size=4 color=#000000 >$info4</font>"; ?></u>
									

											<br>

									<font face="tahoma" size="1" color="#778899">
										&nbsp;Preroid Expire : &nbsp;<b><?php echo "$info5"; ?></b>												
									</font>

								</td>
                                              
		 
												
												
												
                                <td width="12%" bgcolor='#FFFFFF' align="left" >

									&nbsp;<?php echo "<font face=tahoma size=2 color=#27408B><b> $info2</b></font>"; ?>
										<br>
									&nbsp;<font face="tahoma" size="2" color="#"></font>
									<?php echo "<font face=tahoma size=2 color=#	><b>$info3</b></font>"; ?>
											
								</td>
                                                
                                                
											
												
								<td width="3.5%" bgcolor="#FFFFFF" ><div align="right">

											<a href="nu_delequp.php?SerID=<?php echo "$idx"; ?>" onclick="return confirm('Are you sure?')" ><img src="../images/icon_close.jpg" alt="ลบข้อมูล" width="" height="" border="0" ></a></div>
	
								</td>
											
											
                                        
											
					<tr height="">

						<td colspan="6" >  

						</td>

						<td colspan="4" >
							
							<textarea name="info6" type="text" id="" id="info6"  cols="130" rows="1" readonly><?php echo $info6; ?></textarea>
						</td>

					</tr>		
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
