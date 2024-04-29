CREATE DATABASE final_project;

USE final_project;

CREATE TABLE users (
                       id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                       email VARCHAR(60) NOT NULL,
                       password VARCHAR(30) NOT NULL,
                       firstName VARCHAR(30) NOT NULL,
                       lastName VARCHAR(30),
                       street VARCHAR(30),
                       town VARCHAR(30),
                       contactNum VARCHAR(30)
);

INSERT INTO users (email, password, firstName) VALUES ('admin@brand.com', 'admin', 'admin');

CREATE TABLE warehouse (
                           sku INT(15) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                           productName VARCHAR(60) NOT NULL,
                           productCategory VARCHAR(30) NOT NULL,
                           productDesc VARCHAR(400),
                           productPrice DECIMAL(10, 2) NOT NULL,
                           totalStock INT(10) NOT NULL
);

INSERT INTO warehouse
(productName, productCategory, productDesc, productPrice, totalStock)
VALUES
    ('Amelia Lip Liner', 'lipliner', 'A perfectly pink lip liner which compliments all skin tones. A true revolutionary formulation which has 24 hour staying power while being non-drying on the lips.', 18, 10),
    ('Olivia Lip Liner', 'lipliner', 'A statement nude lip liner which compliments all skin tones. A true revolutionary formulation which has 24 hour staying power while being non-drying on the lips.', 18, 10),
    ('Sophia Lip Liner', 'lipliner', 'A luscious brown lip liner which compliments all skin tones. A true revolutionary formulation which has 24 hour staying power while being non-drying on the lips.', 18, 10),
    ('Penny Lipstick', 'lipstick', 'A true nude lipstick for all occasions. A true revolutionary formulation which has 24 hour staying power while being non-drying on the lips.', 24, 10),
    ('Tilly Lipstick', 'lipstick', 'A pretty pink lipstick for all occasions. A true revolutionary formulation which has 24 hour staying power while being non-drying on the lips.', 24, 10),
    ('Haley Lipstick', 'lipstick', 'A statement reddish-brown lipstick for all occasions. A true revolutionary formulation which has 24 hour staying power while being non-drying on the lips.', 24, 10),
    ('Iris Lip Gloss', 'lipgloss', 'A subtle champagne lip gloss. A true revolutionary formulation which hydrating and long lasting on the lips.', 16, 10),
    ('Alexis Lip Gloss', 'lipgloss', 'A subtle intense pink lip gloss. A true revolutionary formulation which hydrating and long lasting on the lips.', 16, 10),
    ('Paris Lip Gloss', 'lipgloss', 'A faintly brown lip gloss. A true revolutionary formulation which hydrating and long lasting on the lips.', 16, 10);

