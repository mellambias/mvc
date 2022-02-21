DROP DATABASE mvc;

CREATE DATABASE  IF NOT EXISTS mvc
CHARACTER SET utf8
COLLATE utf8_general_ci;

USE mvc;

CREATE TABLE IF NOT EXISTS post(
    idpost INT PRIMARY KEY,
    titulo VARCHAR(45),
    contenido VARCHAR(45)
);


INSERT INTO post (idpost,titulo,contenido)
VALUES 
(1,"post1","contenido"),
(2,"post2","contenido"),
(3,"post3","contenido"),
(4,"post4","contenido");
