<?php
// Redirect to index.php after 2 seconds
header("refresh:2;url=index.php");

// Now you can output the HTML
echo "<p>HELLO</p>";

// Optionally, you can exit to prevent further code execution
exit();
?>

