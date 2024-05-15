DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS clothesType;
DROP TABLE IF EXISTS Item;
DROP TABLE IF EXISTS Message;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS Brand;
DROP TABLE IF EXISTS Review;
DROP TABLE IF EXISTS UserOrder;
DROP TABLE IF EXISTS FavoriteItem;
DROP TRIGGER IF EXISTS update_user_rating;

CREATE TABLE User (
    idUser INTEGER PRIMARY KEY AUTOINCREMENT,
    nome VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    pass VARCHAR(255) NOT NULL,
    gender VARCHAR(255) NOT NULL CHECK (
        gender IN ('Mulher', 'Homem')
    ),
    address TEXT NOT NULL,
    profile_image_link TEXT DEFAULT 'https://upload.wikimedia.org/wikipedia/commons/a/ac/Default_pfp.jpg',
    rating FLOAT,
    phoneNumber INTEGER NOT NULL CHECK (100000000 <= phoneNumber AND phoneNumber <= 999999999),
    is_admin BOOLEAN DEFAULT FALSE,
    CONSTRAINT UNIQUE_username UNIQUE (username),
    CONSTRAINT UNIQUE_email UNIQUE (email)
);

CREATE TABLE Item (
    idItem INTEGER PRIMARY KEY AUTOINCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    color VARCHAR(255) NOT NULL CHECK (
        color IN ('Preto', 'Azul', 'Vermelho', 'Bege', 'Branco', 'Castanho', 'Cinza', 'Dourado', 'Laranja', 'Lilás', 'Violeta', 'Rosa', 'Roxo', 'Verde')
    ),
    picture TEXT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    condition VARCHAR(255) NOT NULL CHECK (
        condition IN ('Etiquetado', 'Bom estado', 'Razoável', 'Mau estado')
    ),
    sellerId INTEGER NOT NULL,
    categoryId INTEGER NOT NULL,
    idBrand INTEGER NOT NULL,
    idType INTEGER NOT NULL,
    clotheSize TEXT,
    listedAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sellerId) REFERENCES User(idUser),
    FOREIGN KEY (categoryId) REFERENCES Category(idCategory),
    FOREIGN KEY (idBrand) REFERENCES Brand(idBrand),
    FOREIGN KEY (idType) REFERENCES clothesType(idType)
);

-- Create Message table
CREATE TABLE Message (
    idMessage INTEGER PRIMARY KEY AUTOINCREMENT,
    senderId INTEGER NOT NULL,
    receiverId INTEGER NOT NULL,
    messageText TEXT NOT NULL,
    sentAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (senderId) REFERENCES User(idUser),
    FOREIGN KEY (receiverId) REFERENCES User(idUser)
);

