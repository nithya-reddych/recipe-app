<?php
$str = $_GET['ingredient'];
$cleanStr = urldecode($str);;
$arr = [];
$arr = explode(',', $cleanStr);


$username = "uujdyvq78bdq7";
$password = "Recipe_Project";
$db = "db5gcsntykozag";
$conn = new mysqli('localhost',$username,$password,$db);
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM RTable WHERE Cleaned_Ingredients Like '%".$arr[0]."%'";
for ($i = 1; $i < count($arr); $i++) {
     $sql = $sql. " AND Cleaned_Ingredients Like '%".$arr[$i]."%'";  
}

$result = mysqli_query($conn,$sql);


$counter = 0;
echo "<strong>Recipes based on the ingredients you entered</strong>";
echo "<br>";
while($row = $result->fetch_assoc()) {
     extract ($row);
     if ($counter < 5) {
        echo "<div>";
        echo "<strong>Recipe Name: </strong>";
        echo $Title;
        echo "<br/>";
        echo "Ingredients:</br>";
        $checkID = $ID;
        $sql2 = "SELECT Cleaned_Ingredients FROM Ingredient_List WHERE Recipe_ID = '".$checkID."'";
        $result2 = mysqli_query($conn,$sql2);
        while($row2 = $result2->fetch_assoc()) {
             extract ($row2);
             echo $Cleaned_Ingredients;
             echo "<br/>";
        }
        echo "<br>";
        echo "Instructions:</br>";
        echo $Instructions;
        echo "</div>";
        echo "<br/>";
     }
        
    
    $counter++;

} 






?>