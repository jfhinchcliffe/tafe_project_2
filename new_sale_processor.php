<?php
  $registration = $_POST['registration'];
  $stock_no =  0;
  //echo $registration;
  require_once('config.php');

  $query = "SELECT stock_no FROM car WHERE registration = '$registration'";
  $results = mysql_query($query, $conn);
  if (!$results) {
  die ("Error selecting car data: " .mysql_error());
}
else {
  while ($row = mysql_fetch_array($results)) {
    $stock_no = $row[stock_no];
    echo "stock number: " . $stock_no;
  }
}
?>

<?php
    $mysqli = new mysqli( 'localhost', 'root', 'root', 'w_c_a' );
    $date = date("d.m.y");
    // Check our connection
    if ( $mysqli->connect_error ) {
      die( 'Connect Error: ' . $mysqli->connect_errno . ': ' . $mysqli->connect_error );
    } else {
      echo ("Connected!");
    }
    // Insert our data
    $sql = "UPDATE car SET available=0 WHERE stock_no=$stock_no ";
    $insert = $mysqli->query($sql);

    // Print response from MySQL
    if ( $insert ) {
      echo "Success! Row ID: {$mysqli->insert_id}";
      echo "<a href=add_sale.php>Back to Add Sale</a>";
    } else {
      die("Error: {$mysqli->errno} : {$mysqli->error}");
    }

    // Close our connection
    $mysqli->close();
?>

<?php
  $salesperson_name = $_POST['salesperson_name'];
  $salesperson_id =  0;
  require_once('config.php');

  $query = "SELECT salesperson FROM salesperson WHERE name = '$salesperson_name'";
  $results = mysql_query($query, $conn);
  if (!$results) {
  die ("Error selecting car data: " .mysql_error());
}
else {
  while ($row = mysql_fetch_array($results)) {
    $salesperson_id = $row[salesperson];
    echo "salesperson id is " . $salesperson_id;
  }
}
?>
<?php
  $customer_name = $_POST['customer_id'];
  $customer_id =  0;
  require_once('config.php');
  //need to fix this - duplicate names can result in duplicate customer entries.
  $query = "SELECT customer_id FROM customer WHERE name = '$customer_name' LIMIT 1";
  $results = mysql_query($query, $conn);
  if (!$results) {
  die ("Error selecting car data: " .mysql_error());
}
else {
  while ($row = mysql_fetch_array($results)) {
    $customer_id = $row[customer_id];
    echo "Customer ID" . $customer_id;
  }
}
?>
<?php
    $mysqli = new mysqli( 'localhost', 'root', 'root', 'w_c_a' );
    $date = date("d.m.y");
    // Check our connection
    if ( $mysqli->connect_error ) {
      die( 'Connect Error: ' . $mysqli->connect_errno . ': ' . $mysqli->connect_error );
    } else {
      echo ("Connected!");
    }
    // Insert our data
    $sql = "INSERT INTO sale ( stock_no, salesperson_id, customer_id, date ) VALUES ( '$stock_no', '$salesperson_id', '$customer_id', '$date' )";
    $insert = $mysqli->query($sql);

    // Print response from MySQL
    if ( $insert ) {
      echo "Success! Row ID: {$mysqli->insert_id}";
      echo "<a href=add_sale.php>Back to Add Sale</a>";
    } else {
      die("Error: {$mysqli->errno} : {$mysqli->error}");
    }

    // Close our connection
    $mysqli->close();
?>
