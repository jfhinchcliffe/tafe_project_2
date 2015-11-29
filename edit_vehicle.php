<?php include 'header.php'; ?>
<div id='maincontent'>

<?php

  if (isset($_GET["id"])){
    $vehicle_id = $_GET["id"];

    require_once('config.php');

    $vehicle_query = "SELECT * FROM car include WHERE stock_no = $vehicle_id";
    $vehicle_results = mysql_query($vehicle_query, $conn);
    if (!$vehicle_results) {
      die ("Error selecting car data: " .mysql_error());
    }
    else {
      while ($row = mysql_fetch_array($vehicle_results)) {
        echo "<h3>Edit Vehicle</h3>";
        echo "<FORM method='post' action='edit_vehicle_processor.php'>";
        if ($row[available] == 1) {
          echo '<p> Available?: <input type="checkbox" name="available" checked></p>';
        } else {
          echo '<p> Available?: <input type="checkbox" name="available"></p>';
        }
        echo '<p> Price: <input type="text" name ="price" size="40" value=' . $row[price] . '></p>';
        echo '<p> Description: <input type="text" name="description" value=' . $row[description] . '></p>';
        if ($row[on_special] == 1) {
          echo '<p> On Special?: <input type="checkbox" name="on_special" checked></p>';
        } else {
          echo '<p> On Special?: <input type="checkbox" name="on_special"></p>';
        }
        ?>

        <?php
        //looping through to get manufacturer variables
            echo '<p>Manufacturer: <select name="manufacturer">';
            //Need to figure out how to populate this field as the current value
            $getData = mysql_query("SELECT * FROM manufacturer");

            while($viewData = mysql_fetch_array($getData))
            {
              ?>
              <option id="<?php echo $viewData['id']; ?>"><?php echo $viewData['name']; ?></option>
            <?php } ?>
          </select>

        <?php
          echo '<p> Model: <input type="text" name ="model" size="40" value=' . $row[model] . '></p>';
        ?>

        <?php
          echo '<p>Category: <select name="category">';
          $getData = mysql_query("SELECT * FROM category");
          while($viewData = mysql_fetch_array($getData))
          {
            ?>
              <option id="<?php echo $viewData['id']; ?>"><?php echo $viewData['description']; ?></option>
          <?php } ?>

          </select>
        </p>

        <?php
        echo '<p> Year: <input type ="text" name="year" size="4" value=' . $row[year] . '></p>';
        echo '<p> Kilometres: <input type ="text" name="kilometres" size="20" value=' . $row[kilometres] . '></p>';
        echo '<p> Colour: <input type ="text" name="colour" size="20" value=' . $row[colour] . '></p>';
        echo '<p> Registration: <input type ="text" name="registration" size="6" value=' . $row[registration] . '></p>';
        echo '<p> VIN: <input type ="text" name="vin" size="17" value=' . $row[vin] . '></p>';
        echo '<p> Cylinders: <input type ="text" name="cylinders" size="2" value=' . $row[cylinders] . '></p>';
        echo '<p> Fuel: <input type ="text" name="fuel" size="20" value=' . $row[fuel] . '></p>';
        echo '<p> Transmission: <input type ="text" name="transmission" size="20" value=' . $row[transmission] . '></p>';
        echo '<p> image: <input type ="text" name="image" size="20" value=' . $row[image] . '></p>';
        echo '<input type ="hidden" name="stock_no" value="' . $row[stock_no] . '">';
        echo '<input type ="hidden" name="formtype" value="edit_car">';

        echo '<input type="submit" name="submit" value= "Update">';
        echo '<input type ="reset" name="reset" value ="Reset">';
        echo "</form>";
      }
    }
  } else {
      require_once('config.php');
      $column_counter = 0;
      $query = "SELECT * FROM car";
      $results = mysql_query($query, $conn);
      echo "<h2>Select vehicle to edit</h2>";
      echo "<table>";
      if (!$results) {
        die ("Error selecting car data: " .mysql_error());
      }
        else {
          while ($row = mysql_fetch_array($results)) {
            if ($column_counter == 0) {
              echo "<tr>";
              echo "<td>";
              echo "<a href=edit_vehicle.php?id=$row[stock_no]>";
              echo "<p> $row[registration] </p>";
              echo "</td>";
              $column_counter++;
            } else if ($column_counter == 1) {
              echo "<td>";
              echo "<a href=edit_vehicle.php?id=$row[stock_no]>";
              echo "<p> $row[registration] </p>";
              echo "</td>";
              $column_counter++;
            } else {
              echo "<td>";
              echo "<a href=edit_vehicle.php?id=$row[stock_no]>";
              echo "<p> $row[registration] </p>";
              echo "</td>";
              $column_counter = 0;
            }
          }
        }
        echo "</table>";
      }
?>

</div>
<?php include 'footer.php' ?>
