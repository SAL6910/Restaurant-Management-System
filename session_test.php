<?php
// Start the session
session_start();

// Reset the session when the reset link is clicked
if (isset($_GET['reset']) && $_GET['reset'] == 'true') {
    // Unset all session variables
    session_unset();
    
    // Destroy the session
    session_destroy();
    
    // Redirect to avoid reloading the reset link
    header("Location: session_test.php");
    exit(); // Ensure no further code is executed after redirection
}

// Check if the session variable 'visit_count' exists
if (isset($_SESSION['visit_count'])) {
    // Increment the visit count if it already exists
    $_SESSION['visit_count']++;
} else {
    // Initialize the visit count if it doesn't exist
    $_SESSION['visit_count'] = 1;
}

// Display the session value
echo "<p>You have visited this page " . $_SESSION['visit_count'] . " times.</p>";

// Option to clear session
echo "<p><a href='?reset=true'>Reset session</a></p>";
?>
