<?php
  $username = "root";
  $password = "root";
  $hostname = "localhost";
  //connection to the database
  $conn = @mysql_connect($hostname, $username, $password)
    or die("Unable to connect to MySQL");
  //echo "Connected to MySQL<br>";
  if (mysql_select_db("w_c_a", $conn)) {
    //echo ("<p>Database selection successful</p>");
  }
  else {
    die ("Could not locate w_c_a database" .mysql_error());
  }
  // Select salesperson that matches both username and password
  $sql = "SELECT * FROM salesperson WHERE email= '$_POST[email]' AND password = '$_POST[password]'";
  $result = mysql_query($sql,$conn) or die(mysql_error());
  // if there's a value returned, assign the values to variables.
  if (mysql_num_rows($result) == 1){
    $name = mysql_result($result, 0, 'name');
    $email = mysql_result($result, 0, 'email');
    $id = mysql_result($result, 0, 'salesperson');
    // set a cookie with the email as a value which expires in a day
    session_start();
    $_SESSION["logged_in"] = $id;
    //spit out cookie value
    header("location:employee_page.php");
  } else {
      echo ("<p>Incorrect username or password</p>");
      echo ("<p>Please try <a href=employee_login.php>logging in again</a></p>");
    exit;
  }
?>
