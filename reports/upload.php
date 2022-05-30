
<?php


if(isset($_FILES['upload']['name'])){
 $file = $_FILES['upload']['tmp_name'];
 $file_name = $_FILES['upload']['name'];
 $file_name_array = explode(".", $file_name);
 $extension = end($file_name_array);
echo $new_image_name = rand() . '.' . $extension;
 chmod('upload', 0777);
  move_uploaded_file($file, '../file/' . $new_image_name);
  $function_number = $_GET['CKEditorFuncNum'];
  $ip=$_SERVER['REMOTE_ADDR'];
  $url = '../file/'. $new_image_name;
  $message = '';
  echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";
}
 // $sql = "INSERT INTO email_templete (photo) VALUES ($new_image_name')";
 //  $result = mysql_query($sql);
?>