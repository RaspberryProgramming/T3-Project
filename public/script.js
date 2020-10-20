function eulaAgree() {
  document.getElementById("disclaimer-overlay").style.cssText =
    "visibility:hidden";
  document.cookie = "disclaimer=True";
  localStorage.setItem("disclaimer", "true");
}
