<?php include 'header.php' ?>
  <div id="maincontent">
<?php
  // Pulling in hidden customer ID from post value
  $mysqli = new mysqli( 'localhost', 'root', 'root', 'w_c_a' );

    // Check our connection
    if ( $mysqli->connect_error ) {
      die( 'Connect Error: ' . $mysqli->connect_errno . ': ' . $mysqli->connect_error );
    }
  // Insert our data
  $sql = "UPDATE customer
     SET name = '".mysql_real_escape_string($_POST['name'])."',
     address = '".mysql_real_escape_string($_POST['address'])."',
     phone = '".mysql_real_escape_string($_POST['phone'])."',
     email = '".mysql_real_escape_string($_POST['email'])."'
     include WHERE customer_id='".mysql_real_escape_string($_POST['customer_id'])."'";

     echo ("UPDATE customer
        SET name = '".mysql_real_escape_string($_POST['name'])."',
        address = '".mysql_real_escape_string($_POST['address'])."',
        phone = '".mysql_real_escape_string($_POST['phone'])."',
        email = '".mysql_real_escape_string($_POST['email'])."'
        include WHERE customer_id='".mysql_real_escape_string($_POST['customer_id'])."'");
  $update = $mysqli->query($sql);

  echo "Customer updated: ";
  echo "<a href=customers.php?id=" . $_POST['customer_id'] . ">";
  echo "Back to Edit Customer</a>";
  ?>
</div>
<?php include 'footer.php' ?>
