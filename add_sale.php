<?php
  session_start();
  if(!$_SESSION["logged_in"]){
    header("location:home.php");
    die;
  }
?>
<?php include 'header.html' ?>
  <div id="maincontent">

    <h3>Enter the Sale Information and Submit.</h3>

    <FORM method="post" action="new_sale_processor.php">

      <p> Car:

        <p>Manufacturer: <select name="manufacturer">
          <option id="0">-- Select an Option --</option>

          <?php
              require_once('config.php');
              $getData = mysql_query("SELECT * FROM car");

              while($viewData = mysql_fetch_array($getData))
              {
                $long_description =  $viewData['registration'];
                ?>
                  <option id="<?php echo $viewData['stock_no']; ?>"><?php echo $long_description; ?></option>
              <?php } ?>
          ?>
          </select>
        </p>

      <p> Address: <input type="text" name ="address" size="40"></p>
      <p> Email: <input type="text" name="email"></p>
      <p> Phone: <input type ="text" name="phone" size="20"></p>
      <input type ="hidden" name="formtype" value="new_customer">
      <input type="submit" name="submit" value= "Submit">
      <input type ="reset" name="reset" value ="Reset">

    </form>
    <?php
      require_once('config.php');

      $query = "SELECT * FROM sale WHERE salesperson_id = $salesperson_id";
      $results = mysql_query($query, $conn);
      if ($results) {
      while ($row = mysql_fetch_array($results)) {
        echo "<p> $row[sale_id] </p>";
        echo "<p> $row[stock_no] </p>";
        echo "<p> $row[salesperson_id] </p>";
        echo "<p> $row[customer_id] </p>";
        echo "<p> $row[date] </p>";
      }

    }
    ?>
  </div>

<?php include 'footer.html' ?>
