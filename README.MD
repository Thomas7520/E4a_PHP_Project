# Projet Genshin DB

Cette application web permet de gérer des personnages de type Genshin Impact avec des paramètres comme les éléments, les classes et les origines. Elle inclut un système d'authentification pour accéder aux pages "admin" et un système de logs pour suivre les actions effectuées.

---

## Installation et configuration

1. **Base de données :**

    * Créez une base de données MySQL nommée `genshin_db`.
    * Exécutez le script SQL suivant pour créer les tables et insérer les données de base :

```sql
CREATE DATABASE IF NOT EXISTS genshin_db
    DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;

USE genshin_db;

DROP TABLE IF EXISTS PERSONNAGE;
DROP TABLE IF EXISTS ELEMENT;
DROP TABLE IF EXISTS ORIGIN;
DROP TABLE IF EXISTS UNITCLASS;
DROP TABLE IF EXISTS USERS;

CREATE TABLE IF NOT EXISTS ELEMENT (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    url_img VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS ORIGIN (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    url_img VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS UNITCLASS (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    url_img VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS PERSONNAGE (
    id VARCHAR(50) NOT NULL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    element INT NOT NULL,
    unitclass INT NOT NULL,
    origin INT,
    rarity INT NOT NULL,
    url_img VARCHAR(255) NOT NULL,

    CONSTRAINT fk_element FOREIGN KEY (element) REFERENCES ELEMENT(id)
        ON DELETE CASCADE ON UPDATE CASCADE,

    CONSTRAINT fk_unitclass FOREIGN KEY (unitclass) REFERENCES UNITCLASS(id)
        ON DELETE CASCADE ON UPDATE CASCADE,

    CONSTRAINT fk_origin FOREIGN KEY (origin) REFERENCES ORIGIN(id)
        ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE USERS (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL UNIQUE,
    hash_pwd VARCHAR(255) NOT NULL
);
```

__2. **Inserts de base :**__
   Les tables `ELEMENT`, `ORIGIN`, `UNITCLASS` et `PERSONNAGE` contiennent des valeurs initiales pour tester l'application (exemples d'éléments, origines, classes et personnages).

---

## Création de comptes

Pour créer un compte admin :

* Dans `index.php`, **décommentez** la ligne permettant la création de comptes.
* Lancez la page une fois pour créer le compte.
* Une fois le compte créé, vous pouvez remettre la ligne commentée pour la sécurité.

---

## Configuration

1. Remplissez le fichier `dev.ini` avec les informations de connexion à votre base MySQL :

```ini
dsn = "mysql:host=localhost;dbname=genshin_db;charset=utf8"
user = "votre_utilisateur"
pass = "votre_mot_de_passe"
```

---

## Fonctionnalités

* Consulter la liste des personnages.
* Ajouter, modifier et supprimer des personnages.
* Ajouter des éléments, classes et origines.
* Authentification pour sécuriser l'accès aux pages admin.
* Suivi des actions avec le système de logs.

---

## Lancer le projet

* Lancez le serveur PHP ou utilisez un live server.
* Accédez à `index.php` depuis votre navigateur.

---
