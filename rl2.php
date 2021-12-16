<?php
    session_start();

    if (isset($_SESSION["username"])) {
        $db = new mysqli("localhost", "eie520", "0813465E", "eie520");
        if ($db->connect_error) {
            die ("Connection failed: " . $db->connect_error);
        }

        
        $q = "SELECT recipe.recipe_id, recipe.title, recipe.instructions, recipe.avr_rating, recipe.date_posted, user.username, user.user_avatar FROM recipe LEFT JOIN user ON (recipe.user_id = user.user_id) ORDER BY recipe.date_posted DESC LIMIT 20";

        
        $r1 = $db->query($q);

        if(!$r1 || $r1->num_rows  == 0){
            echo "No rows";
        }
        else{
            $results = array();
    
            while ($row = $r1->fetch_assoc()) {
                $results[] = $row;
            }
    
        //TODO: after creating a query results array, encode it as JSON and echo it as the message
        // - encoding as JSON from PHP: https://www.php.net/manual/en/function.json-encode.php
        echo json_encode($results);
        }
    
            
    
    $db->close();
}
?>







