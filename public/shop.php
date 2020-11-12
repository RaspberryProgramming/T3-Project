<!--
  Hardware Online
  
  Authors: Fioti, Figueroa, Danyluk

  Version: 1.12

  We are located at 12345 Poughkeepsie Lane, Poughkeepsie New York 12550
  Phone Number: 845-666-6969
  Email: admin@hardwareonline.com
-->
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
    <link rel="stylesheet" href="/style.css" />

    <title>Hardware Online</title>
  </head>

  <body>
<?php
# Global Variable Definitions
define("FILE_AUTHOR", "Fioti, Figueroa, Danyluk");
define("FILE_VERSION", 1.13);

#Import code
require "connect_db.php"; # Connects to database and creates $dbc as database connection

if (strlen($_COOKIE["disclaimer"]) == 0 || $_COOKIE["disclaimer"]==False){
    echo "<div class=\"disclaimer-overlay\" id=\"disclaimer-overlay\">";
    include "disclaimer-code.php";
    echo "<button onclick=\"eulaAgree();\">I agree...</button></div>";
  }
require "nav.php"; # Imports the navbar
?>
<main style="padding:0;">
<?php 
/**************************************************************************
 * Trap errors - and display error message if we get one!
 **************************************************************************/
 set_error_handler("handleError");

 function handleError($errno, $errstr,$error_file,$error_line) {
      echo "<b>Error:</b> [$errno] $errstr - $error_file:$error_line";
      echo "<br />";
      echo "Terminating PHP Script";
      die();
   }
   
/**************************************************************************
 *  set up a display/error message; get the passed "id"
 **************************************************************************/
# Used to display errors at the end of execution if necessary
$display_message = "";

$table = "T3_products"; # Default table


if (isset($_GET["id"])){ # Checks whether id url argument was defined
    $id=$_GET["id"];# unique id of the entry that we want to delete
} 

if (!isset($id)){ # If id is not set, display a list of products

    if (isset($_POST["sort"])){ # Checks whether the user sent a POST with sort
        $sort = "ORDER BY " . $_POST["sort"]; # $sort stores the ORDER BY section of mysql query for selected sort column
    } else {
        $sort = "";
    }

    


    $r = mysqli_query($dbc, "SELECT * FROM $table WHERE active=1 $sort;"); # Query the table for it's entries

    if ($r) # If the query is successful
    {
                # Options class changes flex-direction so that we can have items side-by-side
        echo "<div class='options'>";

        echo "<div class='options-menu'>"; # Changes the flex-direction again so the options within the options menu are displayed correctly        
        
        $columns = ["product", "stock", "price"]; # Stores each column name
        

        echo "<form action='' method='POST'>"; # Form that sends POST to server
        echo "Sort by: ";
        echo "<select id='sort' name='sort' >"; # each column will be added to select
            
        for ($i=0; $i<count($columns); $i++){ # iterates through each column index
          # Column name is used to display and as value
          echo "<option value='$columns[$i]'>$columns[$i]</option>";
        }

        echo "</select> ";
        echo "<input type='hidden' name='table' value='$table'>"; # Hidden value to send table name in POST
        echo "<input type='submit' value='Submit' class='btn btn-info'>";
        echo "</form>";

        echo "</div>"; # End of options menu

        # Beggining of table Section
        echo "<div class='options-table'>";
        
        echo "<h1>Shop</h1>";

        echo "<table style='width:100%;'>";
        

        # Takes each row and prints each of it's elements in order
        while ($row = mysqli_fetch_array( $r, MYSQLI_NUM)) {
          echo "<tr>";
          echo "<td><a href='?id=$row[0]'>$row[3]</a></td><td>Stock: $row[4]</td><td>Price: $row[6]$</td>";
          echo "</tr>";

        } 

        echo "</table>";
    }
    else { # If there is an error with the initial query, display an error.
        echo "<br>Database Error!!!";
        echo "<li>" . mysqli_error($dbc)."</li>";
    }
    echo "</div>"; # end of options-table div
    echo "</div>"; # end of options div

} else if (isset($id)) { # if the user wants to view a specific product

   $q = "select * from T3_products WHERE productid=$id AND active=1"; # The query will searchs for the product
   $r = mysqli_query ($dbc,$q);
   
   // Check query return code  
   if ($r ) {
      $exists = FALSE; # Used to check whether the product was found
      while ($row = mysqli_fetch_array( $r, MYSQLI_NUM)) {
        $exists = TRUE;

        # Beggining of product page
        echo "<div style='width:80%;'>";
        echo "<h1>$row[3]</h1>"; # Product Name

        #Query for the product's supplier
        $q = "select * from T3_suppliers WHERE vendorid=$row[1] AND active=1"; 
        $v = mysqli_query ($dbc,$q);

        if($r){
          #Display the vendor name on the page
          while ($vendor = mysqli_fetch_array( $v, MYSQLI_NUM)) {
            echo "<p>Supplier: $vendor[1]</p>";
          }
        }

        if ($row[4] >= 1){ # If the product is in stock
          echo "<p><b style='color: green;'>In Stock</b></p>"; # Show that it is in stock
          echo "<p>Stock: $row[4]</p>"; # Stock Quantity
          echo "<a class='btn btn-success' href='purchase.php?id=$row[0]'>Buy Now: $$row[6]</a>"; # Show Buy Now Button
        } else {
          echo "<p><b style='color: red;'>Out Of Stock</b></p>"; # Display out of stock
        }
        echo "<br><p><b>Description:</b>$row[5]</p>"; # Display the description

      }
      if ($exists == FALSE){
        
        $display_message = "Product Does Not Exist"; # Error if the product is not found
        
      }
   }  	   
   else {     
       echo mysqli_error( $dbc ); # Display mysqli error if one occurs
   }
   

}

if ($display_message){
    echo "<b style='background-color: red;'>$display_message</b>";
}


// End of file 
 ?>

</main>
<?php

include "footer.php";

?>
    <!-- Place scripts at bottom of page so page renders faster -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="/script.js"></script>
</body>
</html>