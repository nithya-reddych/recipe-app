<?php 
session_start();

if (!isset($_SESSION['login_user'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$user_username = $_SESSION['login_user'];
$query = "SELECT username, email, birthday, profile_picture FROM users WHERE username = '$user_username'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
    $email = $row['email'];
    $birthday = $row['birthday'];
    $profile_picture = $row['profile_picture'] ? "uploads/" . $row['profile_picture'] : './images/default.jpeg';
} else {
    $error = "User data not found!";
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
<title><?php echo htmlspecialchars($username) ?> | My Profile</title>
<?php include 'navbar.php'; ?>
<style>
body {
    font-family: 'Josefin Sans', sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    background: url('./images/bg1.jpeg') no-repeat center center fixed;
    background-size: cover;
}

.user-container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 15px;
}

h1 {
    color: #333;
    margin-bottom: 20px;
}

p {
    color: #666;
    margin-bottom: 10px;
}
</style>
</head>
<body>
<div id="navbar-placeholder"></div>

<div class="user-container">
    <?php if (isset($username)): ?>
        <h1>Welcome, <?php echo htmlspecialchars($username); ?></h1>
        <p>Email: <?php echo htmlspecialchars($email); ?></p>
        <p>Birthday: <?php echo htmlspecialchars($birthday); ?></p>
        <img src="<?php echo htmlspecialchars($profile_picture); ?>" alt="Profile Picture" style="width: 150px; height: 150px; border-radius: 75px;">
        <form action="profile.php" method="post" enctype="multipart/form-data">
        </form>
    <?php else: ?>
        <p><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
</div>

</body>
</html>
