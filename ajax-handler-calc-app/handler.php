<?
header("Access-Control-Allow-Origin: *");
$dirname = 'https://fitness4brain.ru/ajax-handler-calc-app';
$array = ($_GET);
if (strpos($array[item_type], 'square_lightbox') !== false) {
  include 'square_lightbox';
  $pic = '<p><img src="'.$dirname.'/images/square_lightbox.png" style="width: 100%;"></p>';
} elseif (strpos($array[item_type], 'composite_lightbox') !== false) {
  include 'composite_lightbox';
  $pic = '<p><img src="'.$dirname.'/images/composite_lightbox.png" style="width: 100%;"></p>';
} elseif (strpos($array[item_type], 'shaped_lightbox') !== false) {
  include 'shaped_lightbox';
  $pic = '<p><img src="'.$dirname.'/images/shaped_lightbox.png" style="width: 100%;"></p>';
} elseif (strpos($array[item_type], 'shaped_twosided_lightbox') !== false) {
  include 'shaped_twosided_lightbox';
  $pic = '<p><img src="'.$dirname.'/images/shaped_twosided_lightbox.png" style="width: 100%;"></p>';
} elseif (strpos($array[item_type], 'click_data_lightbox') !== false) {
  include 'click_data_lightbox';
  $pic = '<p><img src="'.$dirname.'/images/click_data_lightbox.png" style="width: 100%;"></p>';
}
$array = str_replace(',', '.', $array);
if (empty($array[item_type])) {
  echo "Выберите, пожалуйста, название продукта.";
} elseif (empty($array[width]) OR empty($array[height])) {
  echo 'Необходим ввод значений высоты и ширины.';
} elseif ($array[item_type] == 'square_lightbox' && $array[width] > 3) {
  echo 'Превышено максимальное значение ширины для этого продукта, от 0.2 до 1.5 только!';
} elseif ($array[height] < 0.2 OR $array[height] > 1.5) {
  echo 'Высота в пределах от 0.2 до 1.5, только цифры!';
} elseif ($array[width] < 0.2 OR $array[width] > 6) {
  echo 'Ширина в пределах от 0.2 до 6, только цифры!';
} elseif (!is_numeric($array[height]) OR !is_numeric($array[width])) {
  echo "Ширина и высота - только цифры!.";
} else {
  $h              = array_search($array[height], $array_h);
  $w              = array_search($array[width], $array_w);
  $price          = $arr[$h][$w];
  $costprice      = $price * 0.6;
  $profit         = ($price - $costprice) / ($costprice / 100) / 100;
  $profit_manager = ($profit / 10) * 0.7 * $price;
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
  
  if ($price_mounting <= 1500) {
  $price_mounting = 2500;
  } 
  
  $total          = $price + $price_mounting;
  $res_data       = array(
    'price' => $price,
    '% manager' => $profit_manager,
    'price mounting' => $price_mounting,
    'cost price' => $costprice,
    'total' => $total
  );
  echo $pic;
  echo '<p> </p>';
  echo 'Цена ' . $price . ' руб.' . '</br>';
  echo '% менеджера ' . $profit_manager . ' руб.' . '</br>';
  echo 'Стоимость монтажа ' . $price_mounting . ' руб.' . '</br>';
  echo 'Себестоимость ' . $costprice . ' руб.' . '</br>';
  echo '--------------';
  echo '<div style="color: #ff0000;">' . 'Итого ' . $total . ' руб.' . '</div>';
}

