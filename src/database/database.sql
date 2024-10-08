DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Item;
DROP TABLE IF EXISTS Message;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS Brand;
DROP TABLE IF EXISTS Review;
DROP TABLE IF EXISTS UserOrder;
DROP TABLE IF EXISTS FavoriteItem;
DROP TABLE IF EXISTS Apoio;
DROP TABLE IF EXISTS Devolutions;
DROP TABLE IF EXISTS clotheSize;
DROP TABLE IF EXISTS condition;
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
    rating FLOAT DEFAULT 0.0,
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
    type_item VARCHAR(255) NOT NULL CHECK (
        type_item IN ('Homem', 'Mulher', 'Criança')
    ),
    picture TEXT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    condition INTEGER NOT NULL,
    sellerId INTEGER NOT NULL,
    categoryId INTEGER NOT NULL,
    idBrand INTEGER NOT NULL,
    clotheSize INTEGER NOT NULL,
    listedAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    isSold BOOLEAN DEFAULT FALSE,
    idOrder INTEGER,
    FOREIGN KEY (sellerId) REFERENCES User(idUser),
    FOREIGN KEY (categoryId) REFERENCES Category(idCategory),
    FOREIGN KEY (idBrand) REFERENCES Brand(idBrand),
    FOREIGN KEY (clotheSize) REFERENCES clotheSize(idSize),
    FOREIGN KEY (condition) REFERENCES condition(idCondition)
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
    idOrder INTEGER PRIMARY KEY AUTOINCREMENT,
    idBuyer INTEGER REFERENCES User,
    idSeller INTEGER REFERENCES User,
    idItem INTEGER REFERENCES Item,
    paymentOption TEXT NOT NULL,
    productPrice DECIMAL(10, 2) NOT NULL,
    data DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Apoio (
    idApoio INTEGER PRIMARY KEY AUTOINCREMENT,
    idUser INTEGER NOT NULL,
    message TEXT NOT NULL,
    sentAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idUser) REFERENCES User(idUser)
);

CREATE TABLE clotheSize (
    idSize INTEGER PRIMARY KEY AUTOINCREMENT,
    sizeName VARCHAR(255) NOT NULL
);

CREATE TABLE condition (
    idCondition INTEGER PRIMARY KEY AUTOINCREMENT,
    conditionName VARCHAR(255) NOT NULL
);

-- Create Devolutions table
CREATE TABLE Devolutions (
    idDevolutions INTEGER PRIMARY KEY AUTOINCREMENT,
    idUser INTEGER NOT NULL,
    message TEXT NOT NULL,
    sentAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idUser) REFERENCES User(idUser)
);

CREATE TRIGGER update_user_rating
AFTER INSERT ON Review
BEGIN
    UPDATE User
    SET rating = (SELECT AVG(stars) FROM Review WHERE idUser = NEW.idUser)
    WHERE idUser = NEW.idUser;
END;


