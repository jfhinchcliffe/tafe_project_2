<?php
  session_start();
  if(!$_SESSION["logged_in"]){
    header("location:home.php");
    die;
  }
?>
<?php
  require_once('config.php');

  $query = "SELECT category_id,description FROM category";
  $category_results = mysql_query($query, $conn);
  if (!category_results) {
    die ("Error selecting car data: " .mysql_error());
  }
?>
<?php include 'header.php' ?>

  <div id="maincontent">

    <h3>Enter the car information and submit.</h3>

    <FORM method="post" action="new_car_processor.php">

      <p> Available?: <input type="checkbox" name="available"></p>
      <p> Price: <input type="text" name ="price" size="40"></p>
      <p> Description: <input type="text" name="description"></p>
      <p> On Special?: <input type="checkbox" name="on_special"></p>
      <p>Manufacturer: <select name="manufacturer">
        <option id="0">-- Select an Option --</option>

        <?php
            $getData = mysql_query("SELECT * FROM manufacturer");

            while($viewData = mysql_fetch_array($getData))
            { ?>
                <option id="<?php echo $viewData['id']; ?>"><?php echo $viewData['name']; ?></option>
            <?php } ?>
        ?>
        </select>
      </p>
      <p> Model: <input type ="text" name="model" size="20"></p>
      <p>Category: <select name="category">
        <option id="0">-- Select an Option --</option>

        <?php
            $getData = mysql_query("SELECT * FROM category");

            while($viewData = mysql_fetch_array($getData))
            { ?>
                <option id="<?php echo $viewData['id']; ?>"><?php echo $viewData['description']; ?></option>
            <?php } ?>
        ?>
        </select>
      </p>

      <p> Year: <input type ="text" name="year" size="4"></p>
      <p> Kilometres: <input type ="text" name="kilometres" size="20"></p>
      <p> Colour: <input type ="text" name="colour" size="20"></p>
      <p> Registration: <input type ="text" name="registration" size="6"></p>
      <p> VIN: <input type ="text" name="vin" size="17"></p>
      <p> Cylinders: <input type ="text" name="cylinders" size="2"></p>
      <p> Fuel: <input type ="text" name="fuel" size="20"></p>
      <p> Transmission: <input type ="text" name="transmission" size="20"></p>
      <p> image: <input type ="text" name="phone" size="20"></p>
      <input type ="hidden" name="formtype" value="new_car">
      <input type="submit" name="submit" value= "Submit">
      <input type ="reset" name="reset" value ="Reset">

    </form>

    <?php
      require_once('config.php');

      $query = "SELECT * FROM car";
      $results = mysql_query($query, $conn);
      if (!$results) {
        die ("Error selecting car data: " .mysql_error());
    }
    else {
      while ($row = mysql_fetch_array($results)) {
        echo "<p> $row[year] </p>";
        echo "<p> $row[manufacturer] </p>";
        echo "<p> $row[model] </p>";
        echo "<p> $row[price] </p>";
      }
    }
    ?>

  </div>
<?php include 'footer.php' ?>
