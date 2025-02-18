<?php
@session_start();

ob_start();
$useradmin = $_SESSION["useradmin"];
if (empty($useradmin)) {
    echo "<script>alert('Only Administrator');</script>";
    header("Location: ../index.php");
    exit();
}

require_once "../include/tdate.php";
require_once "../include/connectdb.php";

// เช็คข้อมูลผู้ใช้
$sql = "select * from useradmin where useradmin='$useradmin'";
$db_query = mysqli_query($connect, $sql);                    
$result = mysqli_fetch_array($db_query);
$id = $result["id"];
$adminname = $result["name"];
$user_admin = $result["useradmin"];
$pass_admin = $result["passadmin"];

?>



		<!-- ส่วนหัว -->
		<TABLE width="90%" border="0" align="center" cellpadding="1" cellspacing="1">
		  
			<tr valign="center"> 
			
			
				<td width="40%">
			
						<?php echo "<font size=4 color=#000080>$headtxt | $e_date $etime</font>"; ?>
		
						<br>
		
						<div align="left">
			
						<font color="#000000" size="4">Presently Page : <strong>PRINTERS PAGE</strong></font>

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
	$numproducts ="select * from nu_prints";
	$query_select=mysqli_query($connect, $numproducts);
	$numall=mysqli_num_rows($query_select);
?>																											  

<a href="nu_printsadd.php">
	<font face="tahoma" color="#000033" size="4">

		<u><i>Create New</i></u>

	</font>
</a>

&nbsp;

<br>
<br>


<?php
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$infono_filter = isset($_GET['infono']) ? mysqli_real_escape_string($connect, $_GET['infono']) : ''; // ป้องกัน SQL Injection

// ดึงข้อมูลประเภท infono ที่ไม่ซ้ำ
$select_infono = "SELECT DISTINCT infono FROM nu_prints ORDER BY infono";
$query_infono = mysqli_query($connect, $select_infono);
if (!$query_infono) {
    echo "ไม่สามารถดึงข้อมูลประเภท infono: " . mysqli_error($connect);
    exit;
}

// สร้างปุ่มเลือก infono
echo "<form method='GET' action=''>";
echo "<input type='hidden' name='page' value='$page'>"; // ส่งค่าหน้าปัจจุบันไปด้วย
echo "<div style='margin-bottom: 10px;'>"; // ใช้ div เพื่อจัดการรูปแบบการแสดงผล
while ($row = mysqli_fetch_assoc($query_infono)) {
    $selected = ($row['infono'] == $infono_filter) ? 'style="background-color: #ddd;"' : ''; // เปลี่ยนสีเมื่อเลือก
    echo "<button type='submit' name='infono' value='" . $row['infono'] . "' $selected class='btn-style'>" . $row['infono'] . "</button>";
}
echo "</div>";
echo "</form>";

// การกรองข้อมูลตาม infono ที่เลือก
$select = "SELECT * FROM nu_prints WHERE infono LIKE '%$infono_filter%' ORDER BY infono, info4 ASC";
$q_ry = mysqli_query($connect, $select);
$num_rows = mysqli_num_rows($q_ry);

$pagesize = 100;
$rt = $num_rows % $pagesize;
$totalpage = ($rt != 0) ? floor($num_rows / $pagesize) + 1 : floor($num_rows / $pagesize);
$goto = ($page - 1) * $pagesize;

mysqli_free_result($q_ry);
$sql_select_mem = "SELECT * FROM nu_prints WHERE infono LIKE '%$infono_filter%' ORDER BY infono, info4 ASC LIMIT $goto, $pagesize";
$fect = mysqli_query($connect, $sql_select_mem);

if (!$fect) {
    echo "ติดต่อฐานข้อมูลไม่ได้: " . mysqli_error($connect);
    exit;
}

$sum = 0;
$bgcount = 0;

