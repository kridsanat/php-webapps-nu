<?php
session_start();
ob_start();

// Check if user is logged in as administrator
if (empty($_SESSION["useradmin"])) {
    echo "<script>alert('Only Administrator');</script>";
    header("Location: ../index.php");
    exit();
}

$useradmin = $_SESSION["useradmin"];

// Include necessary files
require_once "../include/tdate.php";  // Ensure tdate.php defines $e_date and $etime correctly
require_once "../include/connectdb.php";

// Process file upload if applicable
$photo_1 = "";
if (isset($_FILES["newphoto"]["name"]) && $_FILES["newphoto"]["name"] != "") {
    $name = basename($_FILES['newphoto']['name']);
    $tmp = $_FILES['newphoto']['tmp_name'];
    // Generate unique file name and move the file to the desired location
    $photo_1 = "NEW/" . uniqid() . '_' . $name;
    if (!move_uploaded_file($tmp, $photo_1)) {
        echo "<script>alert('File upload failed');</script>";
        header("Location: ../index.php");
        exit();
    }
}

// Sanitize user input for message
$postmessage = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');

// Retrieve current date and time for the database record
$e_date = date('Y-m-d');
$etime = date('H:i:s');

// Construct SQL INSERT statement
$sql = "INSERT INTO news (topic, newphoto, message, dateregist) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($connect, $sql);
if (!$stmt) {
    die("MySQL prepare statement error: " . mysqli_error($connect));
}

$dateregist = "$e_date $etime";
$topic = $_POST['topic'];  // Getting the topic from POST data
mysqli_stmt_bind_param($stmt, "ssss", $topic, $photo_1, $postmessage, $dateregist);
$result = mysqli_stmt_execute($stmt);

// Check if SQL INSERT was successful
if (!$result) {
    die("Cannot Add Database: " . mysqli_error($connect));
} else {
    echo "<script>alert('News added successfully');</script>";
    header("Location: success_page.php"); // Redirect to a success page or another appropriate page
    exit();
}
?>
