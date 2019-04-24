<?php

function connect(){
  $conn = mysqli_connect("localhost","root","","net_phpdb","3306")or die ("ora konek");
  mysqli_autocommit($conn, false);
  return $conn;
}

?>
