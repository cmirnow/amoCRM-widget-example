<?
header("Access-Control-Allow-Origin: *");
$array = ($_GET);

if (strpos($array[item_type], 'pseudo_not_light') !== false) {
    include 'pseudo_not_light';
} elseif (strpos($array[item_type], 'volumetric_als') !== false) {
    include 'volumetric_als';
} elseif (strpos($array[item_type], 'volumetric_pvc') !== false) {
    include 'volumetric_pvc';
} elseif (strpos($array[item_type], 'volumetric_side_light') !== false) {
    include 'volumetric_side_light';
} elseif (strpos($array[item_type], 'volumetric_kontrazhur') !== false) {
    include 'volumetric_kontrazhur';
}


if(empty($array[item_type]) OR empty($array[width]) OR empty($array[number_of_letters]) OR empty($array[height])) {
  echo 'Все поля формы должны быть заполнены.';
  } /* elseif(!preg_match("|^[\d]+$|", $array[number_of_letters])) {
  echo  'Введите, пожалуйста, любое количество букв от 1 и больше.';
  } */ elseif(!preg_match("|^[\d]+$|", $array[height])){
  echo  'Высота букв - целое число от 3 до 150';
} 
else {

$str = str_replace (" ", "", $array[number_of_letters]);
$str = mb_strlen($str, 'utf-8');

$h              = array_search($array[height], $array_h);
$w              = array_search($array[width], $array_w);


$price = $arr[$h][$w] * $str;
$costprice      = $price * 0.6;
$profit         = ($price - $costprice) / ($costprice / 100) / 100;

if ($price <= 15000) {
    $procent = 20;
} elseif ($price > 15001 && $price < 25000) {
    $procent = 17;
} elseif ($price > 25001 && $price < 40000) {
    $procent = 15;
} elseif ($price > 40001 && $price < 70000) {
    $procent = 12;
} else {
    $procent = 10;
}

$price_mounting = $price / 100 * $procent;
if ($price_mounting < 1500) {
$price_mounting = 1500;
}

echo 'Цена = ' . $price . ' руб.' . '<br>';
echo 'Себестоимость = ' . $costprice . ' руб.' . '<br>';
echo '% прибыли = ' . $profit . ' руб.' . '<br>';
echo 'Стоимость монтажа = ' . $price_mounting . ' руб.' . '</br>';
$total = $price + $price_mounting;
echo '% менеджера = ' . $total * 0.7 . '</br>';
echo '------------' . '</br>';
echo '<div style="color: #ff0000;">' . 'Итого ' . $total . ' руб.' . '</div>';

}
