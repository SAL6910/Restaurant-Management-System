<?php

class UserController
{
  private $db;


  public function __construct($db)
  {
    $this->db = $db;
  }


  public function createUser(User $user): bool
  {
    $stmt = $this->db->prepare("
        INSERT INTO users (username, f_name, l_name, email, phone, password, address, status, date)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    if ($stmt === false) {
      echo "Error preparing statement: " . $this->db->error;
      return false;
    }

    $username   = $user->getUsername();
    $fName      = $user->getFirstName();
    $lName      = $user->getLastName();
    $email      = $user->getEmail();
    $phone      = $user->getPhone();
    $password   = password_hash($user->getPassword(), PASSWORD_DEFAULT);
    $address    = $user->getAddress();
    $status     = $user->getStatus();
    $date       = $user->getDate();

    $bind = $stmt->bind_param(
      "sssssssis",
      $username,
      $fName,
      $lName,
      $email,
      $phone,
      $password,
      $address,
      $status,
      $date
    );

    if ($bind === false) {
      echo "Error binding parameters: " . $stmt->error;
      return false;
    }

    if ($stmt->execute()) {
      return true;
    } else {
      echo "Error executing statement: " . $stmt->error;
      return false;
    }
  }

  // Fetch a user by ID
  public function getUserById(int $u_id): ?User
  {
    $stmt = $this->db->prepare("SELECT * FROM users WHERE u_id = ?");
    if ($stmt === false) {
      echo "Error preparing statement: " . $this->db->error;
      return null;
    }

    $stmt->bind_param("i", $u_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
      return new User(
        $row['u_id'],
        $row['username'],
        $row['f_name'],
        $row['l_name'],
        $row['email'],
        $row['phone'],
        $row['password'],
        $row['address'],
        $row['status'],
        $row['date']
      );
    }

    return null; // No user found
  }

  // Fetch all users
  public function getAllUsers(): array
  {
    $stmt = $this->db->prepare("SELECT * FROM users");
    $stmt->execute();
    $result = $stmt->get_result();
    $users = [];

    while ($row = $result->fetch_assoc()) {

      $users[] = new User(
        $row['u_id'],
        $row['username'],
        $row['f_name'],
        $row['l_name'],
        $row['email'],
        $row['phone'],
        $row['password'],
        $row['address'],
        $row['status'],
        $row['date']
      );
    }

    return $users;
  }

  // Update an existing user
  public function updateUser(User $user): bool
  {
    $stmt = $this->db->prepare("
        UPDATE users
        SET username = ?, f_name = ?, l_name = ?, email = ?, phone = ?, password = ?, address = ?, status = ?
        WHERE u_id = ?
    ");

    if ($stmt === false) {
      echo "Error preparing statement: " . $this->db->error;
      return false;
    }

    // Store User values in variables
    $username   = $user->getUsername();
    $fName      = $user->getFirstName();
    $lName      = $user->getLastName();
    $email      = $user->getEmail();
    $phone      = $user->getPhone();
    $password   = password_hash($user->getPassword(), PASSWORD_DEFAULT); // Hash password before saving
    $address    = $user->getAddress();
    $status     = $user->getStatus();
    $uId        = $user->getUId();

    // Bind parameters (s = string, i = integer)
    $bind = $stmt->bind_param(
      "sssssssii",
      $username,
      $fName,
      $lName,
      $email,
      $phone,
      $password,
      $address,
      $status,
      $uId
    );

    if ($bind === false) {
      echo "Error binding parameters: " . $stmt->error;
      return false;
    }

    // Execute and check for success
    if ($stmt->execute()) {
      return true;
    } else {
      echo "Error executing statement: " . $stmt->error;
      return false;
    }
  }

  // Delete a user
  public function deleteUser(int $u_id): bool
  {
    $stmt = $this->db->prepare("DELETE FROM users WHERE u_id = ?");
    if ($stmt === false) {
      echo "Error preparing statement: " . $this->db->error;
      return false;
    }


    $stmt->bind_param("i", $u_id);


    if ($stmt->execute()) {
      return true;
    } else {
      echo "Error executing statement: " . $stmt->error;
      return false;
    }
  }
}
