<?php
require 'init.php';

$lowerf = //file_get_contents('comp.rxr');
          file_get_contents('O:\programacion\biosmind\ZenDict\lowerf');
echo "mb and raw len: " . mb_strlen($lowerf) . " / " . strlen($lowerf);
$lowerlen = strlen(utf8_decode($lowerf));

// do func for a part, pass init $i, return $a
// or all in a for for better performance
$a = "";
for ($i=0; $i < $lowerlen; $i+=2) {
  $a .= $lowerf[$i];
}

$b = "";
for ($i=1; $i < $lowerlen; $i+=2) {
  $b .= $lowerf[$i];
}
//---------

echo "\n xoring it";
$xor = $a ^ $b;

file_put_contents('comp.rxr', $xor);
echo "xored size: " . strlen(utf8_decode($xor));
