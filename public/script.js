function eulaAgree() {
  /* Used to allow users to agree to disclaimer and store a cookie to prevent the disclaimer from coming back*/
  document.getElementById("disclaimer-overlay").style.cssText = // Hide the disclaimer
    "visibility:hidden";
  document.cookie += "disclaimer=True; max-age=2592000"; // Set the cookie to prevent the disclaimer from coming up again
}