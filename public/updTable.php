<!--
  Hardware Online
  
  Authors: Fioti, Figueroa, Danyluk

  We are located at 12345 Poughkeepsie Lane, Poughkeepsie New York 12550
  Phone Number: 845-666-6969
  Email: admin@hardwareonline.com
-->
<?php
  define("FILE_VERSION", "0.11");
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
  require "connect_db.php";

  if (strlen($_COOKIE["disclaimer"]) == 0 || $_COOKIE["disclaimer"]==False){
    echo "<div class=\"disclaimer-overlay\" id=\"disclaimer-overlay\">";
    include "disclaimer-code.php";
    echo "<button onclick=\"eulaAgree();\">I agree...</button></div>";
  }
  include "nav.php";
    ?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        action_handler();
    }
    else {
        action();
    }

    function action() {
      echo "<br>Running our ACTION code"; 

      echo "<form action='updTable.php' method='POST'>";
      echo "<br> Print Name <input type='text' name='name'>";
      echo "<br> Artist <input type='text' name='artist'>";
      echo "<br> Price <input type='text' name='price'>";
      echo "<br> <input type='submit'>";
      echo "</form>";
    }

    function action_handler() { 	 
      $name = $_POST["name"];
      $artist = $_POST["artist"];
      $price = $_POST["price"];

      echo "<br>Running our ACTION HANDLER code";
      echo "<br> Name was entered: $name";
      echo "<br> Artist was entered: $artist";
      echo "<br> Price was entered: $price";

      require "../connect_db.php";
      $q = "INSERT INTO PRINTS (name, artist, price)"."VALUES('$name','$artist',$price) ;";
      $r = mysqli_query ($dbc,$q);

      if ($r) {
          echo "<br>Data inserted!";
      }
      else {
          echo "<li>".mysqli_error($dbc)."</li>";
      }
    }
?>