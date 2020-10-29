<!--
  Hardware Online
  
  Authors: Fioti, Figueroa, Danyluk

  We are located at 12345 Poughkeepsie Lane, Poughkeepsie New York 12550
  Phone Number: 845-666-6969
  Email: admin@hardwareonline.com
-->
<?php
    define ("FILE_VERSION", "0.11");
    define ("FILE_AUTHOR", "Chris Danyluk");
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

<?php
    require "../connect_db.php";

    if (strlen($_COOKIE["disclaimer"]) == 0 || $_COOKIE["disclaimer"]==False){
        echo "<div class=\"disclaimer-overlay\" id=\"disclaimer-overlay\">";
        include "disclaimer-code.php";
        echo "<button onclick=\"eulaAgree();\">I agree...</button></div>";
    }

    include "nav.php";
    $table = "T3_suppliers";
    $q = "SELECT * FROM $table ;";
    $r = mysqli_query($dbc, $q);

    echo "<table border=1 style='margin-right: auto; margin-left: auto; margin-top: auto; margin-bottom: auto'> <tr> <th> ID </th> <th> Name </th> <th> Address </th> <th> Phone </th> </tr>";

    if ($r) {
        while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
            echo "<tr> <td> $row[0] </td> <td> $row[1] </td> <td> $row[2] </td> <td> $row[3] </td> </tr>";
        }
        echo "</table>";
    }
    else {
        echo "<br> Database Error!";
    }

    include "footer.php";
?>