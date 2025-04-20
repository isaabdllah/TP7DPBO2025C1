CREATE DATABASE restaurant_db;
USE restaurant_db;

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE menu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL,
    category_id INT NOT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    phone VARCHAR(15)
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    menu_id INT NOT NULL,
    quantity INT NOT NULL,
    order_date DATE NOT NULL,
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    FOREIGN KEY (menu_id) REFERENCES menu(id)
);

INSERT INTO categories (name) VALUES
('Pembuka'),
('Hidangan Utama'),
('Penutup'),
('Minuman'),
('Camilan'),
('Lauk Tambahan');

INSERT INTO menu (name, price, stock, category_id) VALUES
('Nasi Gulai Tunjang', 25000, 50, 2),
('Sate Jando', 20000, 40, 2),
('Cimol Bojot', 10000, 60, 5),
('Es Teh Manis', 5000, 100, 4),
('Tahu Gejrot', 12000, 50, 1),
('Ayam Bakar Madu', 30000, 30, 2),
('Kue Lapis', 15000, 25, 3),
('Es Cendol', 8000, 80, 4),
('Bakso Malang', 20000, 40, 2),
('Keripik Singkong', 10000, 70, 5),
('Pisang Goreng', 12000, 50, 5),
('Soto Betawi', 25000, 35, 2),
('Klepon', 8000, 30, 3),
('Es Campur', 15000, 60, 4);

INSERT INTO customers (name, email, phone) VALUES
('Asep', 'asep@example.com', '081234567890'),
('Ujang', 'ujang@example.com', '082345678901'),
('Agus', 'agus@example.com', '083456789012'),
('Yuyun', 'yuyun@example.com', '084567890123'),
('Dewi', 'dewi@example.com', '085678901234');

INSERT INTO orders (customer_id, menu_id, quantity, order_date) VALUES
(1, 1, 2, '2023-10-01'),
(2, 2, 3, '2023-10-02'),
(3, 3, 5, '2023-10-03'),
(4, 4, 4, '2023-10-04'),
(5, 5, 3, '2023-10-05'),
(1, 6, 2, '2023-10-06'),
(2, 7, 1, '2023-10-07'),
(3, 8, 3, '2023-10-08'),
(4, 9, 2, '2023-10-09'),
(5, 10, 4, '2023-10-10');

