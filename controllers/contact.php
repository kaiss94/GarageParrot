<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $name = $_POST['name'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // Connexion à la base de données
    include_once '../config/connectDbAdmin.php';

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparation de la requête SQL
        $stmt = $pdo->prepare("INSERT INTO contact (name, firstname, email, phone, message) VALUES (:name, :firstname, :email, :phone, :message)");

        // Liaison des paramètres de la requête
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':message', $message);

        // Exécution de la requête
        $stmt->execute();

        // Redirection après l'envoi réussi
        header('Location: ../index.php?addedContact=true');
        exit;
    } catch (PDOException $e) {
        // En cas d'erreur de connexion ou d'exécution de la requête
        echo "Erreur : " . $e->getMessage();
    }
} else {
    // Redirection si le formulaire est accédé directement
    header('Location: ../index.php?addedContact=true');
    exit;
}
