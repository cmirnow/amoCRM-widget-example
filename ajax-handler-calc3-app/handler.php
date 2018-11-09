<?
header("Access-Control-Allow-Origin: *");
$array = ($_GET);
$array = str_replace(',', '.', $array);

if(empty($array[product_type]) OR empty($array[height]) OR empty($array[width]) OR empty($array[height_banner]) OR empty($array[width_banner]) ) {
  echo 'Все обязательные поля формы должны быть заполнены.';
}
elseif (!is_numeric($array[height_banner]) OR !is_numeric($array[width_banner])) {
  echo "Ширина и высота - только цифры!.";
}
 else {
$array_options = [];
foreach ($array as $key => $val) 
{
if(stristr($val, 'check') == TRUE) {
$array_options[] = $key;
}
}
/* Arrays */
$arr = array(array(300,320,280),array(350,370,320),array(450,470,470),array(380,450,450),array(480,510,430),array(600,670,570),array(380,450,350));
$array_h = array('banner330','banner440','banner_perforated','self_adhesive_skin','skin_perforated','canvas','paper');
$array_w = array('720','1440','360'); 
$array_costprice = array(50,60,150,70,150,250,100);
/*
print_r($array_price); 
echo '<p> </p>'; */
/* получаем цену продажи и себестоимость кв. метра , price & costprice  */
$h              = array_search($array[height], $array_h);
$w              = array_search($array[width], $array_w); 
$price = $arr[$h][$w];
$costprice = $array_costprice[$h];

$banner_area = $array[height_banner] * $array[width_banner];

if (in_array("eyelets", $array_options)) {
    $eyelets = ($array[height_banner] * 2 + $array[width_banner] * 2) / 0.25 * 10;
    $costprice_eyelets = ($array[height_banner] * 2 + $array[width_banner] * 2) / 0.25 * 2;
    echo 'Люверсы = ' . $eyelets . ' руб' . '</br>';  
}
if (in_array("sizing", $array_options)) {
$sizing = ($array[height_banner] * 2 + $array[width_banner] * 2) * 40;
$costprice_sizing = ($array[height_banner] * 2 + $array[width_banner] * 2) * 10;
    echo 'Проклейка = ' . $sizing . ' руб' . '</br>';
}

if (in_array("perforation", $array_options)) {
$perforation = $array[height_banner] * $array[width_banner] *5 * 15;
$costprice_perforation = $array[height_banner] * $array[width_banner] * 5 * 2;
    echo 'Перфорация = ' . $perforation . ' руб' . '</br>';
}

if (in_array("banner_install", $array_options)) {
$banner_install = ($array[height_banner] * 2 + $array[width_banner] * 2) * 80;
$costprice_banner_install = ($array[height_banner] * 2 + $array[width_banner] * 2) * 10;
    echo 'Монтаж баннера = ' . $banner_install . ' руб' . '</br>';
}

if (in_array("banner_frame", $array_options)) {
$banner_frame = ($array[height_banner] * 2 + $array[width_banner] * 2) * 100;
$costprice_banner_frame = ($array[height_banner] * 2 + $array[width_banner] * 2) * 60;
    echo 'Рамка для баннера = ' . $banner_frame . ' руб' . '</br>';
}
if (in_array("framing", $array_options)) {
$framing = ($array[height_banner] * 2 + $array[width_banner] * 2) * 80;
$costprice_framing = ($array[height_banner] * 2 + $array[width_banner]) * 15;
    echo 'Монтаж рамки = ' . $framing . ' руб' . '</br>';
}

$price_banner = $banner_area * $price;

/* себестоимость баннера: */
$costprice_banner = $banner_area * ($costprice + 30);
$price_total = $price_banner + $eyelets + $sizing + $perforation + $banner_install + $banner_frame + $framing;

$costprice_total = $costprice_banner + $costprice_eyelets + $costprice_sizing + $costprice_perforation + $costprice_banner_install + $costprice_banner_frame + $costprice_framing;
$profit_total = $price_total - $costprice_total;
$procent_manager = (($profit_total) / ($costprice_total / 100) / 100) / 10 * 0.7 * $price_total;
echo '---------------' . '</br>';
echo 'Площадь = ' . $banner_area . 'м' . '</br>';
echo '---------------' . '</br>';
echo 'Цена = ' . $price_total . ' руб' . '</br>';
echo 'Себестоимость = ' . $costprice_total . ' руб' . '</br>';
echo 'Прибыль = ' . $profit_total . ' руб' . '</br>';
echo '% менеджера = ' . round($procent_manager, 2) . ' руб' . '</br>';
}
