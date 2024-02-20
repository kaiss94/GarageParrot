<?php

class Service
{
  private $id;
  private $name;
  private $description;
  private $location;
  private $pdo;

  public function __construct($id, $name, $description, $location)
  {
    $this->id = $id;
    $this->name = $name;
    $this->description = $description;
    $this->location = $location;


    // Connexion à la base de données
    $dsn = 'mysql:host=localhost;dbname=GarageParrot';
    $username = 'vincent_parrot';
    $password = '3f7zhhRn4NH69R';

    try {
      $this->pdo = new PDO($dsn, $username, $password);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo 'Erreur de connexion : ' . $e->getMessage();
      exit();
    }
  }

  // Méthodes pour accéder aux propriétés
  public function getId()
  {
    return $this->id;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getDescription()
  {
    return $this->description;
  }

  public function getlocation()
  {
    return $this->location;
  }

  // Méthode pour enregistrer le service dans la base de données
  public function saveToDatabase()
  {
    $stmt = $this->pdo->prepare('INSERT INTO services (serviceName, description, location) VALUES (:name, :description, :location)');
    $stmt->execute([
      'name' => $this->name,
      'description' => $this->description,
      'location' => $this->location
    ]);
  }
}
