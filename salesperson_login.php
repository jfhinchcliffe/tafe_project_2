<html>
  <?php include 'header.php' ?>
  <head>
    <title>Salesperson Login</title>
  </head>
  <body>

    <h3>Please enter your login information below</h3>

    <FORM method="post" action="salesperson_login_processor.php">

        Salesperson Email:</td><td><INPUT TYPE="TEXT" name="email" size="20">
        Password:</td><td><INPUT TYPE="TEXT" name="password" size="20">
        <INPUT TYPE="submit" name="submit" value="Login">
        <INPUT TYPE="reset" name="reset" value="Reset">

    </form>
    <?php print_r($_COOKIE); ?>

    <?php include 'footer.php' ?>

  </body>
</html>
