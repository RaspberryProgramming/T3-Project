<!--
  Hardware Online

  Filename: updTableUsers.php

  Authors:  Fioti, Figueroa, Danyluk

  Description: Used in table editor to edit, and create table entries for T3_Users

  Last Update: 11/21/2020

  Changelog:
    0.12: Added admin page with table editor Figueroa Fioti
    0.15: Added edit functionality to Table Editor. Figueroa
    0.17: Updated Prologue on all pages Figueroa

  We are located at 12345 Poughkeepsie Lane, Poughkeepsie New York 12550
  Phone Number: 845-666-6969
  Email: admin@hardwareonline.com
-->

<?php

$table = "T3_users"; # stores which table that will be added to

$rankids = ["Customer", "Employee", "Shareholder", "Admin"];
$hashtypes = ["none"];

if ($_SERVER['REQUEST_METHOD']=="GET" && isset($id)) {
    if (isset($id)) {
        $r = mysqli_query($dbc, "SELECT * FROM $table WHERE $identifiers[$table]=$id;"); # Query the table for it's entries
        if ($r) {
            while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) { # iterate over each column
                $username = $row[1];
                $password = $row[2];
                $hashtype = $row[3];
                $rankid = $row[4];
            }
        } else {
            $display_message = "Unable to retreive original values";
            $display_message += "<p>" . mysqli_error($dbc) . "</p>";
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $hashtype = $_POST["hashtype"];
    $rankid = $_POST["rankid"];

    switch ("") {
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
            if (!in_array($hashtype, $hashtypes)) {
                $display_message = "Invalid hashtype";
            } elseif (!in_array($rankid, $rankids)) {
                $display_message = "Invalid RankID";
            }
    }
} else {
    $username = $password = $hashtype = $rankid = "";
}

if ($_SERVER['REQUEST_METHOD'] == "POST" and $display_message == "") { # If the user is submitting the form

    switch ($hashtype) {
        case "none":
            $pwhash = $password;
            break;
    }

    if (isset($id)) {
        # Entry is updated
        $q = "UPDATE $table SET username='$username', pwHash='$pwhash', hashType='$hashtype', rankID='$rankid' WHERE $identifiers[$table]='$id';";
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
        $q = "INSERT INTO $table (username, pwHash, hashType, rankID)" . "VALUES('$username', '$pwhash', '$hashtype', '$rankid');";
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
    echo "<form action='$_SERVER[REQUEST_URI]' method='POST'>";
    echo "<div class='form-group'> <label for='username'> Username </label>";
    echo "<input type='text' name='username' id='username' value='$username' class='form-control' autofocus>";
    echo "</div>";
    echo "<div class='form-group'> <label for='password'> Password </label>";
    echo "<input type='password' name='password' id='password' class='form-control' value='$password'>";
    echo "</div>";
    echo "<div class='form-group'> <label for='hashtype'> HashType </label>";
    echo "<select name='hashtype' id='hashtype' class='form-control'>";
    if ($hashtype == "none") {
        echo "<option value='none' selected>none</option>";
    } else {
        echo "<option value='none'>none</option>";
    }
    echo "</select></div>";

    $sel_cust = $sel_emp = $sel_holder = $sel_adm = "";

    switch ($rankid) {
    case ("Customer"):
      $sel_cust = "selected";
      break;
    case ("Employee"):
      $sel_emp = "selected";
      break;
    case ("Shareholder"):
      $sel_holder = "selected";
      break;
    case ("Admin"):
      $sel_adm = "selected";
      break;
  }
    echo "<div class='form-group'> <label for='rankid'> Rank ID </label>";
    echo "<select name='rankid' id='rankid' class='form-control'>";
    echo "<option value='Customer' $sel_cust>Customer</option>";
    echo "<option value='Employee' $sel_emp>Employee</option>";
    echo "<option value='Shareholder' $sel_holder>Shareholder</option>";
    echo "<option value='Admin' $sel_adm>Admin</option>";
    echo "</select></div>";
    echo "<br> <input type='submit' value='Submit' class='btn btn-secondary'>";

    echo "</form>";
}
?>
