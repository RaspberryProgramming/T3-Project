<?php

    $table = "T3_users";

    $r = mysqli_query($dbc, "SELECT * FROM $table"); # Query the table for it's entries

    if ($r) 
    {
        # Explain the table to retreive the column names
        $e = mysqli_query($dbc, "EXPLAIN $table");

        echo "<table border=1><tr>";

        # Prints out each column name to the header tag for the table
        while($explain = mysqli_fetch_array( $e, MYSQLI_NUM)){
            echo "<th> $explain[0] </th>";
        }

        echo "</tr>";      

        # Takes each row and prints each of it's elements in order
        while ($row = mysqli_fetch_array( $r, MYSQLI_NUM)) {
            # Start the table row
            echo "<tr>";
            
            # Print each element of that row
            $length = count($row);
            for ($i=0; $i<$length; $i++){
                echo "<td>$row[$i]</td>";
            }
            echo "</tr>";
        } 

        echo "</table>";
    }
    else { # If there is an error with the initial query, display an error.
        echo "<br>Database Error!!!";
    }
?>

