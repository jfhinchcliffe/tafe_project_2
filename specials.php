
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
        echo '<div id="specials_vehicle_container">';
        echo '<p><h3><a href=all_vehicles.php?id=' . $row[stock_no] . '> ' . $row[year] . ' ' . $row[name] . ' ' . $row[model] . '</a></h3>';
        echo '<p>Going for $' . $row[price] .'</p>';
        echo '<hr>';
        echo '</div>';
      }
    }
    ?>

  </div>
<?php include 'footer.php' ?>
