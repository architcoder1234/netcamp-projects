<?php
session_start();
include('db_connect.php');

// ✅ Ensure only admin can access this page
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: admin_login.php");
    exit();
}

// ✅ Fetch all users except admin (optional)
$sql = "SELECT id, username, email, profile_photo FROM users WHERE is_admin = 0";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; font-family: 'Segoe UI', sans-serif; }
        .container { margin-top: 50px; max-width: 900px; }
        .card { box-shadow: 0 4px 15px rgba(0,0,0,0.1); border-radius: 12px; }
        table img { border-radius: 50%; object-fit: cover; }
        .btn-sm { padding: 5px 10px; font-size: 14px; }
        .header-title { color: #007bff; font-weight: 600; }
        .logout-btn { background-color: #6c757d; border: none; }
    </style>
</head>
<body>

<div class="container">
    <div class="card p-4">
        <h2 class="text-center header-title">👨‍💻 Admin Dashboard</h2>
        <p class="text-center mb-4">Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></p>

        <table class="table table-bordered table-striped align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th>Photo</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td>
                                <?php
                                $photoPath = !empty($row['profile_photo']) ? $row['profile_photo'] : 'default.png';
                                ?>
                                <img src="<?php echo $photoPath; ?>" width="60" height="60" alt="Profile Photo">
                            </td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td>
                                <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete_user.php?id=<?php echo $row['id']; ?>" 
                                   class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Are you sure you want to delete this user?');">
                                   Delete
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="4">No users found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="text-center">
            <a href="logout.php" class="btn btn-secondary logout-btn">Logout</a>
        </div>
    </div>
</div>

</body>
</html>
