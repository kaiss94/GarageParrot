<?php

class Review
{
  private $reviewId;
  private $clientName;
  private $comment;
  private $rate;
  private $date;
  private $pdo;

  public function __construct($reviewId, $clientName, $comment, $rate, $date)
  {
    $this->reviewId = $reviewId;
    $this->clientName = $clientName;
    $this->comment = $comment;
    $this->rate = $rate;
    $this->date = $date;


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

  // Méthodes pour accéder aux propriétés
  public function getreviewId()
  {
    return $this->reviewId;
  }

  public function getclientName()
  {
    return $this->clientName;
  }

  public function getComment()
  {
    return $this->comment;
  }

  public function getrate()
  {
    return $this->rate;
  }

  public function getdate()
  {
    return $this->date;
  }

  // Méthode pour enregistrer le service dans la base de données
  public function saveToDatabase()
  {
    $stmt = $this->pdo->prepare('INSERT INTO reviews  (clientName, comment, rate, date) VALUES (:clientName, :comment, :rate, :date)');
    $stmt->execute([
      'clientName' => $this->clientName,
      'comment' => $this->comment,
      'rate' => $this->rate,
      'date' => $this->date
    ]);
  }
}
