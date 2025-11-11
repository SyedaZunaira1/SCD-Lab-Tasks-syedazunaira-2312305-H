<?php
// db_connect.php -
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "onlineshop_lab3";

// Create connection without database first
$conn = new mysqli($host, $user, $pass);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "<h2>Setting up Online Shopping Database...</h2>";

// Create database
if ($conn->query("CREATE DATABASE IF NOT EXISTS $dbname") === TRUE) {
    echo "✅ Database created successfully!<br>";
} else {
    echo "❌ Error creating database: " . $conn->error . "<br>";
}

// Select database
$conn->select_db($dbname);

// Create tables
$tables = [
    "CREATE TABLE IF NOT EXISTS categories (
        category_id INT AUTO_INCREMENT PRIMARY KEY,
        category_name VARCHAR(100) NOT NULL
    )",
    
    "CREATE TABLE IF NOT EXISTS customers (
        customer_id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        phone VARCHAR(15) NOT NULL
    )",
    
    "CREATE TABLE IF NOT EXISTS products (
        product_id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        category_id INT,
        FOREIGN KEY (category_id) REFERENCES categories(category_id)
    )",
    
    "CREATE TABLE IF NOT EXISTS orders (
        order_id INT AUTO_INCREMENT PRIMARY KEY,
        customer_id INT,
        order_date DATE NOT NULL,
        FOREIGN KEY (customer_id) REFERENCES customers(customer_id)
    )",
    
    "CREATE TABLE IF NOT EXISTS order_items (
        item_id INT AUTO_INCREMENT PRIMARY KEY,
        order_id INT,
        product_id INT,
        quantity INT NOT NULL,
        FOREIGN KEY (order_id) REFERENCES orders(order_id),
        FOREIGN KEY (product_id) REFERENCES products(product_id)
    )",
    
    "CREATE TABLE IF NOT EXISTS suppliers (
        supplier_id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        contact VARCHAR(100) NOT NULL,
        product_id INT,
        FOREIGN KEY (product_id) REFERENCES products(product_id)
    )"
];

foreach ($tables as $sql) {
    if ($conn->query($sql) === TRUE) {
        echo "✅ Tables created successfully!<br>";
    } else {
        echo "❌ Error creating table: " . $conn->error . "<br>";
    }
}

// Insert data
echo "<h3>Inserting sample data...</h3>";

// Categories
$conn->query("INSERT IGNORE INTO categories (category_name) VALUES 
    ('Electronics'), ('Clothing'), ('Books'), ('Home & Kitchen'), ('Sports')");
echo "✅ Categories inserted<br>";

// Customers
$conn->query("INSERT IGNORE INTO customers (name, email, phone) VALUES 
    ('Ali Khan', 'ali.khan@email.com', '0300-1111111'),
    ('Sara Ahmed', 'sara.ahmed@email.com', '0300-2222222'),
    ('Usman Malik', 'usman.malik@email.com', '0300-3333333'),
    ('Fatima Noor', 'fatima.noor@email.com', '0300-4444444'),
    ('Ahmed Raza', 'ahmed.raza@email.com', '0300-5555555'),
    ('Zainab Ali', 'zainab.ali@email.com', '0300-6666666'),
    ('Bilal Hassan', 'bilal.hassan@email.com', '0300-7777777'),
    ('Hina Shah', 'hina.shah@email.com', '0300-8888888'),
    ('Omar Farooq', 'omar.farooq@email.com', '0300-9999999'),
    ('Ayesha Khan', 'ayesha.khan@email.com', '0300-0000000')");
echo "✅ Customers inserted<br>";

// Products
$conn->query("INSERT IGNORE INTO products (name, price, category_id) VALUES 
    ('Smartphone', 45000.00, 1),
    ('Laptop', 120000.00, 1),
    ('T-Shirt', 2500.00, 2),
    ('Novel Book', 1200.00, 3),
    ('Coffee Maker', 8500.00, 4)");
echo "✅ Products inserted<br>";

// Suppliers
$conn->query("INSERT IGNORE INTO suppliers (name, contact, product_id) VALUES 
    ('Tech Distributors', 'contact@techdist.com', 1),
    ('Tech Distributors', 'contact@techdist.com', 2),
    ('Fashion House', 'info@fashionhouse.com', 3),
    ('Book Publishers Ltd', 'sales@bookpub.com', 4),
    ('Home Essentials Co', 'support@homeessentials.com', 5)");
echo "✅ Suppliers inserted<br>";

// Orders
$conn->query("INSERT IGNORE INTO orders (customer_id, order_date) VALUES 
    (1, '2024-01-15'),
    (2, '2024-01-16'),
    (3, '2024-01-17'),
    (4, '2024-01-18'),
    (5, '2024-01-19')");
echo "✅ Orders inserted<br>";

// Order Items
$conn->query("INSERT IGNORE INTO order_items (order_id, product_id, quantity) VALUES 
    (1, 1, 1),
    (1, 3, 2),
    (2, 2, 1),
    (3, 4, 3),
    (4, 5, 1),
    (5, 1, 2)");
echo "✅ Order items inserted<br>";

echo "<h3 style='color: green;'>🎉 Database setup completed successfully!</h3>";
echo "<a href='index.php' style='display: inline-block; padding: 15px 30px; background: #4CAF50; color: white; text-decoration: none; border-radius: 8px; font-size: 18px; margin-top: 20px;'>Go to Home Page</a>";

$conn->close();
?>