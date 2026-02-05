<?php
session_start();
include('db_connect.php');

if (!isset($_SESSION['username'])) {
    header("Location: form.php");
    exit();
}

$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<?php include('header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Profile</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5 col-md-6">
<div class="card p-4 shadow text-center">
    <h3 class="mb-3">👤 <?= $user['username']; ?>'s Profile</h3>

    <?php if (!empty($user['profile_photo'])): ?>
        <img src="<?php echo htmlspecialchars($user['profile_photo']); ?>" alt="Profile Photo">
    <?php else: ?>
        <img src="default.png" alt="Default Photo">
    <?php endif; ?>

    <p><strong>Email:</strong> <?= $user['email']; ?></p>
    <a href="upload_photo.php" class="btn btn-primary mb-2">Change Profile Photo</a><br>
    <a href="welcome.php" class="btn btn-secondary">Back</a>
</div>
</div>
</body>
</html>



<?php include('footer.php'); ?>
