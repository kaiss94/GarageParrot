<?php

// Connexion à la base de données
$dsn = 'mysql:host=localhost;dbname=GarageParrot';
$username = 'visitor';
$password = '3f7zhhRn4NH69R';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
    exit();
}