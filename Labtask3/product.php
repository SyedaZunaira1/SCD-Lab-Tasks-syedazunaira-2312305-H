<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Online Shopping</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #fd79a8 0%, #fdcb6e 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 2.5em;
        }
        .back-btn {
            display: inline-block;
            padding: 12px 25px;
            background: #FF9800;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .back-btn:hover {
            background: #F57C00;
            transform: translateY(-2px);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 15px 20px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #FF9800;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        tr:hover {
            background-color: #fff3e0;
            transform: scale(1.01);
            transition: all 0.2s ease;
        }
        .price {
            font-weight: bold;
            color: #e74c3c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Products</h1>
        <a href="OnlineShopping.php" class="back-btn">← Back to Home</a>
        
        <table>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price (PKR)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT p.product_id, p.name, c.category_name, p.price 
                        FROM products p 
                        JOIN categories c ON p.category_id = c.category_id";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['product_id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['category_name']}</td>
                                <td class='price'>" . number_format($row['price'], 2) . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No products found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php $conn->close(); ?>