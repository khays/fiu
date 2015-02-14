<!DOCTYPE html>
<html>
<body>

<?php

function pm( $variable ){
  print '<pre>';
  print_r($variable);
  print '</pre>';
}

?>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

<?php
$dir = 'uploads/';
$files = scandir($dir);
$removed = array_shift($files);
$removed = array_shift($files);

pm($files);

foreach ($files as $file){
  print '<img src=' . $dir . $file . ' height="100px" width="100px" />';
}
?>

</body>
</html>
