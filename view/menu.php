<h3>Search Menu</h3>
<form method="GET">
    <input type="hidden" name="page" value="menu"> <!-- Pastikan tetap di halaman menu -->
    <input type="text" name="search_menu" placeholder="Search menu..." value="<?= isset($_GET['search_menu']) ? $_GET['search_menu'] : '' ?>">
    <button type="submit">Search</button>
</form>
<h3>Menu List</h3>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Category</th>
        <th>Action</th>
    </tr>
    <?php
    // Ambil data menu, termasuk nama kategori
    $menus = isset($_GET['search_menu']) ? $menu->searchMenu($_GET['search_menu']) : $menu->getAllMenu();
    foreach ($menus as $m): ?>
        <tr>
            <td><?= $m['id'] ?></td>
            <td><?= $m['name'] ?></td>
            <td><?= 'Rp ' . number_format($m['price'], 2, ',', '.') ?></td>
            <td><?= $m['stock'] ?></td>
            <td><?= $m['category_name'] ?></td> <!-- Menampilkan nama kategori -->
            <td>
                <a href="?page=menu&edit=<?= $m['id'] ?>">Edit</a> |
                <a href="?page=menu&delete_menu=<?= $m['id'] ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php if (isset($_GET['edit'])): 
    $menuToEdit = null;
    foreach ($menu->getAllMenu() as $m) {
        if ($m['id'] == $_GET['edit']) {
            $menuToEdit = $m;
            break;
        }
    }
    if ($menuToEdit): ?>
        <h3>Edit Menu</h3>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $menuToEdit['id'] ?>">
            <label>Name:</label>
            <input type="text" name="name" value="<?= $menuToEdit['name'] ?>" required>
            <label>Price:</label>
            <input type="number" name="price" value="<?= $menuToEdit['price'] ?>" required>
            <label>Stock:</label>
            <input type="number" name="stock" value="<?= $menuToEdit['stock'] ?>" required>
            <label>Category:</label>
            <select name="category_id" required>
                <?php foreach ($menu->getAllCategories() as $category): ?>
                    <option value="<?= $category['id'] ?>" <?= $category['id'] == $menuToEdit['category_id'] ? 'selected' : '' ?>>
                        <?= $category['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" name="update_menu">Update</button>
        </form>
    <?php endif; ?>
<?php else: ?>
    <h3>Add Menu</h3>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" required>
        <label>Price:</label>
        <input type="number" name="price" required>
        <label>Stock:</label>
        <input type="number" name="stock" required>
        <label>Category:</label>
        <select name="category_id" required>
            <?php foreach ($menu->getAllCategories() as $category): ?>
                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="add_menu">Add</button>
    </form>
<?php endif; ?>