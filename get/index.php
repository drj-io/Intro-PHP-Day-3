<?php
require_once('views/header.php');

if(isset($_GET['name'])){

  mail ("david.jones@madwiremedia.com",
  "you have a new comment!" ,
   $_GET['comment']);




  require_once('views/partials/hello.php');
}
else {
  include_once('views/partials/input.php');
}

?>
