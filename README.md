# **PHP User Registration System**

This project implements a simple user registration system using PHP and MySQL. Users can register with a unique username, email, and password, which are securely stored in the database. The system also includes a login page for registered users to authenticate and access a home page.

## Features

- Secure user registration with password hashing
- Database integration for storing user credentials
- Login functionality with session management
- Basic error handling and validation

## Technologies Used

- PHP
- MySQL

## Getting Started

To get started with this project, follow these steps:

1. Clone the repository to your local machine:

   ```bash
   git clone https://github.com/Bikash012/User_Registration-in-PHP.git
   
# Create a MySQL database named my_database.

CREATE DATABASE my_database;

# Create a table named users with the following columns:

id (INT, auto-increment, primary key)
username (VARCHAR)
email (VARCHAR)
password (VARCHAR)

USE my_database;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);
