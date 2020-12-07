<!--
  Hardware Online

  Filename: T3.php

  Authors:  Figueroa

  Description: index page of the website. Displays carousel with photos, navbar with a list of pages, and a footer.

  Last Update: 02/06/2020

  Changelog:
    0.18: Added product receipt page when item an item is purchased.

  We are located at 12345 Poughkeepsie Lane, Poughkeepsie New York 12550
  Phone Number: 845-666-6969
  Email: admin@hardwareonline.com
-->
<?php
define("FILE_VERSION", "0.18");
define("FILE_AUTHOR", "Figueroa");
?>
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
  if (strlen($_COOKIE["disclaimer"]) == 0 || $_COOKIE["disclaimer"] == false) {
      echo "<div class='disclaimer-overlay' id='disclaimer-overlay'>";
      require "disclaimer-code.php";
      echo "<button onclick='eulaAgree();'>I agree...</button></div>";
  }
  require "nav.php";
?>
<main>
  <div class="receipt">
    <h1>Receipt</h1>
    <?php
    $timestamp = date('h:i:sa m/d/Y');
    echo "<p>Created: $timestamp</p>";
    echo "<p style='margin-left: 1in; text-align:left;'>Items:</p>";
    /***************************************
    * Generates the product list, taxes, and total for purchase
    ****************************************/
    if (isset($_GET["id"])) {
        $total = 0.0;
        $id = $_GET['id']; # used to identify the product being purchased
        $tax_rate = 0.08; # Used to determine tax rate in calculations

        require "../connect_db.php"; # Connects to database and produces $dbc database connection variable

        $q = "SELECT * FROM T3_products WHERE productID='$id';"; # Queries for the database entrie connected to the given id
        $r = mysqli_query($dbc, $q); # Query the table for it's entries

        if ($r) {
            while ($row = mysqli_fetch_array($r, MYSQLI_NUM)) { # Extracts each item from the query
                echo "<p>$row[3]: $$row[6]</p>"; # Display the item onto the page
                $total += $row[6]; # add the price to the total for the receipt
            }
        }
        $taxes = $total * $tax_rate; # Calculate the taxes
        $final_total = $total+$taxes; # calculate the final total

        echo "<p style='margin-top: 1in;'>Taxes: $$total X $tax_rate = $$taxes</p>";
        echo "<p style=''>Total: $$final_total</p>";
    } else {
        echo "<p>Empty</p>";
    }

    ?>
  </div>


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
