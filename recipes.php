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
body {
    background-color: #eadad1;
    font-family: "Josefin Sans", sans-serif;
}
.heading {
    font-size: 1.2em; 
    margin-top: 18px;
    color: #8e5c40; 
    font-family: "Josefin Sans", sans-serif;
    font-size: 24px;
    margin-bottom: 10px; 
    font-weight: bold;
}
.container {
    width: 100%;
    margin: auto;
    text-align: center;
    padding: 20px;
    background-color: transparent;
}
.recipe-grid {
    display: flex;
    flex-direction: column; 
    align-items: center;
}

.recipe-card {
    flex-basis: 90%;
    margin: 10px auto; 
    padding: 20px;
    background: #f8f8f8;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.calories-result {
    font-size: 1.1em;
    color: #703c2c; 
    font-weight: bold; 
    margin-top: 10px; 
    padding: 10px;
}


button {
    background-color: #8e5c40; 
    color: white;
    font-family: "Josefin Sans", sans-serif;
    padding: 15px 30px; 
    margin-top: 20px; 
    border: none;
    border-radius: 5px; 
    cursor: pointer;
    transition: background-color 0.3s; 
}
.button-container {
    text-align: center; 
}
button:hover {
    background-color: #703c2c; 
}

textarea {
    width: 90%; 
    padding: 15px; 
    margin-top: 20px; 
    display: inline-block;
    border: 2px solid #ccc; 
    border-radius: 10px; 
    box-sizing: border-box;
    font-family: "Josefin Sans", sans-serif;
}

</style>
</head>
<body>
<div id="navbar-placeholder"></div>
<div class="container">
    <h1>Search Recipes and Check Calories</h1>
    <form id="ingredientForm" action="" method="GET">
        <textarea name="ingredients" rows="5" placeholder="Enter ingredients separated by a comma..."></textarea>
        <div class="button-container">
    <button type="submit">Submit</button>
    </div>    
    </form>
    <div id="recipeResults" class="recipe-grid">
    <?php
    session_start(); 

    $username = '';
    $isLoggedIn = isset($_SESSION['login_user']);
    if ($isLoggedIn) {
        $username = htmlspecialchars($_SESSION['login_user']);
    } else {
        $username = 'User';
    }
    
    if(isset($_GET['ingredients'])) {
        $str = $_GET['ingredients'];
        $cleanStr = urldecode($str);
        $arr = explode(',', $cleanStr);

        $username = "uujdyvq78bdq7";
        $password = "Recipe_Project";
        $db = "db5gcsntykozag";
        $serverName = "35.215.123.83";
        $conn = new mysqli($serverName, $username, $password, $db);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM RTable WHERE Cleaned_Ingredients Like '%".$arr[0]."%'";
        for ($i = 1; $i < count($arr); $i++) {
            $sql .= " AND Cleaned_Ingredients Like '%".$arr[$i]."%'";
        }

        $result = mysqli_query($conn, $sql);

        echo "<div class='recipe-grid'>";

        $counter = 0;
        while($row = $result->fetch_assoc()) {
            if ($counter < 5) {
                echo "<div class='recipe-card'>";
                echo "<div class='heading'><strong>Recipe: </strong>" . $row['Title'] . "</div>";
                echo "<div class='heading'>Ingredients:</div>";
            
                $checkID = $row['ID'];
                $sql2 = "SELECT Cleaned_Ingredients FROM Ingredient_List WHERE Recipe_ID = '$checkID'";
                $result2 = mysqli_query($conn, $sql2);
                $ingredients_list = [];
                while($row2 = $result2->fetch_assoc()) {
                    echo $row2['Cleaned_Ingredients'] . "<br/>";
                    $ingredients_list[] = $row2['Cleaned_Ingredients'];
                }

                $display_func = "function displayCalories(calorieData) {
                        total = 0
                        Object.keys(calorieData).forEach((key) => total += calorieData[key])
                        
                        parent = document.getElementById('calories-". $row['ID'] ."')
                        content = document.createElement('p')
                        content.textContent = total + ' calories'
                        parent.innerHTML = ''
                        parent.appendChild(content)
                        }";

                echo "<div class='heading'>Instructions:</div>" . $row['Instructions'];
                echo "<div id='calories-". $row['ID'] ."' class='calories-result'></div>";
                echo "<button onclick=\"calories_descriptive(['" . implode("', '", $ingredients_list) . "'],". $display_func .")\">Check Calories</button>";
                echo "</div>";
            }
            $counter++;
        }
        echo "</div>";
        echo '<script src="calorieFunctions.js"></script>';
    }
    ?>
    </div>
    <div id="calorieResults"></div>
</div>
</body>
</html>
