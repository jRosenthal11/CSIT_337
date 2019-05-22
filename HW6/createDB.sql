DROP DATABASE IF EXISTS CSIT101;
CREATE DATABASE CSIT101;

USE CSIT101;
CREATE TABLE administrators
(
    adminID INT NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    firstName VARCHAR(255) NOT NULL,
    lastName VARCHAR(255) NOT NULL,
    PRIMARY KEY(adminID)
);

    INSERT INTO administrators (adminID, email, password, firstName, lastName) 
    VALUES
        (1, 'jj@gmail.com', 'sesame', 'John', 'Johnson'),
        (2, 'kk@gmail.com', 'password', 'Karen', 'King'),
        (3, 'sd@gmail.com', 'superman', 'Super', 'Duper');
        
    GRANT SELECT, INSERT, UPDATE, DELETE
    ON *
    TO super@localhost
    IDENTIFIED BY 'super';