document
  .getElementById("incRating")
  .addEventListener("click", increaseRating, false);

document
  .getElementById("decRating")
  .addEventListener("click", decreaseRating, false);

var rating = document.getElementById("rateSubmit");
rating.addEventListener("click", send_ajax_request, false);
