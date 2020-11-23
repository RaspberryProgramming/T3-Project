<!--
  Hardware Online

  Filename: login.php

  Authors: Figueroa

  Description: Login page to allow users to access locked functions on the website

  Last Update: 11/21/2020

  Changelog:
    0.02: Added navbar, and footer to T3.html
    0.03: Added Style to website
    0.11: Added header and footer files, and included them in every page.
    0.14: Added carousel to homepage and Table Editor to navbar
    0.16: Added login functionality

  We are located at 12345 Poughkeepsie Lane, Poughkeepsie New York 12550
  Phone Number: 845-666-6969
  Email: admin@hardwareonline.com
-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/T3.php"><img class="mini-logo" src="/logo.webp"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/T3.php">
          Home
          <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/shop.php">Shop</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/tables.php">Table Editor</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/admin.php">Admin</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/aboutus.php">About Us</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto" style="left:0">
      <?php
      session_start(); # Open the session

      if (isset($_SESSION["login_status"])) {
          # If there is an active login session output a login dropdown menu
          echo "<li class='nav-item dropdown dropleft'>";
          echo "<a class='nav-link dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>";
          echo "<svg width='2em' height='2em' viewBox='0 0 16 16' class='bi bi-person-square' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>";
          echo "<path fill-rule='evenodd' d='M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z'/>";
          echo "<path fill-rule='evenodd' d='M2 15v-1c0-1 1-4 6-4s6 3 6 4v1H2zm6-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z'/>";
          echo "</svg>";
          echo "</a>";
          echo "<div class='dropdown-menu'>";
          echo "<a class='dropdown-item'>$_SESSION[login_status]</a>";
          echo "<div class='dropdown-divider'></div>";

          if ($_SESSION["rankid"] == "Admin") {
              echo "<a class='dropdown-item' href='admin.php'>Admin Panel</a>";
          }
          
          echo "<a class='dropdown-item' href='login.php?logout=true'>Logout";
          echo "<svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-box-arrow-in-right' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>";
          echo "<path fill-rule='evenodd' d='M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z'/>";
          echo "<path fill-rule='evenodd' d='M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z'/>";
          echo "</svg>";
          echo "</a>";
          echo "</div>";
          echo "</li>";
      } else {
          # Output a login button if there isn't an active login session
          echo "<li class='nav-item'>";
          echo "<a class='nav-link' href='/login.php'>Login</a>";
          echo "</li>";
      }
      ?>
    </ul>
  </div>
</nav>
