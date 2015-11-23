<?php
  session_start();
  if(!$_SESSION["logged_in"]){
    header("location:home.php");
    die;
  }
?>
<?php include 'header.html'; ?>
<div id='maincontent'>

<?php

  if (isset($_GET["id"])){
    $customer_id = $_GET["id"];

    require_once('config.php');

    $customer_query = "SELECT * FROM customer WHERE customer_id = $customer_id";
    $customer_results = mysql_query($customer_query, $conn);
    if (!$customer_results) {
      die ("Error selecting car data: " .mysql_error());
    }
    else {
      while ($row = mysql_fetch_array($customer_results)) {
        echo "<p> $row[name] </p>";
        echo "<p> $row[address] </p>";
        echo "<p> $row[phone] </p>";
        echo "<p> $row[email] </p>";
      }
    }
  } else {
      echo "Customer not found";
      }
?>
<a href="add_customer.php">Back to Add Customer</a>

</div>
<?php include 'footer.html' ?>
