<?php 
require_once 'vendor/autoload.php'; 
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('template');
$twig = new Twig_Environment($loader, array(
    'cache' => 'compilation_cache',
    'debug' => true,
    'cache' => false,
));
$template = $twig->loadTemplate('index.html');

echo $twig->render('index.html', array(
  'title' => 'Fast Image Uploader',
  'description' => 'A fast way to upload images to the web',
)); 
?>

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
