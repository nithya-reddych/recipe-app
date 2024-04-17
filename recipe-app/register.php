<?php
include 'db.php';
session_start();
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $birthday = mysqli_real_escape_string($conn, $_POST['birthday']);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $check_username = "SELECT * FROM users WHERE username = '$username'";
    
    $result_email = $conn->query($check_email);
    $result_username = $conn->query($check_username);
    
    if ($result_email->num_rows > 0) {
        $error = "Email already exists";
    } elseif ($result_username->num_rows > 0) {
        $error = "Username already taken";
    } else {
        $sql = "INSERT INTO users (username, email, password, birthday) VALUES ('$username', '$email', '$hashed_password', '$birthday')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['login_user'] = $email;
            header("location: profile.php");
        } else {
            $error = "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    if ($conn) {
        $conn->close();
    }
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
<title>Login / Register</title>
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
    background: url('./images/bg2.jpeg') no-repeat center center fixed;
    background-size: cover;
}
h2 {
    color: #333;
    margin-bottom: 20px;
}
.form {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
}
.action-button {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 5px;
    color: #fff;
    background-color: #8e5c40;
    cursor: pointer;
    transition: background-color 0.3s;
}
.action-button:hover {
    background-color: #926c3b;
}
.signup {
    margin-top: 10px;
}
.signup-button {
    color: #007BFF;
    cursor: pointer;
    text-decoration: underline;
}
.signup-button:hover {
    color: #0056b3;
}
.message {
    text-align: center;
    font-size: 16px;
    color: black;
}
</style>
</head>
<body>
<div id="navbar-placeholder"></div>
<div class="user-container">
    <?php if (!empty($error)) : ?>
    <div class="message" id="message"><?php echo $error; ?></div>
    <?php endif; ?>
    <h2>Register</h2>
    <div id="register">
        <form action="" method="post">
            <input type="text" name="username" class="form" placeholder="Username" required>
            <input type="text" name="email" class="form" placeholder="Email" required>
            <input type="password" name="password" class="form" placeholder="Password" required>
            <input type="date" name="birthday" class="form" required>
            <button type="submit" class="action-button">Register</button>
        </form>
        <div class="signup">
            Already have an account? <a href="login.php" class="signup-button">Login</a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function displayErrorMessage() {
        const errorMessage = document.getElementById('message');
        if (errorMessage.innerText.trim() !== '') {
            errorMessage.style.display = 'block';
            setTimeout(function() {
                errorMessage.style.display = 'none';
            }, 5000);
        }
    }

    displayErrorMessage();
});
</script>

</body>
</html>
