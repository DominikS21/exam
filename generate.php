<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "exam";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
require_once 'vendor/autoload.php';
$faker = Faker\Factory::create();
foreach(range(1,20) as $x) {
  $losowa = rand(1,1000);
  $data = date("Y-m-d h:i:s");
  $content = file_get_contents('https://picsum.photos/id/'.$losowa.'/info');
  $contentarray = json_decode($content); 
  $name = $faker->name;
  $pattern = '/ /';
  $replacement = '_';
  $imagefil = preg_replace($pattern, $replacement, $name);
  $imagefile = $imagefil.'.jpg';
  file_put_contents('./images/'.$imagefile, $content);
  $conn->query("
    INSERT INTO images (name, picsum_id, imagefile, author, width, height, added_at) VALUES ('$name', '$losowa', '$imagefile', '{$contentarray->author}', '$contentarray->width', '$contentarray->height', '$data')
    ");
}
?>