function eulaAgree() {
  document.getElementById("disclaimer-overlay").style.cssText =
    "visibility:hidden";

  localStorage.setItem("disclaimer", "true");
}

if (localStorage.getItem("disclaimer") == "true") {
  document.getElementById("disclaimer-overlay").style.cssText =
    "visibility:hidden";
}
