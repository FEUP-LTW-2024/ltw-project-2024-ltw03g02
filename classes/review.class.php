<?php
  declare(strict_types = 1);

  class Review {

    public int $id;
    public int $idUser;
    public int $idItem;
    public int $stars;
    public string $comment;
    public string $data;

    public function __construct(int $id, int $idUser, int $idItem, int $stars, string $comment, string $data)
    {
      $this->id = $id;
      $this->idUser = $idUser;
      $this->idItem = $idItem;
      $this->stars = $stars;
      $this->comment = $comment;
      $this->data = $data;
    }

    static function getPopularReviews(PDO $db, int $count) : array {
      $stmt = $db->prepare('SELECT id, idUser, idItem, stars, comment, data
                            FROM Review 
                            ORDER BY stars DESC
                            LIMIT ?');
      $stmt->execute(array($count));
  
      $reviews = array();
      while ($review = $stmt->fetch()) {
          $reviews[] = new Review(
          intval($review['id']),
          intval($review['idUser']),
          intval($review['idItem']),
          intval($review['stars']),
          $review['comment'],
          $review['data'],
          ""
        );
      }
  
      return $reviews;
    }

    static function getReviews(PDO $db, int $idItem) : array {
      $stmt = $db->prepare('SELECT id, idUser, idItem, stars, comment, data FROM Review WHERE idItem = ?');
      $stmt->execute(array($idItem));
  
      $review = $stmt->fetch();
  
      $reviews = array();
      while ($review = $stmt->fetch()) {
        $reviews[] = new Review(
          intval($review['id']),
          intval($review['idUser']),
          intval($review['idItem']),
          intval($review['stars']),
          $review['comment'],
          $review['data'],
        );
      }
  
      return $reviews;
    }

    function getInformation() : array { 

      $db = getDatabaseConnection();

      $stmt = $db->prepare('SELECT title FROM Item WHERE idItem = ?');
      $stmt->execute(array($this->idItem));
      $itemName = $stmt->fetch()['title'];

      $stmt = $db->prepare('SELECT User.* FROM User WHERE idUser = ?');
      $stmt->execute(array($this->idUser));
      $u = $stmt->fetch();
      $user = new User(
        intval($u['idUser']),
        $u['nome'],
        $u['username'],
        $u['email'],
        $u['pass'],
        $u['gender'],
        $u['address'],
        $u['profile_image_link'],
        floatval($u['rating']),
        intval($u['phoneNumber']),
        intval($u['is_admin'])
      );

      $stmt = $db->prepare('SELECT User.* FROM User, Item WHERE Item.idItem = ? AND User.idUser = Item.sellerId');
      $stmt->execute(array($this->idItem));
      $u = $stmt->fetch();
      $owner = new User(
        intval($u['idUser']),
        $u['nome'],
        $u['username'],
        $u['email'],
        $u['pass'],
        $u['gender'],
        $u['address'],
        $u['profile_image_link'],
        floatval($u['rating']),
        intval($u['phoneNumber']),
        intval($u['is_admin'])
      );

      $result = array('user' => $user, 'owner' => $owner, 'itemName' => $itemName);
      return $result;
  }
}
?>