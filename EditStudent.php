<?php include 'db.php'?>
<?php
        $id = $_GET['id'];
        $result = $conn->query("SELECT * FROM students WHERE std_id=$id");
        $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Edit Student</title>
</head>
<body>
    <h2>Edit Student Information</h2>
    <form method="POST">
        <label for="">Name : </label>
        <input type="text" name="std_name" value="<?= $row['std_name'] ?>" ><br>

        <label for="">Age : </label>
        <input type="number" name="std_age" value="<?= $row['std_age']?>"><br>

        <label for="">Class : </label>
        <input type="text" name="class" value="<?= $row['class']?>" ><br>

        <label for="">Email : </label>
        <input type="email" name="std_email" value="<?= $row['std_email']?>" ><br>

        <button type="submit" value="Update Student">Save</button>
    </form>
</body>
</html>

<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $stmt = $conn->prepare("UPDATE students SET std_name=?, std_age=?, class=?, std_email=? WHERE std_id=?");
    $stmt->bind_param("sissi", $_POST['std_name'], $_POST['std_age'], $_POST['class'], $_POST['std_email'], $id);
    $stmt->execute();

    header("Location: StudentList.php");
}
?>