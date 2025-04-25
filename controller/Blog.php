<?php
// include_once "./Database.php";
class Blog {
    protected $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getAll() {
        $stmt = $this->db->conn->query("SELECT * FROM blogs ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBlogById($BlogId) {
        $stmt = $this->db->conn->prepare("SELECT * FROM blogs WHERE id = ?");
        $stmt->execute([$BlogId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getBlogBySlug($BlogSlug) {
        $stmt = $this->db->conn->prepare("SELECT * FROM blogs WHERE slug = ?");
        $stmt->execute([$BlogSlug]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getBlogByCategoryId($catId) {
        $stmt = $this->db->conn->prepare("SELECT * FROM blogs WHERE category_id = ?");
        $stmt->execute([$catId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Create($title,$slug, $category_id,  $image, $description, $created_by,$date) {
        
        $stmt = $this->db->conn->prepare("INSERT INTO blogs (title,slug,category_id,  image, description, created_by,created_at) VALUES (?, ?, ?, ?, ?,?, ?)");
        $stmt->execute([$title,$slug, $category_id, $image, $description, $created_by, $date]);
        return ["status"=>"success", "message"=>"New Blog Is Created Successfully"];
    }

    public function Update($id,$title,$slug, $category_id,  $image, $description) {
        $stmt = $this->db->conn->prepare("UPDATE blogs SET title=?, slug=?, category_id=?, image=?, description=? WHERE id=?");
        $stmt->execute([$title,$slug, $category_id,  $image, $description,$id]);
        return ["status"=>"success", "message"=>"Blog Is Updated Successfully"];
    }
}
