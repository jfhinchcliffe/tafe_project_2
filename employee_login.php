<?php
  session_start();
  if($_SESSION["logged_in"]){
    header("location:employee_page.php");
    die;
  }
?>

<?php include 'header.php' ?>

  <div id="maincontent">

    <h3>Please enter your login information below</h3>

    <FORM method="post" action="login.php">

      Salesperson Email: <INPUT TYPE="TEXT" name="email" size="20">
      Password: <INPUT TYPE="PASSWORD" name="password" size="20">
      <INPUT TYPE="submit" name="submit" value="Login">

    </form>
  </div>
<?php include 'footer.php' ?>
