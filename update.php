<?php
include('connection.php');

// Initialize variables for form inputs
$name = $email = $city = $mobile = $password = '';
$update_msg = '';

// Check if user_id is provided and retrieve user details from database
if (isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);
    $sql = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        // Assign retrieved values to variables
        $name = $user['name'];
        $email = $user['email'];
        $city = $user['city'];
        $mobile = $user['mobile'];
        // Password should not be displayed or edited directly in a form for security reasons
    } else {
        echo "User not found.";
        exit;
    }

    mysqli_free_result($result);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize user inputs
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $new_email = mysqli_real_escape_string($conn, $_POST['email']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    
    // Check if the new email is different from the current email
    if ($new_email !== $email) {
        // Check if the new email already exists in the database
        $check_sql = "SELECT * FROM users WHERE email = '$new_email' AND id != $user_id";
        $check_result = mysqli_query($conn, $check_sql);

        if ($check_result && mysqli_num_rows($check_result) > 0) {
            // Email already exists, show alert and do not update
            echo '<script>alert("Email already exists. Please choose a different email.");</script>';
        } else {
            // Update query
            $update_sql = "UPDATE users SET name='$name', email='$new_email', city='$city', mobile='$mobile' WHERE id=$user_id";

            if (mysqli_query($conn, $update_sql)) {
                // Success message
                $update_msg = "User information updated successfully.";
                // JavaScript alert to notify user
                echo '<script>alert("User information updated successfully.");</script>';
                // Redirect back to the profile page after the alert
                echo '<script>window.location.href = "profile.php?user_id=' . $user_id . '";</script>';
                exit;
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        }
    } else {
        // Email is the same as current, proceed with update
        $update_sql = "UPDATE users SET name='$name', email='$email', city='$city', mobile='$mobile' WHERE id=$user_id";

        if (mysqli_query($conn, $update_sql)) {
            // Success message
            $update_msg = "User information updated successfully.";
            // JavaScript alert to notify user
            echo '<script>alert("User information updated successfully.");</script>';
            // Redirect back to the profile page after the alert
            echo '<script>window.location.href = "welcome.php?user_id=' . $user_id . '";</script>';
            exit;
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile Update</title>
    <!-- Your CSS styles -->
    <style>
        /* Your CSS styles for the form can go here */
        .update-form {
            width: 300px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .update-form input[type="text"],
        .update-form input[type="email"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .update-form input[type="submit"] {
            background-color: #fd7e14;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .update-form input[type="submit"]:hover {
            background-color: #e17009;
        }
    </style>
</head>
<body>
    <h2>User Profile Update</h2>
    <div class="update-form">
        <form method="POST" action="">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>"><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>"><br>

            <label for="city">City:</label><br>
            <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($city); ?>"><br>

            <label for="mobile">Mobile:</label><br>
            <input type="text" id="mobile" name="mobile" value="<?php echo htmlspecialchars($mobile); ?>"><br>

            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>
