<?php


class User
{

  protected $db;

  public function __construct(Database $db)
  {
    $this->db = $db;
  }
  public function getAll()
  {
    $stmt = $this->db->conn->query("SELECT * FROM users ORDER BY id DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function register($name, $email, $password)
  {
    // Hash password using md5
    $hashed_password = md5($password);

    $stmt = $this->db->conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $hashed_password]);
  }

  public function login($email, $password)
  {
    $hashed_password = md5($password);

    $stmt = $this->db->conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt->execute([$email, $hashed_password]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
      $_SESSION['user_data'] = [
        'id' => $user['id'],
        'name' => $user['name'],
        'profile_image' => $user['profile_image']
      ];
      return true;
    } else {
      return false;
    }
  }

  public function getById($userId)
  {
    $stmt = $this->db->conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function isLoggedIn(): bool
  {
    return isset($_SESSION['user_data']);
  }

  public function getMyOrders() {
    $userId =  $_SESSION['user_data']["id"];
    // return ["userId"=>$userId];
    $stmt = $this->db->conn->prepare("SELECT * FROM orders WHERE user_id=? ORDER BY id DESC");
    $stmt->execute([$userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getMyOrderCartItems($order_num) {
 
  $stmt = $this->db->conn->prepare("SELECT * FROM carts WHERE order_num=? ORDER BY id DESC");
  $stmt->execute([$order_num]);
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

  public function logout()
  {
    unset($_SESSION['user_data']);
    return true;
  }
}
