SQLite format 3   @     3              &                                                 3 -�   �    ���                                                                                 ��tableUserUserCREATE TABLE User (
    idUser INTEGER PRIMARY KEY AUTOINCREMENT,
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
)'; indexsqlite_autoindex_User_2User'; indexsqlite_autoindex_User_1UserP++Ytablesqlite_sequencesqlite_sequenceCREATE TABLE sqlite_seq   
         L p�L                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              � +5�	Daniel Basíliodbasiliodbasilio@example.comadminpassHomemhttps://upload.wikimedia.org/wikipedia/commons/a/ac/Default_pfp.jpg6M�� !7�Jane Smithjanesmithjanesmith@example.compass1234Mulherhttps://upload.wikimedia.org/wikipedia/commons/a/ac/Default_pfp.jpg@      :�h�� 3#�John Doejohndoejohndoe@example.compassword123Homemhttps://upload.wikimedia.org/wikipedia/commons/a/ac/Default_pfp.jpg@      6Ѿs
   � ���                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            dbasiliojanesmith
	johndoe
   � ���                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        5dbasilio@example.com7janesmith@example.com3	johndoe@example.com   � �����                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
Review	BrandCategoryItem
User   �    ��                                                                                                                                                                                  �C ?��_	3Top Benetton para MeninasTop preto para meninas crianças que gostem de viver o estiloPretoCriançahttps://pt.benetton.com/dw/image/v2/BBSF_PRD/on/demandware.static/-/Sites-ucb-master/default/dw28142888/images/Full_PDP_h/UCB-Bambino_24P_31H3CH01F_100_FS_Full_PDP_h.jpg@^33333RazoávelS2024-02-20 10:40:35�{ 7S�!3Calça Jeans FemininaCalça jeans elegante para mulheresAzulMulherhttps://twicpics.celine.com/product-prd/images/large/2N860930F.07UW_1_LIBSP23.jpg?twic=v1/cover=1:1/resize-max=100/output=preview@C��Q�Bom estadoM2024-04-07 10:00:00�w /[�!			3T-shirt MasculinaT-shirt larga, confortável para homensPretoHomemhttps://twicpics.celine.com/product-prd/images/large/2X75H626U.38AW_1_FW23_M.jpg?twic=v1/cover=1:1/resize-max=100/output=preview@3�p��
=EtiquetadoL2024-01-1          �  ��� �                                                                                 ��tableU                                                                                    P++Ytablesqlite_sequencesqlite_sequenceCREATE TABLE sqlite_sequence(name,seq)��tableUserUserCREATE TABLE User (
    idUser INTEGER PRIMARY KEY AUTOINCREMENT,
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
)'; indexsqlite_autoindex_User_1User'; indexsqlite_autoindex_User_2User    5  5 1                                        �H�stableItemItemCREATE TABLE Item (
    idItem INTEGER PRIMARY KEY AUTOINCREMENT,
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
    idBrand INTEGER NOT NULL,
    clotheSize TEXT,
    listedAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sellerId) REFERENCES User(idUser),
    FOREIGN KEY (categoryId) REFERENCES Category(idCategory),
    FOREIGN KEY (idBrand) REFERENCES Brand(idBrand)
)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 � �6�M"   �	�mtableReviewReviewCREATE TABLE Review (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    idUser INTEGER REFERENCES User,
    idItem INTEGER REFERENCES Item,
    stars INTEGER NOT NULL CHECK (1 <= stars AND stars <= 5),
    comment TEXT NOT NULL,
    data DATE
))= indexsqlite_autoindex_Brand_1Brand��otableBrandBrandCREATE TABLE Brand (
    idBrand INTEGER PRIMARY KEY AUTOINCREMENT,
    brandName VARCHAR(255) NOT NULL UNIQUE	
)�[	�tableMessageMessage	CREATE TABLE Message (
    idMessage INTEGER PRIMARY KEY AUTOINCREMENT,
    senderId INTEGER NOT NULL,
    receiverId INTEGER NOT NULL,
    messageText TEXT NOT NULL,
    sentAt DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (senderId) REFERENCES User(idUser),
    FOREIGN KEY (receiverId) REFERENCES User(idUser)
)�
�tableCategoryCategoryCREATE TABLE Category (
    idCategory INTEGER PRIMARY KEY AUTOINCREMENT,
    categoryName VARCHAR(255) NOT NULL UNIQUE
)/C indexsqlite_autoindex_Category_1Category   C �����������|rcWLC                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          Fato	 Pijama
 Vestido !Activewear Kispo Blusa	 Blazer	
 Casaco	 Top Camisola Sweat
 T-shirt Polo	 Camisa	 Shorts Calções
 Calças
   D d�}�����DsM�����X                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          Fato
