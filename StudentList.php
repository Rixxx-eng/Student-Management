<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Management</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <h2>Student's List</h2>
    <form method="GET" action="StudentList.php" >
        <input
            type="text"
            name="keyword"
            placeholder="Search Students..."
            value="<?php (isset($_GET['keyword'])) ? (isset($_GET['keyword'])) : "" ?>"
            class="form-control" required>

        <button type="submit" class="btn">Search</button>
    </form><br>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Class</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php

        $keyword = trim($_GET['keyword'] ?? '');

        if (!empty($keyword)) {
        
            $stmt = $conn->prepare("SELECT * FROM students WHERE std_name LIKE ? OR class LIKE ? OR std_email LIKE ?"); 
            $LIKE = "%$keyword%";
            $stmt->bind_param("sss", $LIKE, $LIKE, $LIKE);
            $stmt->execute();
            $result = $stmt->get_result();
            
        } else {
            $result = $conn->query("SELECT * FROM students");
        }

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['std_id']}</td>
                        <td>{$row['std_name']}</td>
                        <td>{$row['std_age']}</td>
                        <td>{$row['class']}</td>
                        <td>{$row['std_email']}</td>
                        <td>
                            <a href='EditStudent.php?id={$row['std_id']}' >Edit</a> |
                            <a href='DeleteStudent.php?id={$row['std_id']}' >Delete</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "No Results Found.";
        }
        ?>

    </table><br>
    <a href="Add_Student.php">Add Student</a>
</body>
</html>
