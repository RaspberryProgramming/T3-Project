<!--
  Hardware Online

  Filename: login.php

  Authors: Figueroa

  Description: Login page to allow users to access locked functions on the website

  Last Update: 11/21/2020

  Changelog:
    0.07: Created the beginnings of the Login page and re-enabled disclaimer popup
    0.11: Added header and footer files, and included them in every page.
    0.16: Added login functionality
    0.17: Updated Prologue on all pages
  We are located at 12345 Poughkeepsie Lane, Poughkeepsie New York 12550
  Phone Number: 845-666-6969
  Email: admin@hardwareonline.com
-->
<?php
# Constants used throughout the page such as in the footer
define("FILE_VERSION", "0.16");
define("FILE_AUTHOR", "Figueroa");
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
    require "../connect_db.php"; # Connects to the database and gives us a $dbc connection variable
    require "nav.php"; # RUns all nav.php code and displays the compiled navbar to the top of the window
    ?>

    <main class="login">
      <h2>Login</h2>
      <?php
      session_start(); # Starts the session for the client

      if (isset($_POST['username'])) { # If a username was sent in a POST save it to a variable
          $username = $_POST['username'];
      } elseif (isset($_COOKIE['username'])) { # If the username is stored in a cookie save it to a variable
          $username = $_COOKIE['username'];
      } else { # Default the username variable to be empty
          $username = "";
      }

      if (isset($_POST['password'])) { # If the password was sent in a POST save it to a variable
          $password = $_POST['password'];
      } else { # Default the password variable to be empty
          $password = "";
      }

      if ($_SERVER['REQUEST_METHOD'] == "POST") { # If a POST was sent, attempt to log user in
          $query = "SELECT * FROM T3_users WHERE  username='$username' and BINARY pwHash='$password' and active='1';"; # Search T3_users for active users with username+password combination

          $r = mysqli_query($dbc, $query); # Query the table for it's entries

          if ($r) { # if the query went successfully check for found entries
              if (mysqli_num_rows($r) == 1) { # If there was a user with the combination,
                  while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) { # iterate over each column
                    $_SESSION["login_status"] = "$row[1] is logged in."; # Set the login_status session variable
                    $_SESSION["username"] = $row[1];
                      $_SESSION["rankid"] = $row[4];
                  }
                  echo "<br> Successfully logged in"; # Display sucess message and a button to bring the user back to the homepage
                  echo "<br> <a href='T3.php' class='btn btn-secondary'>Back to homepage</a>";
              } else {
                  $display_message = "Error!! Please enter correct Username and Password"; # Set $display_message to signify that there was an issue with the provided login combination
              }
          } else {
              $display_message = "[Fatal] Error with SQL query"; # Display an error
          }
      }

      if (isset($_SESSION["login_status"]) && $_SERVER['REQUEST_METHOD'] == "GET") { # If the user is already logged in, and has sent a GET Request
          if (isset($_GET['logout'])) { # If they have clicked a logout button in navbar or login/logout page
              # unset login_status session variable to signify the user is logged out
              unset($_SESSION["login_status"]);
              # unset username and rankid Session variables to block access to restricted functionality
              unset($_SESSION["username"]);
              unset($_SESSION["rankid"]);

              echo "<br> Successfully logged out"; # Display logout message and button to bring user back to homepage
              echo "<br> <a class='btn btn-secondary' href='T3.php'>Back to Home Page</a>";
          } else { # If the user hasn't clicked any buttons to logout,
              echo "<br> Already Logged in";
              echo "<br> <a href='?logout=true' class='btn btn-secondary'>Logout</a>";
          }
      } elseif ($display_message != "" || $_SERVER['REQUEST_METHOD'] == "GET") {
          # if there is a message in $display_message or GET request from a client that is not logged in

          echo "<form action='$_SERVER[SCRIPT_NAME]' method='POST'>"; # Display Login Form
          echo "<ul class='login-list'>";
          echo "<li> <input type='text' name='username' value='$username' class='form-control' placeholder='Username'></li>";
          echo "<li> <input type='password' name='password' value='$password' class='form-control' placeholder='Password' ></li>";
          echo "<li> <input type='submit' value='Submit' class='btn btn-secondary'></li>";
          echo "</ul>";
          echo "</form>";


          if ($display_message != "") { # If there is a display message
              echo "<p class='form-warning'>$display_message</p>"; # Add to the end of the form in red
          }
      }
      ?>
    </main>
    <?php
    # Footer is included and displayed at the bottom of the page
    require "footer.php";
    ?>

    <!-- Place scripts at bottom of page so page renders faster -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="script.js"></script>
  </body>

</html>
