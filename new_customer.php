<?php include 'header.html' ?>
  <div id="maincontent">
    <h3>Enter the customer information and submit.</h3>

    <FORM method="post" action="new_customer_processor.php">

      <p> Name: <input type="text" name="name" size = "40"></p>
      <p> Address: <input type="text" name ="address" size="40"></p>
      <p> Email: <input type="text" name="email" value=username@domain.com></p>
      <p> Phone: <input type ="text" name="phone" size="20"></p>
      <input type ="hidden" name="formtype" value="new_customer">
      <input type="submit" name="submit" value= "Submit">
      <input type ="reset" name="reset" value ="Reset">

    </form>
  </div>
<?php include 'footer.html' ?>
