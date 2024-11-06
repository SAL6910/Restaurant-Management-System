<?php
// Include the User model, UserController, and database connection

include '../models/User.php';
include '../controllers/UserController.php';
include '../connection/connect.php';

// Create UserController instance
$userController = new UserController($mysqli);

// Fetch all users
$users = $userController->getAllUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
</head>
<body>
    <h1>All Users</h1>

    <?php if (count($users) > 0): ?>
        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user->getUId() ?></td>
                        <td><?= $user->getUsername() ?></td>
                        <td><?= $user->getFirstName() ?></td>
                        <td><?= $user->getLastName() ?></td>
                        <td><?= $user->getEmail() ?></td>
                        <td><?= $user->getPhone() ?></td>
                        <td><?= $user->getAddress() ?></td>
                        <td><?= $user->getStatus() == 1 ? 'Active' : 'Inactive' ?></td>
                        <td><?= $user->getDate() ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>

</body>
</html>

