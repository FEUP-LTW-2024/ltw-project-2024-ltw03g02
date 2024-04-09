DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Item;
DROP TABLE IF EXISTS Transaction;
DROP TABLE IF EXISTS Message;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS Tickets_List;
DROP TABLE IF EXISTS FAQ;

CREATE TABLE User (
    idUser INTEGER,
    nome VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    pass VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    phoneNumber INTEGER NOT NULL CHECK (100000000 <= phoneNumber AND phoneNumber <= 999999999),
    is_admin BOOL DEFAULT False,
    CONSTRAINT UNIQUE_username UNIQUE (username),
    CONSTRAINT UNIQUE_email UNIQUE (email),
    CONSTRAINT CHECK_roles CHECK (roles = 'client' OR roles = 'agent' OR roles = 'admin'),
    CONSTRAINT pk_user PRIMARY KEY (idUser)
);

CREATE TABLE Item (
    idItem INTEGER PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    condition VARCHAR(255) ENUM ("Etiquetado", "Bom estado", "Razoável", "Mau estado"),
    sellerId INTEGER NOT NULL,
    categoryId INTEGER NOT NULL,
    listedAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sellerId) REFERENCES User(idUser),
    FOREIGN KEY (categoryId) REFERENCES Category(idCategory)
);

-- Create Transaction table
CREATE TABLE Transaction (
    idTransaction INTEGER PRIMARY KEY,
    itemId INTEGER NOT NULL,
    buyerId INTEGER NOT NULL,
    sellerId INTEGER NOT NULL,
    transactionDate DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (itemId) REFERENCES Item(idItem),
    FOREIGN KEY (buyerId) REFERENCES User(idUser),
    FOREIGN KEY (sellerId) REFERENCES User(idUser)
);

-- Create Message table
CREATE TABLE Message (
    idMessage INTEGER PRIMARY KEY,
    senderId INTEGER NOT NULL,
    receiverId INTEGER NOT NULL,
    messageText TEXT NOT NULL,
    sentAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (senderId) REFERENCES User(idUser),
    FOREIGN KEY (receiverId) REFERENCES User(idUser)
);

-- Create Category table
CREATE TABLE Category (
    idCategory INTEGER PRIMARY KEY,
    categoryName VARCHAR(255) NOT NULL UNIQUE
);
