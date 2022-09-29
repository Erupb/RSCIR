CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT,INSERT ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;
USE appDB;

CREATE TABLE IF NOT EXISTS users (
    ID INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(20) NOT NULL,
    password VARCHAR(40) NOT NULL,
    PRIMARY KEY (ID)
    );

CREATE TABLE IF NOT EXISTS valuables (
    ID INT(10) NOT NULL AUTO_INCREMENT,
    title VARCHAR(32) NOT NULL,
    description VARCHAR(256) NOT NULL,
    cost INT(6) NOT NULL,
    PRIMARY KEY (ID)
    );

INSERT INTO users (name, password)
SELECT * FROM (SELECT 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997') AS temp
WHERE NOT EXISTS (
        SELECT name FROM users WHERE name = 'admin' AND password = 'd033e22ae348aeb5660fc2140aec35850c4da997'
    ) LIMIT 1;

INSERT INTO valuables (title, description, cost)
SELECT * FROM (SELECT 'Crocodile', 'A plush toy of crocodile is great present for kids!', 4000) AS temp
WHERE NOT EXISTS (
        SELECT title FROM valuables WHERE title = 'Crocodile' AND description = 'A plush toy of crocodile is great present for kids!' AND cost = 4000
    ) LIMIT 1;

INSERT INTO valuables (title, description, cost)
SELECT * FROM (SELECT 'Pillow', 'A funny pillow with cows print', 800) AS temp
WHERE NOT EXISTS (
        SELECT title FROM valuables WHERE title = 'Pillow' AND description = 'A funny pillow with cows print' AND cost = 800
    ) LIMIT 1;