INSERT INTO User (nome, username, email, pass, gender, address, profile_image_link, rating, phoneNumber, is_admin)
VALUES
    ('John Doe', 'johndoe', 'johndoe@example.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Homem', 'Rua das Árvores, n.10', 'https://www.tvguide.com/a/img/catalog/provider/1/1/1-593743038.jpg', 4.5, 919715443, 0),
    ('Jane Smith', 'janesmith', 'janesmith@example.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Mulher', 'Praceta Luis Falcão 45', 'https://upload.wikimedia.org/wikipedia/commons/c/cd/Panda_Cub_from_Wolong%2C_Sichuan%2C_China.JPG', 4.2, 987654321, 0),
    ('Daniel Basílio', 'dbasilio', 'dbasilio@example.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'Homem', 'Avenida Jorge Nuno Pinto da Costa, 4560-231', 'https://static.giga.de/wp-content/uploads/2015/01/google-chrome-dino.png', 5.0, 911053549, 1),
    ('Ricardo Cardoso', 'ricardo0015', 'ricardo0015@example.com', '0b14d501a594442a01c6859541bcb3e8164d183d32937b851835442f69d5c94e', 'Homem', 'Rua Inês Teixeira nº32', 'http://s2.glbimg.com/C8ORi7DA7326QPtHKxd0a7JGKco=/695x0/s.glbimg.com/po/tt2/f/original/2015/09/15/ness.jpg', 5.0, 932123432, 1),
    ('Daunísia Jone', 'dawen', 'dawen@example.com', 'c63c2d34ebe84032ad47b87af194fedd17dacf8222b2ea7f4ebfee3dd6db2dfb', 'Mulher', 'Rua André Restivo, nº3', 'https://i.pinimg.com/736x/3f/58/60/3f58604beda34909dd5984ef4458a96f.jpg', 5.0, 911053549, 1);

INSERT INTO Item (title, description, color, type_item, picture, price, condition, sellerId, categoryId, idBrand, clotheSize, listedAt)
VALUES
    ('T-shirt Masculina', 'T-shirt larga, confortável para homens', 'Preto', 'Homem', 'https://opcaounica.pt/wp-content/uploads/2020/06/1006_01.jpg', 19.99, 'Etiquetado', 1, 1, 1, 3, '2024-01-10 10:00:00'),
    ('Calça Jeans Feminina', 'Calça jeans elegante para mulheres', 'Azul', 'Mulher', 'https://static.kiabi.pt/images/calcoes-em-camurca-sintetica-preto-null-xv682_1_zc2.jpg', 39.99, 'Bom estado', 2, 2, 2, 2, '2024-04-07 10:00:00'),
    ('Top Benetton para Meninas', 'Top preto para meninas crianças que gostem de viver o estilo', 'Preto', 'Criança', 'https://pt.benetton.com/dw/image/v2/BBSF_PRD/on/demandware.static/-/Sites-ucb-master/default/dw28142888/images/Full_PDP_h/UCB-Bambino_24P_31H3CH01F_100_FS_Full_PDP_h.jpg', 120.30, 'Razoável', 1, 3, 3, 1, '2024-02-20 10:40:35'),
    ('Camisa Masculina', 'Camisa formal para homens', 'Branco', 'Homem', 'https://www.totalprotex.pt/media/catalog/product/cache/default/image/9df78eab33525d08d6e5fb8d27136e95/b/i/bizflame-88-12-fr-shirt-0_4.jpg', 49.99, 'Bom estado', 1, 1, 7, 4, '2023-12-10 21:51:00'),
    ('Vestido Feminino', 'Vestido elegante para mulheres', 'Rosa', 'Mulher', 'https://img.kwcdn.com/product/Fancyalgo/VirtualModelMatting/7aba4c96881db01c0dfb64a0e514896b.jpg?imageMogr2/auto-orient%7CimageView2/2/w/800/q/70/format/webp', 59.99, 'Etiquetado', 2, 2, 5, 3, '2024-02-21 20:01:04'),
    ('Sweat para meninos', 'Sweat fofa para meninos criança', 'Azul', 'Criança', 'https://www.vidaxl.pt/dw/image/v2/BFNS_PRD/on/demandware.static/-/Sites-vidaxl-catalog-master-sku/default/dw9467291c/hi-res/166/1604/182/5410/13369/image_1_13369.jpg', 14.99, 'Razoável', 3, 3, 6, 2, '2024-04-01 08:06:43'),
    ('Pijama Masculino', 'Pijama quentinho e bonito para homens de 18 anos', 'Preto', 'Homem', 'https://womensecret.com/dw/image/v2/AAYL_PRD/on/demandware.static/-/Sites-gc-ws-master-catalog/default/dwf09e4c1f/images/hi-res/P_429682201D3.jpg', 79.99, 'Bom estado', 1, 1, 2, 3, '2023-11-27 01:51:00'),
    ('Casaco Feminino', 'Casaco casual para mulheres', 'Branco', 'Homem', 'https://img.kwcdn.com/thumbnail/s/b59cade0f92c774b20100ef92be11a8f_4399c89a1a23.jpg?imageView2/2/w/800/q/70/format/webp', 29.99, 'Etiquetado', 2, 2, 10, 1, '2022-12-01 18:06:23'),
    ('Calça Infantil', 'Calça confortável para crianças', 'Cinza', 'Criança', 'https://bughug.pt/wp-content/uploads/2024/03/73-650x650.png', 24.99, 'Mau estado', 3, 3, 12, 1, '2024-03-10 12:59:45'),
    ('Calções Hugo Boss Homem', 'Calções casuais para homens, ideais para saídas', 'Bege', 'Homem', 'https://images.hugoboss.com/is/image/boss/hbeu50515314_255_350?$re_fullPageZoom$&qlt=85&fit=crop,1&align=1,1&lastModified=1713351095000&wid=1200&hei=1818', 34.99, 'Bom estado', 1, 1, 4, 2, '2024-03-01 23:46:13'),
    ('Blusa Feminina', 'Blusa casual para mulheres', 'Vermelho', 'Mulher', 'https://http2.mlstatic.com/D_NQ_NP_2X_682376-MLM27591541635_062018-F.jpg', 29.99, 'Etiquetado', 2, 2, 8, 1, '2024-05-01 18:06:23'),
    ('Shorts Infantil', 'Shorts confortável para crianças', 'Verde', 'Criança', 'https://i.pinimg.com/736x/0a/d3/78/0ad378e484487add42537b26aad8b995.jpg', 14.99, 'Bom estado', 3, 3, 9, 1, '2024-06-10 12:59:45'),
    ('Camiseta Adidas Homem', 'Camiseta esportiva para homens', 'Branco', 'Homem', 'https://ae01.alicdn.com/kf/Hae87a2bdfd94479191f86f72821c9495G/Camiseta-esportiva-de-compress-o-para-homens-camiseta-de-compress-o-de-r-pida-secagem-para.jpg', 24.99, 'Bom estado', 1, 1, 5, 2, '2024-07-01 23:46:13'),
    ('Vestido Infantil', 'Vestido bonito para meninas', 'Rosa', 'Criança', 'https://ae01.alicdn.com/kf/HTB14JyfJpXXXXb6XpXXq6xXFXXXz/Flor-do-la-o-menina-vestidos-roupas-crian-as-crian-as-vestidos-de-tutu-de-casamento.jpg', 19.99, 'Etiquetado', 3, 3, 10, 1, '2024-08-20 12:00:00'),
    ('Calça Levis Homem', 'Calça jeans Levis para homens', 'Azul', 'Homem', 'https://http2.mlstatic.com/calca-masculina-levis-jeans-original-504-tradicional-levis-D_NQ_NP_954291-MLB26429676258_112017-F.jpg', 49.99, 'Bom estado', 1, 1, 6, 3, '2024-09-01 10:00:00'),
    ('Blusa Mango Mulher', 'Blusa casual para mulheres', 'Azul', 'Mulher', 'https://ae01.alicdn.com/kf/HTB1yRE3KpXXXXaKXpXXq6xXFXXXu/Escrit-rio-uniforme-blusas-mulheres-blusas-formais-camisas-para-trabalho-de-ver-o-de-manga-curta.jpg', 29.99, 'Etiquetado', 2, 2, 11, 1, '2024-10-01 10:00:00'),
    ('Camiseta Nike Feminina', 'Camiseta esportiva para mulheres', 'Branco', 'Mulher', 'https://i.pinimg.com/originals/51/01/b0/5101b0fae9d0f0fdbe3576f76a39f20d.jpg', 24.99, 'Bom estado', 2, 2, 5, 2, '2024-07-01 23:46:13'),
    ('Vestido Infantil Floral', 'Vestido floral para meninas', 'Branco', 'Criança', 'https://ecameleca.vteximg.com.br/arquivos/ids/160240-2000-2000/vestido-infantil-flores-pink-ninali.jpg?v=636294913202200000', 19.99, 'Etiquetado', 3, 3, 10, 1, '2024-08-20 12:00:00'),
    ('Calça Diesel Homem', 'Calça jeans Diesel para homens', 'Azul', 'Homem', 'https://images.etiquetaunica.com.br/products/calca-diesel-timmen-reta-jeans-masculina-czx4_542131.jpg', 49.99, 'Bom estado', 1, 1, 6, 3, '2024-09-01 10:00:00'),
    ('Blusa Zara Feminina', 'Blusa casual da Zara para mulheres', 'Preto', 'Mulher', 'https://static.mujerhoy.com/www/multimedia/201907/20/media/cortadas/5-zara-blusa-verde.jpg', 29.99, 'Etiquetado', 2, 2, 8, 1, '2024-05-01 18:06:23'),
    ('Shorts Infantil Adidas', 'Shorts esportivo da Adidas para crianças', 'Azul', 'Criança', 'https://www.planetatenis.com.br/media/catalog/product/cache/1/image/800x/9df78eab33525d08d6e5fb8d27136e95/s/h/shorts_adidas_2_move_3-stripes_gn3108_a.jpg', 14.99, 'Bom estado', 3, 3, 9, 1, '2024-06-10 12:59:45');



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
    
INSERT INTO clotheSize(sizeName) 
VALUES
    ('S'),
    ('M'),
    ('L'),
    ('XL');
    
INSERT INTO condition(conditionName)
VALUES
    ('Etiquetado'),
    ('Bom estado'),
    ('Razoável'),
    ('Mau estado');
    
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
    
