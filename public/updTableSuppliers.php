<!--
  Hardware Online

  Filename: updTableSupplierss.php

  Authors:  Fioti, Figueroa, Danyluk

  Description: Used in table editor to edit, and create table entries for T3_suppliers

  Last Update: 11/21/2020

  Changelog:
    0.12: Added admin page with table editor Figueroa Fioti
    0.17: Updated Prologue on all pages Figueroa

  We are located at 12345 Poughkeepsie Lane, Poughkeepsie New York 12550
  Phone Number: 845-666-6969
  Email: admin@hardwareonline.com
-->

<?php

$table = "T3_suppliers"; # stores which table that will be added to

if ($_SERVER['REQUEST_METHOD']=="GET" && isset($id)) {
    if (isset($id)) {
        $r = mysqli_query($dbc, "SELECT * FROM $table WHERE $identifiers[$table]=$id;"); # Query the table for it's entries
        if ($r) {
            while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) { # iterate over each column
                $name = $row[1];
                $address = $row[2];
                $phone = $row[3];
                $email = $row[4];
            }
        } else {
            $display_message = "Unable to retreive original values";
            $display_message += "<p>" . mysqli_error($dbc) . "</p>";
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST["name"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];

    switch ("") {
        case $name:
            $display_message = "Name value missing";
            break;

        case $address:
            $display_message = "Address value missing";
            break;

        case $phone:
            $display_message = "Phone value missing";
            break;

        case $email:
            $display_message = "Email value missing";
            break;

        default:
            if (preg_match("/[a-z]/i", $phone)) {
                $display_message = "Phone number contains letters";
            } elseif (substr_count($email, "@") != 1) {
                $display_message = "Invalid Email";
            }
    }
} else {
    $name = $address = $phone = $email = "";
}

if ($_SERVER['REQUEST_METHOD'] == "POST" and $display_message == "") { # If the user is submitting the form
    if (isset($id)) {
        # Entry is updated
        $q = "UPDATE $table SET vendorname='$name', address='$address', phone='$phone', email='$email' WHERE $identifiers[$table]='$id';";
        $r = mysqli_query($dbc, $q);

        if ($r) {
            echo "Edit Successful";
            echo "<form action='$_SERVER[SCRIPT_NAME]' method='POST'>";
            echo "<input type='hidden' name='table' value='$table'>";
            echo "<input type='submit' value='Go back to table' class='btn btn-success'>";
        } else {
            echo mysqli_error($dbc);
        }
    } else {
        # Insert new entry into form
        $q = "INSERT INTO $table (vendorname, address, phone, email)" . "VALUES('$name', '$address', '$phone', '$email') ;";
        $r = mysqli_query($dbc, $q);

        if ($r) {
            echo "<a href='$_SERVER[REQUEST_URI]' class='btn btn-success'>Add Another</a>";
            echo "<form action='$_SERVER[SCRIPT_NAME]' method='POST'>";
            echo "<input type='hidden' name='table' value='$table'>";
            echo "<input type='submit' value='Go back to table' class='btn btn-success'>";
        } else {
            echo mysqli_error($dbc);
        }
    }
} else {
    echo "<form style='width: 360px;' action='$_SERVER[REQUEST_URI]' method='POST'>";
    echo "<div class='form-group'> <label for='name'> Name </label>";
    echo "<input type='text' name='name' id='name' value='$name' class='form-control' autofocus>";
    echo "</div>";
    echo "<div class='form-group'> <label for='address'> Address </label>";
    echo "<input type='text' name='address' id='address' value='$address' class='form-control'>";
    echo "</div>";
    echo "<div class='form-group'> <label for='phone'> Phone </label>";
    echo "<input type='tel' name='phone' id='phone' value='$phone' class='form-control'>";
    echo "</div>";
    echo "<div class='form-group'> <label for='email'> Email </label>";
    echo "<input type='email' name='email' id='email' value='$email' class='form-control'>";
    echo "</div>";
    echo "<br> <input type='submit' value='Submit' class='btn btn-secondary'>";
    echo "</form>";
}
?>
