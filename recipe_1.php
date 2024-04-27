<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Recipes and Calories</title>
</head>
<body>
<div class="container">
    <h1>Search Recipes and Calculate Calories</h1>
    <form id="ingredientForm" action="display.php" method="GET">
        <textarea name="ingredients" rows="5" placeholder="Enter ingredients separated by a newline or comma..."></textarea>
        <button type="submit">Submit</button>
    </form>
    <div id="recipeResults" class="recipe-grid"></div>
    <div id="calorieResults"></div>
</div>
</body>
</html>
