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
<div id="car_form_container">
<form method="post" action="">
  <table class="car_table">
  <tr><td>Name:</td><td><input name="name" type="text"></td></tr>
  <tr><td>Phone:</td><td><input name="phone" type="text"></td></tr>
  <tr><td>Email:</td><td><input name="email" type="text"></td></tr>
  <tr><td>Password:</td><td><input name="password" type="text"></td></tr>
  <tr><td><input type="submit" value="Submit New Salesperson"></td></tr>
</form>
</table>
<hr>
<h3>Current Salespeople</h3>
<hr>

<?php
require_once('config.php');
$salesperson_query = "SELECT
*
FROM
salesperson";
$salesperson_results = mysql_query($salesperson_query, $conn);
if (!$salesperson_results) {
  die ("Error selecting car data: " .mysql_error());
}
else {
  while ($row = mysql_fetch_array($salesperson_results)) {
    echo "<p><b> Name: </b> $row[name] </p>";
    echo "<p><b> Phone: </b> $row[phone] </p>";
    echo "<p><b> Email: </b> $row[email] </p>";
    echo "<hr>";
  }
}

 ?>

</div>
</div>
<?php include 'footer.php' ?>
