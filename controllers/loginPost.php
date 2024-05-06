<?php
session_start();

include_once '../config/connectDbAdmin.php';

try {
  $pdo = new PDO($dsn, $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //récupérer les données du formulaire de connexion
  $emailForm = $_POST['email'];
  $passwordForm = $_POST['password'];

  //Récupérer les utilisateurs
  $query = "SELECT * FROM users WHERE email = :email";
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(':email', $emailForm);
  $stmt->execute();

  //Est-ce que l'utilisateur (mail) existe ?
  if ($stmt->rowCount() == 1) {
    $monUser = $stmt->fetch(PDO::FETCH_ASSOC);
    if (password_verify($passwordForm, $monUser['password'])) {
      echo "Connexion réussie ! Bienvenue " . $monUser['firstname'] . " " . $monUser['name'];
      //on vérifie alors les rôles
      if ($emailForm === 'vincent.parrot@mongarage.com') {
        //Initialisation de notre session en tant qu'administrateur
        $_SESSION['role'] = 'admin';
        $_SESSION['email'] = $emailForm;
        // création du cookie admin
        setcookie('user', 'admin', time() + 3600, '/');
        // redirection
        header("location: ../views/admin.php");
      } else {
        //Initialisation de notre session en tant que super admin
        $_SESSION['role'] = 'employee';
        $_SESSION['email'] = $emailForm;
        // creation du cookie admin
        setcookie('user', 'employee', time() + 3600, '/');
        //redirection
        header("location: ../views/admin.php");
      }
    } else {
      echo "Mot de passe incorrect";
    }
  } else {
    echo "Utilisateur introuvable, êtes-vous sûr de votre mail ?";
  }
} catch (PDOException $e) {
  echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
