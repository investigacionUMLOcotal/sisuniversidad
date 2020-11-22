<?php
try{
   $GLOBALS['conn'] = new PDO('mysql:host=localhost; dbname=sis_universidad', 'root', 'password');
} catch(PDOException $e){
   echo "Error: ". $e->getMessage();
   die();
}
?>