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

// Retrieve user inputs and escape them
$topic = mysqli_real_escape_string($connect, $_POST['topic']);
$postmessage = mysqli_real_escape_string($connect, $_POST['message']);

if($_FILES["newphoto"]["name"] != "")
{
    // Handle file upload
    $name = $_FILES['newphoto']['name'];
    $tmp = $_FILES['newphoto']["tmp_name"];
    $date_time = date("Y-m-d H:i:s");
    $oldname = explode(".", $name);
    $ext = "." . end($oldname);
    $photo_1 = date('YmdHis') . $ext;
    copy($tmp, "NEW/" . $photo_1);
}
else
{
    $photo_1 = "";
}

// Prepare the SQL statement
$insert = "INSERT INTO news (topic, newphoto, message, dateregist) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($connect, $insert);

if (!$stmt) {
    die("Error in preparing statement: " . mysqli_error($connect));
}

// Bind parameters and execute the statement
$dateregist = $e_date.$etime;
mysqli_stmt_bind_param($stmt, "ssss", $topic, $photo_1, $postmessage, $dateregist);

$result = mysqli_stmt_execute($stmt);

if (!$result) {
    die("Error in executing statement: " . mysqli_stmt_error($stmt));
}

// Close the statement
mysqli_stmt_close($stmt);

// Redirect after insertion
header("Location: newmain.php");
exit();
?>


<html>
<head>
<title><? echo "$headtxt"; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<meta http-equiv="refresh" content="900;url=../logout.php" />

<!-- Fireworks MX Dreamweaver MX target.  Created Sat Apr 02 10:29:23 GMT+0700 (SE Asia Standard Time) 2011-->
<link href="css/style.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="3;URL=newmain.php">
</head>
<body bgcolor="#ffffff">
<div align="center"> 

            <table width="100%" border="0" cellspacing="1" cellpadding="1">
                <tr> 
                    <td>
						<div align="center">
						<br>
                        <br>	
		<img src="../images/ajax-loader.gif" width="" height="">			
                        <br>
                        <br>
        <font color="#003366" size="2">Complated</font>
						<br>
						<br> 
		<font size="2">Please Wait...</font>
						<br>
                        <br>
                        <br>
                        <br>
                        <br>
						
						</div>
					</td>
                </tr>
            </table>
</div>
</body>
</html>
