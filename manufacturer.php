<?php
  session_start();
  if(!$_SESSION["logged_in"]){
    header("location:home.php");
    die;
  }
?>
<?php
if (isset($_GET["id"])){
  $manufacturer_id = $_GET["id"];

  require_once('config.php');

  $manufacturer_query = "SELECT * FROM manufacturer include WHERE manufacturer_id = $manufacturer_id";
  $manufacturer_results = mysql_query($manufacturer_query, $conn);
  if (!$manufacturer_results) {
    die ("Error selecting customer data: " .mysql_error());
  } else {
  while ($row = mysql_fetch_array($manufacturer_results)) {
    echo "Test";
  }
}}

// Only process the form if $_POST isn't empty
if ( ! empty( $_POST ) ) {

  // Connect to MySQL
  $mysqli = new mysqli( 'localhost', 'root', 'root', 'w_c_a' );

  // Check our connection
  if ( $mysqli->connect_error ) {
    die( 'Connect Error: ' . $mysqli->connect_errno . ': ' . $mysqli->connect_error );
  }

  // Insert our data
  $sql = "INSERT INTO manufacturer (name) VALUES ( '{$mysqli->real_escape_string($_POST['name'])}' )";
  $insert = $mysqli->query($sql);

  // Print response from MySQL
  if ( $insert ) {
    header("location:vehicles.php");
  } else {
    die("Error: {$mysqli->errno} : {$mysqli->error}");
  }

  // Close our connection
  $mysqli->close();
}
?>
<?php include 'header.php' ?>

<div id="maincontent">

<form method="post" action="">
  <input name="name" type="text">
  <input type="submit" value="Submit New Manufacturer">
</form>

<?php
  require_once('config.php');

  $query = "SELECT * FROM manufacturer";
  $results = mysql_query($query, $conn);
  if (!$results) {
    die ("Error selecting car data: " .mysql_error());
}
else {
  while ($row = mysql_fetch_array($results)) {
    echo "<p><a href=manufacturer.php?id=$row[manufacturer_id]>$row[name]</a> </p>";
  }
}
?>
<a href="vehicles.php">Back to Vehicles</a>
<?php include 'footer.php' ?>
