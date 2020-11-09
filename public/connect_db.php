<!--
    Filename: connect_db.php - Connect to database with default user
    Important: THis file has out password so it must not be visible to users!

    V1.0 10/8/2020 At original Program
-->

<?php
$dbc=mysqli_connect('127.0.0.1:3306','mike','easysteps', 'site_db')
  OR die
  ( mysqli_connect_error());
?>