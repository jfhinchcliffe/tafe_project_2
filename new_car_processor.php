<?php
  $manufacturer = $_POST['manufacturer'];
  $manufacturer_id =  0;
  require_once('config.php');

  $query = "SELECT manufacturer_id FROM manufacturer include WHERE name = '$manufacturer' LIMIT 1";
  $results = mysql_query($query, $conn);
  if (!$results) {
    die ("Error selecting car data: " .mysql_error());
  }
  else {
    while ($row = mysql_fetch_array($results)) {
      $manufacturer_id = $row[manufacturer_id];
    }
  }
  ?>
  <?php
    $category = $_POST['category'];
    $category_id =  0;
    require_once('config.php');

    $query = "SELECT category_id FROM category include WHERE description = '$category'";
    $results = mysql_query($query, $conn);
    if (!$results) {
      die ("Error selecting car data: " .mysql_error());
    }
    else {
      while ($row = mysql_fetch_array($results)) {
        $category_id = $row[category_id];
      }
    }
    ?>
<?php include 'header.php' ?>
<div id="maincontent">
  <?php
    // Connect to MySQL
    $mysqli = new mysqli( 'localhost', 'root', 'root', 'w_c_a' );

    // Check our connection
    if ( $mysqli->connect_error ) {
      die( 'Connect Error: ' . $mysqli->connect_errno . ': ' . $mysqli->connect_error );
    } else {
      echo ("Connected!");
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
    // Insert our data
    $sql = "INSERT INTO car ( available, price, description, on_special, manufacturer, model, category, year, kilometres, colour, registration, vin, cylinders, fuel, transmission, image ) VALUES ( '$available', '{$mysqli->real_escape_string($_POST['price'])}', '{$mysqli->real_escape_string($_POST['description'])}', '$on_special', '$manufacturer_id', '{$mysqli->real_escape_string($_POST['model'])}', '$category_id', '{$mysqli->real_escape_string($_POST['year'])}', '{$mysqli->real_escape_string($_POST['kilometres'])}', '{$mysqli->real_escape_string($_POST['colour'])}', '{$mysqli->real_escape_string($_POST['registration'])}', '{$mysqli->real_escape_string($_POST['vin'])}', '{$mysqli->real_escape_string($_POST['cylinders'])}', '{$mysqli->real_escape_string($_POST['fuel'])}', '{$mysqli->real_escape_string($_POST['transmission'])}', '{$mysqli->real_escape_string($_POST['image'])}' )";
    $insert = $mysqli->query($sql);


    if ( $insert ) {
      echo "Success! Row ID: {$mysqli->insert_id}";
      echo "<a href=vehicles.php>Back to Vehicles</a>";
    } else {
      die("Error: {$mysqli->errno} : {$mysqli->error}");
    }

    // Close our connection
    $mysqli->close();

   ?>
</div>
<?php include 'footer.php' ?>
