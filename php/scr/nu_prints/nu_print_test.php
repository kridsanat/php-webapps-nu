<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แยกหมวดหมู่</title>
</head>
<body>
    <h2>เลือกหมวดหมู่</h2>
    <form method="GET" action="">
        <!-- ปุ่มเลือกหมวดหมู่ -->
        <button type="submit" name="category" value="cat1">หมวดหมู่ 1</button>
        <button type="submit" name="category" value="cat2">หมวดหมู่ 2</button>
        <button type="submit" name="category" value="cat3">หมวดหมู่ 3</button>
    </form>

    <h3>ข้อมูลที่แสดงตามหมวดหมู่:</h3>
    <?php
    // เชื่อมต่อฐานข้อมูล
    require_once "../include/connectdb.php";

    // ตรวจสอบว่ามีการเลือกหมวดหมู่หรือไม่
    if (isset($_GET['category'])) {
        $category = $_GET['category'];
        
        // สร้าง SQL ตามหมวดหมู่ที่เลือก
        $sql = "SELECT * FROM products WHERE category = '$category'";
        $result = mysqli_query($connect, $sql);
        
        // ตรวจสอบผลลัพธ์
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<p>" . $row['product_name'] . " - " . $row['price'] . " บาท</p>";
            }
        } else {
            echo "<p>ไม่พบข้อมูลในหมวดหมู่นี้</p>";
        }
    } else {
        echo "<p>กรุณาเลือกหมวดหมู่เพื่อดูข้อมูล</p>";
    }
    ?>
</body>
</html>
