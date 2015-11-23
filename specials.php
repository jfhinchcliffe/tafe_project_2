
<?php include 'header.html' ?>
  <div id="maincontent">

    <?php
      require_once('config.php');

      $query = "SELECT * FROM car WHERE on_special > 0";
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
<?php include 'footer.html' ?>
