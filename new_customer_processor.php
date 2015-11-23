
<?php
  //checking for values in customer form. Doing this up here because header won't work otherwise.
  if (($_POST['name']== "")||
      ($_POST['address']== "")|| ($_POST['phone'] == "") || ($_POST['email'] == "")){
    header("Location: new_customer.php");
    exit;
  }
  //ensure that the phone number is an integer.
  if (is_numeric ($_POST['phone'])){
    settype($_POST['phone'], "integer");
  } else {
    header("Location: new_customer.php");
    exit;
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
    }

    // Insert our data
    $sql = "INSERT INTO customer ( name, address, phone, email ) VALUES ( '{$mysqli->real_escape_string($_POST['name'])}', '{$mysqli->real_escape_string($_POST['address'])}', '{$mysqli->real_escape_string($_POST['phone'])}', '{$mysqli->real_escape_string($_POST['email'])}' )";
    $insert = $mysqli->query($sql);

    // Print response from MySQL
    if ( $insert ) {
      echo "Success! Row ID: {$mysqli->insert_id}";
      echo "<a href=add_customer.php>Back to Add Customers</a>";
    } else {
      die("Error: {$mysqli->errno} : {$mysqli->error}");
    }

    // Close our connection
    $mysqli->close();

  ?>
</div>
<?php include 'footer.html' ?>
