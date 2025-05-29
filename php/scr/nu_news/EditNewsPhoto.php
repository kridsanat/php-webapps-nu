<form method="post" action="EditNewsPhotoSave.php" enctype="multipart/form-data">
  <tr bgcolor="#FFFFFF"> 
    <td width="151" valign="top"> 
      <div align="right"><font size="2">Picture:</font></div>
    </td>
    <td width="558">
      <br>
      <?php 
        if ($newphoto >= 100){
          echo "<img src='NEW/$newphoto' width='120' height='120' border='1'><br><br>";
        }
      ?>
      <input name="newphoto" type="file" class="input" id="newphoto" size="40">
      <br><br>

      <!-- ส่งข้อมูลเดิมกลับไปแบบ hidden -->
      <input type="hidden" name="idx" value="<?php echo $idxx; ?>">
      <input type="hidden" name="topic" value="<?php echo htmlspecialchars($topic, ENT_QUOTES, 'UTF-8'); ?>">
      <input type="hidden" name="message" value="<?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>">

      <font size="2" color="red"><b>หน้านี้สำหรับเปลี่ยนเฉพาะรูปภาพเท่านั้น</b></font>
      <br><br>
    </td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td valign="top">&nbsp;</td>
    <td>
      <input name="submit" type="submit" class="submit" value="Submit" onClick="return confirm('เปลี่ยนรูปภาพใช่หรือไม่?')">
      &nbsp;&nbsp;&nbsp;&nbsp;
      <a href="newmain.php"><font face="tahoma">Cancel</font></a>
    </td>
  </tr>
</form>
