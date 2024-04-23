<?php
  declare(strict_types = 1);
  require_once('user.class.php');

  class Category {

    public int $idBrand;
    public string $brandName;
    
    public function __construct(int $idBrand, string $brandName) { 
        $this->idBrand = $idBrand;
        $this->brandName = $brandName;
    }

    static function getBrands(PDO $db) : array {
        $stmt = $db->prepare('SELECT * FROM Brand LIMIT ?');
        $stmt->execute(); 
    
        $brands = array();
        while ($brand = $stmt->fetch()) {
            $brands[] = new Brand(
                intval($brand['idBrand']), 
                $brand['brandName']);
        }
    
        return $brands;
    }

    static function getBrand(PDO $db, int $idBrand) : Brand {
        $stmt = $db->prepare('SELECT * FROM Brand WHERE idBrand = ?');
        $stmt->execute(array($idBrand)); 
    
        $brand = $stmt->fetch();
        return new Brand(
            intval($category['idBrand']), 
            $category['brandName']);
    }

    static function getBrandByItem(PDO $db, int $idItem) : Brand {
        $stmt = $db->prepare('SELECT Brand.* FROM Brand JOIN Item ON Brand.idBrand = Item.idBrand WHERE Item.idItem = ?');
        $stmt->execute(array($idItem)); 
    
        $brand = $stmt->fetch();
        return new Brand(
            intval($brand['idBrand']), 
            $brand['brandName']
        );  
    }
    
    static function getBrandsBySeller(PDO $db, int $sellerId) : array {
        $stmt = $db->prepare('SELECT Brand.* FROM Brand JOIN Item ON Brand.idBrand = Item.idBrand WHERE Item.sellerId = ?');
        $stmt->execute(array($sellerId)); 
    
        $brands = array();
        while ($brand = $stmt->fetch()) {
            $brands[] = new Brand(
                intval($brand['idBrand']), 
                $brand['brandName']
            );
        }
    
        return $brands;
    } 
    
    function save($db) {
        $stmt = $db->prepare('
            UPDATE Brand SET brandName = ?
            WHERE idBrand = ?
        ');
    
        $stmt->execute(array($this->brandName, 
                            $this->idBrand));
    }
    
    static function search(PDO $db, string $query) : array {
        $stmt = $db->prepare('SELECT * FROM Brand WHERE brandName LIKE ?');
        $stmt->execute(array('%'.$query.'%')); 
    
        $brands = array();
        while ($brand = $stmt->fetch()) {
            $brands[] = new Brand(
                intval($brand['idBrand']), 
                $brand['brandName']
            );
        }
    
        return $brands;
    }
  }
?>