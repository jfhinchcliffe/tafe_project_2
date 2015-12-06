<?php include 'header.php' ?>
  <div id="maincontent">
    <div id="car_form_container">
    <h3>Welcome to West Coast Auto</h3>
  </div>
    <p>Humblebrag gluten-free offal vinyl portland godard distillery, quinoa kale chips chambray art party disrupt crucifix bushwick. Cornhole fingerstache single-origin coffee, health goth typewriter asymmetrical literally before they sold out roof party occupy lomo kitsch. Bitters retro marfa jean shorts, everyday carry sartorial pinterest. Venmo polaroid godard paleo humblebrag, aesthetic gentrify quinoa post-ironic pour-over fanny pack skateboard you probably haven't heard of them. Kogi stumptown everyday carry, PBR&B vice shoreditch raw denim hoodie etsy post-ironic church-key messenger bag tousled pork belly. Sustainable letterpress master cleanse single-origin coffee polaroid. Truffaut brooklyn master cleanse, kogi pitchfork YOLO direct trade chia humblebrag paleo mixtape fanny pack bitters narwhal.</p>
  </p>
  <div id="car_form_container">
  <h4>See below for a random sample of our excellent cars!</h4>
</div>
    <?php
        //PHP to pull 3 random images from the database for display on the front page
        require_once('config.php');
        $getData = mysql_query("SELECT file FROM images ORDER BY RAND() LIMIT 3;");

        while($viewData = mysql_fetch_array($getData))
        {
            echo '<img class="css-img" src="uploads/' . $viewData['file'] . '" width="33%">';
         }
    ?>

    </div>

  </div>

<?php include 'footer.php' ?>
