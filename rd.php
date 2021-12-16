<?php
    session_start();
	//TODO: Create a connection to your database using a mysqli object
	// - notice we are using object oriented style
	// - see example 1 here: https://www.php.net/manual/en/mysqli.construct.php
	// - see also lab 11: https://www.cs.uregina.ca/Links/class-info/215/php_mysql/index.html#dbconnection
	$db = new mysqli("localhost","eie520", "0813465E", "eie520");
	
	if ($db -> connect_error) {
	   die ("Connection failed: " . $db -> connect_error);
	}


	$rating = $_GET["rate"];
    $recId = $_SESSION["ID"];
    $uname = $_SESSION["username"];

    $q = "SELECT user_id FROM user WHERE user.username = '$uname'";

    $result = $db->query($q);
    while ($row = $result->fetch_assoc()) {
        $userId = $row["user_id"];
    }

    $s = "SELECT * FROM rating WHERE recipe_id = '$recId' and user_id = '$userId'";
    $r = $db->query($s);
    if($r->num_rows > 0)
        $q = "UPDATE rating SET rating_value = '$rating%' WHERE recipe_id = '$recId' AND user_id = '$userId'";

    else 
        $q = "INSERT INTO rating (recipe_id, user_id, rating_value) VALUES ('$recId','$userId','$rating%')";
   
    $r = $db->query($q);

    $p = "UPDATE recipe SET avr_rating = (SELECT FORMAT(AVG(rating_value),0) FROM rating WHERE recipe_id = '$recId') WHERE recipe_id = '$recId'"; 
    $z = $db->query($p);



    $q = "SELECT recipe.avr_rating FROM recipe WHERE recipe.recipe_id = '$recId%'";
    $r1 = $db->query($q);

    if(!$r1 || $r1->num_rows  == 0){
        echo "No rows";
    }
    else{
        $results;

        while ($row = $r1->fetch_assoc()) {
            $results = $row["avr_rating"];
        }

	//TODO: after creating a query results array, encode it as JSON and echo it as the message
	// - encoding as JSON from PHP: https://www.php.net/manual/en/function.json-encode.php
    echo json_encode($results);
	}


	$db->close();
?>