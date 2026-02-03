<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Student's List </h2>
    <form method="GET" action="StudentList.php" >
        <input
            type="text"
            name="keyword"
            placeholder="Search Students..."
            value="<?php (isset($_GET['keyword'])) ? $_GET['keyword'] : "" ?>"
            class="form-control">

        <button type="submit" class="btn">Search</button>
    </form><br>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Class</th>
            <th>Email</th>
            <th>Parent</th>
            <th>Actions</th>
        </tr>
        <?php

        $keyword = (isset($_GET['keyword'])) ? $_GET['keyword'] : "";

        if ($keyword) {
            $stmt = $conn->prepare("SELECT * FROM students WHERE std_id LIKE ? OR std_name LIKE ? OR std_age LIKE ? OR class LIKE ? OR prt_name LIKE ? OR std_email LIKE ?"); 
            $LIKE = "%$keyword%";
            $stmt->bind_param("isisss", $keyword, $LIKE, $keyword, $LIKE, $LIKE, $LIKE);
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
                        <td>{$row['prt_name']}</td>
                        
                        <td>
                            <a href='EditStudent.php?id={$row['std_id']}' >Edit</a> |
                            <a href='DeleteStudent.php?id={$row['std_id']}' >Delete</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<h2>No Results Found.</h2>";
        }
        ?>
    </table><br>
    <a href="Add_Student.php" class="add">Add Student</a>
</body>
</html>
