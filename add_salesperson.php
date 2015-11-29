<?php
  session_start();
  if(!$_SESSION["logged_in"]){
    header("location:home.php");
    die;
  }
?>
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
  $sql = "INSERT INTO salesperson (name, phone, email, password) VALUES(
    '{$mysqli->real_escape_string($_POST['name'])}',
    '{$mysqli->real_escape_string($_POST['phone'])}',
    '{$mysqli->real_escape_string($_POST['email'])}',
    '{$mysqli->real_escape_string($_POST['password'])}')";

  echo "INSERT INTO salesperson (name, phone, email, password) VALUES(
    '{$mysqli->real_escape_string($_POST['name'])}',
    '{$mysqli->real_escape_string($_POST['phone'])}',
    '{$mysqli->real_escape_string($_POST['email'])}',
    '{$mysqli->real_escape_string($_POST['password'])}')";

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
  <p>Name: <input name="name" type="text"></p>
  <p>Phone: <input name="phone" type="text"></p>
  <p>Email: <input name="email" type="text"></p>
  <p>Password: <input name="password" type="text"></p>
  <p><input type="submit" value="Submit New Salesperson"></p>
</form>

<a href="vehicles.php">Back to Vehicles</a>
<?php include 'footer.php' ?>
