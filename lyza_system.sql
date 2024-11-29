DROP DATABASE IF EXISTS lyza_system;
CREATE DATABASE IF NOT EXISTS lyza_system;
USE lyza_system;

-- SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));

CREATE TABLE branch (
    id INT PRIMARY KEY AUTO_INCREMENT,
    branchName VARCHAR(100) NOT NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    userName VARCHAR(100) NOT NULL UNIQUE,
    firstName VARCHAR(100) NOT NULL,
    lastName VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    isAdmin BOOLEAN DEFAULT FALSE,
    assignedBranch INT DEFAULT NULL,
    userStatus ENUM('active', 'disabled', 'removed') DEFAULT 'active',
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE staff (
    id INT PRIMARY KEY AUTO_INCREMENT,
    userId INT NOT NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (userId) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    branchId INT NOT NULL,
    barCode VARCHAR(100) DEFAULT "",
    productName VARCHAR(100) NOT NULL,
    productPrice DECIMAL(10, 2) NOT NULL,
    productStock INT DEFAULT 0,
    productCategory VARCHAR(100) NOT NULL,
    genericBrand VARCHAR(100) NOT NULL,
    productUnit VARCHAR(100) NOT NULL,
    productImage VARCHAR(100) DEFAULT "",
    productDescription VARCHAR(100) DEFAULT "",
    isArchived BOOLEAN DEFAULT FALSE,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (branchId) REFERENCES branch(id) ON DELETE CASCADE
);

CREATE TABLE productOrdered (
    id INT PRIMARY KEY AUTO_INCREMENT,
    productId INT NOT NULL,
    numberProduct INT NOT NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (productId) REFERENCES products(id) ON DELETE CASCADE
);

CREATE TABLE transactions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    productOrderedIds JSON NOT NULL,

    branchId INT NOT NULL,
    staffId INT NOT NULL,
    totalPrice DECIMAL(10, 2) NOT NULL,
    cashPrice DECIMAL(10, 2) NOT NULL,
    changePrice DECIMAL(10, 2) NOT NULL,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    seniorDiscount BOOLEAN DEFAULT FALSE,
    pwdDiscount BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (branchId) REFERENCES branch(id) ON DELETE CASCADE,
    FOREIGN KEY (staffId) REFERENCES staff(id) ON DELETE CASCADE
);

CREATE TABLE stockHistory (
    id INT PRIMARY KEY AUTO_INCREMENT,
    branchId INT NOT NULL,
    staffId INT NOT NULL,
    productId INT NOT NULL,
    quantity INT NOT NULL,
    remainingStock INT NOT NULL,
    expirationDate DATE DEFAULT NULL,
    discarded BOOLEAN DEFAULT FALSE,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (staffId) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (branchId) REFERENCES branch(id) ON DELETE CASCADE,
    FOREIGN KEY (productId) REFERENCES products(id) ON DELETE CASCADE
);

CREATE TABLE uploadedTransactions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    fileId VARCHAR(255) UNIQUE NOT NULL,
    uploadedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO branch (branchName) VALUES
('All Branch'),
('San Miguel'),
('San Isidro Norte');

INSERT INTO users (firstName, lastName, userName, email, password, isAdmin, assignedBranch, userStatus) VALUES
('admin','admin','ADMIN', 'admin@example.com', '$2y$10$HwfYgfXoL.c0D1bFyLQw5epckFCoLnxzp7d.Z0enLKYImQJwv91yy', TRUE, 1, 'active'),
('staff1','staff','staff1', 'staff1@example.com', '$2y$10$HwfYgfXoL.c0D1bFyLQw5epckFCoLnxzp7d.Z0enLKYImQJwv91yy', FALSE, 2, 'active'),
('staff2','staff','staff2', 'staff2@example.com', '$2y$10$HwfYgfXoL.c0D1bFyLQw5epckFCoLnxzp7d.Z0enLKYImQJwv91yy', FALSE, 3, 'disabled'),
('staff3','staff','staff3', 'staff3@example.com', '$2y$10$HwfYgfXoL.c0D1bFyLQw5epckFCoLnxzp7d.Z0enLKYImQJwv91yy', FALSE, 2, 'removed'),
('NJ','ADMIN','NJ Admin', 'nj.zxc14@gmail.com', '$2y$10$f.Zds9tg/eJbQYllN4JF7OOs1d1AbqM56JjWvfl1RCdWSWaPnSUtG', TRUE, 1, 'active'),
('JOSH','STAFF','Tejada Staff', 'joshtejada2017@gmail.com', '$2y$10$3SRVFjEJ/mu2kCYTwiRPI./We488IGZYLWKb8D3v7HKR9IuW2cg9W', FALSE, 2, 'active');

INSERT INTO staff (userId) VALUES
(2), 
(3), 
(4),
(5);

INSERT INTO products (branchId, barCode, productName, productPrice, productStock, productCategory, productImage, genericBrand, productUnit) VALUES
(2, '12345', 'Alaxan', 30, 0, 'Medicine', 'Alaxan.jpeg', 'Paracetamol', 'Tablet'),
(3, '23456', 'Biogesic', 50, 0, 'Supplement', 'Biogesic.png', 'Paracetamol', 'Tablet');


