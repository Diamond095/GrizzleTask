<?php

require 'vendor/autoload.php';
use GuzzleHttp\Client;
header('Content-Type: text/html; charset=utf-8');

//Создаем переменные для уточнения страны
$number =$_GET['number'];

$country='';



if ($number[0]!='+') {
    $number = '+' . $number;
}

//Получаем с запроса все данные
$client = new Client();
$query = $client->get('https://cdn.jsdelivr.net/gh/andr-04/inputmask-multi@master/data/phone-codes.json');
$response = $query->getBody()->getContents();
$numbersOfAllCountries = json_decode($response, true);

//Тут мы приводим наш введенный номер к общему формату
$number = str_replace([' ', '(', ')'], '-', $number);


$number = str_replace('--', '-', $number);

//Находим страну для определенного номера
for ($i = 0; $i < count($numbersOfAllCountries); $i++) {
    if (strlen($number) == strlen($numbersOfAllCountries[$i]['mask'])) {

        $checkBrackets = (strpos($numbersOfAllCountries[$i]['mask'], '(') !== false && strpos($numbersOfAllCountries[$i]['mask'], ')') !== false);
        preg_match("/.*[0-9]/", $numbersOfAllCountries[$i]['mask'], $matches);

        if ($checkBrackets) {
            $number = str_replace("-", "(", $number);
            $number = preg_replace("/-/", ")", $number, 1);
        }

        if (substr($number, 0, strlen($matches[0])) == $matches[0]) {
            $country = $numbersOfAllCountries[$i]['name_ru'];

        }
    }
}

echo $country;
