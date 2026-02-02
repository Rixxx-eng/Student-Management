<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Add Student</h2>
    <form method="POST">
        Name: <input type="text" name="std_name" required><br>
        Age: <input type="text" name="std_age" required><br>
        Class: <input type="text" name="class" required><br>
        Email: <input type="email" name="std_email" required><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("INSERT INTO students (std_name, std_age, class, std_email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $_POST['std_name'], $_POST['std_age'], $_POST['class'], $_POST['std_email']);
    $stmt->execute();

    header("Location: StudentList.php");
}
?>
