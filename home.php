<?php include 'header.php' ?>
  <div id="maincontent">

    <h3>Welcome to West Coast Auto</h3>

    <?php
        //PHP to pull 3 random images from the database for display on the front page
        require_once('config.php');
        $getData = mysql_query("SELECT file FROM images ORDER BY RAND() LIMIT 3;");

        while($viewData = mysql_fetch_array($getData))
        {
            echo '<img src="uploads/' . $viewData['file'] . '" width="300">';
         }
    ?>
    

  </div>
<?php include 'footer.php' ?>
