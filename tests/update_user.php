<?php
// Include the User model, UserController, and database connection
include '../models/User.php';
include '../controllers/UserController.php';
include '../connection/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Create UserController instance
    $userController = new UserController($mysqli);

    // Get the user we want to update
    $user = $userController->getUserById($_POST['u_id']);

    if ($user) {
        // Update user data
        $user->setUsername($_POST['username']);
        $user->setFirstName($_POST['f_name']);
        $user->setLastName($_POST['l_name']);
        $user->setEmail($_POST['email']);
        $user->setPhone($_POST['phone']);
        $user->setPassword($_POST['password']);
        $user->setAddress($_POST['address']);
        $user->setStatus($_POST['status']);

        if ($userController->updateUser($user)) {
            echo "User updated successfully!";
        } else {
            echo "Error updating user.";
        }
    } else {
        echo "User not found!";
    }
}

// Fetch the user details for the form
$u_id = 1; // Hardcoded for testing. You can pass this via a form
$userController = new UserController($mysqli);
$user = $userController->getUserById($u_id);
?>

<?php if ($user): ?>
    <form method="POST">
        <input type="hidden" name="u_id" value="<?= $user->getUId() ?>">
        Username: <input type="text" name="username" value="<?= $user->getUsername() ?>" required><br>
        First Name: <input type="text" name="f_name" value="<?= $user->getFirstName() ?>" required><br>
        Last Name: <input type="text" name="l_name" value="<?= $user->getLastName() ?>" required><br>
        Email: <input type="email" name="email" value="<?= $user->getEmail() ?>" required><br>
        Phone: <input type="text" name="phone" value="<?= $user->getPhone() ?>" required><br>
        Password: <input type="password" name="password" required><br>
        Address: <textarea name="address" required><?= $user->getAddress() ?></textarea><br>
        Status: <input type="number" name="status" value="<?= $user->getStatus() ?>" required><br>
        <input type="submit" value="Update User">
    </form>
<?php else: ?>
    <p>User not found.</p>
<?php endif; ?>

