<?php 
    include("connection.php");
 ?>

<?php
$name = $_POST['name'];
$email = $_POST['email'];
$city = $_POST['city'];
$mobile = $_POST['mobile'];
$password = $_POST['password'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'user');
if ($conn->connect_error) {
    die('Connection Failed : '.$conn->connect_error);
} else {
    // Check if email already exists
    $checkQuery = "SELECT * FROM users WHERE email = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        // Email already exists, show alert message
        echo '<script>alert("Email already exists. Please use a different email.");window.location = "signup.php";</script>';
    } else {
        // Email does not exist, proceed with registration
        $insertQuery = "INSERT INTO users (name, email, city, mobile, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("sssis", $name, $email, $city, $mobile, $password);

        if ($stmt->execute()) {
            echo '<script>alert("Registration successful!"); window.location = "index.php";</script>';
        } else {
            echo '<script>alert("Error registering user. Please try again later.")</script>';
        }
    }

    // Close statements and connection
    $checkStmt->close();
    $stmt->close();
    $conn->close();
}
?>
