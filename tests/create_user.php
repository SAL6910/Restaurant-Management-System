<?php
// Include the User model, UserController, and database connection
include '../models/User.php';
include '../controllers/UserController.php';
include '../connection/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Create UserController instance
    $userController = new UserController($db);

    // Create a new User instance with the form data
    $user = new User(
        null, // u_id will be auto-incremented
        $_POST['username'],
        $_POST['f_name'],
        $_POST['l_name'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['password'],
        $_POST['address'],
        1, // status set as active (1)
        date('Y-m-d H:i:s') // current timestamp
    );

    // Call createUser method
    if ($userController->createUser($user)) {
        echo "User created successfully!";
    } else {
        echo "Error creating user.";
    }
}
?>

<form method="POST">
    Username: <input type="text" name="username" required><br>
    First Name: <input type="text" name="f_name" required><br>
    Last Name: <input type="text" name="l_name" required><br>
    Email: <input type="email" name="email" required><br>
    Phone: <input type="text" name="phone" required><br>
    Password: <input type="password" name="password" required><br>
    Address: <textarea name="address" required></textarea><br>
    <input type="submit" value="Create User">
</form>

