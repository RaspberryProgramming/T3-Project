<?php
    
$table = "T3_products"; # stores which table that will be added to

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $vendorid = $_POST["vendorID"];
    $model = $_POST["model"];
    $product = $_POST["product"];
    $description = $_POST["description"];
    $price = $_POST["price"];

    switch (""){
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

      default:
        if(gettype(floatval($price)) != "double"){
          echo gettype(floatval($price));
          $display_message = "Invalid datatype of price";
        } else if (strlen($model) < 4){
            $display_message = "Model is less than 4 characters long";
        } else if (strlen($description) < 5){
            $display_message = "Description is less than 5 characters long";
        }
    }

} else {
    $vendorid = $model = $product = $description = $price = "";
}



if ($_SERVER['REQUEST_METHOD'] == "POST" AND $display_message == "") { # If the user is submitting the form

    
    
    # Insert new entry into form
    $q = "INSERT INTO $table (vendorID, model, product, description, price)"."VALUES('$vendorid', '$model', '$product', '$description', '$price');";
    $r = mysqli_query ($dbc,$q);

    if ($r) {
        echo "<a href='' class='btn btn-success'>Add Another</a>";
        $script = $_SERVER['SCRIPT_NAME'];
        echo "<form action='$script' method='POST'>";
        echo "<input type='hidden' name='table' value='$table'>";
        echo "<input type='submit' value='Go back to table' class='btn btn-success'>";
    }
    else {
        echo mysqli_error($dbc);
    }

}
else {
    
    $r = mysqli_query($dbc, "SELECT * FROM T3_suppliers;"); # Query the table for it's entries
    if ($r){
        echo "<form action='' method='POST'>";
        echo "<br> Vendor ID: <select id='vendorID' name='vendorID' >";
        while ($row = mysqli_fetch_array( $r, MYSQLI_NUM)) {
            echo "<option value='$row[0]'>$row[1]</option>";
        } 

        echo "</select> ";
        echo "<br> Model <input type='text' name='model' value='$model'>";
        echo "<br> Product <input type='text' name='product' value='$product'>";
        echo "<br> Description <input type='text' name='description' value='$description'>";
        echo "<br> Price $<input type='number' step='0.01' name='price' value='$price'>";
        echo "<br> <input type='submit' class='btn btn-secondary'>";
        echo "</form>";
    } else {

    }
    
}
?>