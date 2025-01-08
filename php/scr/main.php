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
        }

        header h1 {
            margin: 0;
            font-size: 2.5em;
        }

        .container {
            padding: 20px;
        }

        .welcome {
            text-align: center;
            margin: 20px 0;
        }

        .welcome h2 {
            font-size: 2em;
            color: #007bff;
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
    </style>
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <p>Welcome, <?php echo $adminname; ?>!</p>
    </header>

    <div class="container">
        <div class="welcome">
            <h2>Currently Logged In as: <?php echo $adminname; ?></h2>
        </div>

        <div class="links">
            <a href="nu_news/newmain.php" class="link">Manual</a>
            <a href="nu_equp/nu_equp.php" class="link">System and Networks</a>
            <a href="nu_sup/nu_sup.php" class="link">Sub Domain SSL</a>
            <a href="../ChangePass.php" class="link">Change Password</a>
            <a href="../logout.php" class="link">Sign Out</a>
        </div>
    </div>

    <footer>
        &copy; <?php echo date('Y'); ?> Admin Dashboard. All rights reserved.
    </footer>
</body>
</html>
