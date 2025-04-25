<?php

class Database {
    private $host = 'localhost';
    private $dbname = 'eduvibes__cdb';
    private $username = 'root';
    private $password = '';
    public $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public function SanitizeData($data){
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
       
    
        return $data;
    }

    public function isValidEmail($email){ 
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
    
    public function isOnlyString($data){
        $pattern = "/^[a-zA-Z-' ]*$/";
        if (!preg_match($pattern,$data)) {
            return false;
        }else{
            return true;
        }
    }
    
    public function isOnlyPhoneNumber($data){
        $pattern = "/^[0-9\+ ]*$/";
        if (!preg_match($pattern,$data)) {
            return false;
        }else{
            return true;
        }
    }
    public function makeSlug($text)
    {
        $text = strtolower($text);
        $text = preg_replace('/[^A-Za-z0-9-]+/', '-', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        return $text;
    }

    public function generateRandomString($length = 10, $num=false) {
        if($num == true){
            $characters = '0123456789';
            
        }else{
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        }
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function back(){
        $previousPage = $_SERVER['HTTP_REFERER'];
        header("Location: $previousPage");
    }
}
