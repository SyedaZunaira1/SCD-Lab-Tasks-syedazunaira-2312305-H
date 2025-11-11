<?php
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$id = $_GET['id'];

// Get student data
$sql = "SELECT * FROM students WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$student = mysqli_fetch_assoc($result);

if (!$student) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $roll_no = $_POST['roll_no'];
    $email = $_POST['email'];
    $marks = $_POST['marks'];
    $department = $_POST['department'];
    
    // Check if roll number exists (excluding current student)
    $check_sql = "SELECT * FROM students WHERE roll_no='$roll_no' AND id != '$id'";
    $result = mysqli_query($conn, $check_sql);
    
    if (mysqli_num_rows($result) == 0) {
        $sql = "UPDATE students SET name='$name', roll_no='$roll_no', email='$email', 
                marks='$marks', department='$department' WHERE id='$id'";
        
        if (mysqli_query($conn, $sql)) {
            header("Location: dashboard.php?success=Student updated successfully");
            exit();
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    } else {
        $error = "Roll number already exists!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <style>
        body { font-family: Arial; background: #f5f5f5; padding: 20px; }
        .container { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); max-width: 500px; margin: 0 auto; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input, select { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        button { padding: 10px 20px; background: #ffc107; color: black; border: none; border-radius: 4px; cursor: pointer; }
        .error { color: red; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Student</h2>
        
        <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
        
        <form method="POST">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" value="<?php echo $student['name']; ?>" required>
            </div>
            <div class="form-group">
                <label>Roll Number:</label>
                <input type="text" name="roll_no" value="<?php echo $student['roll_no']; ?>" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="<?php echo $student['email']; ?>" required>
            </div>
            <div class="form-group">
                <label>Marks:</label>
                <input type="number" step="0.01" name="marks" value="<?php echo $student['marks']; ?>" required>
            </div>
            <div class="form-group">
                <label>Department:</label>
                <select name="department" required>
                    <option value="Computer Science" <?php echo $student['department'] == 'Computer Science' ? 'selected' : ''; ?>>Computer Science</option>
                    <option value="Electrical" <?php echo $student['department'] == 'Electrical' ? 'selected' : ''; ?>>Electrical</option>
                    <option value="Mechanical" <?php echo $student['department'] == 'Mechanical' ? 'selected' : ''; ?>>Mechanical</option>
                    <option value="Civil" <?php echo $student['department'] == 'Civil' ? 'selected' : ''; ?>>Civil</option>
                </select>
            </div>
            <button type="submit">Update Student</button>
        </form>
        
        <p><a href="dashboard.php">Back to Dashboard</a></p>
    </div>
</body>
</html>