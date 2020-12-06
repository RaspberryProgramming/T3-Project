<!--
  Hardware Online

  Filename: shop.php

  Authors:  Figueroa

  Description: Displays products and product information. If products are clicked, a product page will be displayed.

  Last Update: 11/21/2020

  Changelog:
    0.13: Added shop to website with product page functionality.
    0.17: Updated Prologue on all pages

  We are located at 12345 Poughkeepsie Lane, Poughkeepsie New York 12550
  Phone Number: 845-666-6969
  Email: admin@hardwareonline.com
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="Description" content=" Main webpage of Hardware Online" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
  <link rel="stylesheet" href="/style.css" />

  <title>Hardware Online</title>
</head>

<body>
<?php
# Global Variable Definitions
define("FILE_AUTHOR", "Figueroa");
define("FILE_VERSION", 1.13);

#Import code
require "connect_db.php"; # Connects to database and creates $dbc as database connection

if (strlen($_COOKIE["disclaimer"]) == 0 || $_COOKIE["disclaimer"] == false) {
    echo "<div class='disclaimer-overlay' id='disclaimer-overlay'>";
    include "disclaimer-code.php";
    echo "<button onclick='eulaAgree();'>I agree...</button></div>";
}

require "nav.php"; # Imports the navbar
?>

<main style="padding:0;">
<?php
/**************************************************************************
 * Trap errors - and display error message if we get one!
 **************************************************************************/
set_error_handler("handleError");

function handleError($errno, $errstr, $error_file, $error_line)
{
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

if (isset($_GET["id"])) { # Checks whether id url argument was defined
$id = $_GET["id"]; # unique id of the entry that we want to delete
}

if (!isset($id)) { # If id is not set, display a list of products

    if (isset($_POST["sort"])) { # Checks whether the user sent a POST with sort
    $sort = "ORDER BY " . $_POST["sort"]; # $sort stores the ORDER BY section of mysql query for selected sort column
    } else {
        $sort = "";
    }

    $r = mysqli_query($dbc, "SELECT * FROM $table WHERE active=1 $sort;"); # Query the table for it's entries

    if ($r) { # If the query is successful
        # Options class changes flex-direction so that we can have items side-by-side
        echo "<div class='options'>";

        echo "<div class='options-menu'>"; # Changes the flex-direction again so the options within the options menu are displayed correctly

        $columns = ["product", "stock", "price"]; # Stores each column name

        echo "<form action='$_SERVER[REQUEST_URI]' method='POST'>"; # Form that sends POST to server
        echo "Sort by: ";
        echo "<select id='sort' name='sort' >"; # each column will be added to select

        for ($i = 0; $i < count($columns); $i++) { # iterates through each column index
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

        echo "<br><table class='shop-table'>";

        # Takes each row and prints each of it's elements in order
        while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
            echo "<tr>";

            echo "<td><a href='?id=$row[0]'><p>$row[3]</p><p><b>Stock:</b> $row[4]</p><p><b>Price:</b> $row[6]$</p></td>";
            echo "<td><svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-cart' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>";
            echo "<path fill-rule='evenodd' d='M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z'/>";
            echo "</svg></a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else { # If there is an error with the initial query, display an error.
        echo "<br>Database Error!!!";
        echo "<li>" . mysqli_error($dbc) . "</li>";
    }
    echo "</div>"; # end of options-table div
    echo "</div>"; # end of options div
} elseif (isset($id)) { # if the user wants to view a specific product

    $q = "select * from T3_products WHERE productid=$id AND active=1"; # The query will searchs for the product
    $r = mysqli_query($dbc, $q);

    // Check query return code
    if ($r) {
        $exists = false; # Used to check whether the product was found
        while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
            $exists = true;

            # Beggining of product page
            echo "<div style='width:80%;'>";
            echo "<h1>$row[3]</h1><br>"; # Product Name

            #Query for the product's supplier
            $q = "select * from T3_suppliers WHERE vendorid=$row[1] AND active=1";
            $v = mysqli_query($dbc, $q);

            if ($r) {
                #Display the vendor name on the page
                while ($vendor = mysqli_fetch_array($v, MYSQLI_NUM)) {
                    echo "<p>Supplier: $vendor[1]</p>";
                }
            }

            if ($row[4] >= 1) { # If the product is in stock
                echo "<p style='color: red;'>$$row[6]</p>";
                echo "<p><b style='color: green;'>In Stock</b></p>"; # Show that it is in stock
                echo "<p>Stock: $row[4]</p>"; # Stock Quantity
                echo "<a class='btn btn-success' href='purchase.php?id=$row[0]'>";
                echo "<svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-cart-plus' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>";
                echo "<path fill-rule='evenodd' d='M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z'/>";
                echo "<path fill-rule='evenodd' d='M8.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 .5-.5z'/>";
                echo "</svg>";
                echo " Buy Now</a>"; # Show Buy Now Button
            } else {
                echo "<p><b style='color: red;'>Out Of Stock</b></p>"; # Display out of stock
            }
            echo "<br><br><p><b>Description:</b><br>$row[5]</p>"; # Display the description
        }
        if ($exists == false) {
            $display_message = "Product Does Not Exist"; # Error if the product is not found
        }
    } else {
        echo mysqli_error($dbc); # Display mysqli error if one occurs
    }
}

if ($display_message) {
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
