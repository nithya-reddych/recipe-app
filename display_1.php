<?php

$str = $_GET['ingredient'];
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

echo "<div style='display: flex; flex-wrap: wrap; justify-content: space-around;'>";
$counter = 0;
while($row = $result->fetch_assoc()) {
    if ($counter < 5) {
        echo "<div style='flex-basis: 30%; margin-bottom: 20px; padding: 10px; background: #f8f8f8; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);'>";
        echo "<strong>Recipe Name: </strong>" . $row['Title'] . "<br/>";
        echo "Ingredients:</br>";
        $checkID = $row['ID'];
        $sql2 = "SELECT Cleaned_Ingredients FROM Ingredient_List WHERE Recipe_ID = '$checkID'";
        $result2 = mysqli_query($conn, $sql2);
        $ingredients_list = [];
        while($row2 = $result2->fetch_assoc()) {
            echo $row2['Cleaned_Ingredients'] . "<br/>";
            $ingredients_list[] = $row2['Cleaned_Ingredients']; // Prepare array for JS
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

        echo "<br>Instructions:</br>" . $row['Instructions'];
        echo "<div id='calories-". $row['ID'] ."'></div>";
        echo "<button onclick=\"calories_descriptive(['" . implode("', '", $ingredients_list) . "'],". $display_func .")\">Check Calories</button>";
        echo "</div>";
    }
    $counter++;
}
echo "</div>";
echo '<script src="calorieFunctions.js"></script>';
?>
