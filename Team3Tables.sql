#  Hardware Online
#  
#  Authors: Fioti, Figueroa, Danyluk
#
#  We are located at 12345 Poughkeepsie Lane, Poughkeepsie New York 12550
#  Phone Number: 845-666-6969
#  Email: admin@hardwareonline.com
#  version: v0.09


CREATE DATABASE IF NOT EXISTS site_db;

USE site_db;

DROP TABLE IF EXISTS T3_products;

CREATE TABLE T3_products (vendorID INT, productID INT AUTO_INCREMENT UNIQUE PRIMARY KEY, model TEXT, product TEXT, stock INT DEFAULT(0), description TEXT, price DOUBLE(10,2), active TINYINT);

INSERT INTO T3_products (vendorID, model, product, stock, description, price, active) VALUES
    (0, "1259216", "Steam Roller", 10, "Top of the line steam roller from Big Boyz Toyz. This steam roller has a v1 engine and loud sounds to make you think you're right on the job site like the old days.", 100.00, 1),
    (0, "1259216", "Dune Buggy", 3, "Big Boyz Toyz new and improved dune buggy can handle jumps of up to 20 meters, and drive at 20 mph", 123.45, 1),
    (1, "1578921", "Solar Roof Tiles", 2000, "First of it's kind, Lesla Solar Roof tiles can power two houses with the roof of one. Don't miss out on the opportunity it will provide your home", 2.39, 1),
    (1, "1578921", "Solar Panel", 300, "New and improved Solar Panals made by Lelsa Rotors. They can output a total of 100 Jigawatts of power with a 30 hz referesh rate.", 2.39, 1);


DROP TABLE IF EXISTS T3_suppliers;

CREATE TABLE T3_suppliers 
    (vendorID INT(11) PRIMARY KEY UNIQUE,
    vendorname TEXT,
    address TEXT,
    phone BigInt);

INSERT INTO T3_suppliers
    VALUES
    (1, 'Lesla', '10 Washington Blvd Goshen NY', 8456662222),
    (0, 'Big Boyz Toyz', '20 North Rd Poughkeepsie NY', 8452221234);

DROP TABLE IF EXISTS T3_users;

CREATE TABLE IF NOT EXISTS T3_users
(   username VARCHAR(256) UNIQUE,
    pwHash TEXT,
    hashType TEXT,
    rankID ENUM("Admin", "Employee", "Shareholder", "Customer"),
    active TINYINT,
    PRIMARY KEY(username));

INSERT INTO T3_users VALUES
("Danyluk", "secure", "none", "Admin", 1),
("Fioti", "password", "none", "Admin", 1),
("Figueroa", "ummm", "none", "Admin", 1),
("aptokash", "ADMIN", "none", "Shareholder", 1),
("AJMarone", "password", "none", "Customer", 1),
("JamesCameron", "password", "none", "Employee", 1);



SELECT *
FROM T3_products;

SELECT *
FROM  T3_users;

SELECT *
FROM T3_suppliers;