// ถ้าไม่มีข้อมูล
if (mysqli_num_rows($fect) == 0) {
    echo "<p>ไม่พบข้อมูลที่ตรงกับการค้นหาา</p>";
} else {
    echo "<table border='1' width='90%' align='center' cellspacing='1' cellpadding='1' >
            <tr>
                <th><font face= 'tahoma' color='#27408B' size='1'>รูปภาพ</font></th>
                <th><font face= 'tahoma' color='#27408B' size='1'>สถาณที่</font></th>
                <th width='200' ><font face= 'tahoma' color='#27408B' size='1'>ผู้แก้ไข</font></th>
                <th><font face= 'tahoma' color='#27408B' size='1'>รายละเอียด</font></th>
                <th width='100'><font face= 'tahoma' color='#27408B' size='1'>จำนวน</font></th>
                <th width='100'><font face= 'tahoma' color='#27408B' size='1'>ราคา</font></th>
                <th width='100'><font face= 'tahoma' color='#27408B' size='1'>รวม</font></th>
            </tr>";

    while ($rows = mysqli_fetch_array($fect)) {

$idx =$rows["id"];
$info1 =$rows["info1"];
$info2 =$rows["info2"];
$info3 =$rows["info3"];
$info4 =$rows["info4"];
$info5 =$rows["info5"];
$info6 =$rows["info6"];
$printsprice =$rows["printsprice"];
$printsphoto =$rows["printsphoto"];
$status =$rows["status"];
$infono =$rows["infono"];
        $bgcolor = ($bgcount % 2 == 0) ? "#E9E9E8" : "#FFFFFF";

        if (is_numeric($info1) && is_numeric($printsprice)) {
            $total = $printsprice * $info1;
            $sum += $total;
        }

        echo "  <tr style='background-color: $bgcolor;'>

                    <form method='post' action='nu_equpedit.php?SerID=" . $idx . "' >
                        <td width='20' ><img src=../pic/$printsphoto width=50 height=50 border=1 ></td>
                    
                        <td bgcolor='#4682B4' width='14%' ><font face= 'tahoma' color='#FFFACD' size='+1'><b>&nbsp;&nbsp;" . $rows["infono"] . "&nbsp;&nbsp;</b></font></td>
                    
                        <td>
                            <font face= 'tahoma' color='#27408B' size='+1'><b>&nbsp;&nbsp;" . $rows["info2"] . "&nbsp;&nbsp;</font>
                            <br>
                            <font face= 'tahoma' color='#FF0033' size='1'>&nbsp;&nbsp;&nbsp;&nbsp;" . $rows["info3"] . "&nbsp;&nbsp;</font>
                        </td>

                        <td>
                            <font face= 'tahoma' color='#27408B' size='+1'>&nbsp;&nbsp;<input name='submit' type='submit' class='submit' value='Edit' >
                                &nbsp;&nbsp;" . $info4 . "&nbsp;&nbsp;
                            </font>
                        </td>

<td bgcolor='#AFEEEE' align='left'>
                            &nbsp;&nbsp;";
        
        // Fixed the condition for Qty.
        if ($info1 == 0) {
            echo "<b><font face='tahoma' size='2' color='#'>Qty.</font><font face='tahoma' size='2' color='#B8860B'>0</font></b>";
        } else if ($info1 < 4) {
            echo "<b><font face='tahoma' size='2' color='#'>Qty.</font><font face='tahoma' size='2' color='#B8860B'>$info1</font></b>";
        } else {
            echo "<b><font face='tahoma' size='2' color='#'>Qty.</font><font face='tahoma' size='2' color='#B8860B'>$info1</font></b>";
        }

        echo "  </td>

                <td bgcolor='#AFEEEE' align='left'>
                    <font face='tahoma' size='2' color='#'>&nbsp;&nbsp;<b>Unit/Price</b><br></font>";
                    
        if ($equpprice == 0) {
            echo "<font face='tahoma' size='2' color='#FF0000'><b>&nbsp;&nbsp;-</b></font>";
        } else {
            $formattedPrice = number_format($equpprice, 2, '.', ',');
            echo "<font face='tahoma' size='2' color='#000000'>&nbsp;&nbsp;$formattedPrice</font>";
        }
        
        echo "  </td>

                <td bgcolor='#AFEEEE' align='right'>
                    <font face='tahoma' size='2' color='#'><b>&nbsp;Total&nbsp;</b><br></font>
                    <font face='tahoma' size='2' color='#000000'>
                        <span>
                            " . number_format($total, 2, '.', ',') . "&nbsp;
                        </span>
                    </font>
</td>



                    </form>

                </tr>

                <tr>

                        <td colspan='7' ><textarea width='1000' cols='230' rows='1' style='resize: vertical;' readonly>" . $info6 . "</textarea></td>
                
                </tr>
              ";
           
        $bgcount++;
    }
    echo "</table>";

}

// แสดงลิงค์แบ่งหน้า
echo "<div><br>";
if ($page > 1) {
    echo "<a href='?page=" . ($page - 1) . "&infono=$infono_filter'>ก่อนหน้า</a> ";
}
for ($i = 1; $i <= $totalpage; $i++) {
    echo "<a href='?page=$i&infono=$infono_filter'>$i</a> ";
}
if ($page < $totalpage) {
    echo "<a href='?page=" . ($page + 1) . "&infono=$infono_filter'>ถัดไป</a> ";
}
echo "</div>";
?>

<!-- เพิ่ม CSS สำหรับการจัดรูปแบบปุ่ม -->
<style>
    .btn-style {
        padding: 10px 20px;
        margin-right: 15px;
        margin-bottom: 10px;
        display: inline-block;
        background-color: #4CAF50; /* สีพื้นหลัง */
        color: white; /* สีข้อความ */
        border: none; /* ขอบปุ่ม */
        border-radius: 5px; /* มุมโค้ง */
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-style:hover {
        background-color: #45a049; /* เปลี่ยนสีเมื่อ hover */
    }

    .btn-style:focus {
        outline: none; /* ลบเส้นขอบเมื่อคลิก */
    }
</style>
