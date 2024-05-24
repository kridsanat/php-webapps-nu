<?php
session_start();
ob_start();
$useradmin = $_SESSION["useradmin"];
if (empty($useradmin)) {
    echo "<script>alert('Only Administrator');</script>";
    header("Location: ../index.php");
    exit();
}

require_once "../include/tdate.php";  // Ensure $e_date is defined in this file
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($headtxt_web); ?></title>
    <meta http-equiv="refresh" content="900;url=../logout.php" />
    <!-- Add appropriate links to CSS and other resources -->
</head>
<body>
<div align="center">
    <h2>News Management</h2>
    <script language="JavaScript">
        function checksearch() {
            var news1 = document.webFormSearch.topic.value;
            var news2 = document.webFormSearch.message.value;

            if (news1.length === 0) {
                alert("Please enter a title");
                document.webFormSearch.topic.focus();
                return false;
            } else if (news2.length === 0) {
                alert("Please enter details");
                document.webFormSearch.message.focus();
                return false;
            } else {
                return true;
            }
        }
    </script>

    <form method="post" action="NewsSave.php" enctype="multipart/form-data" name="webFormSearch" onsubmit="return checksearch()">
        <table border="0" align="center" cellpadding="1" cellspacing="1">
            <tr>
                <td align="right">Title:</td>
                <td><input name="topic" type="text" id="topic" size="120" value="Nutrition Profess | "></td>
            </tr>
            <tr>
                <td align="right">Picture:</td>
                <td><input name="newphoto" type="file" id="newphoto" size="40"></td>
            </tr>
            <tr>
                <td align="right" valign="top">Detail:</td>
                <td>
                    <textarea name="message" cols="180" rows="30" id="message"></textarea>
                    <br><br>
                    Update on: <input name="update" type="text" id="update" size="12" value="<?php echo $e_date; ?>" readonly>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input name="submit" type="submit" value="Submit" onclick="return confirm('Are you sure?')">
                    <a href="newmain.php">Cancel</a>
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>
