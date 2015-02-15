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

// Build an array of loaded images, saved as $files
$dir = 'uploads/thumbs/';
$files = scandir($dir);
$removed = array_shift($files);
$removed = array_shift($files);
$files = array_reverse($files);


// Pass all variables to the template
echo $twig->render('index.html', array(
  'title' => 'Fast Image Uploader',
  'description' => 'A fast way to upload images to the web',
  'files' => $files,
)); 
?>


