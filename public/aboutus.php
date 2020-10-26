<!--
  Hardware Online
  
  Authors: Fioti, Figueroa, Danyluk

  We are located at 12345 Poughkeepsie Lane, Poughkeepsie New York 12550
  Phone Number: 845-666-6969
  Email: admin@hardwareonline.com
-->
<?php
  define("FILE_VERSION", "0.11");
  define("FILE_AUTHOR", "Fioti, Figueroa, Danyluk");
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
      if (strlen($_COOKIE["disclaimer"]) == 0 || $_COOKIE["disclaimer"]==False){
        echo "<div class=\"disclaimer-overlay\" id=\"disclaimer-overlay\">";
        include "disclaimer-code.php";
        echo "<button onclick=\"eulaAgree();\">I agree...</button></div>";
      }
      include "nav.php";
    ?>

    <main>
      <h2>Who We Are</h2>
      <p style="text-align: center">
        We are a group of dedicated individuals, striving to provide the very
        best in DIY hardware.
        <br />
        Started in Poughkeepsie, New York, our goals were clear: Find the very
        best and aquire it for the cheapest cost to our customers<br />
        We take pride in our ability to provide, and are glad to help every from
        suburban dads to urban hippies complete their DIY projects.
      </p>
      <h2>What we do</h2>
      <p style="text-align: center">
        We provide you with the very best tools that America has to offer.<br />
        From Power Drills to Handsaws, Jackhammers to Steamrollers, we have the
        newest and greatest on the market.
        <br />
        Thanks to our patented "Scrap Bots", we are able to obtain our products
        far before our competitors, and for much cheaper.
      </p>
      <h2>Where to find us</h2>
      <p style="text-align: center">
        While mainly online, we do have an in person "Tryout" store, where you
        can go to test tools and equipment before you buy.<br />
        Yes, thats right. Before you buy.
        <br />
        <br />
        We are located at 12345 Poughkeepsie Lane, Poughkeepsie New York
        12550<br />
        Phone Number: 845-666-6969<br />
        Email: admin@hardwareonline.com
      </p>
    </main>
    <?php
    include "footer.php";
    ?>

    <!-- Place scripts at bottom of page so page renders faster -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="script.js"></script>
  </body>

</html>
