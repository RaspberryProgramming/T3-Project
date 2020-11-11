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
    $table = "T3_users";

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        action_handler();
    }
    else {
        action();
    }

    function action() {
      echo "<form action='updTable.php' method='POST'>";
      echo "<br> UserName <input type='text' name='username'>";
      echo "<br> Password Hash <input type='text' name='pwhash'>";
      echo "<br> Hash Type <input type='text' name='hashtype'>";
      echo "<br> Rank ID <input type='text' name='rankid'>";
      echo "<br> <input type='submit'>";
      echo "</form>";
    }

    function action_handler() { 	 
      $username = $_POST["username"];
      $pwHash = $_POST["pwhash"];
      $hashType = $_POST["hashtype"];
      $rankID = $_POST["rankid"];

      $q = "INSERT INTO $table (username, pwHash, hashType, rankID)"."VALUES('$username', '$pwHash', $hashType, '$rankID') ;";
      $r = mysqli_query ($dbc,$q);

      if ($r) {
          echo "<br>Data successfully inserted!";
      }
      else {
          echo "<li>".mysqli_error($dbc)."</li>";
      }
    }
?>

<?php
    include "footer.php";
?>

    <!-- Place scripts at bottom of page so page renders faster -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>

</html>