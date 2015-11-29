
<?php include 'header.php' ?>
  <div id="maincontent">
    <h3>Specials</h3>
    <?php
      require_once('config.php');
      // Selects cars that are both on special and available.
      $query = "SELECT
      *
      FROM
      car
      INNER JOIN
      manufacturer
      ON
      car.manufacturer=manufacturer.manufacturer_id
      WHERE
      on_special = 1
      AND
      available = 1";
      $results = mysql_query($query, $conn);
      if (!$results) {
        die ("Error selecting car data: " .mysql_error());
    }
    else {
      while ($row = mysql_fetch_array($results)) {
        echo '<p><a href=all_vehicles.php?id=' . $row[stock_no] . '> ' . $row[year] . ' ' . $row[name] . ' ' . $row[model] . '</a>';
        echo '<p>Going for $' . $row[price] .'</p>';
      }
    }
    ?>

  </div>
<?php include 'footer.php' ?>
