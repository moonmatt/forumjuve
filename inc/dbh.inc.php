<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "forumjuve";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);


// POSTS

// CREATE TABLE users (
//     id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
//     username varchar(255) NOT NULL,
//     name varchar(255),
//     bio varchar(100),
//     email varchar(255) NOT NULL,
//     pwd varchar(255) NOT NULL,
//     propic varchar(2083),
//     badges varchar(2083),
//     sex int(1),
//     city varchar(20),
//     role varchar(2083),
//     website varchar(2083),
//     dofbirth DATE NOT NULL,
//     date DATE NOT NULL,
//     ban int(1) NOT NULL
// );


// CREATE TABLE posts (
//     id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
//     title varchar(255) NOT NULL,
//     username int NOT NULL,
//     msg LONGTEXT NOT NULL,
//     date DATETIME NOT NULL,
//     permalink varchar(2083),
//     closed int(1) NOT NULL,
// );

// CREATE TABLE roles (
//     id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
//     name varchar(255) NOT NULL,
//     image varchar(2083)
// );

// CREATE TABLE comments (
//     id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
//     username int NOT NULL,
//     msg LONGTEXT NOT NULL,
//     date DATETIME NOT NULL,
//     permalink_post varchar(2083)
// );

// CREATE TABLE postbadges (
//     id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
//     value int NOT NULL,
//     name varchar(255) NOT NULL,
//     image varchar(2083)
// );

// CREATE TABLE badges (
//     id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
//     name varchar(255) NOT NULL,
//     title varchar(255) NOT NULL,
//     image varchar(2083)
// );