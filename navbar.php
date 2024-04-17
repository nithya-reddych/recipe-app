<?php
session_start(); 

$username = isset($_SESSION['login_user']) ? htmlspecialchars($_SESSION['login_user']) : 'User';
$isLoggedIn = isset($_SESSION['login_user']);
?>

<style>
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 5px;
    position: fixed;
    top: 15px;
    left: 0;
    width: 100%;
    z-index: 1000;
}
.navbar .brand-logo {
    display: flex;
    align-items: center;
}
.navbar .brand-logo img {
    height: 50px;
}
.navbar a.active{
    text-decoration: underline;
}
.navbar a, .navbar .dropbtn {
    color: #000000;
    text-decoration: none;
    font-family: "Josefin Sans", sans-serif;
    padding: 10px 15px;
    font-size: 24px;
    background: none;
    border: none;
    cursor: pointer;
}
.navbar a:hover, .navbar .dropbtn:hover {
    color: #474747;
}
.navbar .dropdown {
    position: relative;
    display: inline-block;
}
.navbar .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    z-index: 1;
    right: 0;
}
.navbar .dropdown:hover .dropdown-content {
    display: block;
}
.navbar .dropdown-content a {
    color: black;
    font-size: 16px;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}
.navbar .dropdown-content a:hover {
    background-color: #ddd;
}
</style>

<div class="navbar">
    <div class="brand-logo">
        <a href="home.php"><img src="./images/logo.jpeg" alt="Logo"></a>
    </div>
    <div>
        <a href="home.php">Home</a>
        <a href="recipes.php">Recipes</a>
        <div class="dropdown">
            <button class="dropbtn"><?= $isLoggedIn ? 'Hi, ' . $username : 'User'; ?></button>
            <div class="dropdown-content">
                <?= $isLoggedIn ? '<a href="profile.php">My Profile</a>
                    <a href="fav.php">Favorites</a>
                    <a href="logout.php">Sign Out</a>' : 
                    '<a href="login.php">Sign In / Register</a>'; ?>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const currentPage = window.location.pathname.split('/').pop();
    const navLinks = document.querySelectorAll('.navbar a:not(.dropbtn)');
    navLinks.forEach(link => {
        if (link.getAttribute('href').includes(currentPage)) {
            link.classList.add('active');
        }
    });
});
</script>
