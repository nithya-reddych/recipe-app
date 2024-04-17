<?php
session_start();

if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
    exit(); 
} else {
    include 'db.php';

    $user_username = $_SESSION['login_user'];
    $query = "SELECT username, email, birthday FROM users WHERE username = '$user_username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row['username'];
        $email = $row['email'];
        $birthday = $row['birthday'];
    } else {
        $error = "User data not found!";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
<title>My Account</title>
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
        <h1>Welcome, <?php echo $username; ?></h1>
        <p>Email: <?php echo $email; ?></p>
        <p>Birthday: <?php echo $birthday; ?></p>
    <?php else: ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
</div>

</body>
</html>
