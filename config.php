<?php
$username = "root";
$password = "root";
$hostname = "localhost";

//connection to the database
$conn = @mysql_connect($hostname, $username, $password)
  or die("Unable to connect to MySQL");
echo "Connected to MySQL<br>";

if (mysql_select_db("w_c_a", $conn)) {
  echo ("<p>Database selection successful</p>");
}
else {
  die ("Could not locate w_c_a database" .mysql_error());
}

?>
