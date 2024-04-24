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
<script src="calorieFunctions.js"></script>

<title>Name</title>

</head>
<body>
<div id="navbar-placeholder"></div>
<div class="container">
        <h1>Calculate Calories in Your Recipe</h1>
        <form id="ingredientForm">
            <textarea id="ingredients" name="ingredients" rows="5" placeholder="Enter ingredients separated by a newline or comma..."></textarea>
            <button type="submit">Calculate Calories</button>
        </form>
        <div id="results"></div>
    </div>

    <script>
        document.getElementById('ingredientForm').addEventListener('submit', function(e) {
            e.preventDefault();
            let ingredients = document.getElementById('ingredients').value.split(/\n|,/).map(ing => ing.trim()).filter(ing => ing.length);
            calories_descriptive(ingredients, displayCalories);
        });

        function displayCalories(calorieData) {
            const results = document.getElementById('results');
            results.innerHTML = ''; // Clear previous results
            Object.keys(calorieData).forEach(key => {
                const content = document.createElement('p');
                content.textContent = `${key}: ${calorieData[key]} calories`;
                results.appendChild(content);
            });
        }
    </script>

    <style>
        body {
            font-family: 'Josefin Sans', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: url('./images/bg1.jpeg') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 15px;
            width: 80%;
            max-width: 600px;
        }

        textarea {
            width: 100%;
            margin-bottom: 10px;
        }

        button {
            cursor: pointer;
        }
    </style>
</body>
</html>
