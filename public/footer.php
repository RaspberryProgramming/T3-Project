<!--
  Hardware Online

  Filename: footer.php

  Authors:  Fioti, Figueroa, Danyluk

  Description: Contains all footer text that is needed in every page

  Last Update: 11/21/2020

  Changelog:
    0.02: Added navbar, and footer to T3.html
    0.03: Added Style to website
    0.11: Added header and footer files, and included them in every page.
    0.17: Updated Prologue on all pages

  We are located at 12345 Poughkeepsie Lane, Poughkeepsie New York 12550
  Phone Number: 845-666-6969
  Email: admin@hardwareonline.com
-->

<footer>

        <div class="links">
        <p>
          Email:
          <a href="mailto:admin@hardwareonline.com">admin@hardwareonline.com</a>
        </p>
          |
        <a href="/changelog.php">Changelog</a>
          |
        <a href="/disclaimer.php">Disclaimer</a>

        </div>
      <p>(C) 2020
      <?php echo FILE_AUTHOR; ?>
      All Rights Reserved</p>
      <?php
echo "<p>Version: <a href='/changelog.php'>" . FILE_VERSION . "</a></p>";
?>
</footer>