-- Create Category table
CREATE TABLE Category (
    idCategory INTEGER PRIMARY KEY AUTOINCREMENT,
    categoryName VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE Brand (
    idBrand INTEGER PRIMARY KEY AUTOINCREMENT,
    brandName VARCHAR(255) NOT NULL UNIQUE	
);

CREATE TABLE Review (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    idUser INTEGER REFERENCES User,
    idItem INTEGER REFERENCES Item,
    stars INTEGER NOT NULL CHECK (0 <= stars AND stars <= 5),
    comment TEXT NOT NULL,
    data DATE
);

CREATE TABLE FavoriteItem (
    idUser INTEGER REFERENCES User,
    idItem INTEGER REFERENCES Item,
    PRIMARY KEY (idUser, idItem)
);

CREATE TABLE UserOrder (
    idUser INTEGER REFERENCES User,
    idItem INTEGER REFERENCES Item,
    address TEXT NOT NULL,
    data DATETIME NOT NULL,
    state TEXT NOT NULL,
    PRIMARY KEY(idUser, idItem, data)
);

CREATE TABLE clothesType (
    idType INTEGER PRIMARY KEY AUTOINCREMENT,
    typeName VARCHAR(255) NOT NULL
);

CREATE TRIGGER update_user_rating
AFTER INSERT ON Review
BEGIN
    UPDATE User
    SET rating = (SELECT AVG(stars) FROM Review WHERE idUser = NEW.idUser)
    WHERE idUser = NEW.idUser;
END;


INSERT INTO User (nome, username, email, pass, gender, address, rating, phoneNumber, is_admin)
VALUES
    ('John Doe', 'johndoe', 'johndoe@example.com', 'password123', 'Homem', 'Rua das Árvores, n.10', 4.5, 919715443, 0),
    ('Jane Smith', 'janesmith', 'janesmith@example.com', 'pass1234', 'Mulher', 'Praceta Luis Falcão 45', 4.2, 987654321, 0),
    ('Daniel Basílio', 'dbasilio', 'dbasilio@example.com', 'adminpass', 'Homem', 'Avenida Jorge Nuno Pinto da Costa, 4560-231', 5.0, 911053549, 1);

INSERT INTO Item (title, description, color, picture, price, condition, sellerId, categoryId, idBrand, idType, clotheSize, listedAt)
VALUES
    ('T-shirt Masculina', 'T-shirt larga, confortável para homens', 'Preto', 'https://twicpics.celine.com/product-prd/images/large/2X75H626U.38AW_1_FW23_M.jpg?twic=v1/cover=1:1/resize-max=100/output=preview', 19.99, 'Etiquetado', 1, 1, 1, 1, 'L', '2024-01-10 10:00:00'),
    ('Calça Jeans Feminina', 'Calça jeans elegante para mulheres', 'Azul', 'https://twicpics.celine.com/product-prd/images/large/2N860930F.07UW_1_LIBSP23.jpg?twic=v1/cover=1:1/resize-max=100/output=preview', 39.99, 'Bom estado', 2, 2, 2, 2, 'M', '2024-04-07 10:00:00'),
    ('Top Benetton para Meninas', 'Top preto para meninas crianças que gostem de viver o estilo', 'Preto', 'https://pt.benetton.com/dw/image/v2/BBSF_PRD/on/demandware.static/-/Sites-ucb-master/default/dw28142888/images/Full_PDP_h/UCB-Bambino_24P_31H3CH01F_100_FS_Full_PDP_h.jpg', 120.30, 'Razoável', 1, 3, 3, 3, 'S', '2024-02-20 10:40:35'),
    ('Camisa Masculina', 'Camisa formal para homens', 'Branco', 'https://www.totalprotex.pt/media/catalog/product/cache/default/image/9df78eab33525d08d6e5fb8d27136e95/b/i/bizflame-88-12-fr-shirt-0_4.jpg', 49.99, 'Bom estado', 1, 1, 7, 2, 'XL', '2023-12-10 21:51:00'),
    ('Vestido Feminino', 'Vestido elegante para mulheres', 'Rosa', 'https://img.kwcdn.com/product/Fancyalgo/VirtualModelMatting/7aba4c96881db01c0dfb64a0e514896b.jpg?imageMogr2/auto-orient%7CimageView2/2/w/800/q/70/format/webp', 59.99, 'Etiquetado', 2, 2, 5, 3, 'L', '2024-02-21 20:01:04'),
    ('Sweat para meninos', 'Sweat fofa para meninos criança', 'Azul', 'https://www.vidaxl.pt/dw/image/v2/BFNS_PRD/on/demandware.static/-/Sites-vidaxl-catalog-master-sku/default/dw9467291c/hi-res/166/1604/182/5410/13369/image_1_13369.jpg', 14.99, 'Razoável', 3, 3, 6, 1, 'M', '2024-04-01 08:06:43'),
    ('Pijama Masculino', 'Pijama quentinho e bonito para homens de 18 anos', 'Preto', 'https://womensecret.com/dw/image/v2/AAYL_PRD/on/demandware.static/-/Sites-gc-ws-master-catalog/default/dwf09e4c1f/images/hi-res/P_429682201D3.jpg', 79.99, 'Bom estado', 1, 1, 2, 1, 'L', '2023-11-27 01:51:00'),
    ('Casaco Feminino', 'Casaco casual para mulheres', 'Branco', 'https://img.kwcdn.com/thumbnail/s/b59cade0f92c774b20100ef92be11a8f_4399c89a1a23.jpg?imageView2/2/w/800/q/70/format/webp', 29.99, 'Etiquetado', 2, 2, 10, 2, 'S', '2022-12-01 18:06:23'),
    ('Calça Infantil', 'Calça confortável para crianças', 'Cinza', 'https://bughug.pt/wp-content/uploads/2024/03/73-650x650.png', 24.99, 'Mau estado', 3, 3, 12, 1, 'S', '2024-03-10 12:59:45'),
    ('Calções Hugo Boss Homem', 'Calções casuais para homens, ideais para saídas', 'Bege', 'https://images.hugoboss.com/is/image/boss/hbeu50515314_255_350?$re_fullPageZoom$&qlt=85&fit=crop,1&align=1,1&lastModified=1713351095000&wid=1200&hei=1818', 34.99, 'Bom estado', 1, 1, 4, 3, 'M', '2024-03-01 23:46:13');


INSERT INTO Category(categoryName) 
VALUES
    ('Calças'),
    ('Calções'),
    ('Shorts'),
    ('Camisa'),
    ('Polo'),
    ('T-shirt'),
    ('Sweat'),
    ('Camisola'),
    ('Top'),
    ('Casaco'),
    ('Blazer'),
    ('Blusa'),
    ('Kispo'),
    ('Activewear'),
    ('Vestido'),
    ('Pijama'),
    ('Fato');
    
INSERT INTO Brand(brandName)
VALUES
    ('Zara'),
    ('Berska'),
    ('Pull&Bear'),
    ('Polo Ralph'),
    ('Fred Perry'),
    ('Intimissi'),
    ('Hugo Boss'),
    ('H&M'),
    ('Massimo Dutti'),
    ('Mango'),
    ('Nike'),
    ('Adidas'),
    ('Levis'),
    ('Guess'),
    ('Gucci'),
    ('Balenciaga'),
    ('Primark');

INSERT INTO clothesType(typeName)
VALUES
    ('Homem'),
    ('Mulher'),
    ('Criança');   
    
INSERT INTO Review (idUser, idItem, stars, comment, data)
VALUES
    (2, 17, 4, 'Produto de qualidade, recomendo!', '2024-04-13'), 
    (1, 2, 4, 'Boa aparência.', '2024-04-14'),
    (4, 3, 5, 'Perfeito para o meu filho, está a adorar!', '2024-04-15'), 
    (1, 4, 5, 'Camisa impecável, excelente para ocasiões formais.', '2024-04-16'), 
    (2, 15, 5, 'Vestido lindo, encaixou perfeitamente!', '2024-04-17'), 
    (3, 10, 5, 'Casaco confortável', '2024-04-18'),
    (2, 12, 5, 'Blusa casual perfeita para o dia a dia.', '2024-04-20'),
    (2, 1, 5, 'Calças com excelente qualidade, e com entrega rápida.', '2024-04-21');
    
