<h3>Search Order</h3>
<form method="GET">
    <input type="hidden" name="page" value="orders"> <!-- Pastikan tetap di halaman orders -->
    <input type="text" name="search_order" placeholder="Search by customer or menu..." value="<?= isset($_GET['search_order']) ? $_GET['search_order'] : '' ?>">
    <button type="submit">Search</button>
</form>
<?php
$orders = isset($_GET['search_order']) && !empty($_GET['search_order']) 
    ? $order->searchOrder($_GET['search_order']) 
    : $order->getAllOrders();
?>
<h3>Order List</h3>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Customer</th>
        <th>Menu</th>
        <th>Quantity</th>
        <th>Order Date</th>
        <th>Action</th>
    </tr>
    <?php foreach ($orders as $o): ?>
    <tr>
        <td><?= $o['id'] ?></td>
        <td><?= $o['customer_name'] ?></td>
        <td><?= $o['menu_name'] ?></td>
        <td><?= $o['quantity'] ?></td>
        <td><?= $o['order_date'] ?></td>
        <td>
            <a href="?page=orders&edit=<?= $o['id'] ?>">Edit</a> |
            <a href="?page=orders&delete_order=<?= $o['id'] ?>">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php if (isset($_GET['edit'])): 
    $orderToEdit = null;
    foreach ($order->getAllOrders() as $o) {
        if ($o['id'] == $_GET['edit']) {
            $orderToEdit = $o;
            break;
        }
    }
    if ($orderToEdit): ?>
        <h3>Edit Order</h3>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $orderToEdit['id'] ?>">
            <label>Customer:</label>
            <select name="customer_id" required>
                <?php foreach ($customer->getAllCustomers() as $c): ?>
                    <option value="<?= $c['id'] ?>" <?= $c['id'] == $orderToEdit['customer_id'] ? 'selected' : '' ?>>
                        <?= $c['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <label>Menu:</label>
            <select name="menu_id" required>
                <?php foreach ($menu->getAllMenu() as $m): ?>
                    <option value="<?= $m['id'] ?>" <?= $m['id'] == $orderToEdit['menu_id'] ? 'selected' : '' ?>>
                        <?= $m['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <label>Quantity:</label>
            <input type="number" name="quantity" value="<?= $orderToEdit['quantity'] ?>" required>
            <button type="submit" name="update_order">Update</button>
        </form>
    <?php endif; ?>
<?php else: ?>
    <h3>Add Order</h3>
    <form method="POST">
        <label>Customer:</label>
        <select name="customer_id" required>
            <?php foreach ($customer->getAllCustomers() as $c): ?>
                <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <label>Menu:</label>
        <select name="menu_id" required>
            <?php foreach ($menu->getAllMenu() as $m): ?>
                <option value="<?= $m['id'] ?>"><?= $m['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <label>Quantity:</label>
        <input type="number" name="quantity" required>
        <button type="submit" name="add_order">Add</button>
    </form>
<?php endif; ?>