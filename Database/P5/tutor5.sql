CREATE DATABASE bloons;
USE bloons;

CREATE TABLE `hero` ( 
`id` INT NOT NULL AUTO_INCREMENT, 
`name` VARCHAR(255) NOT NULL, 
`price` INT, PRIMARY KEY (`id`) 
); 

INSERT INTO `hero` (`name`, `price`) VALUES 
('Quincy', '565'),
('Guendolyn', '755'),
('Obyn', '695'),
('Striker Jones', '855'),
('Ettienne', '700'),
('Benjamin', '1205'),
('Geraldo', '650'),
('Silas', '855'); 

CREATE TABLE `tower` ( 
`id` INT NOT NULL AUTO_INCREMENT, 
`name` VARCHAR(255) NOT NULL, 
`price` INT NOT NULL, 
`damage` INT, 
`category` ENUM('Primary','Military','Magic','Support') NOT NULL, PRIMARY KEY (`id`) 
);

INSERT INTO `tower` (`name`, `price`, `damage`, `category`) VALUES
('Dart Monkey', 210, 1, 'Primary'),
('Tack Shooter', 340, 1, 'Primary'),
('Glue Gunner', 240, 0, 'Primary'),
('Sniper Monkey', 380, 2, 'Military'),
('Ace Pilot', 1080, 1, 'Military'),
('Dartling Gunner', 960, 1, 'Military'),
('Wizard Monkey', 280, 1, 'Magic'),
('Alchemist', 380, 1, 'Magic'),
('Druid', 320, 1, 'Magic'),
('Engineer Monkey', 380, 1, 'Support'),
('Spike Factory', 1080, 1, 'Support'),
('Monkey Village', 1280, 0, 'Support');

CREATE TABLE `bloons` ( 
`id` INT NOT NULL AUTO_INCREMENT, 
`name` VARCHAR(255) NOT NULL, 
`health` INT NOT NULL, 
`layer` INT NOT NULL, 
`type` ENUM('Bloon','MOAB','BOSS') NOT NULL, 
`ressistance` ENUM('Black','White','Purple','Lead','Fortified','Black+Lead','Regrow','None') NOT NULL, PRIMARY KEY (`id`) 
);

INSERT INTO `bloons` (`name`, `health`, `layer`, `type`, `ressistance`) VALUES
('Red Bloons', 1, 0, 'Bloon', 'None'),
('Blue Bloons', 1, 1, 'Bloon', 'None'),
('Green Bloons', 1, 2, 'Bloon', 'None'),
('Yellow Bloons', 1, 3, 'Bloon', 'None'),
('Pink Bloons', 1, 4, 'Bloon', 'None'),
('Black Bloons', 1, 5, 'Bloon', 'Black'),
('White Bloons', 1, 5, 'Bloon', 'White'),
('Lead Bloons', 1, 6, 'Bloon', 'Lead'),
('Purple Bloons', 1, 7, 'Bloon', 'Purple'),
('Green Regrow', 1, 3, 'Bloon', 'Regrow'),
('MOAB', 200, 1, 'MOAB', 'None'),
('DDT', 400, 1, 'MOAB', 'Black+Lead'),
('BAD', 20000, 5, 'MOAB', 'None');

CREATE TABLE `Map` ( 
`id` INT NOT NULL AUTO_INCREMENT, 
`name` VARCHAR(255), 
`difficulty` ENUM('Beginner','Intermmidiate','Advanced','Expert'), PRIMARY KEY (`id`) 
); 

INSERT INTO `Map` (`name`, `difficulty`) VALUES
('Monkey Meadow', 'Beginner'),
('On The Loops', 'Beginner'),
('Chutes', 'Intermmidiate'),
('Rakes', 'Intermmidiate'),
('Sunset Gulch', 'Advanced'),
('Another Bricks', 'Advanced'),
('Bloody Puddles', 'Expert'),
('Quad', 'Expert');

