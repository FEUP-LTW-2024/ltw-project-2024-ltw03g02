DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Item;
DROP TABLE IF EXISTS Transaction;
DROP TABLE IF EXISTS Message;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS Brand;
DROP TABLE IF EXISTS Review;
DROP TABLE IF EXISTS UserOrder;
DROP TABLE IF EXISTS ClotheSize;
DROP TABLE IF EXISTS CategorySize;
DROP TRIGGER IF EXISTS update_user_rating;

CREATE TABLE User (
    idUser INTEGER PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    pass VARCHAR(255) NOT NULL,
    rating FLOAT,
    phoneNumber INTEGER NOT NULL CHECK (100000000 <= phoneNumber AND phoneNumber <= 999999999),
    is_admin BOOL DEFAULT False,
    CONSTRAINT UNIQUE_username UNIQUE (username),
    CONSTRAINT UNIQUE_email UNIQUE (email),
    CONSTRAINT CHECK_roles CHECK (roles = 'client' OR roles = 'agent' OR roles = 'admin')
);

CREATE TABLE clothesType(
    idType INTEGER PRIMARY KEY,
    target VARCHAR(255) NOT NULL
);

CREATE TABLE Item (
    idItem INTEGER PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    color VARCHAR(255) ENUM ("Preto", "Azul", "Vermelho", "Bege", "Branco", "Castanho", "Cinza", "Dourado", "Laranja", "Lilás", "Violeta", "Rosa", "Roxo", "Verde"),
    price DECIMAL(10, 2) NOT NULL,
    condition VARCHAR(255) ENUM ("Etiquetado", "Bom estado", "Razoável", "Mau estado"),
    sellerId INTEGER NOT NULL,
    categoryId INTEGER NOT NULL,
    idType INTEGER NOT NULL,
    clotheSize TEXT,
    listedAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sellerId) REFERENCES User(idUser),
    FOREIGN KEY (categoryId) REFERENCES Category(idCategory).
    FOREIGN KEY (genderId) REFERENCES clothesType(idType)
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

CREATE TABLE Brand (
    idBrand INTEGER PRIMARY KEY,
    brandName VARCHAR(255) NOT NULL UNIQUE	
);

CREATE TABLE Review (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    idUser INTEGER REFERENCES User,
    idItem INTEGER REFERENCES Item,
    stars INTEGER NOT NULL CHECK (1 <= stars AND stars <= 5),
    comment TEXT NOT NULL,
    data DATE
);

CREATE TABLE UserOrder (
    idUser INTEGER REFERENCES User,
    idItem INTEGER REFERENCES Item,
    address TEXT NOT NULL,
    data DATETIME NOT NULL,
    state TEXT NOT NULL,
    PRIMARY KEY(idUser, idItem, data)
);

ALTER TABLE User ADD COLUMN rating REAL;

CREATE TRIGGER update_user_rating
AFTER INSERT ON Review
BEGIN
    UPDATE User
    SET rating = (SELECT AVG(stars) FROM Review WHERE idUser = NEW.idUser)
    WHERE idUser = NEW.idUser;
END;
