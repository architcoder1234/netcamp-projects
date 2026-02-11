<?php
include('db_connect.php');
if (isset($_POST['reset'])) {
    $email = $_POST['email'];
    $new_pass = $_POST['new_password'];
    $hashed_pass = password_hash($new_pass, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $update = "UPDATE users SET password='$hashed_pass' WHERE email='$email'";
        if ($conn->query($update)) {
            echo "<script>alert('Password reset successfully!'); window.location='form.php';</script>";
        }
    } else {
        echo "<script>alert('Email not found!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5 col-md-5">
    <div class="card p-4 shadow">
        <h3 class="text-center">Forgot Password</h3>
        <form method="POST">
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control" required>
            </div>
            <button name="reset" class="btn btn-primary w-100">Reset Password</button>
        </form>
    </div>
</div>
</body>
</html>
