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
<title>Name</title>
<?php include 'navbar.php'; ?>
<style>
body, html {
    margin: 0;
    padding: 0;
    font-family: "Josefin Sans", sans-serif;
}

h1 {
    color: #333;
    text-align: center;
    font-family: "Josefin Sans", sans-serif;
}

.main-content {
    height: calc(100vh); 
    position: relative; 
    overflow: hidden;
}
</style>
</head>
<body>
<div class="main-content">
    <video autoplay muted loop class="background-video">
        <source src="./images/bgv1.mp4" type="video/mp4">
    </video>

    <div id="navbar-placeholder"></div>
        <div class="coming-soon"><p>Finding a recipe to suit your mood is now easy!<p>
            <a href="recipes.php" style="text-decoration: none;">
                <button class="get-started-button">Get Started</button>
            </a>
        </div>

</div>
<div class="below-video-section">
    <h1>ABOUT US</h1>
    <div class="section-below-video">
        <div class="left-text">
            <p class="right-food">Right Food</p>
            <p class="right-mind">Right Mind</p>
            <p class="our-philosophy">Our Philosophy</p>
            <p class="info" >We believe that nourishment extends beyond the plate. Founded on the principles of holistic health, our company was established to bridge the gap between dietary habits and mental clarity. We embarked on our journey with a mission to transform lives through the food we eat and the thoughts we nurture. Our philosophy is simple: eat mindfully, live fully. Each recipe is designed not only to please the palate but also to enhance your overall well-being. As we continue to grow, our core values remain rooted in promoting a healthy mind through the right food, empowering our community to make informed choices that benefit both body and spirit.</p>
        </div>
        <div class="right-image">
            <img src="./images/img2.jpeg" alt="Descriptive Alt Text" style="width: 80%;">
        </div>
    </div>
</div>
<div class="signature-recipes">
    <h2>Our Signature Recipes</h2>
    <div class="recipes-container">
        <div class="recipe">
            <img src="./images/food1.jpeg" alt="Rosemary Roasted Chicken With Potatoes">
            <h3>Rosemary Roasted Chicken With Potatoes</h3>
            <p>Cook Time: 135 mins</p>
            <p>Difficulty: Medium</p>
            <p>Calories: 671</p>
        </div>
        <div class="recipe">
            <img src="./images/food2.jpeg" alt="Stuffed Crescent Rolls">
            <h3>Stuffed Crescent Rolls</h3>
            <p>Cook Time: 45 mins</p>
            <p>Difficulty: Medium</p>
            <p>Calories: 114</p>
        </div>
        <div class="recipe">
            <img src="./images/food3.jpeg" alt="Copycat Chicken Fritta">
            <h3>Copycat Chicken Cheese Fritta</h3>
            <p>Cook Time: 35 mins</p>
            <p>Difficulty: Easy</p>
            <p>Calories: 1345</p>
        </div>
        <div class="recipe">
            <img src="./images/food4.jpeg" alt="Vegan Brownie">
            <h3>Vegan Brownie</h3>
            <p>Cook Time: 55 mins</p>
            <p>Difficulty: Medium</p>
            <p>Calories: 284</p>
        </div>
    </div>
</div>
<div class="fun-zone">
    <h2>Fun Zone</h2>
    <div class="interactive-section">
        <div class="recipe-of-the-day">
            <h3>Recipe of the Day</h3>
            <img src="./images/food5.jpeg" alt="Honey Ginger Grilled Salmon" style="width: 80%; border-radius: 10px;" >
            <h4>Honey Ginger Grilled Salmon</h4>
            <p>Cook Time: 50 mins</p>
            <p>Difficulty: Easy</p>
        </div>

        <div class="quiz-section">
            <h3>What Type of Chef Are You?</h3>
            <p>Question 1: How often do you cook at home?</p>
            <select id="question1">
                <option value="daily">Daily</option>
                <option value="few-times-a-week">A few times a week</option>
                <option value="rarely">Rarely</option>
            </select>
        
            <p>Question 2: What do you prefer to cook?</p>
            <select id="question2">
                <option value="meals">Meals</option>
                <option value="desserts">Desserts</option>
                <option value="snacks">Snacks</option>
            </select>
            <div><button onclick="evaluateQuiz()">Submit</button></div>

            <p id="quiz-result"></p>
        </div>
        

        <div class="poll-section">
            <h3>Vote for Your Favorite Dessert!</h3>
            <form>
                <input type="radio" name="dessert" value="Chocolate Cake"> Chocolate Cake<br>
                <input type="radio" name="dessert" value="Cheesecake"> Cheesecake<br>
                <input type="radio" name="dessert" value="Fruit Tart"> Fruit Tart<br>
                <button type="button" onclick="submitPoll()">Vote</button>
            </form>
            <p id="poll-result"></p>
        </div>
    </div>
</div>
<script>
    function evaluateQuiz() {
    const answer1 = document.getElementById('question1').value;
    const answer2 = document.getElementById('question2').value;
    
    let result = '';

    if (answer1 === 'daily' && answer2 === 'meals') {
        result = "You're a Home Chef!";
    } else if (answer1 === 'daily' && answer2 === 'desserts') {
        result = "You're a Pastry Chef at heart!";
    } else if (answer1 === 'few-times-a-week' || answer2 === 'snacks') {
        result = "You're a Casual Cook!";
    } else {
        result = "You're a Okay Cook!";
    }

    document.getElementById('quiz-result').innerText = result;
}

    
    function submitPoll() {
        const pollOptions = document.getElementsByName('dessert');
        let selectedDessert;
        for (let option of pollOptions) {
            if (option.checked) {
                selectedDessert = option.value;
                break;
            }
        }
        if (selectedDessert) {
            document.getElementById('poll-result').innerText = "Thanks for voting for " + selectedDessert + "!";
        } else {
            document.getElementById('poll-result').innerText = "Please select an option to vote!";
        }
    }
    </script>
    

<footer class="site-footer">
    <div class="footer-content">
        <div class="footer-logo">
            <img src="./images/footer.jpeg" alt="Footer Logo">
        </div>
        <div class="contact-info">
            <p><label style="color: #000000;">Let's get in touch!</label></p>
            <p><label>Email</label><br><span>app@gmail.com</span></p>
            <p><label>Phone</label><br><span>(123) 456-7890</span></p>
            <p><label>Social</label></p>
            <div class="social-icons">
                <a href="https://www.facebook.com/" class="social-link"><i class="fa fa-facebook"></i></a>
                <a href="https://www.twitter.com" class="social-link"><i class="fa fa-twitter"></i></a>
                <a href="https://www.instagram.com" class="social-link"><i class="fa fa-instagram"></i></a>
                <a href="https://www.linkedin.com" class="social-link"><i class="fa fa-linkedin"></i></a>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
