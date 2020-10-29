function eulaAgree() {
  document.getElementById("disclaimer-overlay").style.cssText =
    "visibility:hidden";
  document.cookie = "disclaimer=True; max-age=2592000";
  localStorage.setItem("disclaimer", "true");
}
