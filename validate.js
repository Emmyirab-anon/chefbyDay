function LOGINFunc(event) {
  var valid = true;

  // TODO: Get field values for all form fields
  var elements = event.currentTarget;
  var username = elements[0]; //Email
  var pswd = elements[1]; //Password

  // javascript regular expressions (jre) to validate email, username and password
  // TODO: you may wish to change these to better match exercise requirements
  var regex_pswd = /^(\S*)?\d+(\S*)?$/;

  // Empty error message cells have been added to the table above the email,
  // username, password and confirm password fields styled with red text color
  // TODO: Get references to all error message cells and make sure they are empty before validating
  var msg_username = document.getElementById("msg_username");
  var msg_pswd = document.getElementById("msg_pswd");
  msg_username.innerHTML = "";
  msg_pswd.innerHTML = "";

  //Variables for DOM Manipulation commands
  var textNode;

  // if email is left empty or email format is wrong, add an error message to the matching cell.
  if (username.value == null || username.value == "") {
    textNode = document.createTextNode("Username is empty.");
    msg_username.appendChild(textNode);
    valid = false;
  } else if (username.value.length > 8 || username.value.length < 6) {
    textNode = document.createTextNode("Username must be between 6 - 8.");
    msg_username.appendChild(textNode);
    valid = false;
  }

  // TODO: add code to validate password - don't forget regex and length requirements
  if (pswd.value == null || pswd.value == "") {
    textNode = document.createTextNode("Password is empty");
    msg_pswd.appendChild(textNode);
    valid = false;
  } else if (regex_pswd.test(pswd.value) == false) {
    textNode = document.createTextNode(
      "Password is invalid. It must contain letters and atleast one number and no spaces"
    );
    msg_pswd.appendChild(textNode);
    valid = false;
  } else if (pswd.value.length < 8) {
    textNode = document.createTextNode("Password lenght must be 8 or more.");
    msg_pswd.appendChild(textNode);
    valid = false;
  }

  if (valid == false) {
    event.preventDefault(); // Normally, this is where this command should be

    // If the form is not valid, display an "Invalid Data Entered" message and set red text color
    textNode = document.createTextNode("Invalid Data Entered!");
    display_info.setAttribute("style", "color: red"); // Style Method 2: manipulate HTML attribute
    display_info.appendChild(textNode);
  }
}

function SIGNUPFunc(event) {
  // Prevent default event action.
  // Normally only called if a form does not validate. We put it here so you can
  // see the feedback in the display_info div when the page validates.
  // For a submitted form the default action is to send form data to the URI in the
  // form's action="" attribute. If a form has no action, the page will reload,
  // clearing the form and removing any DOM modified elements.

  //Assume the form is valid; set to false if any validation tests fail.
  var valid = true;

  // TODO: Get field values for all form fields
  var elements = event.currentTarget;
  var email = elements[0]; //Email
  var username = elements[1]; //username
  var DOB = elements[2]; //DOB
  var pswd = elements[3]; //Password
  var pswdr = elements[4]; //Confirm Password
  var myAv = elements[5]; //Avatar
  console.log(myAv.value);

  // javascript regular expressions (jre) to validate email, username and password
  // TODO: you may wish to change these to better match exercise requirements
  var regex_email = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
  var regex_DOB = /^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/;
  var regex_pswd = /^(\S*)?\d+(\S*)?$/;
  var regex_myAv = /^([a-zA-Z0-9\s_\\.\-:])+(.png|.jpg|.gif)$/;

  // Empty error message cells have been added to the table above the email,
  // username, password and confirm password fields styled with red text color
  // TODO: Get references to all error message cells and make sure they are empty before validating
  var msg_email = document.getElementById("msg_email");
  var msg_username = document.getElementById("msg_username");
  var msg_DOB = document.getElementById("msg_DOB");
  var msg_pswd = document.getElementById("msg_pswd");
  var msg_pswdr = document.getElementById("msg_pswdr");
  var msg_myAv = document.getElementById("msg_myAv");
  msg_email.innerHTML = "";
  msg_username.innerHTML = "";
  msg_DOB.innerHTML = "";
  msg_pswd.innerHTML = "";
  msg_pswdr.innerHTML = "";
  msg_myAv.innerHTML = "";

  //Variables for DOM Manipulation commands
  var textNode;

  // if email is left empty or email format is wrong, add an error message to the matching cell.
  if (email.value == null || email.value == "") {
    textNode = document.createTextNode("Email address empty.");
    msg_email.appendChild(textNode);
    valid = false;
  } else if (regex_email.test(email.value) == false) {
    textNode = document.createTextNode(
      "Email address wrong format. example: username@somewhere.sth"
    );
    msg_email.appendChild(textNode);
    valid = false;
  } else if (email.value.length > 60) {
    textNode = document.createTextNode(
      "Email address too long. Maximum is 60 characters."
    );
    msg_email.appendChild(textNode);
    valid = false;
  }

  //Code for username
  if (username.value == null || username.value == "") {
    textNode = document.createTextNode("Username is empty.");
    msg_username.appendChild(textNode);
    valid = false;
  } else if (username.value.length > 8 || username.value.length < 6) {
    textNode = document.createTextNode(
      "Username must be 6 to 8 characters long."
    );
    msg_username.appendChild(textNode);
    valid = false;
  }

  //Code to complete validation of username
  if (DOB.value == null || DOB.value == "") {
    textNode = document.createTextNode("Date of birth is empty.");
    msg_DOB.appendChild(textNode);
    valid = false;
  } else if (regex_DOB.test(DOB.value) == false) {
    textNode = document.createTextNode(
      "DOB is invalid. Be Sure it is the right format YYYY-MM-DD"
    );
    msg_DOB.appendChild(textNode);
    valid = false;
  }

  //Code to validate password - don't forget regex and length requirements
  if (pswd.value == null || pswd.value == "") {
    textNode = document.createTextNode("Password is empty");
    msg_pswd.appendChild(textNode);
    valid = false;
  } else if (regex_pswd.test(pswd.value) == false) {
    textNode = document.createTextNode(
      "Password is invalid. It must contain letters and atleast non-letter"
    );
    msg_pswd.appendChild(textNode);
    valid = false;
  } else if (pswd.value.length != 8) {
    textNode = document.createTextNode("Password lenght must be 8.");
    msg_pswd.appendChild(textNode);
    valid = false;
  }

  //Code to confirm password - must match password
  if (pswdr.value == null || pswdr.value == "") {
    textNode = document.createTextNode("Password is empty");
    msg_pswdr.appendChild(textNode);
    valid = false;
  } else if (pswdr.value != pswd.value) {
    textNode = document.createTextNode(
      "Password and Passowrd confirmation do not match "
    );
    msg_pswdr.appendChild(textNode);
    valid = false;
  }

  //Code to validate avatar
  if (myAv.value == null || myAv.value == "") {
    textNode = document.createTextNode("Avatar is empty");
    msg_myAv.appendChild(textNode);
    valid = false;
  } else if (regex_myAv.test(myAv.value) == false) {
    textNode = document.createTextNode(
      "Avatar is invalid. It must be a .gif, .jpg or .png"
    );
    msg_myAv.appendChild(textNode);
    valid = false;
  }

  if (valid == false) {
    event.preventDefault(); // Normally, this is where this command should be

    // If the form is not valid, display an "Invalid Data Entered" message and set red text color
    textNode = document.createTextNode("Invalid Data Entered!");
    display_info.setAttribute("style", "color: red"); // Style Method 2: manipulate HTML attribute
    display_info.appendChild(textNode);
  }
}

