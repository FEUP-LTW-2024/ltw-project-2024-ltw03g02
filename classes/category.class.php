<?php
  declare(strict_types = 1);
  require_once('user.class.php');

  class Category {

    public int $idCategory;
    public string $categoryName;
    
    public function __construct(int $idCategory, string $categoryName) { 
        $this->idCategory = $idCategory;
        $this->categoryName = $categoryName;
    }

    static function getCategories(PDO $db) : array {
        $stmt = $db->prepare('SELECT * FROM Category LIMIT ?');
        $stmt->execute(); 
    
        $categories = array();
        while ($category = $stmt->fetch()) {
            $categories[] = new Category(
                intval($category['idCategory']), 
                $category['categoryName']);
        }
    
        return $categories;
    }

    static function getCategory(PDO $db, int $idCategory) : Category {
        $stmt = $db->prepare('SELECT * FROM Category WHERE idCategory = ?');
        $stmt->execute(array($idCategory)); 
    
        $category = $stmt->fetch();
        return new Category(
            intval($category['idCategory']), 
            $category['categoryName']);
    }

    static function getCategoryByItem(PDO $db, int $idItem) : Category {
        $stmt = $db->prepare('SELECT Category.* FROM Category JOIN Item ON Category.idCategory = Item.categoryId WHERE Item.idItem = ?');
        $stmt->execute(array($idItem)); 
    
        $category = $stmt->fetch();
        return new Category(
            intval($category['idCategory']), 
            $category['categoryName']);
    }  

    static function getCategoryBySeller(PDO $db, int $sellerId) : array {
        $stmt = $db->prepare('SELECT Category.* FROM Category JOIN Item ON Category.idCategory = Item.categoryId WHERE Item.sellerId = ?');
        $stmt->execute(array($sellerId)); 
    
        $categories = array();
        while ($category = $stmt->fetch()) {
            $categories[] = new Category(
                intval($category['idCategory']), 
                $category['categoryName']);
        }
    
        return $categories;
    } 
    
    function save($db) {
      $stmt = $db->prepare('
        UPDATE Category SET categoryName = ?
        WHERE idCategory = ?
      ');

      $stmt->execute(array($this->categoryName, 
                            $this->idCategory));
    }

    static function search(PDO $db, string $query) : array {
        $stmt = $db->prepare('SELECT * FROM Category WHERE categoryName LIKE ?');
        $stmt->execute(array('%'.$query.'%')); 
    
        $categories = array();
        while ($category = $stmt->fetch()) {
            $categories[] = new Category(
                intval($category['idCategory']), 
                $category['categoryName']);
        }
    
        return $categories;
    }
  }
?>