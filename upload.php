<?php
// Testing to make sure directory exists
$target_dir = "uploads/";
$thumb_dir = "uploads/thumbs/";

if (file_exists($target_dir)){
  print 'it is there';
} else {
  print 'it is not there, creating';
  mkdir($target_dir, 0770);
}

if (file_exists($thumb_dir)){
  print 'thumb it is there';
} else {
  print 'it is not there, creating';
  mkdir($thumb_dir, 0770);
}

// Setting filename
date_default_timezone_set('America/Los_Angeles');
$timestamp = date('Ymdhis');
$tags = $_POST['tags'];
$tag_filename = '';
if ($tags != ''){ 
  $tag_list = explode(' ', $tags);
  foreach ($tag_list as $tag){
    $tag_filename .= '-';
    $tag_filename .= $tag;
  }
}

$original_path = $_FILES['fileToUpload']['name'];
$extension = end(explode(".", $original_path));
$target_file = $target_dir . $timestamp . $tag_filename . '.' . $extension;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

$message = '';
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $message .= "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    $message .= "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 10000000) {
    $message .= "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $message .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $message .= "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $message .= "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        $message .= "Sorry, there was an error uploading your file.";
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
  
  print $extension;
  $extension = strtolower($extension);
  switch ($extension){
    case "jpg":
      print 'this is a jpeg';
      imagejpeg($dst, 'uploads/thumbs/' . $timestamp . '.jpg');
      break;
    case "png";
      print 'this is a png';
      imagepng($dst, 'uploads/thumbs/' . $timestamp . '.png');
      break;
    case "gif";
      print 'this is a png';
      imagegif($dst, 'uploads/thumbs/' . $timestamp . '.gif');
      break;
  }

header("Location: view.php?message=" . urlencode($message) . "&file=" . urlencode($target_file));





}
?>
