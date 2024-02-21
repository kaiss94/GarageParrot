<?php
include_once 'connectDbAdmin.php';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Récupérer les données du formulaire d’inscription
    $nameForm = $_POST['name'];
    $firstnameForm = $_POST['firstname'];
    $emailForm = $_POST['email'];
    $passwordForm = $_POST['password'];

    //Vérifier l’unicité de l’adresse mail
    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $emailForm);
    $stmt->execute();

    //Est-ce que l’utilisateur (mail) existe ?
    if ($stmt->rowCount() > 0) {
        die("Cette adresse email est déjà utilisée");
    }

    // Hashage(encryptage)
    $hashedPassword = password_hash($passwordForm, PASSWORD_DEFAULT);
    //Insérer les données dans la base
    $insertQuery = "INSERT INTO users (name, firstname, email, password) VALUES (:name, :firstname, :email, :password)";
    $stmt = $pdo->prepare($insertQuery);
    $stmt->bindParam(':name', $nameForm);
    $stmt->bindParam(':firstname', $firstnameForm);
    $stmt->bindParam(':email', $emailForm);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->execute();
    echo "Inscription réussie";
} catch (PDOException $e) {
    echo "Erreur lors de l’inscription : " . $e->getMessage();
}
