<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login System</title>
    <!-- ✅ Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>

<!-- ✅ Navbar / Header -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <!-- Logo -->
    <a class="navbar-brand d-flex align-items-center" href="welcome.php">
      <img src="logo.png" alt="Logo" width="40" height="40" class="me-2 rounded-circle">
      <span>Login System</span>
    </a>

    <!-- Menu items -->
    <div>
      <a href="form.php" class="btn btn-outline-light btn-sm me-2">Login</a>
      <a href="register.php" class="btn btn-outline-light btn-sm me-2">Signup</a>
      <a href="profile.php" class="btn btn-outline-light btn-sm me-2">Profile</a>
      <a href="admin_login.php" class="btn btn-warning btn-sm me-2">Admin</a>
      <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>
  </div>
</nav>
