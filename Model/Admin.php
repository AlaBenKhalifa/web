<?php

class Admin {
  private ?int $idAdmin = null;
  private ?string $firstName = null;
  private ?string $lastName = null;
  private ?string $email = null;
  private ?string $password = null;

  //Construct
  public function __construct(
    $idAdmin,
    $firstName,
    $lastName,
    $email,
    $password,
  ) {
    $this->idAdmin = $idAdmin;
    $this->firstName = $firstName;
    $this->lastName = $lastName;
    $this->email = $email;
    $this->password = $password;
  }

  // Getters
  public function getIdAdmin() {
    return $this->idAdmin;
  }

  public function getFirstName() {
    return $this->firstName;
  }
  public function getLastName() {
    return $this->lastName;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getPassword() {
    return $this->password;
  }

  // Setters
  public function setId($idAdmin) {
    $this->idClient = $idAdmin;
  }

  public function setFirstName($firstName) {
    $this->firstName = $firstName;
  }

  public function setLastName($lastName) {
    $this->lastName = $lastName;
  }

  public function setEmail($email) {
    $this->email = $email;
  }

  public function setPassword($password) {
    $this->password = $password;
  }
}

?>