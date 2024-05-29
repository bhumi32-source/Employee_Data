<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Employees</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Employee List</h2>
    <?php
    require 'database.php';
    $sql = "SELECT * FROM employee_info";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table class='table table-bordered mt-3'>
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Experience</th>
                        <th>Department</th>
                        <th>Education</th>
                        
                    </tr>
                </thead>
                <tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td><img src='uploads/" . $row['photo'] . "' alt='Photo' width='50'></td>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['gender'] . "</td>
                    <td>" . $row['contact'] . "</td>
                    <td>" . $row['address'] . "</td>
                    <td>" . $row['experience'] . "</td>
                    <td>" . $row['department'] . "</td>
                    <td>" . $row['education'] . "</td>
                    
                </tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>No employees found.</p>";
    }

    $conn->close();
    ?>
</div>
</body>
</html>
