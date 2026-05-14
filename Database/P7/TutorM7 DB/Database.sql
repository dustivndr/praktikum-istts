-- Buat Database --
DROP DATABASE IF EXISTS LimbusCompanyDB;
CREATE DATABASE IF NOT EXISTS LimbusCompanyDB;
USE LimbusCompanyDB;

-- Buat Tabel --
CREATE TABLE sinners (
    sinner_id INT PRIMARY KEY AUTO_INCREMENT,
    sinner_number INT NOT NULL,
    NAME VARCHAR(50) NOT NULL,
    original_literature VARCHAR(100)
);

CREATE TABLE factions (
    faction_id INT PRIMARY KEY AUTO_INCREMENT,
    faction_name VARCHAR(100) NOT NULL,
    region_of_origin VARCHAR(50)
);

CREATE TABLE identities (
    identity_id INT PRIMARY KEY AUTO_INCREMENT,
    sinner_id INT,
    faction_id INT,
    identity_name VARCHAR(100) NOT NULL,
    rarity INT COMMENT '1, 2, or 3 stars',
    damage_type ENUM('Slash', 'Pierce', 'Blunt'),
    FOREIGN KEY (sinner_id) REFERENCES sinners(sinner_id) ON DELETE CASCADE,
    FOREIGN KEY (faction_id) REFERENCES factions(faction_id) ON DELETE SET NULL
);

CREATE TABLE ego (
    ego_id INT PRIMARY KEY AUTO_INCREMENT,
    sinner_id INT,
    ego_name VARCHAR(100) NOT NULL,
    risk_level ENUM('ZAYIN', 'TETH', 'HE', 'WAW', 'ALEPH'),
    sin_type ENUM('Wrath', 'Lust', 'Sloth', 'Gluttony', 'Gloom', 'Envy', 'Pride'),
    FOREIGN KEY (sinner_id) REFERENCES sinners(sinner_id) ON DELETE CASCADE
);

-- Insert Data --
INSERT INTO sinners (sinner_number, NAME, original_literature) VALUES 
(1, 'Yi Sang', 'The Wings'),
(2, 'Faust', 'Faust'),
(3, 'Don Quixote', 'Don Quixote'),
(4, 'Ryoshu', 'Hell Screen'),
(5, 'Meursault', 'The Stranger'),
(6, 'Hong Lu', 'Dream of the Red Chamber');

INSERT INTO factions (faction_name, region_of_origin) VALUES 
('Limbus Company', 'The Bus'),
('W Corp', 'District 23'),
('Dieci Association', 'District 4'),
('R Corp', 'District 18'),
('Shi Association', 'District 4');

INSERT INTO identities (sinner_id, faction_id, identity_name, rarity, damage_type) VALUES 
(1, 1, 'LCB Sinner Yi Sang', 1, 'Pierce'),
(1, 3, 'Dieci Assoc. South Section 4 Yi Sang', 3, 'Blunt'),
(2, 2, 'W Corp. L2 Cleanup Agent Faust', 3, 'Slash'),
(5, 4, 'R Corp. 4th Pack Rhino Meursault', 3, 'Blunt');

INSERT INTO ego (sinner_id, ego_name, risk_level, sin_type) VALUES 
(1, 'Crow''s Eye View', 'ZAYIN', 'Sloth'),
(2, 'Fluid Sac', 'HE', 'Gloom'),
(3, 'La Sangre de Sancho', 'ZAYIN', 'Lust');


