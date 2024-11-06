<?php

class User {
    // Properties
    private ?int $u_id;
    private string $username;
    private string $f_name;
    private string $l_name;
    private string $email;
    private string $phone;
    private string $password;
    private string $address;
    private int $status;
    private string $date; // storing timestamp as string

    // Constructor
    public function __construct($u_id, $username, $f_name, $l_name, $email, $phone, $password, $address, $status, $date) {
        $this->u_id = $u_id;
        $this->username = $username;
        $this->f_name = $f_name;
        $this->l_name = $l_name;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
        $this->address = $address;
        $this->status = $status;
        $this->date = $date;
    }

    // Getters and Setters
    public function getUId(): int {
        return $this->u_id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function setUsername(string $username) {
        $this->username = $username;
    }

    public function getFirstName(): string {
        return $this->f_name;
    }

    public function setFirstName(string $f_name) {
        $this->f_name = $f_name;
    }

    public function getLastName(): string {
        return $this->l_name;
    }

    public function setLastName(string $l_name) {
        $this->l_name = $l_name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email) {
        $this->email = $email;
    }

    public function getPhone(): string {
        return $this->phone;
    }

    public function setPhone(string $phone) {
        $this->phone = $phone;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function getAddress(): string {
        return $this->address;
    }

    public function setAddress(string $address): void {
        $this->address = $address;
    }

    public function getStatus(): int {
        return $this->status;
    }

    public function setStatus(int $status): void {
        $this->status = $status;
    }

    public function getDate(): string {
        return $this->date;
    }
}
?>
