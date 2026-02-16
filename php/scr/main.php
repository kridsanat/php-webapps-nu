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
            <a href="nu_sup/nu_sup.php" class="link">WAN-IP & Production SubDomain Management</a>
            <a href="nu_prints/nu_prints.php" class="link">Printers Management</a>
        </div>
    </div>

    <footer>
        &copy; <?php echo date('Y'); ?> Admin Dashboard. All rights reserved.
    </footer>

<?php
declare(strict_types=1);

// --- DB (SQLite) ---
$dbFile = __DIR__ . '/todo.sqlite';
$pdo = new PDO('sqlite:' . $dbFile);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// --- Create table (ครั้งแรกเท่านั้น) ---
$pdo->exec("
  CREATE TABLE IF NOT EXISTS tasks (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    is_done INTEGER NOT NULL DEFAULT 0,
    created_at TEXT NOT NULL DEFAULT (datetime('now'))
  );
");

// --- Actions ---
$action = $_GET['action'] ?? '';

if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    if ($title !== '') {
        $stmt = $pdo->prepare("INSERT INTO tasks (title) VALUES (:title)");
        $stmt->execute([':title' => $title]);
    }
    header("Location: index.php");
    exit;
}

if ($action === 'toggle') {
    $id = (int)($_GET['id'] ?? 0);
    if ($id > 0) {
        $stmt = $pdo->prepare("UPDATE tasks SET is_done = CASE WHEN is_done=1 THEN 0 ELSE 1 END WHERE id=:id");
        $stmt->execute([':id' => $id]);
    }
    header("Location: index.php");
    exit;
}

if ($action === 'delete') {
    $id = (int)($_GET['id'] ?? 0);
    if ($id > 0) {
        $stmt = $pdo->prepare("DELETE FROM tasks WHERE id=:id");
        $stmt->execute([':id' => $id]);
    }
    header("Location: index.php");
    exit;
}

// --- Fetch tasks ---
$tasks = $pdo->query("SELECT * FROM tasks ORDER BY is_done ASC, id DESC")->fetchAll(PDO::FETCH_ASSOC);

function e(string $s): string { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
?>
<!doctype html>
<html lang="th">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PHP To-Do</title>
  <style>
    body{font-family:system-ui, sans-serif; max-width:720px; margin:40px auto; padding:0 16px;}
    .row{display:flex; gap:8px;}
    input{flex:1; padding:10px; border:1px solid #ccc; border-radius:8px;}
    button{padding:10px 14px; border:0; border-radius:8px; cursor:pointer;}
    ul{list-style:none; padding:0; margin-top:18px;}
    li{display:flex; justify-content:space-between; align-items:center; padding:10px 12px; border:1px solid #eee; border-radius:10px; margin-bottom:10px;}
    .done{text-decoration:line-through; opacity:.6;}
    a{color:#333; text-decoration:none;}
    .actions{display:flex; gap:10px; align-items:center;}
  </style>
</head>
<body>

<h2>To-Do List (PHP + SQLite)</h2>

<form class="row" method="post" action="?action=add">
  <input name="title" placeholder="พิมพ์งานที่ต้องทำ..." required />
  <button type="submit">เพิ่ม</button>
</form>

<ul>
  <?php foreach ($tasks as $t): ?>
    <li>
      <div>
        <a href="?action=toggle&id=<?= (int)$t['id'] ?>">
          <span class="<?= ((int)$t['is_done'] === 1) ? 'done' : '' ?>">
            <?= e($t['title']) ?>
          </span>
        </a>
        <div style="font-size:12px; opacity:.6;">สร้างเมื่อ: <?= e($t['created_at']) ?></div>
      </div>

      <div class="actions">
        <a href="?action=toggle&id=<?= (int)$t['id'] ?>">
          <?= ((int)$t['is_done'] === 1) ? '↩ ยังไม่เสร็จ' : '✅ เสร็จแล้ว' ?>
        </a>
        <a href="?action=delete&id=<?= (int)$t['id'] ?>" onclick="return confirm('ลบรายการนี้?')">🗑 ลบ</a>
      </div>
    </li>
  <?php endforeach; ?>
</ul>

</body>
</html>


</body>
</html>
