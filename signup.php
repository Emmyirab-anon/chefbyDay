<?php
$validate = true;
$error = "";
$uploaddir = 'uploads/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
$reg_email = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";
$reg_DOB = "/^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/";
$reg_pswd = "/^(\S*)?\d+(\S*)?$/";
$reg_myAv = "/^([a-zA-Z0-9\s_\\.\-:])+(.png|.jpg|.gif)$/";
$email = "";
$username = "";
$dob = "mm/dd/yyyy";
$avatar = "";

if (isset($_POST["submitted"]) && $_POST["submitted"]) {
    $email = trim($_POST["email"]);
    $username = trim($_POST["username"]);
    $dob = trim($_POST["DOB"]);
    $password = trim($_POST["password"]);
    $confPassword = trim($_POST["confPassword"]);
    $avatar = $_FILES["userfile"]["name"];
       
    $db = new mysqli("localhost", "eie520", "0813465E", "eie520");
    if ($db->connect_error) {
        die ("Connection failed: " . $db->connect_error);
    }
    
    $q1 = "SELECT * FROM user WHERE user_email = '$email' OR username = '$username";
    $r1 = $db->query($q1);

    // if the email address is already taken.
    if($r1->num_rows > 0) {
        $validate = false;

    } else {
        $emailMatch = preg_match($reg_email, $email);
        $emailLen = strlen($email);
        if($email == null || $email == "" || $emailMatch == false || $emailLen > 60) {
            $validate = false;
        }

        $usernameLen = strlen($username);
        if($username == null || $username == "" || $usernameLen < 6 || $usernameLen > 8) {
            $validate = false;
        }

        $bdayMatch = preg_match($reg_DOB, $dob);
        if($dob == null || $dob == "" || $bdayMatch == false) {
            $validate = false;
        }
              
        $pswdLen = strlen($password);
        $pswdMatch = preg_match($reg_pswd, $password);
        if($password == null || $password == "" || $pswdLen != 8 || $pswdMatch == false) {
            $validate = false;
        }

        if($confPassword == null || $confPassword == "" || $confPassword != $password) {
            $validate = false;
        }

        $avatarText = htmlspecialchars( basename($_FILES["userfile"]["name"]));
        $avatarMatch = preg_match($reg_myAv, $avatarText);
        if($avatarText == null || $avatarText == "" || $avatarMatch == false ){
            $validate = false;
        }
        if(move_uploaded_file($_FILES["userfile"]["temp_name"], $uploadfile) == false) {
            $validate = false;
        }
        
    }

    if($validate == true) {
        $dateFormat = date("d-M-Y", strtotime($dob));
        $ava = $uploaddir . $avatarText;

        $q2 = "INSERT INTO user (username, user_email, user_password, user_dob, user_avatar ) VALUES ('$username','$email', '$password', '$dateFormat', '$ava')";

        $r2 = $db->query($q2);
        
        if ($r2 === true) {
            header("Location: login.php");
            $db->close();
            exit();
        }

    } else {
        $error = "Signup failed.";
        $db->close();
    }

}

?>



<!DOCTYPE html>
<html>

<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="mystyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </link>
    <script type="text/javascript" src="validate.js"></script>
</head>

<body>

    <header class="myHeader">
        <h1>Chef by Day</h1>
    </header>

    <section class="signup">
        <img src="logo_form.png" width="100px" height="100px;" class="logo" alt="logo_chef" />
        <h1>SIGN UP</h1>
        <form id="idSIGNUP" enctype = "multipart/form-data" method="POST" action="">
            <label id="msg_email" class="err_msg"></label>
            <input type="text" name="email" placeholder="Enter Email" id="email" /> <br />

            <label id="msg_username" class="err_msg"></label>
            <input type="text" name="username" placeholder="Enter username" id="username" /> <br />

            <label id="msg_DOB" class="err_msg"></label>
            <input type="date" name="DOB" id="DOB" /> <br />

            <label id="msg_pswd" class="err_msg"></label>
            <input type="password" name="password" placeholder="Enter Password" id="password" /> <br />

            <label id="msg_pswdr" class="err_msg"></label>
            <input type="password" name="confPassword" placeholder="Confirm Password" id="confPassword" /> <br />

            <label id="msg_myAv" class="err_msg"></label>
            <input name = "userfile" type="file" src="#" alt="" id="userfile">

            <input type="submit" value="Create Account" name = "submitted">
        </form>
        <script type="text/javascript" src="signup-r.js"></script>
    </section>



</body>

</html>