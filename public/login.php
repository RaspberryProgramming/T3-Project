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
    if (strlen($_COOKIE["disclaimer"]) == 0 || $_COOKIE["disclaimer"] == false) {
        echo "<div class='disclaimer-overlay' id='disclaimer-overlay'>";
        include "disclaimer-code.php";
        echo "<button onclick='eulaAgree();'>I agree...</button></div>";
    }
    include "connect_db.php";
    include "nav.php";
    ?>
    <main class="login">
      <h2>Login</h2>
      <?php
      session_start();

      if (isset($_POST['username'])) {
          $username = $_POST['username'];
      } elseif (isset($_COOKIE['username'])) {
          $username = $_COOKIE['username'];
      } else {
          $username = "";
      }

      if (isset($_POST['password'])) {
          $password = $_POST['password'];
      } else {
          $password = "";
      }

      if ($_SERVER['REQUEST_METHOD'] == "POST") {
          $query = "SELECT * FROM T3_users WHERE  username='$username' and BINARY pwHash='$password' and active='1';";

          $r = mysqli_query($dbc, $query); # Query the table for it's entries

          if ($r) {
              # userID | username     | pwHash   | hashType | rankID      | active | datechanged
              if (mysqli_num_rows($r) == 1) {
                  $_SESSION["login_status"] = "$row[4] $username is logged in.";
                  echo "<br> Successfully logged in";
                  echo "<br> <a href='T3.php' class='btn btn-secondary'>Back to homepage</a>";
              } else {
                  $display_message = "Error!! Please enter correct Username and Password";
              }
          } else {
              echo "Error with SQL query";
          }
      }

      if (isset($_SESSION["login_status"]) && $_SERVER['REQUEST_METHOD'] == "GET") {
          if (isset($_GET['logout'])) {
              unset($_SESSION["login_status"]);
              echo "<br> Successfully logged out";
              echo "<br> <a class='btn btn-secondary' href='T3.php'>Back to Home Page</a>";
          } else {
              echo "<br> Already Logged in";
              echo "<br> <a href='?logout=true' class='btn btn-secondary'>Logout</a>";
          }
      } elseif ($display_message != "" || $_SERVER['REQUEST_METHOD'] == "GET") {
          echo "<form action='$_SERVER[SCRIPT_NAME]' method='POST'>";
          echo "<ul class='login-list'>";
          echo "<li> <input type='text' name='username' value='$username' class='form-control' placeholder='Username'></li>";
          echo "<li> <input type='password' name='password' value='$password' class='form-control' placeholder='Password' ></li>";
          echo "<li> <input type='submit' value='Submit' class='btn btn-secondary'></li>";

          if ($display_message != "") {
              echo "<li> <p class='form-warning'>$display_message</p> </li>";
          }

          echo "</ul>";
          echo "</form>";
      }
      ?>
      <!--
      <h2>Login</h2>

      <p>Please enter your user name and password below</p>

      <ul class="login-list">
        <li><input name="username" type="text" placeholder="Username" /></li>
        <li><input name="password" type="text" placeholder="Password" /></li>
      </ul>-->
    </main>
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
