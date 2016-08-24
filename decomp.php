<?php
require 'init.php';

### Decompressor
const ABC = 'abcdefghijklmnopqrstuvwxyz ';

$comp = chr(0x41) . chr(0x0F) . chr(0x11) . chr(0x01) . chr(0x1E);
//. 0x0F . 0x11 . 0x01 . 0x1E; // ' anarchism'; = 41 0F 11 01 1E = 'A    '
$abc = str_split (ABC);

$possibles = [];
// for possibles 0 to max word len
for ($i=0; $i < strlen($comp); $i++) {
  $c = $comp[$i];
  foreach ($abc as $key => $a) {
    foreach ($abc as $key => $b) {
      //echo "\n ($a$b) " . ($a^$b) . " $c";
      if (($a ^ $b) == $c) {
        $possibles[$i][$b . $a] = 1;
        $possibles[$i][$a . $b] = 1;
        //break 2;
      }
    }
  }
}

foreach ($possibles as $key => &$p) {
  $p = array_keys($p);
}
//var_dump($possibles);

$words = combinations($possibles);
foreach ($words as $key => $word) {
  //print_r (implode($word));
  $word = implode($word);
  if ($word == ' anarchism') {
    echo "Decomp: " . $word;
    break;
  }
}

// http://stackoverflow.com/questions/8567082/how-to-generate-in-php-all-combinations-of-items-in-multiple-arrays
function combinations($arrays, $i = 0) {
    if (!isset($arrays[$i])) {
        return array();
    }
    if ($i == count($arrays) - 1) {
        return $arrays[$i];
    }

    // get combinations from subsequent arrays
    $tmp = combinations($arrays, $i + 1);

    $result = array();

    // concat each array from tmp with each element from $arrays[$i]
    foreach ($arrays[$i] as $v) {
        foreach ($tmp as $t) {
            $result[] = is_array($t) ?
                array_merge(array($v), $t) :
                array($v, $t);
        }
    }

    return $result;
}
