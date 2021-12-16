<?php
session_start();
//If nobody is logged in, display login and signup page.
if(isset($_SESSION["username"]))
{
    $db = new mysqli("localhost", "eie520", "0813465E", "eie520");
    if ($db->connect_error) {
        die ("Connection failed: " . $db->connect_error);

    }

    $recId = $_GET['ID'];
    $_SESSION["ID"] = $recId;
    
    
    $q = "SELECT recipe.recipe_id, recipe.title, recipe.instructions, recipe.ingredients, recipe.avr_rating, recipe.date_posted, user.user_id, user.username, user.user_avatar, rating.rating_value FROM recipe LEFT JOIN user ON (recipe.user_id = user.user_id) LEFT JOIN rating  ON (recipe.recipe_id = rating.recipe_id) WHERE recipe.recipe_id = '$recId%'";
    $result = $db->query($q);

    
    
    $db->close();

}

else
{	
    echo "<H3>Please Login or Sign up</h3>";
    echo "<a href='login.php'>Login</a> <a href='signup.php'>Signup</a>";	
            
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Recipe Details</title>
    <link rel="stylesheet" href="mystyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="validate.js"></script>
    <script type="text/javascript" src="rdscripts.js"></script>
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
        <p><i class="fa fa-user-circle"></i> <?php echo $_SESSION['username']; ?></p>
        <form>
            <input type="search" name="searchBar" placeholder="Search...">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </header>

    <?
    while ($row = $result->fetch_assoc()) {
        $title = $row["title"];
        $instructions = $row["instructions"];
        $avrRating = $row["avr_rating"];
        $date = $row["date_posted"];
        $username = $row["username"];
        $avatar = $row["user_avatar"];
        $ingredients = $row["ingredients"];
        $rating = $row["rating_value"];

    ?>

    <aside>
        <h3>Author;</h3>
        <p>This recipe was posted by <?php echo $username; ?></p>
        <br />

        <h3>Ingredients;</h3>
        <p><?php echo $ingredients; ?></p>
    </aside>

    <section class="recipedetail">
        <h2><?php echo $title; ?></h2>
        <img src="images/image1.jpeg" alt="">

        </br></br>
        <span id="averageRating" >Average Rating: </span>
        <? $i = 0;
            while($i < $avrRating){
                echo "<span class='fa fa-star checked fkStar'></span>";
                $i = $i + 1;
            }
            $v = 5 - $i;
            $i = 0;
            while($i < $v){
                echo "<span class='fa fa-star fkStar'></span>";
                $i = $i + 1;
            }
        ?>
       

        <h3>Instructions;</h3>
        <p><?php echo $instructions; ?></p>

        <form id="USERrating">
            <p>Rate Recipe: <span class="fa fa-star checked"></span></p>

            <button id="incRating">+</button>
            <input type="number" name="ratingUser" value = "<? echo $rating ?>" id="ratingUser" min="1" max='5'>
            <button id="decRating">-</button>

            <input type="button" value="Submit" name = "submitted" id = "rateSubmit">
        </form>
        <script type="text/javascript" src="recipedetail-r.js"></script>
    </section>
    <?
    }
    
    ?>

</body>

</html>