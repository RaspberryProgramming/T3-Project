#  Hardware Online
#  
#  Authors: Fioti, Figueroa, Danyluk
#
#  We are located at 12345 Poughkeepsie Lane, Poughkeepsie New York 12550
#  Phone Number: 845-666-6969
#  Email: admin@hardwareonline.com
#  version: v0.09


CREATE DATABASE IF NOT EXISTS site_db;

CREATE USER IF NOT EXISTS 'mike'@'localhost' IDENTIFIED BY 'easysteps';

GRANT SELECT, INSERT, UPDATE, DELETE ON site_db.* TO 'mike'@'localhost';

USE site_db;

DROP TABLE IF EXISTS T3_products;

CREATE TABLE T3_products (
    vendorID INT,
    productID INT AUTO_INCREMENT UNIQUE PRIMARY KEY,
    model TEXT,
    product TEXT,
    stock INT DEFAULT(0),
    description TEXT,
    price DOUBLE(10,2),
    active TINYINT DEFAULT 1);

INSERT INTO T3_products (vendorID, model, product, stock, description, price, active) VALUES
    (0, "1259216", "Steam Roller", 10, "Top of the line steam roller from Big Boyz Toyz. This steam roller has a v1 engine and loud sounds to make you think you're right on the job site like the old days.", 100.00, 1),
    (0, "1259216", "Dune Buggy", 3, "Big Boyz Toyz new and improved dune buggy can handle jumps of up to 20 meters, and drive at 20 mph", 123.45, 1),
    (1, "1578921", "Solar Roof Tiles", 2000, "First of it's kind, Lesla Solar Roof tiles can power two houses with the roof of one. Don't miss out on the opportunity it will provide your home", 2.39, 1),
    (1, "1578921", "Solar Panel", 300, "New and improved Solar Panals made by Lelsa Rotors. They can output a total of 100 Jigawatts of power with a 30 hz referesh rate.", 2.39, 1);


DROP TABLE IF EXISTS T3_suppliers;

CREATE TABLE T3_suppliers 
    (vendorID INT(11) AUTO_INCREMENT PRIMARY KEY UNIQUE,
    vendorname TEXT,
    address TEXT,
    phone BigInt,
    email TEXT,
    active TINYINT DEFAULT 1);

INSERT INTO T3_suppliers
    VALUES
    (1, 'Lesla', '10 Washington Blvd Goshen NY', 8456662222, 'supplies@lesla.com', 1),
    (0, 'Big Boyz Toyz', '20 North Rd Poughkeepsie NY', 8452221234, 'supplies@bbt.com', 1);

DROP TABLE IF EXISTS T3_users;

CREATE TABLE IF NOT EXISTS T3_users
(
    userID INT AUTO_INCREMENT UNIQUE PRIMARY KEY,
    username VARCHAR(256) UNIQUE,
    pwHash TEXT,
    hashType TEXT,
    rankID ENUM("Admin", "Employee", "Shareholder", "Customer"),
    active TINYINT DEFAULT 1,
    datechanged DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

INSERT INTO T3_users (username, pwHash, hashType, rankID, active, datechanged) VALUES 
("Danyluk", "secure", "none", "Admin", 1, CURRENT_DATE),
("Fioti", "password", "none", "Admin", 1, CURRENT_DATE),
("Figueroa", "ummm", "none", "Admin", 1, CURRENT_DATE),
("aptokash", "ADMIN", "none", "Shareholder", 1, CURRENT_DATE),
("AJMarone", "password", "none", "Customer", 1, CURRENT_DATE),
("JamesCameron", "password", "none", "Employee", 1, CURRENT_DATE);



SELECT *
FROM T3_products;

SELECT *
FROM  T3_users;

SELECT *
FROM T3_suppliers;
