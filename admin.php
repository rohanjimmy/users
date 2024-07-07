<?php
// Include the database connection file
include('connection.php');

// Check if the delete_id parameter is present in the URL
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']); // Sanitize the input to avoid SQL injection
    $sql = "DELETE FROM users WHERE id = $delete_id";

    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("User deleted successfully.");</script>';
        echo '<script>window.location.href = "admin.php";</script>'; // Redirect to refresh the page
        exit;
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
}

// Pagination configuration and search handling
$results_per_page = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start_from = ($page - 1) * $results_per_page;

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

$sql = "SELECT id, name, email, city, mobile FROM users";
if (!empty($search)) {
    $sql .= " WHERE name LIKE '%$search%'";
}
$sql .= " LIMIT $start_from, $results_per_page";

$result = mysqli_query($conn, $sql);

// Total records for pagination
$sql_pagination = "SELECT COUNT(*) AS total FROM users";
if (!empty($search)) {
    $sql_pagination .= " WHERE name LIKE '%$search%'";
}
$result_pagination = mysqli_query($conn, $sql_pagination);
$row_pagination = mysqli_fetch_assoc($result_pagination);
$total_records = $row_pagination['total'];
$total_pages = ceil($total_records / $results_per_page);

// Close the connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <style>
        /* Your existing CSS styles */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .pagination a {
            color: black;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
            border: 1px solid #ddd;
        }
        .pagination a.active {
            background-color: #4CAF50;
            color: white;
            border: 1px solid #4CAF50;
        }
        .pagination a:hover:not(.active) {background-color: #ddd;}
        .search-container {
            margin-bottom: 20px;
        }
        .search-container input[type=text] {
            padding: 10px;
            margin-right: 10px;
            font-size: 17px;
            border: 1px solid #ccc;
            width: 300px;
        }
        .back-button {
            margin-top: 20px;
        }
        .back-button a {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .back-button a:hover {
            background-color: #45a049;
        }
        /* New style for delete button */
        .delete-button {
            display: inline-block;
            padding: 8px 16px;
            background-color: #f44336;
            color: white;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .delete-button:hover {
            background-color: #c62828;
        }
    </style>
</head>
<body>

    <h2>User Details</h2>

    <!-- Search bar -->
    <div class="search-container">
        <input type="text" id="search" placeholder="Search ..." autocomplete="off">
    </div>

    <!-- Table to display user details -->
    <?php if (mysqli_num_rows($result) > 0): ?>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>City</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['city']); ?></td>
                    <td><?php echo htmlspecialchars($row['mobile']); ?></td>
                    <td><a class="delete-button" href="admin.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a></td>
                </tr>
            <?php endwhile; ?>
        </table>

        <!-- Pagination links -->
        <div class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <?php $active_class = ($i == $page) ? 'active' : ''; ?>
                <a href="<?php echo $_SERVER['PHP_SELF'] . '?page=' . $i . '&search=' . urlencode($search); ?>" class="<?php echo $active_class; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
        </div>
    <?php else: ?>
        <p>No records found</p>
    <?php endif; ?>

    <!-- Back to home button -->
    <div class="back-button">
        <a href="index.php">&laquo; Back to Home</a>
    </div>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <!-- Script for live search -->
    <script>
        $(document).ready(function () {
            $("#search").on("keyup", function () {
                var searchTerm = $(this).val().toLowerCase();
                $("table tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchTerm) > -1);
                });
            });
        });
    </script>

</body>
</html>
