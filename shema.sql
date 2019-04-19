CREATE DATABASE yaticave_488893
    DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;

USE yaticave_488893;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_registration TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    email CHAR(128) NOT NULL UNIQUE,
    name CHAR(128) NOT NULL,
    password CHAR(64) NOT NULL,
    avatar CHAR(255),
    contact TEXT(560)
);

CREATE INDEX u_name ON users(name);

CREATE TABLE lots (
    id INT AUTO_INCREMENT PRIMARY KEY,
    create_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    title CHAR(255) NOT NULL,
    description TEXT(1200),
    picture CHAR(255),
    price INT(10) NOT NULL,
    end_date TIMESTAMP,
    staf_step INT(3) NOT NULL,
    user_id INT NOT NULL,
    winner_id INT,
    category_id INT
);

CREATE INDEX l_title ON lots(title);

CREATE TABLE cathegory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name CHAR(255) NOT NULL UNIQUE,
    code CHAR(128) NOT NULL UNIQUE
);

CREATE INDEX c_name ON cathegory(name);

CREATE TABLE user_staf (
    id INT AUTO_INCREMENT PRIMARY KEY,
    staf_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    amount INT(10) NOT NULL,
    user_id INT,
    lot_id INT
);

