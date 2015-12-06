<?php
  session_start();
  if(!$_SESSION["logged_in"]){
    header("location:home.php");
    die;
  }
?>

<?php include 'header.php' ?>
  <div id="maincontent">
      <?php
        require_once('config.php');
        $salesperson_id = $_SESSION["logged_in"];
        $query = "SELECT * FROM salesperson include WHERE salesperson = $salesperson_id";
        $results = mysql_query($query, $conn);
        if (!$results) {
          die ("Error selecting customer data: " .mysql_error());
      }
      else {
        while ($row = mysql_fetch_array($results)) {
          echo '<div id="employee_information">';
          echo "<h3>Employee Information</h3>";
          echo "<table>";
          echo "<tr><td><b>Name:</b></td><td> $row[name] </td></tr>";
          echo "<tr><td><b>Phone:</b></td><td> $row[phone] </td></tr>";
          echo "<tr><td><b>Email:</b></td><td> $row[email] </td></tr>";
          echo "</table>";
          echo "</div>";
        }
      }
    ?>
    <div id="employee_links">
      <ul>
        <li><a href="customers.php">Customers</a></li>
        <li><a href="vehicles.php">Vehicles</a></li>
        <li><a href="add_sale.php">Add a Sale</a></li>
        <li><a href="add_salesperson.php">Add a Salesperson</a></li>
      </ul>
    </div>

  </div>
<?php include 'footer.php' ?>
