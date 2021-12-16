<?php
session_start();
      
//If nobody is logged in, display login and signup page.
if(isset($_SESSION["username"]))
{
    $validate = true;
$error = "";
$title = "";
$ingredients = "";
$description = "";


if (isset($_POST["submitted"]) && $_POST["submitted"]) {
    $title = $_POST["title"];
    $date = $_POST["ingredients"];
    $instructions = $_POST["instructions"];
       
    $db = new mysqli("localhost", "eie520", "0813465E", "eie520");
    if ($db->connect_error) {
        die ("Connection failed: " . $db->connect_error);
    }

    $titleLen = strlen($title);
        if($title == null || $title == "" || $titleLen > 50) {
            $validate = false;
        }
              
        if($ingredients == null || $ingredients == "") {
            $validate = false;
        }

        if($instructions == null || $instructions == "") {
            $validate = false;
        }

    if($validate == true) {
       $dateFormat = date("d-M-Y");
       $rating = 0;

        $q2 = "INSERT INTO recipe (title, ingredients, instructions, avr_rating, date_posted) VALUES ('$title', '$ingredients', '$instructions', '$rating', '$dateFormat')";
       
        $r2 = $db->query($q2);
        
        if ($r2 === true) {
            header("Location: recipelist.php");
            $db->close();
            exit();
        }

    }

}

}

else
{	
    echo "<h3>Please Login or Sign up</h3>";
    echo "<a href='login.html'>Login</a> <a href='signup.php'>Signup</a>";	
            
}


?>


<!DOCTYPE html>
<html>

<head>
    <title>Post Recipe</title>
    <link rel="stylesheet" href="mystyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="validate.js"></script>
    </link>
</head>

<body>

    <header class="myHeader">
        <h1>Chef by Day</h1>
        <ul>
            <li><a href="recipedetail.php">Details</a></li>
            <li><a href="recipelist.php">List</a></li>
            <li><a href="postrecipe.php">Post</a></li>

        </ul>
        <p><i class="fa fa-user-circle"></i> <?php echo $_SESSION['username'] ?></p>
        <form>
            <input type="search" name="searchBar" placeholder="Search...">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </header>

    <section class="postRecipe">
        <form id="idPOSTRECIPE" method="POST" action="recipelist.php">
            <h2>Post Recipe</h2>
            <label id="msg_title" class="err_msg"></label>
            <input id="title" type="text" name="title" placeholder="Title">
            <span id=count></span>

            <label id="msg_ingredients" class="err_msg"></label>
            <textarea id = "ingredients" name="ingredients" cols="30" rows="10" placeholder="Ingredients"></textarea>

            <label id="msg_instructions" class="err_msg"></label>
            <textarea id = "instructions" name="instructions" cols="50" rows="30" placeholder="Instructions"></textarea>

            <input type="submit" value="Submit">
        </form>
        <script type="text/javascript" src="postrecipe-r.js"></script>
    </section>

</body>

</html>