DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS clothesType;
DROP TABLE IF EXISTS Item;
DROP TABLE IF EXISTS Message;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS Brand;
DROP TABLE IF EXISTS Review;
DROP TABLE IF EXISTS UserOrder;
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
    CONSTRAINT UNIQUE_email UNIQUE (email)
);

CREATE TABLE clothesType(
    idType INTEGER PRIMARY KEY,
    target VARCHAR(255) NOT NULL
);

CREATE TABLE Item (
    idItem INTEGER PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    color VARCHAR(255) NOT NULL CHECK (
        color IN ('Preto', 'Azul', 'Vermelho', 'Bege', 'Branco', 'Castanho', 'Cinza', 'Dourado', 'Laranja', 'Lilás', 'Violeta', 'Rosa', 'Roxo', 'Verde')
    ),
    price DECIMAL(10, 2) NOT NULL,
    condition VARCHAR(255) NOT NULL CHECK (
        condition IN ('Etiquetado', 'Bom estado', 'Razoável', 'Mau estado')
    ),
    sellerId INTEGER NOT NULL,
    categoryId INTEGER NOT NULL,
    idType INTEGER NOT NULL,
    clotheSize TEXT,
    listedAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sellerId) REFERENCES User(idUser),
    FOREIGN KEY (categoryId) REFERENCES Category(idCategory),
    FOREIGN KEY (idType) REFERENCES clothesType(idType)
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

CREATE TRIGGER update_user_rating
AFTER INSERT ON Review
BEGIN
    UPDATE User
    SET rating = (SELECT AVG(stars) FROM Review WHERE idUser = NEW.idUser)
    WHERE idUser = NEW.idUser;
END;


INSERT INTO User (idUser, nome, username, email, pass, rating, phoneNumber, is_admin)
VALUES
    (1, 'John Doe', 'johndoe', 'johndoe@example.com', 'password123', 4.5, 919715443, False),
    (2, 'Jane Smith', 'janesmith', 'janesmith@example.com', 'pass1234', 4.2, 987654321, False),
    (3, 'Daniel Basílio', 'dbasilio', 'dbasilio@example.com', 'adminpass', 5.0, 911053549, True);

INSERT INTO clothesType (idType, target)
VALUES
    (1, 'Homem'),
    (2, 'Mulher'),
    (3, 'Criança');

INSERT INTO Item (idItem, title, description, color, price, condition, sellerId, categoryId, idType, clotheSize, listedAt)
VALUES
    (1, 'Camiseta Masculina', 'Camiseta de algodão confortável para homens', 'Preto', 19.99, 'Etiquetado', 1, 1, 1, 'L', '2024-01-10 10:00:00'),
    (2, 'Calça Jeans Feminina', 'Calça jeans elegante para mulheres', 'Azul', 39.99, 'Bom estado', 2, 2, 2, 'M', '2024-04-07 10:00:00'),
    (3, 'Moletom Infantil', 'Moletom quentinho para crianças', 'Vermelho', 29.99, 'Razoável', 1, 3, 3, 'S', '2024-02-20 10:40:35'),
    (4, 'Camisa Masculina', 'Camisa formal para homens', 'Branco', 49.99, 'Bom estado', 1, 1, 1, 'XL', '2023-12-10 21:51:00'),
    (5, 'Vestido Feminino', 'Vestido elegante para mulheres', 'Rosa', 59.99, 'Etiquetado', 2, 2, 2, 'L', '2024-02-21 20:01:04'),
    (6, 'Camiseta Infantil', 'Camiseta fofa para crianças', 'Azul', 14.99, 'Razoável', 3, 3, 3, 'M', '2024-04-01 08:06:43'),
    (7, 'Jaqueta Masculina', 'Jaqueta estilosa para homens', 'Preto', 79.99, 'Bom estado', 1, 1, 1, 'L', '2023-11-27 01:51:00'),
    (8, 'Blusa Feminina', 'Blusa casual para mulheres', 'Branco', 29.99, 'Etiquetado', 2, 2, 2, 'S', '2022-12-01 18:06:23'),
    (9, 'Calça Infantil', 'Calça confortável para crianças', 'Cinza', 24.99, 'Mau estado', 3, 3, 3, 'S', '2024-03-10 12:59:45'),
    (10, 'Bermuda Masculina', 'Bermuda casual para homens', 'Bege', 34.99, 'Bom estado', 1, 1, 1, 'M', '2024-03-01 23:46:13');


INSERT INTO Category(idCategory, categoryName) 
VALUES
    (1, 'Calças'),
    (2, 'Calções'),
    (3, 'Shorts'),
    (4, 'Camisa'),
    (5, 'Polo'),
    (6, 'T-shirt'),
    (7, 'Sweat'),
    (8, 'Camisola'),
    (9, 'Top'),
    (10, 'Casaco'),
    (11, 'Blazer'),
    (12, 'Blusa'),
    (13, 'Kispo'),
    (14, 'Activewear'),
    (15, 'Vestido'),
    (16, 'Pijama'),
    (17, 'Fato');
    
INSERT INTO Brand(idBrand, brandName)
VALUES
    (1, 'Zara'),
    (2, 'Berska'),
    (3, 'Pull&Bear'),
    (4, 'Polo Ralph'),
    (5, 'Fred Perry'),
    (6, 'Intimissi'),
    (7, 'Modalfa'),
    (8, 'H&M'),
    (9, 'Massimo Dutti'),
    (10, 'Mango'),
    (11, 'Nike'),
    (12, 'Adidas'),
    (13, 'Levis'),
    (14, 'Guess'),
    (15, 'Gucci'),
    (16, 'Balenciaga'),
    (17, 'Primark');
    
INSERT INTO Review (id, idUser, idItem, stars, comment, data)
VALUES
    (1, 2, 17, 4, 'Produto de qualidade, recomendo!', '2024-04-13'), 
    (2, 1, 2, 4, 'Boa aparência.', '2024-04-14'),
    (3, 4, 3, 5, 'Perfeito para o meu filho, está a adorar!', '2024-04-15'), 
    (4, 1, 4, 5, 'Camisa impecável, excelente para ocasiões formais.', '2024-04-16'), 
    (5, 2, 15, 5, 'Vestido lindo, encaixou perfeitamente!', '2024-04-17'), 
    (6, 3, 10, 5, 'Casaco confortável', '2024-04-18'),
    (7, 2, 12, 5, 'Blusa casual perfeita para o dia a dia.', '2024-04-20'),
    (8, 2, 1, 5, 'Calças com excelente qualidade, e com entrega rápida.', '2024-04-21');
    
