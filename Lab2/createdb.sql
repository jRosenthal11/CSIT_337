-- Create the products database
DROP DATABASE IF EXISTS products;
CREATE DATABASE products;
USE products;
-- MySQL command

-- create the tables
CREATE TABLE books
(
    id INT,
    title VARCHAR(255),
    category VARCHAR(255),
    isbn INT,
    PRIMARY KEY(id)
);

-- insert data into the database
INSERT INTO books
VALUES
    (1, 'Visual Basic 2010 How to Program', 'Programming', 0132152134),
    (2, 'Visual C# 2010 How to Program', 'Programming', 0132151421),
    (3, 'Java How to Program', 'Programming', 0132575663),
    (4, 'C++ How to Program', 'Programming', 0132662361),
    (5, 'C How to Program', 'Programming', 0136123562),
    (6, 'Internet & World Wide Web How to Program', 'Programming', 0132151006),
    (7, 'Operating Systems', 'Operating Systems', 0131828274)