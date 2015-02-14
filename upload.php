<?php
$target_dir = "uploads/";
$timestamp = date('Ymdhis');

$original_path = $_FILES['fileToUpload']['name'];
$extension = end(explode(".", $original_path));
$target_file = $target_dir . $timestamp . '.' . $extension;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 10000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

if ($uploadOk == 1){
  $size = getimagesize($target_file);
  $ratio = $size[0]/$size[1];
  if ($ratio > 1){
    $width = 100;
    $height = 100/$ratio;
  } else {
    $width = 100*$ratio;
    $height = 100;
  }

  $src = imagecreatefromstring(file_get_contents($target_file));
  $dst = imagecreatetruecolor($width,$height);
  imagecopyresampled($dst,$src,0,0,0,0,$width,$height,$size[0],$size[1]);
  imagejpeg($dst, 'uploads/thumbs/' . $timestamp . '.jpg');





  print '<img src=' . $target_file . ' />';
}
?>
