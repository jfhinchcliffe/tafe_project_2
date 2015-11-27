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
        echo "<h3>Edit Customer</h3>";
        echo "<FORM method='post' action='edit_customer_processor.php'>";
          echo '<p> Name: <input type="text" name="name" size = "40" value=' . $row[name] . '></p>';
          echo '<p> Address: <input type="text" name ="address" size="40" value=' . $row[address] . '></p>';
          echo '<p> Email: <input type="text" name="email" value=' . $row[email] . '></p>';
          echo '<p> Phone: <input type ="text" name="phone" size="20" value=' . $row[phone] . '></p>';
          echo '<input type ="hidden" name="customer_id" value="' . $row[customer_id] . '">';
          echo '<input type ="hidden" name="formtype" value="edit_customer">';
          echo '<input type="submit" name="submit" value= "Update">';
        echo '</form>';
      }
    }
  } else {
    // If there isn't an ID, display the New Customer form and all customers below, with links
    // to their edit pages.

    echo "<h3>Enter new customer information and submit.</h3>";

    echo "<FORM method='post' action='new_customer_processor.php'>";

      echo '<p> Name: <input type="text" name="name" size = "40"></p>';
      echo '<p> Address: <input type="text" name ="address" size="40"></p>';
      echo '<p> Email: <input type="text" name="email"></p>';
      echo '<p> Phone: <input type ="text" name="phone" size="20"></p>';
      echo '<input type ="hidden" name="formtype" value="new_customer">';
      echo '<input type="submit" name="submit" value= "Submit">';
      echo '<input type ="reset" name="reset" value ="Reset">';

    echo '</form>';

    require_once('config.php');
    echo "<h3>Current Customers</h3>";
    $query = "SELECT * FROM customer";
    $results = mysql_query($query, $conn);
    if (!$results) {
      die ("Error selecting customer data: " .mysql_error());
  }
  else {
    // In the absence of an ID, all customers will be displayed down
    // the bottom of the page
    while ($row = mysql_fetch_array($results)) {
      echo "<a href=customers.php?id=";
      echo $row[customer_id];
      echo "><p> $row[name] </p></a>";
      echo "<p> $row[address] </p>";
      echo "<p> $row[phone] </p>";
      echo "<p> $row[email] </p>";
    }
  }
      }
?>
<a href="customers.php">Back to Customers Page</a>

</div>
<?php include 'footer.html' ?>
