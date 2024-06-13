<?php
// Set the path to your batch file
$batchFile = 'C:\\check password exprice input.bat';

// Escape the command to ensure it's safe to run
$escapedCommand = escapeshellcmd($batchFile);

// Execute the batch file
$output = shell_exec($escapedCommand);

// Output the result
echo nl2br($output);
?>
