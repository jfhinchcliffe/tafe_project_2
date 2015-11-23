<?php

/*check if form fields are blank. If they are, let the customer know and provide a link to return to the original customer details form*/

if ($_POST["gname"] ==""){
  echo "you need to enter your given name";
  echo "<a href='testform.html'>Return to details form</a>";
}
elseif ($_POST["fname"] =="") {
  echo "you need to enter your family name";
  echo "<a href='testform.html'>Return to details form</a>";

}
elseif($_POST["email"] == ""){
  echo "you need to enter your email address";
  echo "<a href='testform.html'>Return to details form</a>";

}
else {
  echo "<p> Your form has been submitted for processing</p>";
  echo "<p>$_POST[gname], $_POST[fname], $_POST[email]</p>";
}

require_once('config.php');



?>
