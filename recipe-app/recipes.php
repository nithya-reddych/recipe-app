<?php
session_start(); 

$username = '';
$isLoggedIn = isset($_SESSION['login_user']);
if ($isLoggedIn) {
    $username = htmlspecialchars($_SESSION['login_user']);
} else {
    $username = 'User';
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
<link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Satisfy&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/96c75676d8.js" crossorigin="anonymous"></script>

<?php include 'navbar.php'; ?>
<title>Name</title>

</head>
<body>
<div id="navbar-placeholder"></div>




</body>
</html>
