<?php
  session_start();
  if(!$_SESSION["logged_in"]){
    header("location:home.php");
    die;
  }
?>
<?php include 'header.php' ?>
  <div id="maincontent">
    <div id="car_form_container">

    <h3>Enter the Sale Information and Submit.</h3>

    <FORM method="post" action="new_sale_processor.php">

        <p>Car Registration #: <select name="registration">
          <?php
              require_once('config.php');
              $getData = mysql_query("SELECT * FROM car include WHERE available = 1");

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
    <hr>
    <?php

      require_once('config.php');
      $salesperson_id = $_SESSION["logged_in"];
      $query = "SELECT * FROM sale include WHERE salesperson_id = $salesperson_id";
      $results = mysql_query($query, $conn);
      if ($results) {
      while ($row = mysql_fetch_array($results)) {

        echo "<p><b> Sell Date: $</b> $row[date] </p>";

        $stock_no = $row['stock_no'];
        $salesperson_id = $row['salesperson_id'];
        $customer_id = $row['customer_id'];

        require_once('config.php');

        $vehicle_query = "SELECT
        *
        FROM
        car
        WHERE
        stock_no = $stock_no";
        $vehicle_results = mysql_query($vehicle_query, $conn);
        if (!$vehicle_results) {
          die ("Error selecting car data: " .mysql_error());
        }
        else {
          while ($row = mysql_fetch_array($vehicle_results)) {
            echo "<p><b> Price: $</b> $row[price] </p>";
            echo "<p><b> Registration:</b> $row[registration] </p>";
          }
        }

        $salesperson_query = "SELECT
        name
        FROM
        salesperson
        WHERE
        salesperson = $salesperson_id";
        $salesperson_results = mysql_query($salesperson_query, $conn);
        if (!$salesperson_results) {
          die ("Error selecting car data: " .mysql_error());
        }
        else {
          while ($row = mysql_fetch_array($salesperson_results)) {
            echo "<p><b> Sold By: </b> $row[name] </p>";
          }
        }

        $customer_query = "SELECT
        name
        FROM
        customer
        WHERE
        customer_id = $customer_id";
        $customer_results = mysql_query($customer_query, $conn);
        if (!$customer_results) {
          die ("Error selecting car data: " .mysql_error());
        }
        else {
          while ($row = mysql_fetch_array($customer_results)) {
            echo "<p><b> Sold To: </b> $row[name] </p>";
            echo "<hr>";
          }
        }

      }

    }
    ?>
    </div>
  </div>

<?php include 'footer.php' ?>
