<!--
  Hardware Online
  
  Authors: Fioti, Figueroa, Danyluk

  We are located at 12345 Poughkeepsie Lane, Poughkeepsie New York 12550
  Phone Number: 845-666-6969
  Email: admin@hardwareonline.com
-->
<?php
    $table = "T3_suppliers";
    $q = "SELECT * FROM $table ;";
    $r = mysqli_query($dbc, $q);

    echo "<table border=1 style='margin-right: auto; margin-left: auto; margin-top: auto; margin-bottom: auto'>
    <tr> <th> ID </th> <th> Name </th> <th> Address </th> <th> Phone </th> <th> Email </th> <th> ACTIVE? </th> </tr>";

    if ($r) {
        while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
            echo "<tr> <td> $row[0] </td> <td> $row[1] </td> <td> $row[2] </td> <td> $row[3] </td> <td> $row[4] </td> </tr>";
        }
        echo "</table>";
    }
    else {
        echo "<br> Database Error!";
    }
?>