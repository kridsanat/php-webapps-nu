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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin System</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #1d3557;
            color: white;
            padding: 20px;
            text-align: center;
            border-bottom: 5px solid #457b9d;
        }

        header h1 {
            margin: 0;
            font-size: 2.5em;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
        }

        .user-info {
            text-align: right;
            margin-bottom: 20px;
        }

        .user-info span {
            font-size: 1.3em;
            color: #1d3557;
            font-weight: bold;
        }

        .user-info a {
            text-decoration: none;
            margin-left: 15px;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 0.9em;
            background-color: #457b9d;
            color: white;
            transition: background-color 0.3s;
        }

        .user-info a:hover {
            background-color: #1d3557;
        }

        .links {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .links .btn {
            text-decoration: none;
            color: white;
            font-size: 1em;
            padding: 12px 25px;
            border-radius: 8px;
            background-color: #457b9d;
            text-align: center;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .links .btn:hover {
            background-color: #1d3557;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th, .table td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: left;
        }

        .table th {
            background-color: #457b9d;
            color: white;
            text-align: center;
        }

        .table tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .table tr:hover {
            background-color: #f1f5f9;
        }

        .table a {
            text-decoration: none;
            color: #457b9d;
            font-weight: bold;
        }

        .table a:hover {
            color: #1d3557;
        }

        footer {
            text-align: center;
            padding: 15px;
            background-color: #1d3557;
            color: white;
            margin-top: 30px;
            font-size: 0.9em;
        }

        @media (max-width: 768px) {
            .links {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .user-info {
                text-align: center;
            }

            .table th, .table td {
                font-size: 0.9em;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
    </header>
    <div class="container">
        <div class="user-info">
            Welcome, <span><?php echo $adminname; ?></span>
            <a href="../ChangePass.php">Change Password</a>
            <a href="../logout.php">Sign Out</a>
        </div>

        <div class="links">
            <a href="nu_equpadd.php" class="btn">Create New</a>
            <a href="nu_equp_view.php" class="btn">View Page</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
<?php
$sql_select_mem = "SELECT * FROM nu_equps";
$fect = mysqli_query($connect, $sql_select_mem);
if (!$fect) {
    die("Database error: " . mysqli_error($connect));
}
$index = 1;
while ($row = mysqli_fetch_array($fect)) {
    $quantity = is_numeric($row["info1"]) ? $row["info1"] : 0;
    $unit_price = is_numeric($row["equpprice"]) ? $row["equpprice"] : 0;
    $total = $quantity * $unit_price;
    echo "<tr>";
    echo "<td style='text-align: center;'>{$index}</td>";
    echo "<td>{$row['info2']}</td>";
    echo "<td style='text-align: right;'>{$quantity}</td>";
    echo "<td style='text-align: right;'>" . number_format($unit_price, 2) . "</td>";
    echo "<td style='text-align: right;'>" . number_format($total, 2) . "</td>";
    echo "<td style='text-align: center;'>";
    echo "<a href='nu_equpedit.php?SerID={$row['id']}'>Edit</a> | ";
    echo "<a href='nu_delequp.php?SerID={$row['id']}' onclick=\"return confirm('Are you sure?')\">Delete</a>";
    echo "</td>";
    echo "</tr>";
    $index++;
}
?>
            </tbody>
        </table>
    </div>
    <footer>
        &copy; <?php echo date('Y'); ?> Admin Dashboard. All rights reserved.
    </footer>
</body>
</html>
