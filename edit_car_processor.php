
<?php
  //checking for values in customer form. Doing this up here because header won't work otherwise.
  /* if (($_POST['price']== "")||
      ($_POST['description']== "")|| ($_POST['manufacturer'] == "") || ($_POST['model'] == "") || ($_POST['category'] == "") || ($_POST['year'] == "") || ($_POST['kilometres'] == "")){
    header("Location: add_vehicle.php");
    exit;
  }
  */
  //ensure that the phone number is an integer.
?>
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
      echo $manufacturer_id;
    }
  }
  ?>
  <?php
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
        echo $category_id;
      }
    }
    ?>
<?php include 'header.html' ?>
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
    echo $_POST['price'];
    $sql = mysql_query("UPDATE car
         SET available = '.$available.',
         SET price = '".mysql_real_escape_string($_POST['price'])."'
         WHERE stock_no='".mysql_real_escape_string($_POST['stock_no'])."'");

    $update = $mysqli->query($sql);


    /*if ( $udpate ) {
      echo "Success! Row ID: {$mysqli->update_id}";
      echo "<a href=add_vehicle.php>Back to Add Vehicle</a>";
    } else {
      die("Error: {$mysqli->errno} : {$mysqli->error}");
    } */

    // Close our connection
    $mysqli->close();

   ?>
</div>
<?php include 'footer.html' ?>
