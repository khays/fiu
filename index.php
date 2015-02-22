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

//Find the tags on the file name, save to $all_tags
$all_tags = array();
foreach ($files as $file){
  $tags = '';
  // Isolate the tags
  $tags = explode("-", $file);
  $removed = array_shift($tags);
  // get the last tag, and the extension
  $last_tag = array_pop($tags);
  // remove the extension
  $last_tag_wo_ext = preg_replace('/\\.[^.\\s]{3,4}$/', '', $last_tag);

  // Combine all the tags, without the extension
  array_push($tags, $last_tag_wo_ext);
  foreach($tags as $tag){
    array_push($all_tags, $tag);
  }
}

// remove blank and duplicate tags
$all_tags_final = array_unique((array_filter($all_tags)));

// Pass all variables to the template
echo $twig->render('index.html', array(
  'title' => 'Fast Image Uploader',
  'description' => 'A fast way to upload images to the web',
  'files' => $files,
)); 
?>


