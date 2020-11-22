<?php
try{
$conn = new PDO('mysql:host=localhost; dbname=universidadbd', 'root', '');
} catch(PDOException $e){
   echo "Error: ". $e->getMessage();
   die();
}
?>