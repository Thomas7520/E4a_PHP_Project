# Projet Genshin DB/PHP

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
 
    CONSTRAINT fk_element
        FOREIGN KEY (element) REFERENCES ELEMENT(id)
        ON DELETE CASCADE ON UPDATE CASCADE,
 
    CONSTRAINT fk_unitclass
        FOREIGN KEY (unitclass) REFERENCES UNITCLASS(id)
        ON DELETE CASCADE ON UPDATE CASCADE,
 
    CONSTRAINT fk_origin
        FOREIGN KEY (origin) REFERENCES ORIGIN(id)
        ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO ELEMENT (name, url_img) VALUES
('Pyro','https://static.wikia.nocookie.net/gensin-impact/images/e/e8/Element_Pyro.png'),
('Hydro','https://static.wikia.nocookie.net/gensin-impact/images/3/35/Element_Hydro.png'), 
('Cryo','https://static.wikia.nocookie.net/gensin-impact/images/8/88/Element_Cryo.png'), 
('Electro','https://static.wikia.nocookie.net/gensin-impact/images/7/73/Element_Electro.png'), 
('Geo','https://static.wikia.nocookie.net/gensin-impact/images/4/4a/Element_Geo.png'), 
('Anemo','https://static.wikia.nocookie.net/gensin-impact/images/a/a4/Element_Anemo.png');

INSERT INTO ORIGIN (name, url_img) VALUES 
('Mondstadt','https://static.wikia.nocookie.net/gensin-impact/images/c/ce/Mondstadt_Emblem_Night.png'), 
('Liyue','https://static.wikia.nocookie.net/gensin-impact/images/c/c3/Liyue_Emblem_Night.png'), 
('Inazuma','https://static.wikia.nocookie.net/gensin-impact/images/a/a5/Inazuma_Emblem_Night.png'), 
('Sumeru','https://static.wikia.nocookie.net/gensin-impact/images/e/ef/Sumeru_Emblem_Night.png'), 
('Fontaine','https://static.wikia.nocookie.net/gensin-impact/images/0/06/Fontaine_Emblem_Night.png');

INSERT INTO UNITCLASS (name, url_img) VALUES 
('Sword','https://static.wikia.nocookie.net/gensin-impact/images/9/95/Weapon-class-sword-icon.png'), 
('Claymore','https://static.wikia.nocookie.net/gensin-impact/images/5/51/Weapon-class-claymore-icon.png'), 
('Polearm','https://static.wikia.nocookie.net/gensin-impact/images/9/91/Weapon-class-polearm-icon.png'), 
('Bow','https://static.wikia.nocookie.net/gensin-impact/images/9/97/Weapon-class-bow-icon.png'),
('Catalyst','https://static.wikia.nocookie.net/gensin-impact/images/0/02/Weapon-class-catalyst-icon.png');

INSERT INTO PERSONNAGE (id, name, element, unitclass, origin, rarity, url_img) VALUES 
('p1', 'Amber', 1, 4, 1, 4, 'https://static.wikia.nocookie.net/gensin-impact/images/7/75/Amber_Icon.png'), 
('p2', 'Diluc', 1, 2, 1, 5, 'https://static.wikia.nocookie.net/gensin-impact/images/3/3d/Diluc_Icon.png'), 
('p3', 'Mona', 2, 5, 1, 5, 'https://static.wikia.nocookie.net/gensin-impact/images/4/41/Mona_Icon.png'), 
('p4', 'Kaeya', 3, 1, 1, 4, 'https://static.wikia.nocookie.net/gensin-impact/images/b/b6/Kaeya_Icon.png'), 
('p5', 'Xiangling', 1, 3, 2, 4, 'https://static.wikia.nocookie.net/gensin-impact/images/3/39/Xiangling_Icon.png'), 
('p6', 'Zhongli', 5, 3, 2, 5, 'https://static.wikia.nocookie.net/gensin-impact/images/a/a6/Zhongli_Icon.png'), 
('p7', 'Ganyu', 3, 4, 2, 5, 'https://static.wikia.nocookie.net/gensin-impact/images/7/79/Ganyu_Icon.png');
 
 CREATE TABLE USERS (
    id VARCHAR(50) PRIMARY KEY,
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
* Gestion de page not-found.

---

## Lancer le projet

* Lancez le serveur PHP ou utilisez un live server.
* Accédez à `index.php` depuis votre navigateur.

---
