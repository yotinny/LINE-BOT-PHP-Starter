<?php
$access_token = 't0XAsAbr3TrUARjo7IEKOt5NG5z6uYE8KmJ45cXH2cZo5T3F9Il4cz6LV6oYkosbfhWNdgBn7Uhan+2/AV6El/bfgKaYCsYr8rImuxnEq0YMbQdMHYEvue3HeFiyMy14fzmB1KiBtA1iwUfw9bbPVAdB04t89/1O/w1cDnyilFU=';
$url = 'https://api.line.me/v1/oauth/verify';
$headers = array('Authorization: Bearer ' . $access_token);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);
echo $result;