<?php
require_once "include/connectdb.php";
?>


<html>
<head>

<title><?php echo "$headtxt"; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<!-- Fireworks MX Dreamweaver MX target.  Created Sat Apr 02 10:29:23 GMT+0700 (SE Asia Standard Time) 2011-->
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#ffffff" background="images/background.jpg" onLoad="javascript:document.getElementById('useradmin').focus();">
<div align="center"><font color="#990000" size="+1"><strong><font color="#333333" size="2"><br>
  <br>
  <br>
  </font></strong></font>
  <table width="43%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#E9E9E6">
    <tr>
      <td bgcolor="#FFFFFF">
<div align="center"><font color="#990000" size="+1"><strong><font color="#333333" size="2">

			<br><br>
			<br><br>
          :: Information Managedment System ::</font><br>
			</strong></font> <br>
			<table width="356" border="0" align="center" cellpadding="1" cellspacing="1">
            <form method="post" action="SignIn.php">
              <tr> 
                <td width="156"><div align="right"><font size="2">Username 
                    :</font></div></td>
                <td width="286"><font size="3"> 
                  <input name="useradmin" type="text" class="input" id="useradmin" size="15">
                  </font></td>
              </tr>
              <tr> 
                <td><div align="right"><font size="2">Password :</font></div></td>
                <td><font size="3"> 
                  <input name="passadmin" type="password" class="input" id="passadmin" size="15">
                  </font></td>
              </tr>
              <tr> 
                <td><font size="3">&nbsp;</font></td>
                <td><input name="submit" type="submit" class="submit" value="Sign-In!"></td>
              </tr>
            </form>
          </table>
          <br>
          <br>
		  
		  
		   <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
            <form method="post" action="SignIn.php">
              <tr> 
                <td width="156">
				
				<div align="left">
				
				<font size="2"></font>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="nu_sys\pdf\FM-DIT-001 R00 แบบฟอร์มร้องขอดำเนินการด้าน IT 01-03-22.pdf">Download Request From</A>
				<br>
				<br>
				
				</div>
					
				</td>
                
              </tr>
             
            </form>
          </table>
		  
		  
        </div></td>
    </tr>
	
	
	
	
	
  </table>
  <!--
  <br>
  <a href="toppig.php">��纺���</a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<a href="webboom\index.php">���ͺ����红�¢ͧ</a>
  
  
  <br>
  <br>
  -->
</div>
  
  
  
</body>
</html>
