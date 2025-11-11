<?php
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Search functionality
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $where = "select * from students WHERE name LIKE '%$search%' OR roll_no LIKE '%$search%'";
} else {
    $where = "";
}

// Sorting functionality
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
$order = isset($_GET['order']) ? $_GET['order'] : 'ASC';

$sql = "SELECT * FROM students $where ORDER BY $sort $order";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body { font-family: Arial; margin: 0; padding: 20px; background: #f5f5f5; }
        .header { background: white; padding: 15px; border-radius: 5px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
        .search-box { margin-bottom: 20px; }
        table { width: 100%; background: white; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f8f9fa; cursor: pointer; }
        .btn { padding: 8px 15px; text-decoration: none; border-radius: 4px; margin: 2px; }
        .btn-primary { background: #007bff; color: white; }
        .btn-warning { background: #ffc107; color: black; }
        .btn-danger { background: #dc3545; color: white; }
        .btn-success { background: #28a745; color: white; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Welcome, <?php echo $_SESSION['user_name']; ?>!</h2>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

    <div class="search-box">
        <form method="GET">
            <input type="text" name="search" placeholder="Search by name or roll number" value="<?php echo $search; ?>">
            <button type="submit">Search</button>
            <?php if ($search): ?>
                <a href="dashboard.php">Clear</a>
            <?php endif; ?>
        </form>
    </div>

    <a href="add_student.php" class="btn btn-success">Add New Student</a>

    <table>
        <thead>
            <tr>
                <th><a href="?sort=name&order=<?php echo $order == 'ASC' ? 'DESC' : 'ASC'; ?>&search=<?php echo $search; ?>">Name</a></th>
                <th><a href="?sort=roll_no&order=<?php echo $order == 'ASC' ? 'DESC' : 'ASC'; ?>&search=<?php echo $search; ?>">Roll No</a></th>
                <th>Email</th>
                <th><a href="?sort=marks&order=<?php echo $order == 'ASC' ? 'DESC' : 'ASC'; ?>&search=<?php echo $search; ?>">Marks</a></th>
                <th>Department</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['roll_no']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['marks']; ?></td>
                <td><?php echo $row['department']; ?></td>
                <td>
                    <a href="edit_student.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                    <a href="delete_student.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <?php if (mysqli_num_rows($result) == 0): ?>
        <p>No students found.</p>
    <?php endif; ?>
</body>
</html>