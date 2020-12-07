<!--
  Hardware Online

  Filename: T3.php

  Authors:  Figueroa

  Description: index page of the website. Displays carousel with photos, navbar with a list of pages, and a footer.

  Last Update: 11/21/2020

  Changelog:
    0.01: Added T3.html
    0.02: Added navbar, and footer to T3.html
    0.03: Added Style to website
    0.05: Added Disclaimer popup, and disclaimer page
    0.06: Disabled Disclaimer popup
    0.07: Created the beginnings of the Login page and re-enabled disclaimer popup
    0.14: Added carousel to homepage and Table Editor to navbar
    0.17: Updated Prologue on all pages

  We are located at 12345 Poughkeepsie Lane, Poughkeepsie New York 12550
  Phone Number: 845-666-6969
  Email: admin@hardwareonline.com
-->
<?php
define("FILE_VERSION", "0.14");
define("FILE_AUTHOR", "Fioti, Figueroa, Danyluk");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no"
  />
  <meta name="Description" content=" Main webpage of Hardware Online" />
  <link
    rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
    crossorigin="anonymous"
  />
  <link rel="stylesheet" href="style.css" />

  <title>Hardware Online</title>
</head>

<body>
<?php
  if (strlen($_COOKIE["disclaimer"]) == 0 || $_COOKIE["disclaimer"] == false) {
      echo "<div class='disclaimer-overlay' id='disclaimer-overlay'>";
      require "disclaimer-code.php";
      echo "<button onclick='eulaAgree();'>I agree...</button></div>";
  }
  require "nav.php";
?>
<main>
<div id="carouselExampleIndicators" class="carousel slide"  data-interval="false" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="carousel-caption" style="display: table-cell; vertical-align: middle;">
        <img class="logo-large" src="logo.webp" alt="First slide">
        <div class="text">
          <h1>Hardware Online</h1>
          <p>America's Favorite Online Hardware Store</p>
        </div>
      </div>
      <img class="d-block w-100" src="slide-1.webp" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="slide-2.webp" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="slide-3.webp" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


</main>

<?php
  require "footer.php";
?>

<!-- Place scripts at bottom of page so page renders faster -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="script.js"></script>
</body>

</html>
