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

echo '<h4><a href=manufacturer.php>Add new manufacturer</a>   <a href=category.php>Add new category</a></h4>';

if (isset($_GET["id"])){
  $car_id = $_GET["id"];

  require_once('config.php');


  $car_query = "SELECT * FROM car WHERE stock_no = $car_id";
  $car_results = mysql_query($car_query, $conn);
  if (!$car_results) {
    die ("Error selecting customer data: " .mysql_error());
  }
  else {
    while ($row = mysql_fetch_array($car_results)) {
      echo '<h3>Edit car information and submit.</h3>';
      echo '<FORM method="post" action="edit_car_processor.php">';
      if ($row["available"] == 1 ){
        echo '<p> Available?: <input type="checkbox" name="available" checked></p>';
      } else {
        echo '<p> Available?: <input type="checkbox" name="available"></p>';
      }
      echo '<p> Price: <input type="text" name ="price" size="40" value = ' . $row[price] .'></p>';
      echo '<p> Description: <input type="text" name="description" value = ' . $row[description] .'></p>';
      if ($row["on_special"] == 1){
        echo '<p> On Special?: <input type="checkbox" name="on_special" checked></p>';
      } else {
        echo '<p> On Special?: <input type="checkbox" name="on_special"></p>';
      }
      echo '<p>Manufacturer: <select name="manufacturer">';
      ?>
      <?php
          $getData = mysql_query("SELECT * FROM manufacturer");

          while($viewData = mysql_fetch_array($getData))
          { ?>
              <option id="<?php echo $viewData['id']; ?>"><?php echo $viewData['name']; ?></option>
          <?php } ?>
        ?>
        </select>
      <?php
      echo '</p>';
      echo '<p> Model: <input type ="text" name="model" size="20" value = ' . $row[model] .'></p>';
      echo '<p>Category: <select name="category">';
      ?>
        <?php
            $getData = mysql_query("SELECT * FROM category");

            while($viewData = mysql_fetch_array($getData))
            { ?>
                <option id="<?php echo $viewData['id']; ?>"><?php echo $viewData['description']; ?></option>
            <?php } ?>
        ?>
        <?php
        echo '</select>';
      echo '</p>';

      echo '<p> Year: <input type ="text" name="year" size="4" value = ' . $row[year] .'></p>';
      echo '<p> Kilometres: <input type ="text" name="kilometres" size="20" value = ' . $row[kilometres] .'></p>';
      echo '<p> Colour: <input type ="text" name="colour" size="20" value = ' . $row[colour] .'></p>';
      echo '<p> Registration: <input type ="text" name="registration" size="6" value = ' . $row[registration] .'></p>';
      echo '<p> VIN: <input type ="text" name="vin" size="17" value = ' . $row[vin] .'></p>';
      echo '<p> Cylinders: <input type ="text" name="cylinders" size="2" value = ' . $row[cylinders] .'></p>';
      echo '<p> Fuel: <input type ="text" name="fuel" size="20" value = ' . $row[fuel] .'></p>';
      echo '<p> Transmission: <input type ="text" name="transmission" size="20" value = ' . $row[transmission] .'></p>';
      echo '<p> image: <input type ="text" name="phone" size="20" value = ' . $row[image] .'></p>';
      echo '<input type ="hidden" name="stock_no" value="' . $row[stock_no] . '">';
      echo '<input type ="hidden" name="formtype" value="new_car">';
      echo '<input type="submit" name="submit" value= "Submit">';
    }
    echo '<a href=vehicles.php>Back to all vehicles</a>';
  }
} else {
  ?>

    <h3>Enter new car information and submit.</h3>

    <FORM method="post" action="new_car_processor.php">

      <p> Available?: <input type="checkbox" name="available"></p>
      <p> Price: <input type="text" name ="price" size="40"></p>
      <p> Description: <input type="text" name="description"></p>
      <p> On Special?: <input type="checkbox" name="on_special"></p>
      <p>Manufacturer: <select name="manufacturer">

        <?php
            require_once('config.php');
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
        echo "<p><a href=vehicles.php?id=$row[stock_no]>$row[year]</a></p>";
        echo "<p> $row[manufacturer] </p>";
        echo "<p> $row[model] </p>";
        echo "<p> $row[price] </p>";
      }
    }

  }
  ?>
  </div>
<?php include 'footer.html' ?>
