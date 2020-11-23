<!--
  Hardware Online

  Filename: connect_db.php

  Important: THis file has out password so it must not be visible to users!

  Authors:  Fioti, Figueroa, Danyluk

  Description: Creates database connection and gives a $dbc variable to interact with site_db

  Last Update: 11/21/2020

  Changelog:
    0.09: Created sql database
    0.17: Updated Prologue on all pages
  We are located at 12345 Poughkeepsie Lane, Poughkeepsie New York 12550
  Phone Number: 845-666-6969
  Email: admin@hardwareonline.com
-->

<?php
$dbc = mysqli_connect('127.0.0.1:3306', 'mike', 'easysteps', 'site_db')
or die(mysqli_connect_error());
?>
