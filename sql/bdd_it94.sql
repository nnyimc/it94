    -- Création de la base de données it94
CREATE DATABASE IF NOT EXISTS it94;

    --Création de la table infosContacts
CREATE TABLE IF NOT EXISTS infosContacts(
             id INT (4) AUTO_INCREMENT PRIMARY KEY,
			 nom VARCHAR (25) NOT NULL,
			 prenom VARCHAR (25) NOT NULL,
			 societe VARCHAR (25) NOT NULL,
			 telephone VARCHAR (30) NOT NULL,
			 adressemail VARCHAR (40) NOT NULL,
			 message VARCHAR (400) NOT NULL,
			 UNIQUE KEY (nom, prenom)  
);

    -- Création de la table Article
CREATE TABLE IF NOT EXISTS article(
    idArt INT(4) AUTO_INCREMENT, 
    titre VARCHAR(50) NOT NULL, 
    chapeau VARCHAR(120) NOT NULL, 
    motsCles VARCHAR(120) NOT NULL,
    PRIMARY KEY (idArt, motsCles)
);

	-- Création de la table Photo
CREATE TABLE IF NOT EXISTS photo(
    idPht INT(5) AUTO_INCREMENT PRIMARY KEY, 
    nom VARCHAR(30) NOT NULL,
    motsCles VARCHAR(120) NOT NULL,
    idArt INT(4) NOT NULL,
    FOREIGN KEY(idArt, motsCles) REFERENCES article(idArt,motsCles)
);

	-- Création de la table Auteur
CREATE TABLE IF NOT EXISTS auteur(
    idAut INT(2) AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(30) NOT NULL,
    prenom VARCHAR(30) NOT NULL,
    motsCles VARCHAR(120) NOT NULL,
    idArt INT(4) NOT NULL,
    FOREIGN KEY(idArt, motsCles) REFERENCES article(idArt,motsCles)
);

	-- Création de la table Composition
CREATE TABLE IF NOT EXISTS composition(
    idArt INT(4) NOT NULL,
    idPht INT(5) NOT NULL,
    idAut INT(2) NOT NULL,
    parag1 VARCHAR (300) NOT NULL,
    parag2 VARCHAR (300),
    parag3 VARCHAR (300),
    parag4 VARCHAR (300),
    motsCles VARCHAR (120),
    FOREIGN KEY(idArt, motsCles) REFERENCES article(idArt,motsCles)
);