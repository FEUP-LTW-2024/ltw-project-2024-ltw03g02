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
    gender VARCHAR(255) NOT NULL CHECK (
        gender IN ('Mulher', 'Homem')
    ),
    profile_image_link TEXT DEFAULT 'https://upload.wikimedia.org/wikipedia/commons/a/ac/Default_pfp.jpg',
    rating FLOAT,
    phoneNumber INTEGER NOT NULL CHECK (100000000 <= phoneNumber AND phoneNumber <= 999999999),
    is_admin BOOLEAN DEFAULT FALSE,
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
    type_item VARCHAR(255) NOT NULL CHECK (
        type_item IN ('Mulher', 'Homem', 'Criança')
    ),
    picture TEXT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    condition VARCHAR(255) NOT NULL CHECK (
        condition IN ('Etiquetado', 'Bom estado', 'Razoável', 'Mau estado')
    ),
    sellerId INTEGER NOT NULL,
    categoryId INTEGER NOT NULL,
    idType INTEGER NOT NULL,
    idBrand INTEGER NOT NULL,
    clotheSize TEXT,
    listedAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sellerId) REFERENCES User(idUser),
    FOREIGN KEY (categoryId) REFERENCES Category(idCategory),
    FOREIGN KEY (idType) REFERENCES clothesType(idType),
    FOREIGN KEY (idBrand) REFERENCES Brand(idBrand)
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


INSERT INTO User (idUser, nome, username, email, pass, gender, rating, phoneNumber, is_admin)
VALUES
    (1, 'John Doe', 'johndoe', 'johndoe@example.com', 'password123', 'Homem', 4.5, 919715443, 0),
    (2, 'Jane Smith', 'janesmith', 'janesmith@example.com', 'pass1234', 'Mulher', 4.2, 987654321, 0),
    (3, 'Daniel Basílio', 'dbasilio', 'dbasilio@example.com', 'adminpass', 'Homem', 5.0, 911053549, 1);

INSERT INTO clothesType (idType, target)
VALUES
    (1, 'Homem'),
    (2, 'Mulher'),
    (3, 'Criança');

INSERT INTO Item (idItem, title, description, color, type_item, picture, price, condition, sellerId, categoryId, idType, idBrand, clotheSize, listedAt)
VALUES
    (1, 'T-shirt Masculina', 'T-shirt larga, confortável para homens', 'Preto', 'Homem', 'https://twicpics.celine.com/product-prd/images/large/2X75H626U.38AW_1_FW23_M.jpg?twic=v1/cover=1:1/resize-max=100/output=preview', 19.99, 'Etiquetado', 1, 1, 1, 1, 'L', '2024-01-10 10:00:00'),
    (2, 'Calça Jeans Feminina', 'Calça jeans elegante para mulheres', 'Azul', 'Mulher', 'https://twicpics.celine.com/product-prd/images/large/2N860930F.07UW_1_LIBSP23.jpg?twic=v1/cover=1:1/resize-max=100/output=preview', 39.99, 'Bom estado', 2, 2, 2, 2, 'M', '2024-04-07 10:00:00'),
    (3, 'Top Benetton para Meninas', 'Top preto para meninas crianças que gostem de viver o estilo', 'Preto', 'Criança', 'https://pt.benetton.com/dw/image/v2/BBSF_PRD/on/demandware.static/-/Sites-ucb-master/default/dw28142888/images/Full_PDP_h/UCB-Bambino_24P_31H3CH01F_100_FS_Full_PDP_h.jpg', 120.30, 'Razoável', 1, 3, 3, 3, 'S', '2024-02-20 10:40:35'),
    (4, 'Camisa Masculina', 'Camisa formal para homens', 'Branco', 'Homem', 'https://www.totalprotex.pt/media/catalog/product/cache/default/image/9df78eab33525d08d6e5fb8d27136e95/b/i/bizflame-88-12-fr-shirt-0_4.jpg', 49.99, 'Bom estado', 1, 1, 1, 7, 'XL', '2023-12-10 21:51:00'),
    (5, 'Vestido Feminino', 'Vestido elegante para mulheres', 'Rosa', 'Mulher', 'https://img.kwcdn.com/product/Fancyalgo/VirtualModelMatting/7aba4c96881db01c0dfb64a0e514896b.jpg?imageMogr2/auto-orient%7CimageView2/2/w/800/q/70/format/webp', 59.99, 'Etiquetado', 2, 2, 2, 5, 'L', '2024-02-21 20:01:04'),
    (6, 'Sweat para meninos', 'Sweat fofa para meninos criança', 'Azul', 'Criança', 'https://www.vidaxl.pt/dw/image/v2/BFNS_PRD/on/demandware.static/-/Sites-vidaxl-catalog-master-sku/default/dw9467291c/hi-res/166/1604/182/5410/13369/image_1_13369.jpg', 14.99, 'Razoável', 3, 3, 3, 6, 'M', '2024-04-01 08:06:43'),
    (7, 'Pijama Masculino', 'Pijama quentinho e bonito para homens de 18 anos', 'Preto', 'Homem', 'https://womensecret.com/dw/image/v2/AAYL_PRD/on/demandware.static/-/Sites-gc-ws-master-catalog/default/dwf09e4c1f/images/hi-res/P_429682201D3.jpg', 79.99, 'Bom estado', 1, 1, 1, 2, 'L', '2023-11-27 01:51:00'),
    (8, 'Casaco Feminino', 'Casaco casual para mulheres', 'Branco', 'Homem', 'https://img.kwcdn.com/thumbnail/s/b59cade0f92c774b20100ef92be11a8f_4399c89a1a23.jpg?imageView2/2/w/800/q/70/format/webp', 29.99, 'Etiquetado', 2, 2, 2, 10, 'S', '2022-12-01 18:06:23'),
    (9, 'Calça Infantil', 'Calça confortável para crianças', 'Cinza', 'Criança', 'https://bughug.pt/wp-content/uploads/2024/03/73-650x650.png', 24.99, 'Mau estado', 3, 3, 3, 12, 'S', '2024-03-10 12:59:45'),
    (10, 'Calções Hugo Boss Homem', 'Calções casuais para homens, ideais para saídas', 'Bege', 'Homem', 'https://images.hugoboss.com/is/image/boss/hbeu50515314_255_350?$re_fullPageZoom$&qlt=85&fit=crop,1&align=1,1&lastModified=1713351095000&wid=1200&hei=1818', 34.99, 'Bom estado', 1, 1, 1, 4, 'M', '2024-03-01 23:46:13');


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
    (7, 'Hugo Boss'),
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
    
