<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppliers - Online Shopping</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%);
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
            background: #9C27B0;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .back-btn:hover {
            background: #7B1FA2;
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
            background-color: #9C27B0;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        tr:hover {
            background-color: #f3e5f5;
            transform: scale(1.01);
            transition: all 0.2s ease;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Suppliers</h1>
        <a href="OnlineShopping.php" class="back-btn">← Back to Home</a>
        
        <table>
            <thead>
                <tr>
                    <th>Supplier Name</th>
                    <th>Contact</th>
                    <th>Product Supplied</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT s.name, s.contact, p.name as product_name 
                        FROM suppliers s 
                        JOIN products p ON s.product_id = p.product_id";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['name']}</td>
                                <td>{$row['contact']}</td>
                                <td>{$row['product_name']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No suppliers found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php $conn->close(); ?>