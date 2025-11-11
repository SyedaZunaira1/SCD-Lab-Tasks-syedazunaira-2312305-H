<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shopping Management System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        tr:hover {
            background-color: #e9ecef;
            transform: scale(1.01);
            transition: all 0.2s ease;
        }
        .button-container {
            text-align: center;
            margin-top: 40px;
        }
        .btn {
            display: inline-block;
            padding: 15px 30px;
            margin: 0 15px;
            background: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 1.1em;
            font-weight: bold;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
        }
        .btn:hover {
            background: #45a049;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(76, 175, 80, 0.4);
        }
        .btn-orders { background: #2196F3; }
        .btn-orders:hover { background: #1976D2; }
        .btn-products { background: #FF9800; }
        .btn-products:hover { background: #F57C00; }
        .btn-suppliers { background: #9C27B0; }
        .btn-suppliers:hover { background: #7B1FA2; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Online Shopping Management System</h1>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM customers";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['customer_id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['phone']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No customers found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        
        <div class="button-container">
            <a href="order.php" class="btn btn-orders">View Orders</a>
            <a href="product.php" class="btn btn-products">View Products</a>
            <a href="supplier.php" class="btn btn-suppliers">View Suppliers</a>
        </div>
    </div>
</body>
</html>
<?php $conn->close(); ?>