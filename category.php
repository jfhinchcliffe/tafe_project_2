<?php
// Only process the form if $_POST isn't empty
if ( ! empty( $_POST ) ) {

  // Connect to MySQL
  $mysqli = new mysqli( 'localhost', 'root', 'root', 'w_c_a' );

  // Check our connection
  if ( $mysqli->connect_error ) {
    die( 'Connect Error: ' . $mysqli->connect_errno . ': ' . $mysqli->connect_error );
  }

  // Insert our data
  $sql = "INSERT INTO category (description) VALUES ( '{$mysqli->real_escape_string($_POST['description'])}' )";
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
<?php include 'header.html' ?>

<div id="maincontent">

<form method="post" action="">
  <input name="description" type="text">
  <input type="submit" value="Submit New Category">
</form>

<?php
  require_once('config.php');

  $query = "SELECT * FROM category";
  $results = mysql_query($query, $conn);
  if (!$results) {
    die ("Error selecting car data: " .mysql_error());
}
else {
  while ($row = mysql_fetch_array($results)) {
    echo "<p> $row[description] </p>";
  }
}
?>
<a href="vehicles.php">Back to Vehicles</a>
<?php include 'footer.html' ?>
