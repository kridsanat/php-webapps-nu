<?php
declare(strict_types=1);

@session_start();
ob_start();

// Start session and check user admin
$useradmin = $_SESSION["useradmin"] ?? '';
if (empty($useradmin)) {
    echo "<script>alert('Only Administrator');</script>";
    header("Location: ../index.php");
    exit();
}

require_once "include/tdate.php";
require_once "include/connectdb.php";

// Query user information (MySQL)
$stmt = $connect->prepare("SELECT * FROM useradmin WHERE useradmin = ?");
$stmt->bind_param("s", $useradmin);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

if (!$result) {
    header("Location: ../index.php");
    exit();
}

$id = (int)($result["id"] ?? 0);
$adminname = htmlspecialchars((string)($result["name"] ?? ''), ENT_QUOTES, 'UTF-8');

// =====================
// TODO APP (SQLite)
// =====================
$dbFile = __DIR__ . '/todo.sqlite';

$pdo = new PDO('sqlite:' . $dbFile, null, null, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

$pdo->exec("
  CREATE TABLE IF NOT EXISTS tasks (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    is_done INTEGER NOT NULL DEFAULT 0,
    created_at TEXT NOT NULL DEFAULT (datetime('now'))
  );
");

$action = $_GET['action'] ?? '';

// --- Add ---
if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    if ($title !== '') {
        $pdoStmt = $pdo->prepare("INSERT INTO tasks (title) VALUES (:title)");
        $pdoStmt->execute([':title' => $title]);
    }
    header("Location: main.php");
    exit;
}

// --- Toggle done ---
if ($action === 'toggle') {
    $taskId = (int)($_GET['id'] ?? 0);
    if ($taskId > 0) {
        $pdoStmt = $pdo->prepare("
            UPDATE tasks
            SET is_done = CASE WHEN is_done = 1 THEN 0 ELSE 1 END
            WHERE id = :id
        ");
        $pdoStmt->execute([':id' => $taskId]);
    }
    header("Location: main.php");
    exit;
}

// --- Delete ---
if ($action === 'delete') {
    $taskId = (int)($_GET['id'] ?? 0);
    if ($taskId > 0) {
        $pdoStmt = $pdo->prepare("DELETE FROM tasks WHERE id = :id");
        $pdoStmt->execute([':id' => $taskId]);
    }
    header("Location: main.php");
    exit;
}

// --- Edit / Update ---
$editingId = 0;

if ($action === 'edit') {
    $editingId = (int)($_GET['id'] ?? 0);
    if ($editingId <= 0) {
        header("Location: main.php");
        exit;
    }
}

if ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskId = (int)($_GET['id'] ?? 0);
    $title  = trim($_POST['title'] ?? '');

    if ($taskId > 0 && $title !== '') {
        $pdoStmt = $pdo->prepare("UPDATE tasks SET title = :title WHERE id = :id");
        $pdoStmt->execute([':title' => $title, ':id' => $taskId]);
    }
    header("Location: main.php");
    exit;
}

// --- Fetch tasks ---
$tasks = $pdo->query("SELECT * FROM tasks ORDER BY is_done ASC, id DESC")->fetchAll();

function e(string $s): string {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
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
            padding-bottom: 80px; /* กัน footer บัง */
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

        /* ===== Todo Section ===== */
        /* หัวข้อรายการ (ลิงก์สีน้ำเงิน) */
/* =========================
   TODO UI (fixed font sizes)
   ========================= */

.todo-section{
  max-width: 860px;
  margin: 10px auto 0;
  background: #fff;
  border: 1px solid #e8e8f0;
  border-radius: 10px;
  padding: 10px;
}

.todo-section h2{
  margin: 0 0 14px;
  font-size: 18px; /* เดิม 1.3em */
}

.todo-row{
  display:flex;
  gap:10px;
}

.todo-row input{
  flex:1;
  padding:10px;
  border:1px solid #ccc;
  border-radius:8px;
  font-size: 14px;
}

.todo-row button{
  padding:10px 14px;
  border:0;
  border-radius:8px;
  cursor:pointer;
  background:#007bff;
  color:#fff;
  font-size: 14px;
}

.todo-list{
  list-style:none;
  padding:0;
  margin:10px 0 0;
}

.todo-item{
  display:flex;
  justify-content:space-between;
  align-items:center;
  padding:10px 12px;
  border:1px solid #eee;
  border-radius:10px;
  margin-bottom:10px;
  gap: 12px;
}

/* ฝั่งซ้าย (ชื่อ + meta) */
.todo-title,
.todo-title a,
.todo-item a{
  font-size: 11px !important;
}

.todo-meta{
  font-size: 11px;
  opacity: .6;
  margin-top: 2px;
}

/* ทำเสร็จแล้ว */
.todo-done{
  text-decoration: line-through;
  opacity:.6;
}

/* ฝั่งขวา (action buttons) */
.todo-actions{
  display:flex;
  gap:10px;
  align-items:center;
  flex-wrap: wrap;
  white-space: nowrap;
}

.todo-actions a{
  color:#333;
  text-decoration:none;
  font-size: 12px;
  font-weight: 500;
}
.todo-actions a:hover{
  text-decoration: underline;
}

/* ปุ่มยกเลิก (ถ้ามีใช้) */
.todo-cancel{
  text-decoration:none;
  padding:10px 12px;
  display:inline-block;
  font-size: 12px;
}

footer{
  text-align: center;
  padding: 10px;
  background-color: #007bff;
  color: white;
  position: fixed;
  bottom: 0;
  width: 100%;
}

/* Mobile */
@media (max-width: 768px){
  .todo-row{flex-direction:column;}
  .todo-row button{width:100%;}
  .todo-section h2{font-size: 16px;}
  .todo-actions a{font-size: 11px;}
  .todo-title a{font-size: 9px;}
  .todo-meta{font-size: 10px;}
}
    </style>
</head>
<body>
    <header>
        <h1>ยินดีตอนรับเข้าสู่ระบบ คุณ <font face='tahoma' color='#FFD700' size='+3'><b><?php echo $adminname; ?>!</b></font></h1>

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

        <!-- Todo List -->
        <div class="todo-section">
            <h2>To-Do List</h2>

            <form class="todo-row" method="post" action="?action=add">
                <input name="title" placeholder="พิมพ์งานที่ต้องทำ..." required />
                <button type="submit">เพิ่ม</button>
            </form>

            <ul class="todo-list">
                <?php foreach ($tasks as $t): ?>
                    <?php $isEditing = ($editingId === (int)$t['id']); ?>
                    <li class="todo-item">
                        <div style="flex:1;">
                            <?php if ($isEditing): ?>
                                <form class="todo-row" method="post" action="?action=update&id=<?= (int)$t['id'] ?>">
                                    <input name="title" value="<?= e((string)$t['title']) ?>" required />
                                    <button type="submit">บันทึก</button>
                                    <a class="todo-cancel" href="main.php">ยกเลิก</a>
                                </form>
                                <div class="todo-meta">สร้างเมื่อ: <?= e((string)$t['created_at']) ?></div>
                            <?php else: ?>
                                <a href="?action=toggle&id=<?= (int)$t['id'] ?>">
                                    <span class="<?= ((int)$t['is_done'] === 1) ? 'todo-done' : '' ?>">
                                        <?= e((string)$t['title']) ?>
                                    </span>
                                </a>
                                <div class="todo-meta">สร้างเมื่อ: <?= e((string)$t['created_at']) ?></div>
                            <?php endif; ?>
                        </div>
<br><br>
                        <?php if (!$isEditing): ?>
                            <div class="todo-actions">
                                <a href="?action=edit&id=<?= (int)$t['id'] ?>">✏️ แก้ไข</a>
                                <a href="?action=toggle&id=<?= (int)$t['id'] ?>">
                                    <?= ((int)$t['is_done'] === 1) ? '↩ ยังไม่เสร็จ' : '✅ เสร็จแล้ว' ?>
                                </a>
                                <a href="?action=delete&id=<?= (int)$t['id'] ?>" onclick="return confirm('ลบรายการนี้?')">🗑 ลบ</a>
                            </div>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <footer>
        &copy; <?php echo date('Y'); ?> Admin Dashboard. All rights reserved.
    </footer>
</body>
</html>
