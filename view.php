<?php
require_once 'vendor/autoload.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem('template');
$twig = new Twig_Environment($loader, array(
    'cache' => 'compilation_cache',
    'debug' => true,
    'cache' => false,
));
$template = $twig->loadTemplate('view.html');

if(isset($_GET["message"])){
  $message = $_GET["message"];
} else {
  $message = '';
}
$target_file = $_GET["file"];


// Pass all variables to the template
echo $twig->render('view.html', array(
  'title' => 'Fast Image Uploader',
  'description' => $message,
  'image' => 'uploads/' . $target_file,
)); 
?>

