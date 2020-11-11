<!--
  Hardware Online
  
  Authors: Fioti, Figueroa, Danyluk

  Version: 1.12

  We are located at 12345 Poughkeepsie Lane, Poughkeepsie New York 12550
  Phone Number: 845-666-6969
  Email: admin@hardwareonline.com
-->

<?php
    
$table = "T3_suppliers"; # stores which table that will be added to

if ($_SERVER['REQUEST_METHOD'] == "POST"){
  $name = $_POST["name"];
  $address = $_POST["address"];
  $phone = $_POST["phone"];
  $email = $_POST["email"];

  switch (""){
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
      if(preg_match("/[a-z]/i", $phone)){
        $display_message = "Phone number contains letters";
      } else if (substr_count($email, "@") != 1){
        $display_message = "Invalid Email";
      }
  }


} else {
    $name = $address = $phone = $email = "";
}



if ($_SERVER['REQUEST_METHOD'] == "POST" AND $display_message == "") { # If the user is submitting the form

    
    
    # Insert new entry into form
    $q = "INSERT INTO $table (vendorname, address, phone, email)"."VALUES('$name', '$address', '$phone', '$email') ;";
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
        echo "<br> Name <input type='text' name='name' value='$name'>";
        echo "<br> Address <input type='text' name='address' value='$address'>";
        echo "<br> Phone <input type='tel' name='phone' value='$phone'>";
        echo "<br> Email <input type='email' name='email' value='$email'>";
        echo "<br> <input type='submit'>";
        echo "</form>";
        echo "</form>";
    } else {

    }
    
}
?>