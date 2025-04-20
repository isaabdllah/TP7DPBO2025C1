<?php
require_once 'config/db.php';

class Menu
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->conn;
    }

    public function getAllMenu()
    {
        $stmt = $this->db->query("SELECT menu.*, categories.name AS category_name 
                                  FROM menu 
                                  JOIN categories ON menu.category_id = categories.id
                                  ORDER BY menu.id ASC"); // Mengurutkan berdasarkan id secara ascending
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addMenu($name, $price, $stock, $category_id)
    {
        $stmt = $this->db->prepare("INSERT INTO menu (name, price, stock, category_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $price, $stock, $category_id]);
    }

    public function updateMenu($id, $name, $price, $stock, $category_id)
    {
        $stmt = $this->db->prepare("UPDATE menu SET name = ?, price = ?, stock = ?, category_id = ? WHERE id = ?");
        return $stmt->execute([$name, $price, $stock, $category_id, $id]);
    }

    public function deleteMenu($id)
    {
        $stmt = $this->db->prepare("DELETE FROM menu WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function searchMenu($keyword)
    {
        $stmt = $this->db->prepare("SELECT menu.*, categories.name AS category_name 
                                    FROM menu 
                                    JOIN categories ON menu.category_id = categories.id
                                    WHERE menu.name LIKE ?");
        $stmt->execute(["%$keyword%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllCategories()
    {
        $stmt = $this->db->query("SELECT * FROM categories");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>