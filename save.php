<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $experience = $_POST['experience'];
    $department = $_POST['department'];
    $education = $_POST['education'];
    $hobbies = implode(", ", $_POST['hobby']); //  convert array to string separated by comma

    // Handle file upload
    $photo = $_FILES['photo'];
    $photo_name = basename($photo['name']); //gets the original name
    $target_dir = "uploads/";
    $target_file = $target_dir . $photo_name; //concatenates the target directory and the file name to get the full path.

    

    if (move_uploaded_file($photo['tmp_name'], $target_file)) {
        $sql = "INSERT INTO employee_info (name, email, gender, contact, address, experience, department, education, hobby, photo)
                VALUES ('$name', '$email', '$gender', '$contact', '$address', '$experience', '$department', '$education', '$hobbies', '$photo_name')";

        if ($conn->query($sql) === TRUE) {
            header("Location: view.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }

    $conn->close();
}
?>

