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


    $rec = $_GET["rec"];

    $q = "SELECT * FROM recipe WHERE recipe_id = '$rec'";
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