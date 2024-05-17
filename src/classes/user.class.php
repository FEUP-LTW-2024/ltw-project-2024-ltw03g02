<?php
  declare(strict_types = 1);

  class User {

    public int $idUser;
    public string $nome;
    public string $username;
    public string $email;
    public string $pass;
    public string $gender;
    public string $address;
    public string $profile_image_link;
    public float $rating;
    public int $phoneNumber;
    public int $is_admin;

    public function __construct(int $idUser, string $nome, string $username, string $email, string $pass, string $gender, string $address, string $profile_image_link, float $rating, int $phoneNumber, int $is_admin) { 
      $this->idUser = $idUser;
      $this->nome = $nome;
      $this->username = $username;
      $this->email = $email;
      $this->pass = $pass;
      $this->gender = $gender;
      $this->address = $address;
      $this->profile_image_link = $profile_image_link;
      $this->rating = $rating;
      $this->phoneNumber = $phoneNumber;
      $this->is_admin = $is_admin;
    }

    public function getName() : string {
      $names = explode(" ", $this->nome);
      return count($names) > 1 ? $names[0] . " " . $names[count($names)-1] : $names[0];
    }

    public function getUsername() : string {
      return $this->username;
    }
    
    public function getEmail() : string {
      return $this->email;
    }
    
    public function getPass() : string {
      return $this->pass;
    }
    
    public function getGender() : string {
      return $this->gender;
    }
    
    public function getAddress() : string {
      return $this->address;
    }
    
    public function getProfileImageLink() : string {
      return $this->profile_image_link;
    }
    
    public function getPhoneNumber() : int {
      return $this->phoneNumber;
    }


    public function getIsAdmin() : string {
      return $this->is_admin == 1 ? "Yes" : "No";
    }

    public function getPhoto() : string {
      return $this->profile_image_link;
    }

    static function getUserWithPassword(PDO $db, string $email, string $pass) : ?User {

      $stmt = $db->prepare('SELECT * FROM User WHERE email = ?');
      $stmt->execute(array(strtolower($email)));
      $user = $stmt->fetch();
      if ($user !== false && password_verify($pass, $user['pass'])) {
        return new User(
          intval($user['idUser']),
          $user['nome'],
          $user['username'],
          $user['email'],
          $user['pass'],
          $user['gender'],
          $user['address'],
          $user['profile_image_link'],
          floatval($user['rating']),
          intval($user['phoneNumber']),
          intval($user['is_admin']),
        );
      } else return null;
    }

    static function check_password($pass, $hash) {
      return hash('sha256', $pass) == $hash;
    }

    static function getUserWithUsername(PDO $db, string $username, string $pass) : ?User {
      $stmt = $db->prepare('SELECT * FROM User WHERE username = ?');
      $stmt->execute(array($username));

      $user = $stmt->fetch();
      if ($user !== false && User::check_password($pass, $user['pass'])) {
          return new User(
              intval($user['idUser']),
              $user['nome'],
              $user['username'],
              $user['email'],
              $user['pass'],
              $user['gender'],
              $user['address'],
              $user['profile_image_link'],
              floatval($user['rating']),
              intval($user['phoneNumber']),
              intval($user['is_admin']),
          );
      } else return null;
  }

    static function getUsers(PDO $db, int $count) : array {

      $stmt = $db->prepare('SELECT idUser, nome, username, email, pass, gender, address, profile_image_link, rating, phoneNumber, is_admin FROM User LIMIT ?');
      $stmt->execute(array($count));
  
      $users = array();
      while ($user = $stmt->fetch()) {
        $users[] = new User(
          intval($user['idUser']),
          $user['nome'],
          $user['username'],
          $user['email'],
          $user['pass'],
          $user['gender'],
          $user['address'],
          $user['profile_image_link'],
          floatval($user['rating']),
          intval($user['phoneNumber']),
          intval($user['is_admin']),
        );
      }
  
      return $users;
    }

    static function getUser(PDO $db, int $id) : User {

      $stmt = $db->prepare('SELECT idUser, nome, username, email, pass, gender, address, profile_image_link, rating, phoneNumber, is_admin FROM User WHERE id = ?');
      $stmt->execute(array($id));
  
      $user = $stmt->fetch();
  
      return new User(
        intval($user['idUser']),
        $user['nome'],
        $user['username'],
        $user['email'],
        $user['pass'],
        $user['gender'],
        $user['address'],
        $user['profile_image_link'],
        floatval($user['rating']),
        intval($user['phoneNumber']),
        intval($user['is_admin']),
      );
    } 

    function save($db) {
      $stmt = $db->prepare('
        UPDATE User SET nome = ?, username = ?, email = ?, pass = ?, gender = ?, address = ?, profile_image_link = ?, rating = ?, phoneNumber = ?, is_admin = ?
        WHERE idUser = ?
      ');

      $stmt->execute(array($this->nome, $this->username, $this->email, $this->pass, 
                                    $this->gender, $this->address, $this->profile_image_link, $this->rating, $this->phoneNumber, $this->is_admin, $this->idUser));
    }


    function getFavoriteItems(PDO $db) : ?array {

      $stmt = $db->prepare('SELECT * FROM FavoriteItem WHERE idUser = ?');
      $stmt->execute(array($this->id));

      $items = array();
      while ($line = $stmt->fetch()) {
        $items[] = Item::getItem($db, intval($line['idItem']));
      }

      return $items;
    }

    function getOldOrders(PDO $db) : array {

      $stmt = $db->prepare("SELECT * FROM UserOrder WHERE idUser = ? AND (state = 'Cancelado' OR state = 'Entregue')");
      $stmt->execute(array($this->id));

      $orders = array();
      while ($line = $stmt->fetch()) {
        $item = Item::getItem($db, intval($line['idItem']));
        $orders[] = array(  $item,
                            $item->picture,
                            Category::getCategory($db, intval($item->idCategory)),
                            $line['state'],
                            $line['data']                                                );
      }

      return $orders;
    }

    function getNewOrders(PDO $db) : array {

      $stmt = $db->prepare("SELECT * FROM UserOrder WHERE idUser = ? AND ((state = 'Cancelado' OR state = 'Entregue')");
      $stmt->execute(array($this->id));

      $orders = array();
      while ($line = $stmt->fetch()) {
        $item = Item::getItem($db, intval($line['idItem']));
        $orders[] = array(  $item,
                            $item->picture,
                            Category::getCategory($db, intval($item->idCategory)),
                            $line['state'],
                            $line['data']                                               );
      }

      return $orders;
    }

    static function getStars(PDO $db, int $idUser) : float {

      $stmt = $db->prepare('SELECT round(avg(Review.stars), 2) as stars
                            FROM Review
                            WHERE Review.idUser = ?
                            GROUP BY Review.idUser');
      $stmt->execute(array($idUser));
      $result = $stmt->fetch()['stars'] ?? 0;
      return floatval($result);
    }

    static function buy(PDO $db, int $id) : bool {

      $stmt = $db->prepare("SELECT * FROM UserOrder, Item WHERE UserOrder.idUser = ? AND Item.idItem = UserOrder.idItem");
      $stmt->execute(array(intval($_SESSION['id']), $id));
      $attemp = $stmt->fetch();

      return $attemp != NULL;
    }

    static function getItems(PDO $db, $idUser) {
      $stmt = $db->prepare("SELECT * FROM Item WHERE sellerId = ?");
      $stmt->execute([$idUser]);
  
      $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
      return $items;
  }
  }
?>