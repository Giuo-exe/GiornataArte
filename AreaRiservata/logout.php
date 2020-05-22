<?php
if (isset($_SERVER['HTTP_COOKIE'])) {
  $check=false;
  $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
  foreach($cookies as $cookie) {
      $parts = explode('=', $cookie);
      $name = trim($parts[0]);
      setcookie($name, '', time()-1000);
      setcookie($name, '', time()-1000, '/');
      $check=true;
  }
  if($check){
    $_SESSION["token"]="";
    header("Location: ../index.php");
  }
}
 ?>
