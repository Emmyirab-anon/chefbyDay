function send_ajax_request() {
  //To make the previous average rating disappear
  [].forEach.call(document.querySelectorAll(".fkStar"), function (el) {
    el.style.visibility = "hidden";
  });

  // create a variable we need to send to our PHP file
  var num = document.getElementById("ratingUser").value;
  if (num > 5) {
    num = 5;
  }
  if (num < 0) {
    num = 0;
  }

  console.log(num);

  //create XMLHttpRequest object
  var xmlhttp = new XMLHttpRequest();

  // access the onreadystatechange event for the XMLHttpRequest object
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var display_Rating = document.getElementById("averageRating");

      var results = JSON.parse(this.responseText);

      display_Rating.innerHTML = "Average Rating: ";

      for (var i = 0; i < results; i++) {
        display_Rating.innerHTML += "<span class='fa fa-star checked'></span>";
      }

      for (var i = 0; i < 5 - results; i++) {
        display_Rating.innerHTML += "<span class='fa fa-star'></span>";
      }
    }
  };

  xmlhttp.open("GET", "rd.php?rate=" + num, true);

  //Do this to actually execute the either type of request
  xmlhttp.send();
} //send_ajax_request() function
