-- Création de la base de données
CREATE DATABASE GarageParrot;

-- Utilisation de la base de données
USE GarageParrot;

-- Création de la table "users" pour stocker les informations des employées du garage
CREATE TABLE users (
  userId integer AUTO_INCREMENT PRIMARY KEY,
  name varchar(100) NOT NULL,
  firstname varchar(100) NOT NULL,
  email varchar(255) NOT NULL UNIQUE,
  password varchar(255) NOT NULL
);


-- Création de la table "cars" pour stocker les informations des voitures d'occasion
CREATE TABLE cars (
  carId integer AUTO_INCREMENT PRIMARY KEY,
  brand varchar(100) NOT NULL,
  model varchar(100) NOT NULL,
  mileage integer(4) NOT NULL,
  kilometers integer(7) NOT NULL,
  price integer(8) NOT NULL,
  engine varchar(20) NOT NULL,
  description text (300) NOT NULL,
  pictureLocation varchar(250)
);

-- Création de la table "reviews" pour stocker les informations des avis clients
CREATE TABLE reviews (
  reviewId integer AUTO_INCREMENT PRIMARY KEY,
  clientName varchar(100) NOT NULL,
  comment text(500) NOT NULL,
  rate integer(2) NOT NULL,
  date Datetime NOT NULL,
  validated boolean DEFAULT FALSE
);

-- Création de la table "Services" pour stocker les informations des différents services proposés
CREATE TABLE services (
  serviceId integer AUTO_INCREMENT PRIMARY KEY,
  serviceName varchar(250) NOT NULL,
  description text(500),
  location varchar(250) 
);

-- Création de la table "openingHours" pour stocker les horaires d'ouverture du garage
CREATE TABLE openinghours (
  id integer PRIMARY KEY UNIQUE,
  lundiAuVendredi varchar(50) NOT NULL,
  samedi varchar(100) NOT NULL,
  dimanche varchar(255) NOT NULL
);

-- Création de la table "contact" pour stocker les messages de contact
CREATE TABLE contact (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  firstname VARCHAR(100) NOT NULL,
  email VARCHAR(255) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  message TEXT NOT NULL,
  date_time DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Création de l’administrateur mysql Vincent Parrot
CREATE USER 'vincent_parrot'@'localhost' IDENTIFIED BY '3f7zhhRn4NH69R';

-- Attribution des droits sur toutes les tables de la database GarageParrot
GRANT SELECT, INSERT, UPDATE, DELETE ON GarageParrot.* TO 'vincent_parrot'@'localhost';

-- Création du profil visitor mysql pour lire les données
CREATE USER 'visitor'@'localhost' IDENTIFIED BY '3f7zhhRn4NH69R';

-- Attribution du droit de lecture uniquement sur les tables cars, reviews et services de la database GarageParrot
GRANT SELECT ON GarageParrot.cars TO 'visitor'@'localhost';
GRANT SELECT ON GarageParrot.reviews TO 'visitor'@'localhost';
GRANT SELECT ON GarageParrot.services TO 'visitor'@'localhost';
GRANT SELECT ON GarageParrot.openinghours TO 'visitor'@'localhost';

-- Création du compte utilisateur de Vincent Parrot (mot de passe : password123)
INSERT INTO users (name, firstname, email, password)
VALUES ('Parrot', 'Vincent', 'vincent.parrot@mongarage.com', '$2y$10$hv2m6oFnpMs6sZmpyNK1r.iWEJO/CU96h7b95VjYCC5Msw.lGdn8G');

-- Création du compte utilisateur de l'employé José Fereira (mot de passe : password123)
INSERT INTO users (name, firstname, email, password)
VALUES ('Fereira', 'José', 'jose.fereira@mongarage.com', '$2y$10$VsRmVHr9HnLLgR3K93xeEupAE74EoYcesMQApq/Rp43/n9PFgXZJi');

-- Création des horaires
INSERT INTO openingHours (id, lundiAuVendredi, samedi, dimanche)
VALUES (1, '08:45-12:00, 14:00-18:00', '08:45-12:00', 'fermé');

-- Création des voitures
INSERT INTO cars (brand, model, mileage, kilometers, price, engine, description, pictureLocation)
VALUES 
('RENAULT', 'CLIO', 2010, 109000, 8500, 'DIESEL', '1.5 dCi 90cv', 'uploads/cars/clio3.jpg'),
('CITROEN', 'C-CROSS', 2014, 89000, 6700, 'DIESEL', '1.6 hdi 92cv', 'uploads/cars/citroen.jpeg'),
('CITROEN', 'PICASSO', 2004, 288000, 1750, 'ESSENCE', '2l 16v', 'uploads/cars/picasso.jpg'),
('VOLKSWAGEN', 'PASSAT', 2017, 68000, 25000, 'ESSENCE', '1.4 TSI 150cv', 'uploads/cars/passat.jpg');

-- Création des avis
INSERT INTO reviews (clientName, comment, rate, date, validated)
VALUES
('Esma M.', 'Prestation au top ! Bon accueil et intervention efficace.', 5,'2024-02-19 00:00:00', 1),
('Laure D.', 'Super mécanos !', 5,'2024-02-16 00:00:00', 0),
('Mickaël F.', 'Carrosserie impeccable !', 5,'2024-02-15 00:00:00', 1),
('dsfsff', 'commentaire à supprimer', 3,'2024-02-16 00:00:00', 0);

-- Création des services
INSERT INTO services (serviceName, description, location)
VALUES
('Carrosserie', "Peintures Réparations Pare-brise Remplacement d'éléments","uploads/services/carrosserie.jpg"),
('Courroie de distribution', 'Remplacement de la courroie de distribution',"uploads/services/distributionCourroie.jpg"),
('Pneus', "Remplacement des pneus. Equilibrage. Parallélisme.","uploads/services/pneus.jpg"),
('Vidange', "Vidange huile moteur. Remplacement des filtres.","uploads/services/vidange.jpg"),
('Freinage', "Remplacement des disques et plaquettes.","uploads/services/freinage.jpg");