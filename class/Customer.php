<?php
require_once 'config/db.php';

class Customer
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->conn;
    }

    public function getAllCustomers()
    {
        $stmt = $this->db->query("SELECT * FROM customers");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCustomer($name, $email, $phone)
    {
        $stmt = $this->db->prepare("INSERT INTO customers (name, email, phone) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $email, $phone]);
    }

    public function updateCustomer($id, $name, $email, $phone)
    {
        $stmt = $this->db->prepare("UPDATE customers SET name = ?, email = ?, phone = ? WHERE id = ?");
        return $stmt->execute([$name, $email, $phone, $id]);
    }

    public function deleteCustomer($id)
    {
        $stmt = $this->db->prepare("DELETE FROM customers WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function searchCustomer($keyword)
    {
        $stmt = $this->db->prepare("SELECT * FROM customers WHERE name LIKE ?");
        $stmt->execute(["%$keyword%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>