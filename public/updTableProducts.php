<?php

$table = "T3_products"; # stores which table that will be added to

if ($_SERVER['REQUEST_METHOD']=="GET" && isset($id)) {
    if (isset($id)) {
        $r = mysqli_query($dbc, "SELECT * FROM $table WHERE $identifiers[$table]=$id;"); # Query the table for it's entries
        if ($r) {
            while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) { # iterate over each column
                $vendorid = $row[1];
                $model = $row[2];
                $product = $row[3];
                $description = $row[5];
                $price = $row[6];
                $stock = $row[4];
            }
        } else {
            $display_message = "Unable to retreive original values";
            $display_message += "<p>" . mysqli_error($dbc) . "</p>";
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    $vendorid = $_POST["vendorID"];
    $model = $_POST["model"];
    $product = $_POST["product"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];
 
    switch ("") {
        case $vendorid:
            $display_message = "Vendor value missing";
            break;

        case $model:
            $display_message = "Model value missing";
            break;

        case $product:
            $display_message = "Product value missing";
            break;

        case $description:
            $display_message = "Description value missing";
            break;

        case $price:
            $display_message = "Price value missing";
            break;

        case $stock:
            $display_message = "Stock value missing";

            // no break
        default:
            if (gettype(floatval($price)) != "double") {
                $display_message = "Invalid price";
            } elseif (preg_match("/[a-z]/i", $stock)) {
                $display_message = "Stock cannot have letters";
            } elseif (strlen($model) < 4) {
                $display_message = "Model is less than 4 characters long";
            } elseif (strlen($description) < 5) {
                $display_message = "Description is less than 5 characters long";
            }
    }
} else {
    $vendorid = $model = $product = $description = $price = $stock = "";
}

if ($_SERVER['REQUEST_METHOD'] == "POST" and $display_message == "") { # If the user is submitting the form
    if (isset($id)) {
        # Entry is updated
        $q = "UPDATE $table SET vendorID='$vendorid', model='$model', product='$product', description='$description', price='$price', stock='$stock' WHERE $identifiers[$table]='$id';";
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
        $q = "INSERT INTO $table (vendorID, model, product, description, price, stock)" . "VALUES('$vendorid', '$model', '$product', '$description', '$price', '$stock');";
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
    $r = mysqli_query($dbc, "SELECT * FROM T3_suppliers;"); # Query the table for it's entries
    if ($r) {
        echo "<form action='$_SERVER[REQUEST_URI]' method='POST'>";

        echo "<div class='form-group'>";
        echo "<label for='vendorID'>Vendor ID</label>";
        echo "<select id='vendorID' name='vendorID' class='form-control' autofocus>";
        while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) {
            if ($vendorid == $row[0]) {
                echo "<option value='$row[0]' selected>$row[1]</option>";
            } else {
                echo "<option value='$row[0]'>$row[1]</option>";
            }
        }

        echo "</select> </div>";
        echo "<div class='form-group'> <label for='model'> Model </label>";
        echo "<input type='text' id='model' name='model' value='$model' class='form-control'>";
        echo "</div>";
        echo "<div class='form-group'> <label for='product'> Product </label>";
        echo "<input type='text' id='product' name='product' value='$product' class='form-control'>";
        echo "</div>";
        echo "<div class='form-group'> <label for='description'> Description </label>";
        echo "<textarea style='width: 25em;' type='text' id='description' name='description' class='form-control'> $description </textarea>";
        echo "</div>";
        echo "<div class='form-group'> <label for='price'> Price ($) </label>";
        echo "<input type='number' step='0.01' id='price' name='price' value='$price' class='form-control'>";
        echo "</div>";
        echo "<div class='form-group'> <label for='stock'> Stock </label>";
        echo "<input type='number' id='stock' value='$stock' name='stock' class='form-control'>";
        echo "<br> <input type='submit' value='Submit' class='btn btn-secondary'>";
        echo "</form>";
    } else {
        $display_message = "Unable to query for vendors";
    }
}