-- operator pembanding --
-- =, !=, <>, <, >, <=, >=
-- operator kondisional --
-- versi 1
SELECT *
FROM bloons
WHERE health NOT BETWEEN 200 AND 20000;

-- versi 2
SELECT *
FROM tower
WHERE price < 500 OR category != Military;

-- penggunaan group by
SELECT COUNT(*) AS total_tower FROM tower 
WHERE price >= 400
GROUP BY damage 
-- fungsi group by filter data, jadi data / nilai yang sm gk keluar
--------------------------------------------------------------------
-- penggunaan order by
-- contoh 1
 SELECT * FROM bloons
 ORDER BY id DESC
 
 -- contoh 2
 SELECT * FROM map
 ORDER BY NAME ASC, difficulty DESC -- (sort akan di mulai dari name kemudian di lanjutkan dari difficulty)
 -- sort by ascending atau descending disingkat dengan ASC and ASC
 -- bs juga menggunakan 1,2,3 merujuk column

-------------------------------------------------------------------- 

-- HAVING : filters grouped data setelah fungsi GROUP BY
SELECT category, COUNT(*) total
FROM tower
GROUP BY category
HAVING total > 2;

-- COUNT : hitung seluruh barisan
SELECT COUNT(*) total_heroes
FROM hero;

-- SUM : Jumlah total dari sebuah kolom
SELECT SUM(price) total_price
FROM hero;

-- AVG : Jumlah rata-rata dari sebuah kolom
SELECT AVG(price) avg_price
FROM tower;

-- FLOOR : hilangkan seluruh angka desimal
SELECT FLOOR(12.89);

-- POWER : pangkat
SELECT POWER(5,2);

-- SQRT : fungsi akar
SELECT SQRT(81);

-- ROUND : pembulatan nagka
SELECT ROUND(AVG(price),2) AS avg_price
FROM hero;

-- + : penjumlahan
SELECT name, price + 100 AS upgraded_price
FROM hero;

-- - : pengurangan
SELECT name, price - 50 AS discounted_price
FROM hero;

-- * : perkalian
SELECT name, price * 2 AS double_price
FROM hero;

-- / : pembagian
SELECT name, price / 2 AS half_price
FROM hero;

--------------------------------------------------------------------
-- CASE WHEN : conditional logic like if-else
SELECT NAME, price,
CASE
    WHEN price < 700 THEN 'Cheap'
    WHEN price <= 900 THEN 'Medium'
    ELSE 'Expensive'
END AS category
FROM hero;

--------------------------------------------------------------------
-- contoh contoh lain
 
-- Munculkan hero, nama map dan tingkat kesulitan map
SELECT hero.name, map.name, map.difficulty
FROM hero, map
WHERE hero.price < 700;

-- Groupkan tower dan filter berdasarkan kategori tower dan average price > 400.
SELECT category,
COUNT(*) total_tower,
AVG(price) avg_price,
SUM(damage) total_damage
FROM tower
GROUP BY category
HAVING AVG(price) > 400;

-- Group towers berdasarkan category, kemudian hitung jumlah tower, average price,
-- lalu sort kategori berdasarkan dari yang termahal ke termurah
SELECT 
category,
COUNT(*) AS total_tower,
AVG(price) AS avg_price,
SUM(damage) AS total_damage
FROM tower
WHERE price >= 300
GROUP BY category
HAVING COUNT(*) >= 2
ORDER BY avg_price DESC;

-- tunjukan jumlah combo untuk hero dan tower berdasarkan kategori dimana harga hero lebih murah dibandingkan dengan harga tower, 
-- kemudian sort dari termahal hingga termurah
SELECT
tower.category,
COUNT(*) AS combo_total,
AVG(hero.price) AS avg_hero_price
FROM hero, tower
WHERE hero.price < tower.price
GROUP BY tower.category
ORDER BY avg_hero_price DESC;


