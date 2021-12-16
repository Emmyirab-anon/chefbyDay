<?php

$validate = true;
$reg_Pswd = "/^(\S*)?\d+(\S*)?$/";

$username = "";
$error = "";

if (isset($_POST["submitted"]) && $_POST["submitted"]) {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    
    $db = new mysqli("localhost", "eie520", "0813465E", "eie520");
    if ($db->connect_error) {
        die ("Connection failed: " . $db->connect_error);
    }

    
    $q = "SELECT * FROM user WHERE username = '$username' AND user_password = '$password'";
       
    $r = $db->query($q);
    $row = $r->fetch_assoc();
    if($username != $row["username"] && $password != $row["password"]) {
        $validate = false;

    } else {
        if($username == null || $username == "") {
            $validate = false;
        }
        
        $pswdLen = strlen($password);
        $passwordMatch = preg_match($reg_Pswd, $password);
        if($password == null || $password == "" || $pswdLen < 8 || $passwordMatch == false) {
            $validate = false;
        }
    }
    
    if($validate == true) {
        session_start();
        $_SESSION["username"] = $row["username"];
        header("Location: recipelist.php");
        $db->close();
        exit();

    } else {
        $error = "The email/password combination was incorrect. Login failed.";
        $db->close();
    }
}


?>


<!DOCTYPE html>
<html>

<head>
    <title>Log In</title>
    <link rel="stylesheet" href="mystyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="validate.js"></script>
    </link>
</head>

<body>

    <header class="myHeader">
        <h1>Chef by Day</h1>
    </header>

    <section class="login">
        <img src="logo_form.png" width="100px" height="100px;" class="logo" alt="logo_chef" />
        <h1>LOG IN</h1>
        <form id="idLog" method="POST" action="" enctype="multipart/form-data">
            <label id="msg_username" class="err_msg"></label>
            <input type="text" name="username" id="username" placeholder="Enter username" /> <br />

            <label id="msg_pswd" class="err_msg"></label>
            <input type="password" name="password" id="password" placeholder="Enter Password" /> <br />

            <input type="submit" value="Login" name = "submitted">
            <a href="signup.php">Create Account</a>
            <a href="#">Forgot password?</a>
        </form>
        <script type="text/javascript" src="login-r.js"></script>
    </section>



</body>

</html>