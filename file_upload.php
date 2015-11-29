<?php
$stock_no = $_GET['id'];
if(isset($_POST['btn-upload']))
{
  require_once('config.php');
  //creates a random file name to prevent duplication
 $file = rand(1000,100000)."-".$_FILES['file']['name'];
 $file_loc = $_FILES['file']['tmp_name'];
 $file_size = $_FILES['file']['size'];
 $file_type = $_FILES['file']['type'];
 $folder="uploads/";
 $stock_no = $_POST['stock_no'];

 move_uploaded_file($file_loc,$folder.$file);
 $sql="INSERT INTO images(file,type,size,stock_no) VALUES('$file','$file_type','$file_size','$stock_no')";
 mysql_query($sql);

}

?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>File Upload and view With PHP and MySql</title>
</head>
<body>
<form action="file_upload.php" method="post" enctype="multipart/form-data">
<input type="file" name="file" />
<?php echo '<input type ="hidden" name="stock_no" value="' . $stock_no . '">'; ?>
<button type="submit" name="btn-upload">Upload</button>
</form>
TEST
<?php echo '<a href=vehicles.php?id=' . $stock_no . '>Back to Car Page</a>'; ?>

</body>
</html>
