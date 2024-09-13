<?php

$target_dir = "/tmp";
$uploaded = true;

if (isset($_POST["submit"])) {
    $target_file = $target_dir . basename($_FILES["upload"]["name"]);
    if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
        echo "<br/>Uploaded to ". $target_file. " with size of " .$_FILES["upload"]["size"]. "<br/>";
    }
    
}

?>

<?=form_open_multipart();?>
  Select image to upload:
  <input type="file" name="upload">
  <input type="submit" value="Upload Image" name="submit">
<?=form_close();?>