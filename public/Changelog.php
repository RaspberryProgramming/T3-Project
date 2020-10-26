<!--
  Hardware Online
  
  Authors: Fioti, Figueroa, Danyluk

  We are located at 12345 Poughkeepsie Lane, Poughkeepsie New York 12550
  Phone Number: 845-666-6969
  Email: admin@hardwareonline.com
-->
<?php
  #PHP Constants
  define("FILE_VERSION", "1.0");
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
            if (strlen($_COOKIE["disclaimer"]) == 0 || $_COOKIE["disclaimer"]==False){
              echo "<div class=\"disclaimer-overlay\" id=\"disclaimer-overlay\">";
              include "disclaimer-code.php";
              echo "<button onclick=\"eulaAgree();\">I agree...</button></div>";
            }
            include "nav.php";
      ?>
    <main>
      <h1 style="margin-left: 10px">Changelog</h1>
      <table class="changelog" style="width: 80%">
        <tr>
          <th style="width: 80px">Version</th>
          <th>Changes</th>
        </tr>
        <tr>
          <td>V0.01</td>
          <td>Added T3.html</td>
        </tr>
        <tr>
          <td>V0.02</td>
          <td>Added navbar, and footer to T3.html</td>
        </tr>
        <tr>
          <td>V0.03</td>
          <td>Added Style to website</td>
        </tr>
        <tr>
          <td>V0.04</td>
          <td>Added Changelog webpage with style</td>
        </tr>
        <tr>
          <td>V0.05</td>
          <td>Added Disclaimer popup, and disclaimer page</td>
        </tr>
        <tr>
          <td>V0.06</td>
          <td>Disabled disclaimer popup</td>
        </tr>
        <tr>
          <td>V0.07</td>
          <td>Created the beginnings of the Login page</td>
        </tr>
        <tr>
          <td>V0.08</td>
          <td>
            Created the About Us Page, and filled it out to share our story
          </td>
        </tr>
        <tr>
          <td>V0.09</td>
          <td>
            Created sql database
          </td>
        </tr>
      </table>
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
