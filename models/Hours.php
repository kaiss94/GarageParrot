<?php

class Hours
{
  private $id;
  private $lundiAuVendredi;
  private $samedi;
  private $dimanche;
  private $pdo;

  public function __construct($id, $lundiAuVendredi, $samedi, $dimanche)
  {
    $this->id = $id;
    $this->lundiAuVendredi = $lundiAuVendredi;
    $this->samedi = $samedi;
    $this->dimanche = $dimanche;


    // Connexion à la base de données
    include_once '../config/connectDbAdmin.php';

    try {
      $this->pdo = new PDO($dsn, $username, $password);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo 'Erreur de connexion : ' . $e->getMessage();
      exit();
    }
  }


  // Méthode pour enregistrer le service dans la base de données
  public function saveToDatabase()
  {
    $stmt = $this->pdo->prepare('UPDATE openingHours SET lundiAuVendredi = :lundiAuVendredi, samedi = :samedi, dimanche = :dimanche WHERE id = 1');
    $stmt->execute([
      'lundiAuVendredi' => $this->lundiAuVendredi,
      'samedi' => $this->samedi,
      'dimanche' => $this->dimanche
    ]);
  }
}
