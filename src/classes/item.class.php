<?php
  declare(strict_types = 1);

  class Item {

    public int $idItem;
    public string $title;
    public string $description;
    public string $color;
    public string $type_item;
    public string $picture;
    public float $price;
    public string $condition;
    public int $sellerId;
    public int $categoryId;
    public int $idBrand;
    public string $clotheSize;
    public string $listedAt;

    public function __construct(int $idItem, string $title, string $description, string $color, string $type_item, string $picture, float $price, string $condition, int $sellerId, int $categoryId, int $idBrand, string $clotheSize, string $listedAt) { 
        $this->idItem = $idItem;
        $this->title = $title;
        $this->description = $description;
        $this->color = $color;
        $this->type_item = $type_item;
        $this->picture = $picture;
        $this->price = $price;
        $this->condition = $condition;
        $this->sellerId = $sellerId;
        $this->categoryId = $categoryId;
        $this->idBrand = $idBrand;
        $this->clotheSize = $clotheSize;
        $this->listedAt = $listedAt;
    }

    static function getItems(PDO $db, int $count) : array {

        $stmt = $db->prepare('SELECT * FROM Item LIMIT ?');
        $stmt->execute(array($count)); 
    
        $items = array();
        while ($item = $stmt->fetch()) {
            $items[] = new Item(
                intval($item['idItem']),
                $item['title'],
                $item['description'],
                $item['color'],
                $item['type_item'],
                $item['picture'],
                floatval($item['price']),
                $item['condition'],
                intval($item['sellerId']),
                intval($item['categoryId']),
                intval($item['idBrand']),
                $item['clotheSize'],
                $item['listedAt']
            );
        }
    
        return $items;
    }

    static function getItemsFromCategory(PDO $db, int $categoryId) : array {

        $stmt = $db->prepare('SELECT * FROM Item WHERE categoryId = ?');
        $stmt->execute(array($categoryId)); 
    
        $items = array();
        while ($item = $stmt->fetch()) {
            $items[] = new Item(
                intval($item['idItem']),
                $item['title'],
                $item['description'],
                $item['color'],
                $item['type_item'],
                $item['picture'],
                floatval($item['price']),
                $item['condition'],
                intval($item['sellerId']),
                intval($item['categoryId']),
                intval($item['idBrand']),
                $item['clotheSize'],
                $item['listedAt']
            );
        }
    
        return $items;
    }

    static function getItemsFromBrand(PDO $db, int $idBrand) : array {

        $stmt = $db->prepare('SELECT * FROM Item WHERE idBrand = ?');
        $stmt->execute(array($idBrand)); 
    
        $items = array();
        while ($item = $stmt->fetch()) {
            $items[] = new Item(
                intval($item['idItem']),
                $item['title'],
                $item['description'],
                $item['color'],
                $item['type_item'],
                $item['picture'],
                floatval($item['price']),
                $item['condition'],
                intval($item['sellerId']),
                intval($item['categoryId']),
                intval($item['idBrand']),
                $item['clotheSize'],
                $item['listedAt']
            );
        }
    
        return $items;
    }
    
    static function getItemsFromSeller(PDO $db, int $sellerId) : array {
    
        $stmt = $db->prepare('SELECT * FROM Item WHERE Item.sellerId = ?');
        $stmt->execute(array($sellerId)); 
    
        $items = array();
        while ($item = $stmt->fetch()) {
            $items[] = new Item(
                intval($item['idItem']),
                $item['title'],
                $item['description'],
                $item['color'],
                $item['type_item'],
                $item['picture'],
                floatval($item['price']),
                $item['condition'],
                intval($item['sellerId']),
                intval($item['categoryId']),
                intval($item['idBrand']),
                $item['clotheSize'],
                $item['listedAt']
            );
        }
    
        return $items;
    }

    static function getPendingOrders(PDO $db, int $id) : array {

      $stmt = $db->prepare('SELECT Item.*, UserOrder.state, User.nome AS owner, User.idUser AS userID
                            FROM Dish, UserOrder, User 
                            WHERE Item.categoryId = ? 
                            AND UserOrder.state <> "Cancelado" AND UserOrder.state <> "Entregue"
                            AND UserOrder.idItem = Item.idItem
                            AND UserOrder.idUser = User.idUser');
      $stmt->execute(array($id));
  
      $orders = array();
      while ($item = $stmt->fetch()) {
        $currentItem = new Item(
            intval($order['idItem']),
            $item['title'],
            $item['description'],
            $item['color'],
            $item['type_item'],
            $item['picture'],
            floatval($item['price']),
            $item['condition'],
            intval($item['sellerId']),
            intval($item['categoryId']),
            intval($item['idBrand']),
            $item['clotheSize'],
            $item['listedAt']);
        $orders[] = array($currentItem, $item['owner'], $item['userID'], $item['state']);
      }
      return $orders;
    }

    static function getItem(PDO $db, int $id) : Item {

      $stmt = $db->prepare('SELECT * FROM Item WHERE idItem = ?');
      $stmt->execute(array($id));
  
      $dish = $stmt->fetch();

      return new Item(
        intval($item['idItem']),
            $item['title'],
            $item['description'],
            $item['color'],
            $item['type_item'],
            $item['picture'],
            floatval($item['price']),
            $item['condition'],
            intval($item['sellerId']),
            intval($item['categoryId']),
            intval($item['idBrand']),
            $item['clotheSize'],
            $item['listedAt'],
      );
    }  

    static function getAttributes(PDO $db, string $attribute) : array {
      
      $result = array();
      $querie = "SELECT $attribute FROM Item GROUP BY $attribute";
      $stmt = $db->prepare($querie);
      $stmt->execute();

      while ($attemp = $stmt->fetch()) {
        $result[] = $attemp[$attribute];
      }
      return $result;
    }

    static function getItemsByColor(PDO $db, string $color) : array {
        $stmt = $db->prepare('SELECT * FROM Item WHERE color = ?');
        $stmt->execute(array($color)); 
    
        $items = array();
        while ($item = $stmt->fetch()) {
            $items[] = new Item(
                intval($item['idItem']),
                $item['title'],
                $item['description'],
                $item['color'],
                $item['type_item'],
                $item['picture'],
                floatval($item['price']),
                $item['condition'],
                intval($item['sellerId']),
                intval($item['categoryId']),
                intval($item['idBrand']),
                $item['clotheSize'],
                $item['listedAt']
            );
        }
    
        return $items;
    }
    
    static function getItemsByType(PDO $db, string $type_item) : array {
        $stmt = $db->prepare('SELECT * FROM Item WHERE Item.type_item = ?');
        $stmt->execute(array($type_item)); 
    
        $items = array();
        while ($item = $stmt->fetch()) {
            $items[] = new Item(
                intval($item['idItem']),
                $item['title'],
                $item['description'],
                $item['color'],
                $item['type_item'],
                $item['picture'],
                floatval($item['price']),
                $item['condition'],
                intval($item['sellerId']),
                intval($item['categoryId']),
                intval($item['idBrand']),
                $item['clotheSize'],
                $item['listedAt']
            );
        }
    
        return $items;
    }
    


    static function getItemsByCondition(PDO $db, string $condition) : array {
        $stmt = $db->prepare('SELECT * FROM Item WHERE condition = ?');
        $stmt->execute(array($condition)); 
    
        $items = array();
        while ($item = $stmt->fetch()) {
            $items[] = new Item(
                intval($item['idItem']),
                $item['title'],
                $item['description'],
                $item['color'],
                $item['type_item'],
                $item['picture'],
                floatval($item['price']),
                $item['condition'],
                intval($item['sellerId']),
                intval($item['categoryId']),
                intval($item['idBrand']),
                $item['clotheSize'],
                $item['listedAt']
            );
        }
    return $items;
    }   
    
    static function filteredSearch(PDO $db, $clotheSize, $type_item, $categoryId) {
        $sql = 'SELECT picture, username, price, clotheSize, type_item, categoryId, categoryName
            FROM Item 
            JOIN User ON sellerId=idUser 
            JOIN Category ON categoryId=idCategory';
        $sql .= ' WHERE 1=1';
        if ($clotheSize != null) {
            $sql .= ' AND clotheSize = :clotheSize';
        } 
        if ($type_item != null) {
            $sql .= ' AND type_item = :type_item';
        }
        if ($categoryId != null) {
            $sql .= ' AND categoryId = :categoryId';
        }  
        $sql .= ';';

        $stmt = $db->prepare($sql);
        if($type_item != null){
            $stmt->bindParam(':type_item', $type_item);
        }
        if($clotheSize != null){
            $stmt->bindParam(':clotheSize', $clotheSize);
        }
        if($categoryId != null){
            $stmt->bindParam(':categoryId', $categoryId);
        }

        $stmt->execute();
        $items = $stmt->fetchAll();
      
        return $items;
    }

    function save($db) {
        $stmt = $db->prepare('
            UPDATE Item SET title = ?, description = ?, color = ?, type_item = ?, picture = ?, price = ?, condition = ?, sellerId = ?, categoryId = ?, idBrand = ?, clotheSize = ?, listedAt = ?
            WHERE idItem = ?
        ');
    
        $stmt->execute(array($this->title, $this->description, $this->color, $this->type_item, $this->picture, $this->price, $this->condition, $this->sellerId, $this->categoryId, $this->idBrand, $this->clotheSize, $this->listedAt,
                            $this->idItem));
    }
  }
?>