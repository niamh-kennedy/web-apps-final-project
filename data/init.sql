CREATE DATABASE final_project;

USE final_project;

CREATE TABLE users (
                       id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                       firstName VARCHAR(30) NOT NULL,
                       lastName VARCHAR(30) NOT NULL,
                       email VARCHAR(60) NOT NULL,
                       password VARCHAR(30) NOT NULL,
                       street VARCHAR(30) NOT NULL,
                       town VARCHAR(30) NOT NULL,
                       contactNum VARCHAR(30) NOT NULL
);

CREATE TABLE warehouse (
                           SKU INT(15) UNSIGNED AUTO_INCREMENT=101 PRIMARY KEY,
                           productName VARCHAR(60) NOT NULL,
                           productDesc VARCHAR(60) NOT NULL,
                           quantity VARCHAR(30) NOT NULL,
                           price VARCHAR(30) NOT NULL
);