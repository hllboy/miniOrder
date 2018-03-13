CREATE TABLE Users (
    id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL
);
CREATE TABLE Products (
    productID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    productName VARCHAR(30) NOT NULL,
    productPrice DECIMAL(6,2) NOT NULL
);
CREATE TABLE OrderedProducts (
    orderedID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    productID INT(4) NOT NULL,
    quantity INT(4) NOT NULL,
    userID INT(4) NOT NULL,
    totalAmount DECIMAL(10,2) NOT NULL,
    regDate date
);

INSERT INTO Users(name) VALUES("Matti Karttunen");
INSERT INTO Users(name) VALUES("Joe Johnson");
INSERT INTO Users(name) VALUES("Jack Cardinal");
INSERT INTO Users(name) VALUES("Mary Wilman");
INSERT INTO Users(name) VALUES("Adam Kendall");
INSERT INTO Users(name) VALUES("Kate Wolski");

INSERT INTO Products(productName, productPrice) VALUES ("French Fries", "2.20");
INSERT INTO Products(productName, productPrice) VALUES ("Pepsi", "1.40");
INSERT INTO Products(productName, productPrice) VALUES ("Coca Cola", "1.20");
INSERT INTO Products(productName, productPrice) VALUES ("Fanta", "1.20");
INSERT INTO Products(productName, productPrice) VALUES ("Pizza", "4.30");
INSERT INTO Products(productName, productPrice) VALUES ("Hamburger", "3.80");
INSERT INTO Products(productName, productPrice) VALUES ("Pasta", "4.10");
INSERT INTO Products(productName, productPrice) VALUES ("Sprite", "0.90");
INSERT INTO Products(productName, productPrice) VALUES ("Water", "0.60");