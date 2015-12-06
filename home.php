<?php include 'header.php' ?>
  <div id="maincontent">

    <h3>Welcome to West Coast Auto</h3>

    <?php
        //PHP to pull 3 random images from the database for display on the front page
        require_once('config.php');
        $getData = mysql_query("SELECT file FROM images ORDER BY RAND() LIMIT 3;");
        echo '<div class="carousel-box">';



        echo '<ol class="content">';
        while($viewData = mysql_fetch_array($getData))
        {
            echo '<img class="css-img" src="uploads/' . $viewData['file'] . '" width="33%">';
         }
    ?>
    </div>

  </div>

<?php include 'footer.php' ?>
