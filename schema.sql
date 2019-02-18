CREATE DATABASE doingsdone
    DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;

USE doingsdone;

CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title CHAR(120),
    user_id INT NOT NULL
);

CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_added DATETIME,
    date_completed DATETIME,
    status BIT DEFAULT 0,
    title CHAR(100) NOT NULL,
    file CHAR(250),
    due_date DATETIME,
    user_id INT NOT NULL,
    project_id INT
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    email CHAR(60) NOT NULL UNIQUE,
    name CHAR(60) NOT NULL,
    password CHAR(60) NOT NULL
);