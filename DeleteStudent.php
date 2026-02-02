<?php include("db.php");

    $id = $_GET['id'];
    $sql = "DELETE FROM students WHERE std_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: StudentList.php");
    
?>