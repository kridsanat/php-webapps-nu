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
<?php
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$infono_filter = isset($_GET['infono']) ? $_GET['infono'] : ''; // รับค่าจาก URL ถ้ามีการเลือก

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
echo "<select name='infono' onchange='this.form.submit()'>";
echo "<option value=''>เลือกประเภท</option>";
while ($row = mysqli_fetch_assoc($query_infono)) {
    $selected = ($row['infono'] == $infono_filter) ? 'selected' : '';
    echo "<option value='" . $row['infono'] . "' $selected>" . $row['infono'] . "</option>";
}
echo "</select>";
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
echo "<table border='1'>
        <tr>
            <th>หมายเลข</th>
            <th>ข้อมูล 1</th>
            <th>ข้อมูล 2</th>
            <th>ราคา</th>
            <th>รูปภาพ</th>
        </tr>";

while ($rows = mysqli_fetch_array($fect)) {
    $info1 = $rows["info1"];
    $printsprice = $rows["printsprice"];
    $printsphoto = $rows["printsphoto"];
    $bgcolor = ($bgcount % 2 == 0) ? "#E9E9E8" : "#FFFFFF";

    if (is_numeric($info1) && is_numeric($printsprice)) {
        $total = $printsprice * $info1;
        $sum += $total;
    }

    echo "<tr style='background-color: $bgcolor;'>
            <td>" . $rows["infono"] . "</td>
            <td>" . $info1 . "</td>
            <td>" . $rows["info2"] . "</td>
            <td>" . $printsprice . "</td>
            <td><img src='" . $printsphoto . "' width='50' height='50'></td>
          </tr>";
    $bgcount++;
}

echo "</table>";
echo "<p>ผลรวมทั้งหมด: " . number_format($sum, 2) . " บาท</p>";

// แสดงลิงค์แบ่งหน้า
for ($i = 1; $i <= $totalpage; $i++) {
    echo "<a href='?page=$i&infono=$infono_filter'>$i</a> ";
}
?>
