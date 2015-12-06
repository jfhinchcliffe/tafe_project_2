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
<?php

echo '<h4><a href=manufacturer.php>Add new manufacturer</a>   <a href=category.php>Add new category</a></h4>';

if (isset($_GET["id"])){
  $car_id = $_GET["id"];

  require_once('config.php');


  $car_query = "SELECT * FROM car include WHERE stock_no = $car_id";
  $car_results = mysql_query($car_query, $conn);
  if (!$car_results) {
    die ("Error selecting customer data: " .mysql_error());
  }
  else {
    while ($row = mysql_fetch_array($car_results)) {
      echo '<h3>Edit Car</h3>';
      echo '<h4>Edit car information and submit.</h4>';
      echo '<div id=car_form_all>';
      echo '<table>';
      echo '<FORM enctype="multipart/form-data"method="post" action="edit_car_processor.php">';
      if ($row["available"] == 1 ){
        echo '<tr><td>Available?:</td><td><input type="checkbox" name="available" checked></td></tr>';
      } else {
        echo '<tr><td>Available?:</td><td><input type="checkbox" name="available"></td></tr>';
      }
      echo '<tr><td>Price:</td><td><input type="text" name ="price"value = ' . $row[price] .'></td></tr>';
      echo '<tr><td>Description:</td><td><textarea name="description" rows="4">' . $row[description] .'</textarea></td></tr>';
      if ($row["on_special"] == 1){
        echo '<tr><td>On Special?:</td><td><input type="checkbox" name="on_special" checked></td></tr>';
      } else {
        echo '<tr><td>On Special?:</td><td><input type="checkbox" name="on_special"></td></tr>';
      }
      echo '<tr><td>Manufacturer:</td><td><select name="manufacturer">';
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
      echo '</td></tr>';
      echo '<tr><td>Model:</td><td><input type ="text" name="model" size="20" value = ' . $row[model] .'></td></tr>';
      echo '<tr><td>Category:</td><td><select name="category">';
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
      echo '</td></tr>';

      echo '<tr><td>Year:</td><td><input type ="text" name="year" size="4" value = ' . $row[year] .'></td></tr>';
      echo '<tr><td>Kilometres:</td><td><input type ="text" name="kilometres" size="20" value = ' . $row[kilometres] .'></td></tr>';
      echo '<tr><td>Colour:</td><td><input type ="text" name="colour" size="20" value = ' . $row[colour] .'></td></tr>';
      echo '<tr><td>Registration:</td><td><input type ="text" name="registration" size="6" value = ' . $row[registration] .'></td></tr>';
      echo '<tr><td>VIN:</td><td><input type ="text" name="vin" size="17" value = ' . $row[vin] .'></td></tr>';
      echo '<tr><td>Cylinders:</td><td><input type ="text" name="cylinders" size="2" value = ' . $row[cylinders] .'></td></tr>';
      echo '<tr><td>Fuel:</td><td><input type ="text" name="fuel" size="20" value = ' . $row[fuel] .'></td></tr>';
      echo '<tr><td>Transmission:</td><td><input type ="text" name="transmission" size="20" value = ' . $row[transmission] .'></td></tr>';
      echo '<input type ="hidden" name="stock_no" value="' . $row[stock_no] . '">';
      echo '<input type ="hidden" name="formtype" value="new_car">';
      echo '<tr><td><input type="submit" name="btn-submit_edit_car" value= "Submit"></td></tr>';
    }
    echo '</table>';
    echo '</div>';
    echo '<div id=car_image_upload>';
    echo '<p><h4><a href=file_upload.php?id=' . $car_id .'>Upload Image</a></h4></p>';
    ?>
      <?php
          $getData = mysql_query("SELECT file FROM images include WHERE stock_no = $car_id");

          while($viewData = mysql_fetch_array($getData))
          {
              echo '<img src="uploads/' . $viewData['file'] . '" >';
           }
      ?>
      <?php
      echo '</div>';
      echo '<p><a href=vehicles.php>Back to all vehicles</a></p>';

  }

} else {
  ?>

    <div id="car_form_all">
    <h3>New Car</h3>
    <h4>Enter new car information and submit.</h4>

    <table>
    <FORM enctype="multipart/form-data" method="post" action="new_car_processor.php">

      <tr><td>Available?:</td><td><input type="checkbox" name="available"></td></tr>
      <tr><td>Price:</td><td><input type="text" name ="price" ></td></tr>
      <tr><td>Description:</td><td><textarea rows="3" name="description"></textarea></td></tr>
      <tr><td>On Special?:</td><td><input type="checkbox" name="on_special"></td></tr>
      <tr><td>Manufacturer:</td><td><select name="manufacturer">

        <?php
            require_once('config.php');
            $getData = mysql_query("SELECT * FROM manufacturer");

            while($viewData = mysql_fetch_array($getData))
            { ?>
                <option id="<?php echo $viewData['id']; ?>"><?php echo $viewData['name']; ?></option>
            <?php } ?>
        ?>
        </select>
      </td></tr>
      <tr><td><p> Model:</td><td><input type ="text" name="model" size="20"></p></td></tr>
      <tr><td><p>Category:</td><td><select name="category">

        <?php
            $getData = mysql_query("SELECT * FROM category");

            while($viewData = mysql_fetch_array($getData))
            { ?>
                <option id="<?php echo $viewData['id']; ?>"><?php echo $viewData['description']; ?></option>
            <?php } ?>
        ?>
        </select>
      </td></tr>

      <tr><td>Year:</td><td><input type ="text" name="year" size="4"></td></tr>
      <tr><td>Kilometres:</td><td><input type ="text" name="kilometres" size="20"></td></tr>
      <tr><td>Colour:</td><td><input type ="text" name="colour" size="20"></td></tr>
      <tr><td>Registration:</td><td><input type ="text" name="registration" size="6"></td></tr>
      <tr><td>VIN:</td><td><input type ="text" name="vin" size="17"></td></tr>
      <tr><td>Cylinders:</td><td><input type ="text" name="cylinders" size="2"></td></tr>
      <tr><td>Fuel:</td><td><input type ="text" name="fuel" size="20"></td></tr>
      <tr><td>Transmission:</td><td><input type ="text" name="transmission" size="20"></td></tr>
      <tr><td>image:</td><td><input type ="text" name="phone" size="20"></td></tr>
      <input type ="hidden" name="formtype" value="new_car">
      <tr><td><input type="submit" name="submit" value= "Submit">
      <input type ="reset" name="reset" value ="Reset"></td></tr>

    </form>
  </table>
  </div>


    <?php
      echo '<div id=car_form_all>';
      echo '<h3>Current Cars</h3>';
      require_once('config.php');

      $query = "SELECT * FROM car";
      $results = mysql_query($query, $conn);
      if (!$results) {
        die ("Error selecting car data: " .mysql_error());
    }
    else {
      echo '<table class="car_table">';
      echo "<tr><th>Registration</th><th>Available</th><th>On Special</th></tr>";
      while ($row = mysql_fetch_array($results)) {
        echo "<tr>";
        echo "<td> <a href=vehicles.php?id=$row[stock_no]>$row[registration]</a></td>";
        echo "<td> $row[available] </td>";
        echo "<td> $row[on_special] </td>";
        echo "<tr>";
      }
      echo "</table>";
      echo "</div>";
    };
  }
  ?>
  </div>
</div>
<?php include 'footer.php' ?>
