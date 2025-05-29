<?php
@session_start();

require_once "../include/tdate.php";
require_once "../include/connectdb.php";


?>

<STYLE type=text/css>
BODY {
background-image : url('../images/bg.gif');

background-attachment : fixed

}
</STYLE>


<?php
						  $sql_1="select * from news where id = '$_GET[NewsID]'";
						  $db_query=mysqli_query($connect,$sql_1);
						  $result1=mysqli_fetch_array($db_query);
						  $idx=$result1['id'];
						  $topic=$result1['topic'];
						  $message=$result1['message'];
						  $newphoto=$result1['newphoto'];
						  $dateregist=$result1['dateregist'];
						  
?>






<html>

		<head>
		<?php echo "$fav"; ?>
			<title><?php echo "$topic"; ?></title>
			<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
			<meta http-equiv="refresh" content="1800;url=../logout.php" />

			<link href="" rel="" type="">
		</head>

<body bgcolor="#ffffff">

			
<br>
<br>	






<table width="1000" border="0"  align="center" cellpadding="0" cellspacing="0" ><tr><td><table width="1000" border="0"  align="center" cellpadding="0" cellspacing="0" >
  <!-- fwtable fwsrc="Untitled" fwbase="home.jpg" fwstyle="Dreamweaver" fwdocid = "742308039" fwnested="0" -->

	



			
  <tr>
    <td colspan="5" bgcolor="#FFFFFF" border="1"  align="center" cellpadding="0" cellspacing="0" style=border-style:solid;border-width:1px;border-color:#000000 gray gray #000000 ;>
	<div align="center">
      <table width="1000" border="0" cellspacing="0" cellpadding="0">
        <tr valign="top">

         
         
          <td width="719">
		  
		  
		  <table width="1000" border="1" align="center" cellpadding="1" cellspacing="1">
            <tr >
              <td colspan="2">
			  
			  
			  
			  
              <table width="100%" border="0" cellpadding="2" cellspacing="0" bordercolor="#852A3B">
                <tr>    
                  <td>
					<div align="center">
				  <table width="80%" border="0" cellspacing="1" cellpadding="3">
					
                      <tr >
                        <td colspan="2" >
						<table width="" border="0" >
						<tr>
						<td>
						<br>
						
						<br>
						<br>
						</td>
						</tr>
						

						
						</table>
						
						<table width="100%" border="0" cellspacing="1" cellpadding="4">
						

						<font face="tahoma" size="5" color="#222222">
						<tr>
						<td>
						<font face="tahoma" size="3" color=""><?php echo "<b>$topic</b>"; ?>&nbsp;&nbsp;</font>
						</td>
						</tr>
						</font>
						</table>
						</td>
                      </tr>
                      <tr>
                        <td colspan="2">
						<table width="900" border="0" cellspacing="1" cellpadding="4">
                            <tr>
                              <td>
							  <font size="2" face="tahoma" color="#222222">

							  <?php echo nl2br(htmlspecialchars_decode($message, ENT_QUOTES)); ?>

							  
							  
							
							  <?php 
							  if ($newphoto >= 100){
							  echo "<img src=NEW/$newphoto width=100%>
							  
							  ";
							  }
								else{
								echo "";	
								}
							  ?>
							  </font>
							  </td>
                            </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="100%"><div align="right"><font face="tahoma" size="2" color="#222222"><? echo ":: Date $dateregist ::"; ?>
						<br><br><br></font></div>
						</td>
                        <td width="1%">&nbsp;</td>
                      </tr>
                  </table>
				  </div>
				  </td>
                </tr>
              </table>
            </div> 
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  </td>
            </tr>
            
          </table></td>
          
        </tr>
        
</table>


</body>
</html>
