<?php
session_start();

include_once '../config/connectDbAdmin.php';

// Utiliser HTTPS pour chiffrer les données transmises
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
  //laisser commenté en local
    header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    exit();
}

// Limite les tentatives de connexion pour prévenir les attaques par force brute
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

if ($_SESSION['login_attempts'] >= 5) {
    die('Trop de tentatives de connexion. Veuillez réessayer plus tard.');
}

// Fonction pour valider et nettoyer les données d'entrée
function clean_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier le jeton CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Invalid CSRF token.");
    }

    // Récupérer les données du formulaire de connexion
    $emailForm = clean_input($_POST['email']);
    $passwordForm = clean_input($_POST['password']);

    // Vérifier que les champs ne sont pas vides
    if (empty($emailForm) || empty($passwordForm)) {
        die("Adresse email ou mot de passe vide.");
    }

    // Récupérer les utilisateurs
    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $emailForm);
    $stmt->execute();

    // Est-ce que l'utilisateur (mail) existe ?
    if ($stmt->rowCount() == 1) {
        $monUser = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($passwordForm, $monUser['password'])) {
            echo "Connexion réussie ! Bienvenue " . htmlspecialchars($monUser['firstname']) . " " . htmlspecialchars($monUser['name']);
            // Réinitialiser le compteur de tentatives de connexion
            $_SESSION['login_attempts'] = 0;

            // Initialisation de notre session en tant qu'administrateur ou employé
            $_SESSION['role'] = ($emailForm === 'vincent.parrot@mongarage.com') ? 'admin' : 'employee';
            $_SESSION['email'] = $emailForm;

            // Création du cookie sécurisé
            setcookie('user', $_SESSION['role'], time() + 3600, '/', '', true, true); // Secure et HttpOnly

            // Régénérer l'ID de session pour prévenir les attaques de fixation de session
            session_regenerate_id();

            // Redirection
            header("Location: ../views/admin.php");
            exit();
        } else {
            $_SESSION['login_attempts']++;
            die("Mot de passe incorrect.");
        }
    } else {
        $_SESSION['login_attempts']++;
        die("Utilisateur introuvable, êtes-vous sûr de votre mail ?");
    }
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
