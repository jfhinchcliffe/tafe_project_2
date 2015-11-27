<?php
$username = "root";
$password = "root";
$hostname = "localhost";

//connection to the database
$conn = @mysql_connect($hostname, $username, $password)
  or die("Unable to connect to MySQL");

if (mysql_select_db("w_c_a", $conn)) {
}
else {
  die ("Could not locate w_c_a database" .mysql_error());
}

?>
