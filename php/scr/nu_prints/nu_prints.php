<?php
include 'config.php'; // เชื่อมต่อฐานข้อมูล

// ดึงค่า infono ที่ไม่ซ้ำ
$infono_list = [];
$sql_select_distinct = "SELECT DISTINCT infono FROM nu_prints ORDER BY infono ASC";
$query_select_distinct = mysqli_query($connect, $sql_select_distinct);

while ($row = mysqli_fetch_assoc($query_select_distinct)) {
    $infono_list[] = $row['infono'];
}

// กรองข้อมูลตาม infono ที่เลือก
$filter = "";
if (!empty($_GET['infono'])) {
    $selected_infono = mysqli_real_escape_string($connect, $_GET['infono']);
    $filter = "WHERE infono = '$selected_infono'";
}

// ดึงข้อมูลจากตาราง nu_prints
$sql_select_mem = "SELECT * FROM nu_prints $filter ORDER BY infono, info4 ASC";
$fect = mysqli_query($connect, $sql_select_mem);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายการปริ้นเตอร์</title>
    <style>
        .btn {
            padding: 5px 10px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 10px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h2>เลือก infono</h2>
<div>
    <a href="printers.php" class="btn" style="background-color: #28a745;">ทั้งหมด</a>
    <?php foreach ($infono_list as $infono) : ?>
        <a href="printers.php?infono=<?= $infono ?>" class="btn">infono: <?= $infono ?></a>
    <?php endforeach; ?>
</div>

<h2>รายการปริ้นเตอร์</h2>
<table border="1">
    <tr>
        <th>infono</th>
        <th>info4</th>
        <th>รายละเอียด</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($fect)) : ?>
        <tr>
            <td><?= $row['infono'] ?></td>
            <td><?= $row['info4'] ?></td>
            <td><?= $row['detail'] ?></td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
