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
    <tr> <th> ID </th> <th> Name </th> <th> Address </th> <th> Phone </th> <th> Email </th> <th> Active </th> </tr>";

    if ($r) {
        # Takes each row and prints each of it's elements in order
        while ($row = mysqli_fetch_array( $r, MYSQLI_NUM)) {
            # Start the table row
            echo "<tr>";
            
            # Print each element of that row
            $length = count($row) + 1;
            for ($i=0; $i<$length; $i++){
                echo "<td>$row[$i]</td>";
            }
            echo "</tr>";
        } 

        echo "</table>";
    }
    else {
        echo "<br> Database Error!";
    }
?>