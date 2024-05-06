<?php

class Car
{
  private $id;
  private $brand;
  private $model;
  private $mileage;
  private $kilometers;
  private $price;
  private $engine;
  private $description;
  private $pictureLocation;
  private $pdo;

  public function __construct($id, $brand, $model, $mileage, $kilometers, $price, $engine, $description, $pictureLocation)
  {
    $this->id = $id;
    $this->brand = $brand;
    $this->model = $model;
    $this->mileage = $mileage;
    $this->kilometers = $kilometers;
    $this->price = $price;
    $this->engine = $engine;
    $this->description = $description;
    $this->pictureLocation = $pictureLocation;


    // Connexion à la base de données
    include_once 'connectDbAdmin.php';

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

  public function getBrand()
  {
    return $this->brand;
  }

  public function getModel()
  {
    return $this->model;
  }

  public function getmileage()
  {
    return $this->mileage;
  }

  public function getKilometers()
  {
    return $this->kilometers;
  }

  public function getPrice()
  {
    return $this->price;
  }

  public function getEngine()
  {
    return $this->engine;
  }
  public function getDescription()
  {
    return $this->description;
  }

  public function getPictureLocation()
  {
    return $this->pictureLocation;
  }

  // Méthode pour enregistrer la voiture dans la base de données
  public function saveToDatabaseCars()
  {
    $stmt = $this->pdo->prepare('INSERT INTO cars (brand, model, mileage, kilometers, price, engine, description, pictureLocation) VALUES (:brand, :model, :mileage, :kilometers, :price, :engine, :description, :pictureLocation)');
    $stmt->execute([
      'brand' => $this->brand,
      'model' => $this->model,
      'mileage' => $this->mileage,
      'kilometers' => $this->kilometers,
      'price' => $this->price,
      'engine' => $this->engine,
      'description' => $this->description,
      'pictureLocation' => $this->pictureLocation
    ]);
  }
}
