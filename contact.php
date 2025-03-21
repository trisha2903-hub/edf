<?php
// Connect to MySQL Database
$conn = new mysqli("localhost", "root", "", "green_banking");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Validate fields (Prevent empty submissions)
    if (empty($first_name) || empty($last_name) || empty($email) || empty($subject) || empty($message)) {
        echo "<script>alert('All fields are required!'); window.location.href='index.html';</script>";
        exit();
    }

    // Prevent SQL Injection
    $first_name = $conn->real_escape_string($first_name);
    $last_name = $conn->real_escape_string($last_name);
    $email = $conn->real_escape_string($email);
    $subject = $conn->real_escape_string($subject);
    $message = $conn->real_escape_string($message);

    // Prepare SQL statement
    $sql = "INSERT INTO contact_messages (first_name, last_name, email, subject, message) 
            VALUES ('$first_name', '$last_name', '$email', '$subject', '$message')";

    // Execute query
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Message sent successfully!'); window.location.href='index.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
