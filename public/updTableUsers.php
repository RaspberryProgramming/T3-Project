<!--
  Hardware Online
  
  Authors: Fioti, Figueroa, Danyluk

  Version: 1.12

  We are located at 12345 Poughkeepsie Lane, Poughkeepsie New York 12550
  Phone Number: 845-666-6969
  Email: admin@hardwareonline.com
-->

<?php
    
$table = "T3_users"; # stores which table that will be added to

$rankids = ["Customer", "Employee", "Shareholder", "Admin"];
$hashtypes = ["none"];

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $hashtype = $_POST["hashtype"];
    $rankid = $_POST["rankid"];

    switch (""){
      case $username:
        $display_message = "Username value missing";
        break;
      
      case $password:
        $display_message = "Password value missing";
        break;
      
      case $hashtype:
        $display_message = "Hashtype value missing";
        break;
      
      case $rankid:
        $display_message = "RankID value missing";
        break;

      default:
        if (!in_array($hashtype, $hashtypes)){
            $display_message = "Invalid hashtype";
        } else if (!in_array($rankid, $rankids)){
            $display_message = "Invalid RankID";
        }
    }

} else {
    $vendorid = $model = $product = $description = $price = "";
}



if ($_SERVER['REQUEST_METHOD'] == "POST" AND $display_message == "") { # If the user is submitting the form

    switch ($hashtype){
      case "none":
        $pwhash = $password;
        break;
    }
    
    # Insert new entry into form
    $q = "INSERT INTO $table (username, pwHash, hashType, rankID)"."VALUES('$username', '$pwhash', '$hashtype', '$rankid');";
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
        echo "<br> Username <input type='text' name='username' value='$username'>";
        echo "<br> Password <input type='text' name='password' value='$password'>";
        echo "<br> Hash Type <select name='hashtype'>";
        echo "<option value='none'>none</option>";
        echo "</select>";
        echo "<br> Rank ID <select name='rankid'>";
        echo "<option value='Customer'>Customer</option>";
        echo "<option value='Employee'>Employee</option>";
        echo "<option value='Shareholder'>Shareholder</option>";
        echo "<option value='Admin'>Admin</option>";
        echo "</select>";
        echo "<br> <input type='submit' class='btn btn-secondary'>";

        echo "</form>";
    } else {

    }
    
}
?>