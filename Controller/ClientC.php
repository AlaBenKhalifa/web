<?php

include_once dirname(__FILE__). '/../config.php';

class ClientC {
  public function listClients() {
    $sql = "SELECT * FROM Client";
    $db = config::getConnexion();
    try {
        $liste = $db->query($sql);
        return $liste;
    } catch (Exception $e) {
        die('Error:' . $e->getMessage());
    }
  }

  function showClient($id) {
    $sql = "SELECT * from client where IdClient = $id";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute();

        $client = $query->fetch();
        return $client;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
  }

  function getClientByEmail($email) {
    $sql = "SELECT idClient, email, password, firstname, lastname from client where email = :email";
    $db = config::getConnexion();
    try {
      $query = $db->prepare($sql);
      $query->execute([
        ':email' => $email,
      ]);

      $client = $query->fetch();
      return $client;
    } catch (Exception $e) {
      die('Error: '. $e->getMessage());
    }
  }

  function addClient($client) {
    $sql = "INSERT INTO client 
            VALUES (:id ,:fi, :la, :em, :pass, :p)";
    $db = config::getConnexion();
    try {
      $query = $db->prepare($sql);
      $query->execute([
          ':id' => $client->getIdClient(),

          ':fi' => $client->getFirstName(),
          ':la' => $client->getLastName(),
          ':em' => $client->getemail(),
          ':pass' => $client->getpassword(),
          ':p' => $client->getphone()
      ]);
    } catch (Exception $e) {
      echo 'Error: ' . $e->getMessage();
    }
  }
    
  function updateClient($client, $id) {
    $db = config::getConnexion();
    try {
      $query = $db->prepare(
        "UPDATE client SET
            firstName = :fi, 
            lastName = :la,
            email = :em,
            phone = :p
        WHERE idClient = :id"
      );

      $query->execute([
        'id' => $id,
        'fi' => $client->getFirstName(),
        'la' => $client->getLastName(),
        'em' => $client->getEmail(),
        'p' => $client->getPhone()
      ]);
      $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  function deleteClient($id) {
    $sql = "DELETE FROM client WHERE idClient = :id";
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
