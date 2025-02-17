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
    echo "<table border='1' width='1000' >
            <tr>
                <th>รูปภาพ</th>
                <th>หมายเลข</th>
                <th>ผู้แก้ไข</th>
                <th>รายละเอียด</th>
                
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

        echo "<tr style='background-color: $bgcolor;'>
        
                <td width='20' ><img src=../pic/$printsphoto width=50 height=50 border=1 ></td>
                <td bgcolor='#4682B4' width='14%' ><font face= 'tahoma' color='#FFFACD' size='+1'><b>&nbsp;&nbsp;" . $rows["infono"] . "&nbsp;&nbsp;</b></font></td>
                <td><font face= 'tahoma' color='#27408B' size='+1'><b>&nbsp;&nbsp;" . $rows["info2"] . "&nbsp;&nbsp;</b></font></td>
                <td><font face= 'tahoma' color='#27408B' size='+1'>&nbsp;&nbsp;" . $info4 . "&nbsp;&nbsp;</font></td>
                

              </tr>
              <tr>
              <td colspan='4' ><textarea width='1000' cols='50' rows='1' readonly>" . $info6 . "</textarea></td>
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
