
<?php include 'header.php' ?>
  <div id="maincontent">

    <?php
      require_once('config.php');
      // Selects cars that are both on special and available.
      $query = "SELECT * FROM car include WHERE on_special > 0 AND available = 1";
      $results = mysql_query($query, $conn);
      if (!$results) {
        die ("Error selecting car data: " .mysql_error());
    }
    else {
      while ($row = mysql_fetch_array($results)) {
        echo "<p> $row[year] $row[manufacturer] </p>";
        echo "<p> $row[model]. Going for $ $row[price] </p>";
      }
    }
    ?>

  </div>
<?php include 'footer.php' ?>
