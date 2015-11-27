<?php
  $manufacturer = $_POST['manufacturer'];
  $manufacturer_id =  0;
  require_once('config.php');

  $query = "SELECT manufacturer_id FROM manufacturer WHERE name = '$manufacturer' LIMIT 1";
  $results = mysql_query($query, $conn);
  if (!$results) {
    die ("Error selecting car data: " .mysql_error());
  }
  else {
    while ($row = mysql_fetch_array($results)) {
      $manufacturer_id = $row[manufacturer_id];
    }
  }

    $category = $_POST['category'];
    $category_id =  0;
    require_once('config.php');

    $query = "SELECT category_id FROM category WHERE description = '$category'";
    $results = mysql_query($query, $conn);
    if (!$results) {
      die ("Error selecting car data: " .mysql_error());
    }
    else {
      while ($row = mysql_fetch_array($results)) {
        $category_id = $row[category_id];
      }
    }

    // Connect to MySQL
    $mysqli = new mysqli( 'localhost', 'root', 'root', 'w_c_a' );

    // Check our connection
    if ( $mysqli->connect_error ) {
      die( 'Connect Error: ' . $mysqli->connect_errno . ': ' . $mysqli->connect_error );
    }
    if ($_POST['available']=="on"){
      $available = 1;
    } else {
      $available = 0;
    }

    if ($_POST['on_special']=="on"){
      $on_special = 1;
    } else {
      $on_special = 0;
    }
    $stock_no = $_POST['stock_no'];
    // Insert our data
    $sql = mysql_query("UPDATE car
         SET available = '".$available."',
         price = '".mysql_real_escape_string($_POST['price'])."',
         description = '".mysql_real_escape_string($_POST['description'])."',
         on_special = '".$on_special."',
         manufacturer = '".$manufacturer_id."',
         model = '".mysql_real_escape_string($_POST['model'])."',
         category = '".$category_id."',
         year = '".mysql_real_escape_string($_POST['year'])."',
         kilometres = '".mysql_real_escape_string($_POST['kilometres'])."',
         colour = '".mysql_real_escape_string($_POST['colour'])."',
         registration = '".mysql_real_escape_string($_POST['registration'])."',
         vin = '".mysql_real_escape_string($_POST['vin'])."',
         cylinders = '".mysql_real_escape_string($_POST['cylinders'])."',
         fuel = '".mysql_real_escape_string($_POST['fuel'])."',
         transmission = '".mysql_real_escape_string($_POST['transmission'])."',
         image = '".mysql_real_escape_string($_POST['image'])."'
         WHERE stock_no='".mysql_real_escape_string($_POST['stock_no'])."'");
    $update = $mysqli->query($sql);


    echo "Vehicle updated: ";
    echo "<a href=edit_vehicle.php?id=" . $_POST['stock_no'] . ">";
    echo "Back to Edit Vehicle</a>";
   ?>
