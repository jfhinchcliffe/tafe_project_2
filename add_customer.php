<?php
  session_start();
  if(!$_SESSION["logged_in"]){
    header("location:home.php");
    die;
  }
?>
<?php include 'header.html' ?>
  <div id="maincontent">

    <h3>Enter the customer information and submit.</h3>

    <FORM method="post" action="new_customer_processor.php">

      <p> Name: <input type="text" name="name" size = "40"></p>
      <p> Address: <input type="text" name ="address" size="40"></p>
      <p> Email: <input type="text" name="email"></p>
      <p> Phone: <input type ="text" name="phone" size="20"></p>
      <input type ="hidden" name="formtype" value="new_customer">
      <input type="submit" name="submit" value= "Submit">
      <input type ="reset" name="reset" value ="Reset">

    </form>
    <?php
      require_once('config.php');

      $query = "SELECT * FROM customer";
      $results = mysql_query($query, $conn);
      if (!$results) {
        die ("Error selecting customer data: " .mysql_error());
    }
    else {
      while ($row = mysql_fetch_array($results)) {
        echo "<a href=customer.php?id=";
        echo $row[customer_id];
        echo "><p> $row[name] </p></a>";
        echo "<p> $row[address] </p>";
        echo "<p> $row[phone] </p>";
        echo "<p> $row[email] </p>";
      }
    }
    ?>
  </div>

<?php include 'footer.html' ?>
