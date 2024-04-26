<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="calorieFunctions.js"></script> <!-- Ensure this script is correctly linked -->
    <title>Recipes and Calories</title>
</head>
<body>
<div class="container">
    <h1>Search Recipes and Calculate Calories</h1>
    <form id="ingredientForm">
        <textarea id="ingredients" name="ingredients" rows="5" placeholder="Enter ingredients separated by a newline or comma..."></textarea>
        <button type="button" onclick="searchRecipes(getIngredients())">Submit</button>
    </form>
    <div id="recipeResults" class="recipe-grid"></div>
    <div id="calorieResults"></div>
</div>

<script>
    function getIngredients() {
        return document.getElementById('ingredients').value.split(/\n|,/).map(ing => ing.trim()).filter(ing => ing.length);
    }

    function searchRecipes(ingredients) {
        const results = document.getElementById('recipeResults');
        results.innerHTML = '<h2>Matching Recipes:</h2>'; // Clear previous results
        const xhr = new XMLHttpRequest();
        xhr.open("GET", "display.php?ingredient=" + encodeURIComponent(ingredients.join(',')), true);
        xhr.onload = function() {
            if (xhr.status == 200) {
                results.innerHTML += xhr.responseText; // Append the search results from display.php
            } else {
                results.innerHTML += '<p>Failed to retrieve recipes.</p>';
            }
        };
        xhr.send();
    }
</script>

<style>
    body {
        font-family: 'Josefin Sans', sans-serif;
        margin: 0;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: url('./images/bg1.jpeg') no-repeat center center fixed;
        background-size: cover;
    }

    .container {
        width: 100%; 
        text-align: center;
        padding: 20px;
    }

    .recipe-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around; 
    }

    .recipe-card {
        flex: 1 1 30%; 
        margin-bottom: 20px;
        padding: 10px;
        background: #f8f8f8;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        box-sizing: border-box; 
    }

    textarea, button {
        width: 100%;
        margin-bottom: 10px;
    }

    button {
        cursor: pointer;
    }
</style>
</body>
</html>
