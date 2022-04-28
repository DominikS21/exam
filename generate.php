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
  $conn->query("
    INSERT INTO images (name, picsum_id, author, width, height, added_at) VALUES ('{$faker->name}', '$losowa', '{$contentarray->author}', '$contentarray->width', '$contentarray->height', '$data')
    ");
}
?>