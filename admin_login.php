<?php
// admin_login.php
session_start();
include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Prepare and fetch only admin users
    $sql = "SELECT * FROM users WHERE username = ? AND is_admin = 1 LIMIT 1";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // If admin user found
    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashed = $row['password'];

        $password_ok = false;

        // 1) Try modern password_verify (password_hash)
        if (function_exists('password_verify') && password_verify($password, $hashed)) {
            $password_ok = true;
        } else {
            // 2) Fallback: maybe the stored password is md5 (older system)
            if ($hashed === md5($password)) {
                $password_ok = true;
            }
            // 3) Or fallback: plain-text (not recommended) — check exact match (only for debugging)
            // else if ($hashed === $password) { $password_ok = true; } 
        }

        if ($password_ok) {
            // set sessions used by user and admin pages
            $_SESSION['username'] = $row['username'];       // for pages expecting 'username'
            $_SESSION['admin_username'] = $row['username']; // explicit admin session
            $_SESSION['is_admin'] = 1;

            // Redirect to admin dashboard
            header("Location: admin_dashboard.php");
            exit();
        } else {
            // wrong password
            echo "<script>alert('Incorrect password for admin.');</script>";
        }
    } else {
        // no admin user found
        echo "<script>alert('Admin account not found or not authorized. Make sure the user has is_admin = 1.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Login</title>
    <style>
        body { font-family: Arial, sans-serif; background:#f2f4f7; }
        .login-box { width:360px; margin:80px auto; background:#fff; padding:26px; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.08);}
        input { width:100%; padding:10px; margin:8px 0; border-radius:6px; border:1px solid #ddd; }
        button { width:100%; padding:10px; background:#007bff; color:#fff; border:none; border-radius:6px; cursor:pointer; }
        button:hover { background:#0056b3; }
    </style>
</head>
<body>
<div class="login-box">
    <h2 style="text-align:center">Admin Login</h2>
    <form method="post" action="">
        <input type="text" name="username" placeholder="Admin username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <p style="text-align:center; margin-top:10px;"><a href="form.php">Back to user login</a></p>
</div>
</body>
</html>
