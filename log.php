<?php
include('connection.php');

if (isset($_POST['submit'])) {
    // Get the user inputs and sanitize them
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if it's the admin login
    if ($email == 'admin@gmail.com' && $password == 'admin') {
        // Redirect admin user to admin.php
        header("Location: admin.php");
        exit();
    }

    // For regular users, perform the database query
    // Create a SQL query for regular users
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        // Fetch user details
        $user = mysqli_fetch_assoc($result);
        $user_id = $user['id']; // Extract user ID
        
        // Redirect regular users to welcome.php with user ID
        header("Location: welcome.php?user_id=" . $user_id);
        exit(); // Make sure to exit after the header redirect
    } else {
        echo '<script>
                alert("Login failed. Invalid email or password!!");
                window.location.href = "login.php";
              </script>';
    }

    // Close the connection
    mysqli_close($conn);
}
?>
