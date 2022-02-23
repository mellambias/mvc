DROP DATABASE mvc;

CREATE DATABASE  IF NOT EXISTS mvc
CHARACTER SET utf8
COLLATE utf8_general_ci;

USE mvc;

CREATE TABLE IF NOT EXISTS posts(
    idpost INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    titulo VARCHAR(45),
    contenido VARCHAR(45)
);


CREATE TABLE IF NOT EXISTS users(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE users
  ADD UNIQUE KEY email (email);

# Siembra de datos

INSERT INTO posts (idpost,titulo,contenido)
VALUES 
(1,"post1","contenido"),
(2,"post2","contenido"),
(3,"post3","contenido"),
(4,"post4","contenido");
