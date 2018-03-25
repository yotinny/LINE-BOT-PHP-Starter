<?php
//echo "I am a bot";
/////test thingspeak////
/////end thingspeak/////


$API_URL = 'https://api.line.me/v2/bot/message/reply';
$ACCESS_TOKEN = 't0XAsAbr3TrUARjo7IEKOt5NG5z6uYE8KmJ45cXH2cZo5T3F9Il4cz6LV6oYkosbfhWNdgBn7Uhan+2/AV6El/bfgKaYCsYr8rImuxnEq0YMbQdMHYEvue3HeFiyMy14fzmB1KiBtA1iwUfw9bbPVAdB04t89/1O/w1cDnyilFU='; // Access Token ค่าที่เราสร้างขึ้น
$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array

if ( sizeof($request_array['events']) > 0 )
{

 foreach ($request_array['events'] as $event)
 {
  $reply_message = '';
  $reply_token = $event['replyToken'];

  if ( $event['type'] == 'message' ) 
  {
   if( $event['message']['type'] == 'text' )
   {
    $text = $event['message']['text'];
    $reply_message = 'ระบบได้รับข้อความ ('.$text.') ของคุณแล้ว';
   }
   else
    $reply_message = 'ระบบได้รับ '.ucfirst($event['message']['type']).' ของคุณแล้ว';
  
  }
  else
   $reply_message = 'ระบบได้รับ Event '.ucfirst($event['type']).' ของคุณแล้ว';
 
  if( strlen($reply_message) > 0 )
  {
   //$reply_message = iconv("tis-620","utf-8",$reply_message);
   $data = [
    'replyToken' => $reply_token,
    'messages' => [['type' => 'text', 'text' => $reply_message]]
   ];
   $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);

   $send_result = send_reply_message($API_URL, $POST_HEADER, $post_body);
   echo "Result: ".$send_result."\r\n";
  }
 }
}

echo "OK";

function send_reply_message($url, $post_header, $post_body)
{
 $ch = curl_init($url);
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
 $result = curl_exec($ch);
 curl_close($ch);
 
 $API_KEY = "2ENTOBHKZDQQJ3NO";
 $temp_tm= 20;
 $ThingsSpeakURL = "http://api.thingspeak.com/update?key=".$API_KEY."&field8=".$temp_tm;
 $curl_handle = curl_init($ThingsSpeakURL);
 curl_setopt( $curl_handle, CURLOPT_URL, $ThingsSpeakURL );
 curl_setopt( $curl_handle, CURLOPT_RETURNTRANSFER, true);
 curl_setopt( $curl_handle, CURLOPT_FOLLOWLOCATION, 1);
 curl_exec( $curl_handle );
 curl_close( $curl_handle );
 
 return $result;
}

?>
