<?php
include 'db.php';
session_start();
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "SELECT id, password FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['login_user'] = $username;
            header("location: profile.php");
        } else {
            $error = "Your Username or Password is invalid";
        }
    } else {
        $error = "Your Username or Password is invalid";
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
.hide-pass {
    cursor: pointer;
    position: absolute;
    right: 20px;
    top: 10px;
    color: #333;
}
</style>
</head>
<body>
<div id="navbar-placeholder"></div>
<div class="user-container">
    <div id="message" class="message" style="<?php echo (!empty($error) ? '' : 'display:none;'); ?>"><?php echo $error; ?></div>
    <h2 id="form-title">Login</h2>
    <div id="login">
        <form action="login.php" method="post">
            <input type="text" name="username" class="form" placeholder="Username" required>
            <div style="position: relative;">
                <input type="password" name="password" class="form" placeholder="Password" required id="password">
                <span onclick="hidePass()" class="hide-pass">Show</span>
            </div>
            <button type="submit" class="action-button">Login</button>
        </form>
        <div class="signup">
            Don't have an account? <span class="signup-button" onclick="changeForm()">Sign up</span>
        </div>
    </div>
    <div id="register" style="display:none;">
        <form action="register.php" method="post">
            <input type="text" name="username" class="form" placeholder="Username" required>
            <input type="text" name="email" class="form" placeholder="Email" required>
            <input type="password" name="password" class="form" placeholder="Password" required>
            <input type="date" name="birthday" class="form" required>
            <button type="submit" class="action-button">Register</button>
        </form>
        <div class="signup">
            Already have an account? <span class="signup-button" onclick="changeForm()">Login</span>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function displayErrorMessage() {
        const errorMessage = document.getElementById('message');
        if (errorMessage.innerText !== '') { 
            errorMessage.style.display = 'block';
            setTimeout(function() {
                errorMessage.style.display = 'none';
            }, 5000);
        }
    }

    displayErrorMessage();
});


function changeForm() {
    const loginForm = document.getElementById('login');
    const registerForm = document.getElementById('register');
    const formTitle = document.getElementById('form-title');
    if (loginForm.style.display === 'none') {
        loginForm.style.display = 'block';
        registerForm.style.display = 'none';
        formTitle.textContent = 'Login';
    } else {
        loginForm.style.display = 'none';
        registerForm.style.display = 'block';
        formTitle.textContent = 'Register';
    }
}

function hidePass() {
    var passwordInput = document.getElementById('password');
    var toggleBtn = document.querySelector('.hide-pass');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleBtn.textContent = 'Hide';
    } else {
        passwordInput.type = 'password';
        toggleBtn.textContent = 'Show';
    }
}
</script>
</body>
</html>
