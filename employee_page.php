<?php
  session_start();
  if(!$_SESSION["logged_in"]){
    header("location:home.php");
    die;
  }
?>

<?php include 'header.html' ?>
  <div id="maincontent">
    <?php
      echo ("User ID " . $_COOKIE[logged_in] . " is set!");
    ?>
      <?php
        require_once('config.php');
        $salesperson_id = $_SESSION["logged_in"];
        $query = "SELECT * FROM salesperson WHERE salesperson = $salesperson_id";
        $results = mysql_query($query, $conn);
        if (!$results) {
          die ("Error selecting customer data: " .mysql_error());
      }
      else {
        while ($row = mysql_fetch_array($results)) {
          echo "Employee Information";
          echo "<p> $row[name] </p>";
          echo "<p> $row[address] </p>";
          echo "<p> $row[phone] </p>";
          echo "<p> $row[email] </p>";
        }
      }
    ?>
    <a href="add_customer.php">Add a Customer</a>
    <a href="add_vehicle.php">Add a Vehicle</a>
    <a href="add_sale.php">Add a Sale</a>
    <a href="logout.php">Log Out!</a>

  </div>
<?php include 'footer.html' ?>