function POSTRECIPEFunc(event) {
  // Prevent default event action.
  // Normally only called if a form does not validate. We put it here so you can
  // see the feedback in the display_info div when the page validates.
  // For a submitted form the default action is to send form data to the URI in the
  // form's action="" attribute. If a form has no action, the page will reload,
  // clearing the form and removing any DOM modified elements.

  //Assume the form is valid; set to false if any validation tests fail.
  var valid = true;

  // TODO: Get field values for all form fields
  var elements = event.currentTarget;
  var title = elements[0];
  var ingredients = elements[1];
  var instructions = elements[2];

  // Empty error message cells have been added to the table above the email,
  // username, password and confirm password fields styled with red text color
  // TODO: Get references to all error message cells and make sure they are empty before validating
  var msg_title = document.getElementById("msg_title");
  var msg_ingredients = document.getElementById("msg_ingredients");
  var msg_instructions = document.getElementById("msg_instructions");

  msg_title.innerHTML = "";
  msg_ingredients.innerHTML = "";
  msg_instructions.innerHTML = "";

  //Variables for DOM Manipulation commands
  var textNode;

  // if email is left empty or email format is wrong, add an error message to the matching cell.
  if (title.value == null || title.value == "") {
    textNode = document.createTextNode("Title is empty.");
    msg_title.appendChild(textNode);
    valid = false;
  } else if (title.value.length > 50) {
    textNode = document.createTextNode(
      "Title is too long. Maximum is 50 characters."
    );
    msg_title.appendChild(textNode);
    valid = false;
  }

  if (ingredients.value == null || ingredients.value == "") {
    textNode = document.createTextNode("Ingredients is empty.");
    msg_ingredients.appendChild(textNode);
    valid = false;
  }

  if (instructions.value == null || instructions.value == "") {
    textNode = document.createTextNode("Instructions is empty.");
    msg_instructions.appendChild(textNode);
    valid = false;
  }

  if (valid == false) {
    event.preventDefault(); // Normally, this is where this command should be

    // If the form is not valid, display an "Invalid Data Entered" message and set red text color
    textNode = document.createTextNode("Invalid Data Entered!");
    display_info.setAttribute("style", "color: red"); // Style Method 2: manipulate HTML attribute
    display_info.appendChild(textNode);
  }
}

function titleCharCount(event) {
  var elements = event.currentTarget;
  var title = elements[0];

  var msg_count = document.getElementById("count");
  msg_count.innerHTML = "";

  var textNode = document.createTextNode(title.value.length);

  if (title.value.length <= 50) {
    msg_count.append("Currecnt count: ");
    msg_count.append(textNode);
    var brk = document.createElement("br");
    msg_count.append(brk);
    var x = 50 - title.value.length;
    msg_count.append("You have " + x + " characters left");
  } else {
    msg_count.append("Characters exceeded. Max is 50");
    var brk = document.createElement("br");
    msg_count.append(brk);
  }
}

function increaseRating(event) {
  event.preventDefault();
  var x = document.getElementById("ratingUser").value;
  if (x == 5) {
    document.getElementById("incRating").disabled = true;
  } else {
    document.getElementById("decRating").disabled = false;
    document.getElementById("ratingUser").value++;
  }
}

function decreaseRating(event) {
  event.preventDefault();
  var x = document.getElementById("ratingUser").value;
  if (x == 0) {
    document.getElementById("decRating").disabled = true;
  } else {
    document.getElementById("incRating").disabled = false;
    document.getElementById("ratingUser").value--;
  }
}
