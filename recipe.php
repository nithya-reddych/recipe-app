<html>


<script>
      function submitForm(action) {
                form = document.getElementById('submit');
                form.action = action;
                form.submit();
       }
</script>
<form id = "submit">
<?php 
    echo "<label for='ingredient'>Ingredient</label>";
    echo "<input type = 'text' name = 'ingredient'>";
    echo "<button onclick = submitForm('display.php')>Submit</button>";
?>
</form>
</html>