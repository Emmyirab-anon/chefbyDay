<?php
    session_start();

    if (isset($_SESSION["username"])) {
        $db = new mysqli("localhost", "eie520", "0813465E", "eie520");
        if ($db->connect_error) {
            die ("Connection failed: " . $db->connect_error);
        }

        
        $q = "SELECT recipe.recipe_id, recipe.title, recipe.instructions, recipe.avr_rating, recipe.date_posted, user.username, user.user_avatar FROM recipe LEFT JOIN user ON (recipe.user_id = user.user_id) ORDER BY recipe.date_posted DESC LIMIT 20";

        $result = $db->query($q);
    
            
    
    $db->close();
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Recipe List</title>
    <link rel="stylesheet" href="mystyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        <p><i class="fa fa-user-circle"></i><?php echo $_SESSION['username']; ?></p>
        <form>
            <input type="search" name="searchBar" placeholder="Search...">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </header>
    <?
    while ($row = $result->fetch_assoc()) {
        $recipeID = $row["recipe_id"];
        $title = $row["title"];
        $instructions = $row["instructions"];
        $avrRating = $row["avr_rating"];
        $date = $row["date_posted"];
        $username = $row["username"];
        $avatar = $row["user_avatar"];
     

    ?>

    <section>
        <div class="container">
            <img src="<? echo $avatar; ?>" id = "avatar<?echo $recipeID?>" alt=""/>
            <div class="description">
                
            <? echo "<h4> <a href='recipedetail.php?ID=$recipeID' id = 'recDetailPage$recipeID'>$title</a> </h4>"; ?>
            <p id = "username<?echo $recipeID?>">Posted by: <? echo $username; ?></p>
            
            <span id = "myrating<?echo $recipeID?>"></span>
            <? 
                $i = 0;
                while($i < $avrRating){
                    echo "<span class='fa fa-star checked fkStar2'></span>";
                    $i = $i + 1;
                }
                $v = 5 - $i;
                $i = 0;
                while($i < $v){
                    echo "<span class='fa fa-star fkStar2'></span>";
                    $i = $i + 1;
                }
            ?>

            <p id = "instruction<?echo $recipeID?>"><? echo substr($instructions, 0, 97) . "..."; ?></p>

            </div>
        </div>

        <script type="text/javascript">
            setInterval(updateListRating, 20000);

            function updateListRating(){
                //To make the previous average rating disappear
                [].forEach.call(document.querySelectorAll(".fkStar2"), function (el) {el.style.visibility = "hidden";});

      

                var num = <? echo $recipeID ?>;
                

                //create XMLHttpRequest object
                var xmlhttp = new XMLHttpRequest();

                // access the onreadystatechange event for the XMLHttpRequest object
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        var display_Rating = document.getElementById("myrating<?echo $recipeID?>");

                        var results = JSON.parse(this.responseText);

                        display_Rating.innerHTML = "";

                        for (var i = 0; i < results; i++) {
                            display_Rating.innerHTML += "<span class='fa fa-star checked'></span>";
                        }

                        for (var i = 0; i < 5 - results; i++) {
                            display_Rating.innerHTML += "<span class='fa fa-star'></span>";
                        }
                    }
                };

                xmlhttp.open("GET", "rl1.php?rec=" + num, true);

                //Do this to actually execute the either type of request
                xmlhttp.send();
            }


            ///PART C
            setInterval(updateList, 90000);

            function updateList(){
                var xmlhttp = new XMLHttpRequest();

                // access the onreadystatechange event for the XMLHttpRequest object
                xmlhttp.onreadystatechange = function () {
                    
                    if (this.readyState == 4 && this.status == 200) {
                        var results = JSON.parse(this.responseText);

                        for(var i = 0; i < results.length; i++){
                            db_record = results[i];

                            var recipeDetail = document.getElementById("recDetailPage" + db_record.title);
                            var avatar = document.getElementById("avatar" + db_record.user_avatar);
                            var username = document.getElementById("username" + db_record.username);
                            var instruction = document.getElementById("instruction" + db_record.instructions);

                            avatar.src = db_record.user_avatar;
                            recipeDetail.href = "recipedetail.php?ID=" + db_record.recipe_id;
                            recipeDetail.innerHTML = db_record.title;
                            username.innerHTML = "Posted by: " + db_record.username;
                            instruction.innerHTML = db_record.instructions;
                            console.log(db_record.username);

                           updateListRating();

                        }
                    }
                };

                xmlhttp.open("GET", "rl2.php", true);

                //Do this to actually execute the either type of request
                xmlhttp.send();
            }
        </script>
    </section>

    <?
    }
    ?>


</body>

</html>