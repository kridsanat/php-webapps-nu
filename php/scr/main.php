<?php
@session_start();

// Start session and check user admin
ob_start();
$useradmin = $_SESSION["useradmin"];
if (empty($useradmin)) {
    echo "<script>alert('Only Administrator');</script>";
    header("Location: ../index.php");
    exit();
}

require_once "include/tdate.php";
require_once "include/connectdb.php";

// Query user information
$stmt = $connect->prepare("SELECT * FROM useradmin WHERE useradmin = ?");
$stmt->bind_param("s", $useradmin);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

if (!$result) {
    header("Location: ../index.php");
    exit();
}

$id = $result["id"];
$adminname = htmlspecialchars($result["name"], ENT_QUOTES, 'UTF-8');

?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php echo "$fav"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="900;url=logout.php">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            position: relative;
        }

        header h1 {
            margin: 0;
            font-size: 2.5em;
        }

        .top-right {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .top-right button {
            background-color: #ffffff;
            color: #007bff;
            border: 1px solid #007bff;
            border-radius: 5px;
            padding: 5px 10px;
            margin: 5px 0;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        .top-right button:hover {
            background-color: #007bff;
            color: white;
        }

        .container {
            padding: 20px;
        }

        .welcome {
            text-align: center;
            margin: 20px 0;
        }

        .links {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .link {
            background-color: #28a745;
            color: white;
            text-decoration: none;
            padding: 15px 30px;
            border-radius: 5px;
            font-size: 1.2em;
            transition: background-color 0.3s;
        }

        .link:hover {
            background-color: #218838;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #007bff;
            color: white;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        @media (max-width: 768px) {
            header {
                text-align: left;
                padding: 10px;
            }

            header h1 {
                font-size: 1.8em;
            }

            .top-right {
                position: static;
                flex-direction: row;
                justify-content: flex-end;
            }

            .container {
                padding: 10px;
            }

            .links {
                flex-direction: column;
                gap: 10px;
            }

            .link {
                font-size: 1em;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <header>
        
        <h1>ยินดีตอนรับเข้าสู่ระบบ คุณ <font face= 'tahoma' color='#FFD700' size='+3'><b><?php echo $adminname; ?>!</b></font></h1>
        
        
        <div class="top-right">
            <button onclick="location.href='../ChangePass.php'">Change Password</button>
            <button onclick="location.href='../logout.php'">Sign Out</button>
        </div>
        
    </header>

    <div class="container">
        <div class="links">
            <a href="nu_news/newmain.php" class="link">Manual</a>
            <a href="nu_equp/nu_equp.php" class="link">System and Networks Management</a>
            <a href="nu_sup/nu_sup.php" class="link">Sub Domain Management</a>
            <a href="nu_prints/nu_prints.php" class="link">Printers Management</a>
        </div>
    </div>

    <footer>
        &copy; <?php echo date('Y'); ?> Admin Dashboard. All rights reserved.
    </footer>
</body>
</html>
