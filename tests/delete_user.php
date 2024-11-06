<?php
// Include the User model, UserController, and database connection
include '../models/User.php';
include '../controllers/UserController.php';
include '../connection/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Create UserController instance
    $userController = new UserController($mysqli);

    // Delete the user
    $u_id = $_POST['u_id'];
    if ($userController->deleteUser($u_id)) {
        echo "User deleted successfully!";
    } else {
        echo "Error deleting user.";
    }
}
?>

<form method="POST">
    Enter User ID to Delete: <input type="number" name="u_id" required><br>
    <input type="submit" value="Delete User">
</form>

