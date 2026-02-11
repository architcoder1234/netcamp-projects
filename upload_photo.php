<?php
session_start();
include('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_photo'])) {
    $username = $_SESSION['username'];
    $targetDir = "uploads/";
    $fileName = basename($_FILES['profile_photo']['name']);
    $targetFile = $targetDir . $fileName;

    // Create uploads folder if it doesn’t exist
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Move uploaded file to uploads folder
    if (move_uploaded_file($_FILES['profile_photo']['tmp_name'], $targetFile)) {
        $sql = "UPDATE users SET profile_photo='$targetFile' WHERE username='$username'";
        if ($conn->query($sql)) {
            echo "<script>alert('Profile photo uploaded successfully!'); window.location='welcome.php';</script>";
        } else {
            echo "❌ Database update error: " . $conn->error;
        }
    } else {
        echo "❌ File upload failed!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Profile Photo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5 col-md-5">
<div class="card p-4 shadow">
    <h3 class="text-center">Upload Profile Photo</h3>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Select Photo</label>
            <input type="file" name="photo" class="form-control" required>
        </div>
        <button type="submit" name="upload" class="btn btn-primary w-100">Upload</button>
    </form>
</div>
</div>
</body>
</html>
