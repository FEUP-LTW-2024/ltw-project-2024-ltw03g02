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

INSERT INTO Item (idItem, title, description, color, price, condition, sellerId, categoryId, idType, clotheSize)
VALUES
    (1, 'Camiseta Masculina', 'Camiseta de algodão confortável para homens', 'Preto', 19.99, 'Etiquetado', 1, 1, 1, 'L'),
    (2, 'Calça Jeans Feminina', 'Calça jeans elegante para mulheres', 'Azul', 39.99, 'Bom estado', 2, 2, 2, 'M'),
    (3, 'Moletom Infantil', 'Moletom quentinho para crianças', 'Vermelho', 29.99, 'Razoável', 1, 3, 3, 'S'),
    (4, 'Camisa Masculina', 'Camisa formal para homens', 'Branco', 49.99, 'Bom estado', 1, 1, 1, 'XL'),
    (5, 'Vestido Feminino', 'Vestido elegante para mulheres', 'Rosa', 59.99, 'Etiquetado', 2, 2, 2, 'L'),
    (6, 'Camiseta Infantil', 'Camiseta fofa para crianças', 'Azul', 14.99, 'Razoável', 3, 3, 3, 'M'),
    (7, 'Jaqueta Masculina', 'Jaqueta estilosa para homens', 'Preto', 79.99, 'Bom estado', 1, 1, 1, 'L'),
    (8, 'Blusa Feminina', 'Blusa casual para mulheres', 'Branco', 29.99, 'Etiquetado', 2, 2, 2, 'S'),
    (9, 'Calça Infantil', 'Calça confortável para crianças', 'Cinza', 24.99, 'Mau estado', 3, 3, 3, 'S'),
    (10, 'Bermuda Masculina', 'Bermuda casual para homens', 'Bege', 34.99, 'Bom estado', 1, 1, 1, 'M');


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
    
INSERT INTO Review (idUser, idItem, stars, comment, data)
VALUES
    (2, 17, 4, 'Produto de qualidade, recomendo!', '2024-04-13'), 
    (1, 2, 4, 'Boa aparência.', '2024-04-14'),
    (4, 3, 5, 'Perfeito para o meu filho, está a adorar!', '2024-04-15'), 
    (1, 4, 5, 'Camisa impecável, excelente para ocasiões formais.', '2024-04-16'), 
    (2, 15, 5, 'Vestido lindo, encaixou perfeitamente!', '2024-04-17'), 
    (3, 10, 5, 'Casaco confortável', '2024-04-18'),
    (2, 12, 5, 'Blusa casual perfeita para o dia a dia.', '2024-04-20'),
    (2, 1, 5, 'Calças com excelente qualidade, e com entrega rápida.', '2024-04-21'), 
    
