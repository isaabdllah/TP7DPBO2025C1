<?php
require_once 'class/Menu.php';
require_once 'class/Customer.php';
require_once 'class/Order.php';

$menu = new Menu();
$customer = new Customer();
$order = new Order();

if (isset($_POST['add_menu'])) {
    $menu->addMenu($_POST['name'], $_POST['price'], $_POST['stock'], $_POST['category_id']);
}
if (isset($_POST['update_menu'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $category_id = $_POST['category_id'];

    $menu->updateMenu($id, $name, $price, $stock, $category_id);
}
if (isset($_GET['delete_menu'])) {
    $menu->deleteMenu($_GET['delete_menu']);
}

if (isset($_POST['add_customer'])) {
    $customer->addCustomer($_POST['name'], $_POST['email'], $_POST['phone']);
}
if (isset($_POST['update_customer'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $customer->updateCustomer($id, $name, $email, $phone);
}
if (isset($_GET['delete_customer'])) {
    $customer->deleteCustomer($_GET['delete_customer']);
}

if (isset($_POST['add_order'])) {
    $order->addOrder($_POST['customer_id'], $_POST['menu_id'], $_POST['quantity']);
}
if (isset($_GET['delete_order'])) {
    $order->deleteOrder($_GET['delete_order']);
}

if (isset($_POST['update_order'])) {
    $id = $_POST['id'];
    $customer_id = $_POST['customer_id'];
    $menu_id = $_POST['menu_id'];
    $quantity = $_POST['quantity'];

    $order->updateOrder($id, $customer_id, $menu_id, $quantity);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurant Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'view/header.php'; ?>
    <main>
        <h2>Welcome to Restaurant Management System</h2>
        <nav>
            <a href="?page=menu">Menu</a> |
            <a href="?page=customers">Customers</a> |
            <a href="?page=orders">Orders</a>
        </nav>

        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            if ($page == 'menu') include 'view/menu.php';
            elseif ($page == 'customers') include 'view/customers.php';
            elseif ($page == 'orders') include 'view/orders.php';
        }
        ?>
    </main>
    <?php include 'view/footer.php'; ?>
</body>
</html>