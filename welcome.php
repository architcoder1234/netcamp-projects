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
<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <style>
        body { 
		font-family: Arial; 
		background: #eef2f3; 
		text-align: center; 
		}
        .profile { 
		margin-top: 50px; 
		background: #fff; 
		padding: 50px; 
		display: inline-block;
		border-radius: 10px; 
		box-shadow: 0 0 10px #aaa; 
		}
        img { 
		border-radius: 60%; 
		border: 3px solid #007bff; 
		width: 120px; height: 120px; 
		object-fit: cover; 
		}
        button { margin: 10px; 
		padding: 10px 20px; border: none; 
		background: #007bff; color: white; 
		border-radius: 5px; cursor: pointer; 
		}
        button:hover { 
		background: #0056b3; 
		}
    </style>
</head>
<body>
   
	
<div class="profile">
    <h2>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h2>

    <?php if (!empty($user['profile_photo'])): ?>
        <img src="<?php echo htmlspecialchars($user['profile_photo']); ?>" alt="Profile Photo">
    <?php else: ?>
        <img src="default.png" alt="Default Photo">
    <?php endif; ?>

    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>

    <form action="upload_photo.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="profile_photo" accept="image/*" required>
        <button type="submit">Upload New Photo</button>
    </form>

    <button onclick="window.location.href='profile.php'">View Profile</button>
    <button onclick="window.location.href='logout.php'">Logout</button>
</div>
</body>
</html>
