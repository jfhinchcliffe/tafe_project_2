<?php include 'header.html'; ?>
<div id='maincontent'>

<?php

  if (isset($_GET["id"])){
    $vehicle_id = $_GET["id"];

    require_once('config.php');

    $vehicle_query = "SELECT * FROM car WHERE stock_no = $vehicle_id";
    $vehicle_results = mysql_query($vehicle_query, $conn);
    if (!$vehicle_results) {
      die ("Error selecting car data: " .mysql_error());
    }
    else {
      while ($row = mysql_fetch_array($vehicle_results)) {
        echo "<p> $row[year] </p>";
        echo "<p> $row[manufacturer] </p>";
        echo "<p> $row[model] </p>";
        echo "<p> $row[price] </p>";
      }
    }
  } else {
      require_once('config.php');

      $query = "SELECT * FROM car";
      $results = mysql_query($query, $conn);
      if (!$results) {
        die ("Error selecting car data: " .mysql_error());
      }
        else {
          while ($row = mysql_fetch_array($results)) {
            echo "<a href=all_vehicles.php?id=$row[stock_no]>";
            echo "$row[year]";
            echo "</a>";
            echo "<p> $row[manufacturer] </p>";
            echo "<p> $row[model] </p>";
            echo "<p> $row[price] </p>";
          }
        }
      }
?>

</div>
<?php include 'footer.html' ?>
