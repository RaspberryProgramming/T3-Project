<?php

    $table = "T3_users";

    $r = mysqli_query($dbc, "SELECT * FROM $table");

    if ($r) 
    {
      $e = mysqli_query($dbc, "EXPLAIN $table");
      echo "<table border=1><tr>";

      while($explain = mysqli_fetch_array( $e, MYSQLI_NUM)){
          echo "<th> $explain[0] </th>";
      }

      echo "</tr>";      


      while ($row = mysqli_fetch_array( $r, MYSQLI_NUM)) {
          echo "<tr>";
          $length = count($row);
          for ($i=0; $i<$length; $i++){
          	echo "<td>$row[$i]</td>";
          }
          echo "</tr>";
      } 

      echo "</table>";
    }
    else {
        echo "<br>Database Error!!!";
    }
?>

