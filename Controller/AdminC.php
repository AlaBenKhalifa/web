<?php

include_once dirname(__FILE__). '/../config.php';

class AdminC {
  public function listAdmin() {
    $sql = "SELECT * FROM admin";
    $db = config::getConnexion();
    try {
      $query = $db->prepare($sql);
      $query->execute();
      $admin = $query->fetch();
      
      return $admin;
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
  }

  function showAdmin($id) {
    $sql = "SELECT * from admin where idAdmin = $id";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute();

        $admin = $query->fetch();
        return $admin;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
  }

  function getAdminByEmail($email) {
    $sql = "SELECT idAdmin, email, password, firstName, lastName from admin where email = :email";
    $db = config::getConnexion();
    try {
      $query = $db->prepare($sql);
      $query->execute([
        ':email' => $email,
      ]);

      $admin = $query->fetch();
      return $admin;
    } catch (Exception $e) {
      die('Error: '. $e->getMessage());
    }
  }

  function addAdmin($admin) {
    $sql = "INSERT INTO admin 
            VALUES (:ida ,:fia, :laa, :ema, :passa)";
    $db = config::getConnexion();
    try {
      $query = $db->prepare($sql);
      $query->execute([
        ':ida' => $admin->getIdAdmin(),
        ':fia' => $admin->getFirstName(),
        ':laa' => $admin->getLastName(),
        ':ema' => $admin->getEmail(),
        ':passa' => $admin->getPassword(),
      ]);
    } catch (Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }
    
  function updateAdmin($admin, $id) {
    $db = config::getConnexion();
    try {
      $query = $db->prepare(
        "UPDATE admin SET
            firstName = :fia, 
            lastName = :laa,
            email = :ema
        WHERE idAdmin = :ida"
      );

      $query->execute([
        'ida' => $id,
        'fia' => $admin->getFirstName(),
        'laa' => $admin->getLastName(),
        'ema' => $admin->getEmail(),
      ]);
      $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  function deleteAdmin($id) {
    $sql = "DELETE FROM admin WHERE idadmin = :id";
    $db = config::getConnexion();

    try {
      $req = $db->prepare($sql);
      $req->bindValue(':id', $id);
      $req->execute();
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
  }
}
