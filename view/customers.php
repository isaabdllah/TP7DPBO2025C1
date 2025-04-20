<h3>Search Customer</h3>
<form method="GET">
    <input type="hidden" name="page" value="customers"> <!-- Pastikan tetap di halaman customers -->
    <input type="text" name="search_customer" placeholder="Search customer..." value="<?= isset($_GET['search_customer']) ? $_GET['search_customer'] : '' ?>">
    <button type="submit">Search</button>
</form>
<h3>Customer List</h3>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Action</th>
    </tr>
    <?php
    $customers = isset($_GET['search_customer']) ? $customer->searchCustomer($_GET['search_customer']) : $customer->getAllCustomers();
    foreach ($customers as $c): ?>
    <tr>
        <td><?= $c['id'] ?></td>
        <td><?= $c['name'] ?></td>
        <td><?= $c['email'] ?></td>
        <td><?= $c['phone'] ?></td>
        <td>
            <a href="?page=customers&edit=<?= $c['id'] ?>">Edit</a> |
            <a href="?page=customers&delete_customer=<?= $c['id'] ?>">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php if (isset($_GET['edit'])): 
    $customerToEdit = null;
    foreach ($customer->getAllCustomers() as $c) {
        if ($c['id'] == $_GET['edit']) {
            $customerToEdit = $c;
            break;
        }
    }
    if ($customerToEdit): ?>
        <h3>Edit Customer</h3>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $customerToEdit['id'] ?>">
            <label>Name:</label>
            <input type="text" name="name" value="<?= $customerToEdit['name'] ?>" required>
            <label>Email:</label>
            <input type="email" name="email" value="<?= $customerToEdit['email'] ?>" required>
            <label>Phone:</label>
            <input type="text" name="phone" value="<?= $customerToEdit['phone'] ?>" required>
            <button type="submit" name="update_customer">Update</button>
        </form>
    <?php endif; ?>
<?php else: ?>
    <h3>Add Customer</h3>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Phone:</label>
        <input type="text" name="phone" required>
        <button type="submit" name="add_customer">Add</button>
    </form>
<?php endif; ?>