PijamaVestido!Activewear	Kispo	Blusa
Blazer
Casaco
Top	Camisola	SweatT-shirtPolo
Camisa
ShortsCalções
	Calças   3 ����������wlbXN?3                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
 Primark !Balenciaga Gucci Guess Levis	 Adidas Nike
 Mango	 'Massimo Dutti H&M Hugo Boss Intimissi !Fred Perry !Polo Ralph Pull&Bear	 Berska Zara
   4 m@��OY���c��x�4��                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          Primark!Balenciaga	Gucci	Guess	Levis
AdidasNike	Mango
'Massimo Dutti	H&MHugo BossIntimissi!Fred Perry!Polo RalphPull&Bear
Berska	Zara   / ��f��{/                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       J 	{!Calças com excelente qualidade, e com entrega rápida.2024-04-21; [!Blusa casual perfeita para o dia a dia.2024-04-20' 3!
Casaco confortável2024-04-18: Y!Vestido lindo, encaixou perfeitamente!2024-04-17G 	u!Camisa impecável, excelente para ocasiões formais.2024-04-16> a!Perfeito para o meu filho, está a adorar!2024-04-15" 	+!Boa aparência.2024-04-144 M!Produto de qualidade, recomendo!2024-04-13                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              �  ( :�� (                    �b1�triggerupdate_user_ratingReviewCREATE TRIGGER update_user_rating
AFTER INSERT ON Review
BEGIN
    UPDATE User
    SET rating = (SELECT AVG(stars) FROM Review WHERE idUser = NEW.idUser)
    WHERE idUser = NEW.idUser;
END�w�=tableUserOrderUserOrderCREATE TABLE UserOrder (
    idUser INTEGER REFERENCES User,
    idItem INTEGER REFERENCES Item,
    address TEXT NOT NULL,
    data DATETIME NOT NULL,
    state TEXT NOT NULL,
    PRIMARY KEY(idUser, idItem, data)
)1E indexsqlite_autoindex_UserOrder_1UserOrder��otableBrandBrandCREATE TABLE Brand (
    idBrand INTEGER PRIMARY KEY AUTOINCREMENT,
    brandName VARCHAR(255) NOT NULL UNIQUE	
))= indexsqlite_autoindex_Brand_1Brand�	�mtableReviewReviewCREATE TABLE Review (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    idUser INTEGER REFERENCES User,
    idItem INTEGER REFERENCES Item,
    stars INTEGER NOT NULL CHECK (1 <= stars AND stars <= 5),
    comment TEXT NOT NULL,
    data DATE
)   
                              
         	            _ratingReviewCREATE TRIGGER update_user_rating
AFTER INSERT ON Review
BEGIN
    UPDATE User
    SET rating = (SELECT AVG(stars) FROM Review WHERE idUser = NEW.idUser)
    WHERE idUser = NEW.idUser;
END�w�=tableUserOrderUserOrderCREATE TABLE UserOrder (
    idUser INTEGER REFERENCES User,
    idItem INTEGER REFERENCES Item,
    address TEXT NOT NULL,
    data DATETIME NOT NULL,
    state TEXT NOT NULL,
    PRIMARY KEY(idUser, idItem, data)
)1E indexsqlite_autoindex_UserOrder_1UserOrder��otableBrandBrandCREATE TABLE Brand (
    idBrand INTEGER PRIMARY KEY AUTOINCREMENT,
    brandName VARCHAR(255) NOT NULL UNIQUE	
))= indexsqlite_autoindex_Brand_1Brand�	�mtableReviewReviewCREATE TABLE Review (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    idUser INTEGER REFERENCES User,
    idItem INTEGER REFERENCES Item,
    stars INTEGER NOT NULL CHECK (1 <= stars AND stars <= 5),
    comment TEXT NOT NULL,
    data DATE
)       �  �                                                                                                                                                                                    �C ?��_	3Top Benetton para MeninasTop preto para meninas crianças que gostem de viver o estiloPretoCriançahttps://pt.benetton.com/dw/image/v2/BBSF_PRD/on/demandware.static/-/Sites-ucb-master/default/dw28142888/images/Full_PDP_h/UCB-Bambino_24P_31H3CH01F_100_FS_Full_PDP_h.jpg@^33333RazoávelS2024-02-20 10:40:35�{ 7S�!3Calça Jeans FemininaCalça jeans elegante para mulheresAzulMulherhttps://twicpics.celine.com/product-prd/images/large/2N860930F.07UW_1_LIBSP23.jpg?twic=v1/cover=1:1/resize-max=100/output=preview@C��Q�Bom estadoM2024-04-07 10:00:00�w /[�!			3T-shirt MasculinaT-shirt larga, confortável para homensPretoHomemhttps://twicpics.celine.com/product-prd/images/large/2X75H626U.38AW_1_FW23_M.jpg?twic=v1/cover=1:1/resize-max=100/output=preview@3�p��
=EtiquetadoL2024-01-10 10:00:00    � 	� �                                                                                                                                                                                                              � 1M�W3Sweat para meninosSweat fofa para meninos criançaAzulCriançahttps://www.vidaxl.pt/dw/image/v2/BFNS_PRD/on/demandware.static/-/Sites-vidaxl-catalog-master-sku/default/dw9467291c/hi-res/166/1604/182/5410/13369/image_1_13369.jpg@-��G�{RazoávelM2024-04-01 08:06:43� -I�G!3Vestido FemininoVestido elegante para mulheresRosaMulherhttps://img.kwcdn.com/product/Fancyalgo/VirtualModelMatting/7aba4c96881db01c0dfb64a0e514896b.jpg?imageMogr2/auto-orient%7CimageView2/2/w/800/q/70/format/webp@M��Q�EtiquetadoL2024-02-21 20:01:04�t -?�!		3Camisa MasculinaCamisa formal para homensBrancoHomemhttps://www.totalprotex.pt/media/catalog/product/cache/default/image/9df78eab33525d08d6e5fb8d27136e95/b/i/bizflame-88-12-fr-shirt-0_4.jpg@H��Q�Bom estadoXL2023-12-10 21:51:00    + �Q +                           �#
 ?q�?!		3Calções Hugo Boss HomemCalções casuais para homens, ideais para saídasBegeHomemhttps://images.hugoboss.com/is/image/boss/hbeu50515314_255_350?$re_fullPageZoom$&qlt=85&fit=crop,1&align=1,1&lastModified=1713351095000&wid=1200&hei=1818@A~�Q�Bom estadoM2024-03-01 23:46:13�1	 +Q�!3Calça InfantilCalça confortável para criançasCinzaCriançahttps://bughug.pt/wp-content/uploads/2024/03/73-650x650.png@8�p��
=Mau estadoS2024-03-10 12:59:45�d +C�{!3Casaco FemininoCasaco casual para mulheresBrancoHomemhttps://img.kwcdn.com/thumbnail/s/b59cade0f92c774b20100ef92be11a8f_4399c89a1a23.jpg?imageView2/2/w/800/q/70/format/webp@=�p��
=Etiquetado
S2022-12-01 18:06:23� -m�/!		3Pijama MasculinoPijama quentinho e bonito para homens de 18 anosPretoHomemhttps://womensecret.com/dw/image/v2/AAYL_PRD/on/demandware.static/-/Sites-gc-ws-master-catalog/default/dwf09e4c1f/images/hi-res/P_429682201D3.jpg@S�\(�Bom estadoL2023-11-27 01:51:00