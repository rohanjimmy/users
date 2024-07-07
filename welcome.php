<?php
include('connection.php');

if (isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);
    $sql = "SELECT * FROM users WHERE id = $user_id";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        .profile-card {
            width: 300px;
            background: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin: 20px auto;
        }
        .profile-card img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }
        .profile-details h2 {
            margin-bottom: 5px;
            color: #333;
        }
        .profile-details p {
            margin-bottom: 5px;
            color: #666;
        }
        .button-container {
            margin-top: 20px;
        }
        .button-container a {
            text-decoration: none;
        }
        .button-container button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }
        .button-container button.logout {
            background-color: #007bff;
            color: #fff;
        }
        .button-container button.logout:hover {
            background-color: #0056b3;
        }
        .button-container button.update {
            background-color: #fd7e14;
            color: #fff;
        }
        .button-container button.update:hover {
            background-color: #e17009;
        }
    </style>
</head>
<body>
    <h2>User Profile</h2>
    <div class="profile-card">
        <div class="profile-details">
            <h2><?php echo $user['name']; ?></h2>
            <p>Email: <?php echo $user['email']; ?></p>
            <p>City: <?php echo $user['city']; ?></p>
            <p>Mobile: <?php echo $user['mobile']; ?></p>
            <p>Password: <?php echo $user['password']; ?></p>
        </div>
    </div>

    <div class="button-container"><center>
        <a href="update.php?user_id=<?php echo $user_id; ?>"><button class="update">Update</button></a>
        <a href="index.php"><button class="logout">Logout</button></a>
        </center>
    </div>
</body>
</html>

<?php
    } else {
        echo "User not found.";
    }

    mysqli_close($conn);
} else {
    echo "User ID not provided.";
}
?>
