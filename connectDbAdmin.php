<?php

// Connexion à la base de données avec les droits admin
$dsn = 'mysql:host=localhost;dbname=GarageParrot';
$username = 'vincent_parrot';
$password = '3f7zhhRn4NH69R';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
    exit();
}