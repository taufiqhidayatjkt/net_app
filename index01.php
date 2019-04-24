<?php

echo "met datang opick<br>";
$jam = date('H:i:s');
echo "sekarang jam : ".$jam;

echo "<br>";
echo "<br>";

$a = 1;
while ($a <= 10) {
  // code...
  $a*=3;
  echo $a."<br>";
}

echo "<br>";
echo "<br> ini adalah bilangan genap <br>";

for ($i=0; $i <=10 ; $i+=2) {

  echo $i . "<br>";

}

echo "<br> ini adalah bilangan ganjil<br>";

for ($i=1; $i <=10 ; $i+=2) {

  echo $i . "<br>";

}
