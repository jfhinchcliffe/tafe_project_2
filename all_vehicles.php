<?php include 'header.php'; ?>
<div id='maincontent'>

<?php

echo '<div id="vehicle_category_header">';

echo "<h3>Select Category</h3>";
echo "<a href=all_vehicles.php>All Cars</a> ";
require_once('config.php');
$getData = mysql_query("SELECT
*
FROM
category");

while($viewData = mysql_fetch_array($getData))
{
    echo "<a href=all_vehicles.php?category=" . $viewData[category_id] . "> " . $viewData[description] . " </a>";
}
echo "</div>";

if (isset($_GET["category"])){
  $category_id = $_GET["category"];

  require_once('config.php');

  $query = "SELECT
  *
  FROM
  car
  INNER JOIN
  manufacturer
  ON
  car.manufacturer=manufacturer.manufacturer_id
  INNER join
  images
  ON
  images.stock_no=car.stock_no
  WHERE
  category=$category_id";

  $results = mysql_query($query, $conn);
  if (!$results) {
    die ("Error selecting car data: " .mysql_error());
  }
    else {
      while ($row = mysql_fetch_array($results)) {
        echo '<div id="vehicle_container">';
        echo '<div id="vehicle_details">';
        echo "<p><b> Make:</b> $row[name]</p>";
        echo "<p><b> Model:</b> $row[model] </p>";
        echo "<p><b> Year:</b> $row[year] </p>";
        echo "<p><b> Odometer:</b> $row[kilometres] </p>";
        echo '</div>';
        echo '<div id="vehicle_desc">';
        echo "<p> $row[description] </p>";
        echo '</div>';
        echo '<div id="vehicle_image">';
        echo '<a href=all_vehicles.php?id=' . $row[stock_no] . '><img src="uploads/' . $row['file'] . '"></a>';
        echo '</div>';
        echo '</div>';
      }
    }

} else if (isset($_GET["id"])){
  $vehicle_id = $_GET["id"];

  require_once('config.php');

  $vehicle_query = "SELECT
  *
  FROM
  car
  INNER JOIN
  manufacturer
  ON
  car.manufacturer=manufacturer.manufacturer_id
  INNER join
  images
  ON
  images.stock_no=car.stock_no
  WHERE
  car.stock_no = $vehicle_id";
  $vehicle_results = mysql_query($vehicle_query, $conn);
  if (!$vehicle_results) {
    die ("Error selecting car data: " .mysql_error());
  }
  else {
    while ($row = mysql_fetch_array($vehicle_results)) {
      echo "<a href=all_vehicles.php>Back</a>";
      echo '<div id="vehicle_container">';
      echo '<div id="vehicle_details">';
      echo "<p><b> Make:</b> $row[name]</p>";
      echo "<p><b> Model:</b> $row[model] </p>";
      echo "<p><b> Year:</b> $row[year] </p>";
      echo "<p><b> Odometer:</b> $row[kilometres] </p>";
      echo '</div>';
      echo '<div id="vehicle_desc">';
      echo "<p> $row[description] </p>";
      echo '</div>';
      echo '<div id="vehicle_image">';
      echo '<a href=all_vehicles.php?id=' . $row[stock_no] . '><img src="uploads/' . $row['file'] . '" width="250"></a>';
      echo '</div>';
      echo '</div>';
    }
  }
} else {


      require_once('config.php');

      $query = "SELECT
      *
      FROM
      car
      INNER JOIN
      manufacturer
      ON
      car.manufacturer=manufacturer.manufacturer_id
      INNER join
      images
      ON
      images.stock_no=car.stock_no";
      $results = mysql_query($query, $conn);
      if (!$results) {
        die ("Error selecting car data: " .mysql_error());
      }
        else {
          while ($row = mysql_fetch_array($results)) {
            echo '<div id="vehicle_container">';
            echo '<div id="vehicle_details">';
            echo "<p><b> Make:</b> $row[name]</p>";
            echo "<p><b> Model:</b> $row[model] </p>";
            echo "<p><b> Year:</b> $row[year] </p>";
            echo "<p><b> Odometer:</b> $row[kilometres] </p>";
            echo '</div>';
            echo '<div id="vehicle_desc">';
            echo "<p> $row[description] </p>";
            echo '</div>';
            echo '<div id="vehicle_image">';
            echo '<a href=all_vehicles.php?id=' . $row[stock_no] . '><img src="uploads/' . $row['file'] . '"></a>';
            echo '</div>';
            echo '</div>';
            echo '<hr>';
          }
        }
      }
?>
</div>
<?php include 'footer.php' ?>
