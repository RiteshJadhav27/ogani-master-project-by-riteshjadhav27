-- First Create database name with " fruitmart " by using below cammoand
    CREATE DATABASE fruitmart;

-- Then type this command to inter in database 
    USE fruitmart;

-- After creating Database Create the Table as shown below

                +---------------------+
                | Tables_in_fruitmart |
                +---------------------+
                | orders              |
                | products            |
                | users               |
                +---------------------+

-- To create order table like showen below 
    +---------------+---------------+------+-----+---------------------+----------------+
    | Field         | Type          | Null | Key | Default             | Extra          |
    +---------------+---------------+------+-----+---------------------+----------------+
    | order_id      | int(11)       | NO   | PRI | NULL                | auto_increment |
    | username      | varchar(255)  | NO   |     | NULL                |                |
    | email         | varchar(255)  | NO   |     | NULL                |                |
    | address       | text          | NO   |     | NULL                |                |
    | phone         | varchar(15)   | NO   |     | NULL                |                |
    | order_details | text          | NO   |     | NULL                |                |
    | total_amount  | decimal(10,2) | NO   |     | NULL                |                |
    | order_notes   | text          | YES  |     | NULL                |                |
    | status        | varchar(20)   | YES  |     | Pending             |                |
    | order_date    | timestamp     | NO   |     | current_timestamp() |                |
    +---------------+---------------+------+-----+---------------------+----------------+

    -- To create order table use this command 
        CREATE TABLE orders (
            order_id INT(11) NOT NULL AUTO_INCREMENT,
            username VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            address TEXT NOT NULL,
            phone VARCHAR(15) NOT NULL,
            order_details TEXT NOT NULL,
            total_amount DECIMAL(10,2) NOT NULL,
            order_notes TEXT DEFAULT NULL,
            status VARCHAR(20) DEFAULT 'Pending',
            order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (order_id)
        );

    -- 

-- To create product table showen below 
    +-------------+---------------+------+-----+---------------------+----------------+
    | Field       | Type          | Null | Key | Default             | Extra          |
    +-------------+---------------+------+-----+---------------------+----------------+
    | id          | int(11)       | NO   | PRI | NULL                | auto_increment |
    | name        | varchar(100)  | NO   |     | NULL                |                |
    | description | text          | YES  |     | NULL                |                |
    | price       | decimal(10,2) | NO   |     | NULL                |                |
    | image       | varchar(255)  | YES  |     | NULL                |                |
    | category    | varchar(50)   | YES  |     | NULL                |                |
    | stock       | int(11)       | NO   |     | 10                  |                |
    | created_at  | timestamp     | NO   |     | current_timestamp() |                |
    +-------------+---------------+------+-----+---------------------+----------------+

-- Use this command to create product table 
        CREATE TABLE products (
            id INT(11) NOT NULL AUTO_INCREMENT,
            name VARCHAR(100) NOT NULL,
            description TEXT DEFAULT NULL,
            price DECIMAL(10,2) NOT NULL,
            image VARCHAR(255) DEFAULT NULL,
            category VARCHAR(50) DEFAULT NULL,
            stock INT(11) NOT NULL DEFAULT 10,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
        );

-- To create users table showen below 
    +------------+----------------------+------+-----+---------------------+----------------+
    | Field      | Type                 | Null | Key | Default             | Extra          |
    +------------+----------------------+------+-----+---------------------+----------------+
    | id         | int(11)              | NO   | PRI | NULL                | auto_increment |
    | name       | varchar(100)         | NO   |     | NULL                |                |
    | email      | varchar(100)         | NO   | UNI | NULL                |                |
    | password   | varchar(255)         | NO   |     | NULL                |                |
    | phone      | varchar(15)          | YES  |     | NULL                |                |
    | address    | text                 | YES  |     | NULL                |                |
    | role       | enum('user','admin') | YES  |     | user                |                |
    | created_at | timestamp            | NO   |     | current_timestamp() |                |
    +------------+----------------------+------+-----+---------------------+----------------+

-- Use this command to create users table 
        CREATE TABLE users (
            id INT(11) NOT NULL AUTO_INCREMENT,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            phone VARCHAR(15) DEFAULT NULL,
            address TEXT DEFAULT NULL,
            role ENUM('user', 'admin') DEFAULT 'user',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
        );

-- To see all tables use below command 
    SHOW TABLES;

-- To see the structure of the table:
    DESC users;
