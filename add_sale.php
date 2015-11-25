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

        <p>Car Registration #: <select name="registration">
          <?php
              require_once('config.php');
              $getData = mysql_query("SELECT * FROM car WHERE available = 1");

              while($viewData = mysql_fetch_array($getData))
              {
                ?>
                  <option id="<?php echo $viewData['stock_no']; ?>"><?php echo $viewData['registration']; ?></option>
              <?php } ?>
          ?>
          </select>
        </p>
        <p>Sold By #: <select name="salesperson_name">
          <?php
              require_once('config.php');
              $getData = mysql_query("SELECT * FROM salesperson");

              while($viewData = mysql_fetch_array($getData))
              {
                ?>
                  <option id="<?php echo $viewData['salespeson']; ?>"><?php echo $viewData['name']; ?></option>
              <?php } ?>
          ?>
          </select>
        </p>

        <p>Sold To #: <select name="customer_id">
          <?php
              require_once('config.php');
              $getData = mysql_query("SELECT * FROM customer");

              while($viewData = mysql_fetch_array($getData))
              {
                ?>
                  <option id="<?php echo $viewData['customer_id']; ?>"><?php echo $viewData['name']; ?></option>
              <?php } ?>
          ?>
          </select>
        </p>
      <input type ="hidden" name="formtype" value="new_sale_processor">
      <input type="submit" name="submit" value= "Submit">
      <input type ="reset" name="reset" value ="Reset">

    </form>
    <?php
      require_once('config.php');
      $salesperson_id = $_SESSION["logged_in"];
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
