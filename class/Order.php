<?php
require_once 'config/db.php';

class Order {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllOrders() {
        $stmt = $this->db->query("SELECT orders.*, customers.name AS customer_name, menu.name AS menu_name 
                                  FROM orders 
                                  JOIN customers ON orders.customer_id = customers.id 
                                  JOIN menu ON orders.menu_id = menu.id
                                  ORDER BY orders.id ASC"); // Mengurutkan berdasarkan ID secara ascending
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addOrder($customer_id, $menu_id, $quantity) {
        $stmt = $this->db->prepare("INSERT INTO orders (customer_id, menu_id, quantity, order_date) VALUES (?, ?, ?, CURDATE())");
        return $stmt->execute([$customer_id, $menu_id, $quantity]);
    }

    public function deleteOrder($id) {
        $stmt = $this->db->prepare("DELETE FROM orders WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function updateOrder($id, $customer_id, $menu_id, $quantity) {
        $stmt = $this->db->prepare("UPDATE orders SET customer_id = ?, menu_id = ?, quantity = ?, order_date = CURDATE() WHERE id = ?");
        return $stmt->execute([$customer_id, $menu_id, $quantity, $id]);
    }

    public function searchOrder($keyword) {
        $stmt = $this->db->prepare("SELECT orders.*, customers.name AS customer_name, menu.name AS menu_name 
                                    FROM orders 
                                    JOIN customers ON orders.customer_id = customers.id 
                                    JOIN menu ON orders.menu_id = menu.id
                                    WHERE customers.name LIKE ? OR menu.name LIKE ?
                                    ORDER BY orders.id ASC");
        $stmt->execute(["%$keyword%", "%$keyword%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>