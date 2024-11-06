<?php
// Include the User model, UserController, and database connection
include '../models/User.php';
include '../controllers/UserController.php';
include '../connection/connect.php';

// Create UserController instance
$userController = new UserController($db);

// Fetch user by ID (change the id as needed for testing)
$u_id = $_GET['id'] ?? '';
$user = $userController->getUserById($u_id);

if ($user) {
    echo "<h2>User Details:</h2>";
    echo "ID: " . $user->getUId() . "<br>";
    echo "Username: " . $user->getUsername() . "<br>";
    echo "First Name: " . $user->getFirstName() . "<br>";
    echo "Last Name: " . $user->getLastName() . "<br>";
    echo "Email: " . $user->getEmail() . "<br>";
    echo "Phone: " . $user->getPhone() . "<br>";
    echo "Address: " . $user->getAddress() . "<br>";
    echo "Status: " . ($user->getStatus() ? "Active" : "Inactive") . "<br>";
    echo "Date: " . $user->getDate() . "<br>";
} else {
    echo "User not found!";
}
?>

