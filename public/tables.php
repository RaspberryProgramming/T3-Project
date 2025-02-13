<!--
  Hardware Online

  Filename: tables.php

  Authors:  Fioti, Figueroa, Danyluk

  Description: Table editor with edit, delete and add functionality for all database tables.

  Last Update: 11/21/2020

  Changelog:
    0.12: Added admin page with table editor Figueroa
    0.15: Added edit functionality to Table Editor Figueroa
    0.17: Updated Prologue on all pages Figueroa
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
  <link rel="stylesheet" href="style.css" />

  <title>Hardware Online</title>
</head>

<body>
<?php
# Global Variable Definitions
define("FILE_AUTHOR", "Fioti, Figueroa, Danyluk");
define("FILE_VERSION", 1.15);

#Import code
require "../connect_db.php"; # Connects to database and creates $dbc as database connection

if (strlen($_COOKIE["disclaimer"]) == 0 || $_COOKIE["disclaimer"] == false) {
    echo "<div class='disclaimer-overlay' id='disclaimer-overlay'>";
    require "disclaimer-code.php";
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

# stores a translation from table to displayed name when echoing table name
$dispTableNames = array("T3_users" => "Users", "T3_products" => "Products", "T3_suppliers" => "Suppliers");
$identifiers = array("T3_users" => "userID", "T3_products" => "productID", "T3_suppliers" => "vendorID");
$script = $_SERVER['SCRIPT_NAME'];

if (isset($_GET["id"])) { # Checks whether id url argument was defined
    $id = $_GET["id"]; # unique id of the entry that we want to delete

    if (isset($_GET["table"]) && isset($dispTableNames[$_GET["table"]])) { # If table is also set, this signifies that the user is requesting to delete a file
        $table = $_GET["table"]; # Stores the table that the entry we want to delete is in
    } elseif (isset($_GET["edit"]) && isset($dispTableNames[$_GET["edit"]])) { # If edit is also set, this signifies that the user wants to edit the id entry

        $identifier = $identifiers[$_GET["edit"]];

        $q = "SELECT * FROM $_GET[edit] WHERE $identifier = '$id';";
        $r = mysqli_query($dbc, $q); # Query the table for it's entries

        if (mysqli_num_rows($r) > 0) {
            $edit = $_GET["edit"];
        } else {
            $display_message = "Missing Entry!!!";
        }
    } else {
        # The webpage is not designed to only have id url argument
        $display_message = "Missing table!!!";
    }
} elseif (isset($_GET["add"]) && isset($dispTableNames[$_GET["add"]])) { # If add url argument is set, this signifies that the user wants to add a new entry
  $add = $_GET["add"]; # add variable stores the table name that we want to change
} elseif (isset($_GET["add"])) {
    # The webpage is not designed to only have id url argument
    $display_message = "Missing table!!!";
}

/**************************************************************************
 *  Delete Function of webpage
 **************************************************************************/
if (isset($table) && isset($id)) { # if the user wants to delete a column
# $identifiers is used to match tables with their primary key identifier
    $q = "UPDATE $table SET active=0 WHERE $identifiers[$table]=$id"; # The query will update the active column for the row to 0
    $r = mysqli_query($dbc, $q);

    // Check query return code
    if ($r) {
        echo "<div style='background-color:gray; color: white; margin:0;' class='options-table'>Item deleted!</div>";
    } else {
        echo mysqli_error($dbc); # Display mysqli error if one occurs
    }
}

/**************************************************************************
 *  Displays table and table functions
 **************************************************************************/

if (!isset($add) && !isset($edit) && $display_message == "") { # If neither id or add were defined, then the table will be displayed

    if (isset($_POST["sort"])) { # Checks whether the user sent a POST with sort
        $sort = "ORDER BY " . $_POST["sort"]; # $sort stores the ORDER BY section of mysql query for selected sort column
    } else {
        $sort = "";
    }

    if (isset($_POST["filter"])) { # Checks whether the # The webpage is not designed to only have id url argument
        if ($_POST["filter"] == "Y") {
            $filter = "WHERE active = 1"; # $sort stores the ORDER BY section of mysql query for selected sort column
        } elseif ($_POST["filter"] == "N") {
            $filter = "WHERE active='0'";
        } else {
            $filter = "";
        }
    } else {
        $filter = "WHERE active=1";
    }

    if (isset($table)) {
    } elseif (isset($_POST["table"])) { # Checks whether the user sent a POST with table
        $table = $_POST["table"]; # stores table that will be displayed
    } else {
        $table = "T3_products"; # Default table
    }

    $q = "SELECT * FROM $table $filter $sort;";
    $r = mysqli_query($dbc, $q); # Query the table for it's entries

    if ($r) { # If the query is successful
        # Options class changes flex-direction so that we can have items side-by-side
        echo "<div class='options'>";

        echo "<div class='options-menu'>"; # Changes the flex-direction again so the options within the options menu are displayed correctly

        echo "<form action='$script' method='POST'>";
        echo "<label style='color: white;'>Table:</label>";
        echo "<select id='table' name='table' >";
        if (isset($table) && $table == "T3_products") {
            echo "<option value='T3_products' selected>Products</option>";
        } else {
            echo "<option value='T3_products'>Products</option>";
        }
        if (isset($table) && $table == "T3_suppliers") {
            echo "<option value='T3_suppliers' selected>Vendors</option>";
        } else {
            echo "<option value='T3_suppliers'>Vendors</option>";
        }
        if (isset($table) && $table == "T3_users") {
            echo "<option value='T3_users' selected>Users</option>";
        } else {
            echo "<option value='T3_users'>Users</option>";
        }
        echo "</select>";
        echo "<input type='submit' value='Submit' class='btn btn-info'>";
        echo "</form>";

        # Explain the table to retreive the column names
        $e = mysqli_query($dbc, "EXPLAIN $table"); # Querys table in order to retreive list of columns

        $columns = []; # Stores each column name

        while ($explain = mysqli_fetch_array($e, MYSQLI_NUM)) { # iterate over each column
          array_push($columns, $explain[0]); # appends the column name to the end of $columns
        }

        echo "<form action='$script' method='POST'>"; # Form that sends POST to server
        echo "<label style='color: white;'>Sort By:</label>";
        echo "<select id='sort' name='sort' >"; # each column will be added to select

        for ($i = 0; $i < count($columns); $i++) { # iterates through each column index
          if ($columns[$i] != "active") { # If the column says active it will be removed
            if (isset($_POST["sort"]) && $columns[$i] == $_POST["sort"]) {
                echo "<option value='$columns[$i]' selected>$columns[$i]</option>"; # Column name is used to display and as value
            } else {
                echo "<option value='$columns[$i]'>$columns[$i]</option>"; # Column name is used to display and as value
            }
          }
        }

        echo "</select> ";
        # Used to signify filter for table
        echo "<label style='color: white;'>Filter:</label>";
        echo "<select id='filter' name='filter' >";
        if (isset($_POST["filter"]) && $_POST["filter"] == "Y") {
            echo "<option value='Y' selected>Show Active</option>";
        } else {
            echo "<option value='Y'>Show Active</option>";
        }
        if (isset($_POST["filter"]) && $_POST["filter"] == "N") {
            echo "<option value='N' selected>Show Inactive</option>";
        } else {
            echo "<option value='N'>Show Inactive</option>";
        }
        if (isset($_POST["filter"]) && $_POST["filter"] == "A") {
            echo "<option value='A' selected>Show All</option>";
        } else {
            echo "<option value='A'>Show All</option>";
        }
        echo "</select>";
        echo "<input type='hidden' name='table' value='$table'>"; # Hidden value to send table name in POST
        echo "<input type='submit' value='Submit' class='btn btn-info'>";
        echo "</form>";

        #Redirects to Add item form
        echo "<a href='?add=$table' class='btn btn-success'>Add Item</a>";

        echo "</div>"; # End of options menu

        # Beggining of table Section
        echo "<div class='options-table'>";

        echo "<h1>$dispTableNames[$table] Table</h1>";

        echo "<table border=1><tr>";

        $col = $found = 0; # $col and $found are used to ensure that active column is displayed as DELETE to allow for column deletion

        # Prints out each column name to the header tag for the table
        for ($i = 0; $i < count($columns); $i++) {
            if ($columns[$i] != "active") { # Removes active column so it can be added at the end
                $colname = ucfirst($columns[$i]);
                echo "<th> $colname </th>"; # column name is added to table header
              if ($found == 0) { # As long as the active column has not been found, $col will increment
              $col++;
              }
            } else {
                $found = 1; # Stops the col counter
            }
        }
        echo "<th> Edit </th>"; # Adds EDIT column to end of table
        echo "<th> Delete </th>"; # Adds DELETE column to the end of the table
        echo "</tr>";

        # Takes each row and prints each of it's elements in order
        while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
            # Start the table row
            echo "<tr>";

            # Print each element of that row
            $length = count($row);
            for ($i = 0; $i < $length; $i++) {
                if ($i != $col) { # As long as the column is not the active column
                    echo "<td>$row[$i]</td>";
                }
            }
            echo "<td><a class='btn btn-warning' href='?id=$row[0]&edit=$table'>Edit</a></td>"; # EDIT button allows editing of entry in each table
            echo "<td><a class='btn btn-danger' href='?id=$row[0]&table=$table'>Delete</a></td>"; # DELETE button added to allow deletion functionality at the end of each row
            echo "</tr>";
        }

        echo "</table>";
    } else { # If there is an error with the initial query, display an error.
        echo "<br>Database Error!!!";
        echo "<li>" . mysqli_error($dbc) . "</li>";
    }
    echo "</div>"; # end of options-table div
    echo "</div>"; # end of options div

/**************************************************************************
 *  Will open dialog to add entries to specific table
 **************************************************************************/
} elseif (isset($add)) { # If the user wants to add a new item to the table
    require "updTable$dispTableNames[$add].php";

/**************************************************************************
 *  Will open dialog to edit specific entries to specific table
 **************************************************************************/
} elseif (isset($edit)) {
    require "updTable$dispTableNames[$edit].php";
}

if ($display_message) {
    echo "<b style='background-color: red;'>$display_message</b>";
}

// End of file
?>

</main>
<?php
require "footer.php";
?>

<!-- Place scripts at bottom of page so page renders faster -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="script.js"></script>
</body>
</html>
