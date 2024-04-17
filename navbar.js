document.addEventListener('DOMContentLoaded', function() {
    const navbarHTML = `
    <div class="navbar">
        <div class="brand-logo">
            <a href="home.html"><img src="./images/logo.jpeg" alt="Logo" style="height: 50px;"></a>
        </div>
        <div class="about">
            <a href="home.html">Home</a>
            <a href="recipes.html">Recipes</a>
            <a href="user.html">User</a>
        </div>
    </div>
    `;

    document.getElementById('navbar-placeholder').innerHTML = navbarHTML;

    const currentPage = window.location.pathname.split('/').pop();
    const navLinks = document.querySelectorAll('.navbar a');
    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPage) {
            link.classList.add('active');
        }
    });
});
