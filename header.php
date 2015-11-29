<html>
  <head>
    <title>West Coast Auto</title>
    <link rel="stylesheet" type="text/css" href="/stylesheets/style.css">
  </head>
<body>
  <div id="container">
    <div id="topnav">
      <a href="home.php">Home</a>|
      <?php
      session_start();
      if($_SESSION["logged_in"]){
        echo '<a href="employee_page.php">Employee Page</a>|';
        echo '<a href="logout.php">Log Out!</a>|';
      } else {
        echo '<a href="employee_login.php">Employee Login</a>|';
      }
      ?>
      <a href="privacy_policy.php">Privacy Policy</a>
    </div>
    <div id="topbannerleft">
      <img src="images/west_coast_auto_logo.png">
    </div>
    <div id="topbannerright">
      Address info Here
    </div>
    <div id="header">
      <div id="navbar">
        <ul>
          <li><a href="home.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="specials.php">Specials</a></li>
          <li><a href="all_vehicles.php">Used Vehicles</a></li>
          <li><a href="finance.php">Finance</a></li>
          <li><a href="testimonials.php">Testimonials</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
      </div>
    </div>
