<?php
//echo "I am a bot";
/////test thingspeak////
/////end thingspeak/////
$temx_tm = '';
$newimgcode ='';

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
  $img = '';
  $value = '';
  $reply_token = $event['replyToken'];

  if ( $event['type'] == 'message' ) 
  {
   if( $event['message']['type'] == 'text' )
   {
    $text = $event['message']['text'];
    $temx_tm = $text;
    if ($temx_tm == "Coy/graph" || $temx_tm == "Cob/graph" || $temx_tm == "Cor/graph" || $temx_tm == "Cc/graph" || $temx_tm == "Ct/graph" || $temx_tm == "Cr/graph" || $temx_tm == "/image" || $temx_tm == "Count" || $temx_tm == "Cr" || $temx_tm == "Ct" || $temx_tm == "Cc" || $temx_tm == "Cr" || $temx_tm == "Cor" || $temx_tm == "Cob" || $temx_tm == "Coy")
    {
     $url = "https://api.thingspeak.com/channels/427743/feeds.xml?results=1";
     $xml = simplexml_load_file($url);
     $field7 = $xml->xpath('//feed/field7');    
     //$re = print_r($field7, true);
     
     $re = print_r($field7, true);   
     $value = explode("=>", $re);
     $newimgcode = explode(")", $value[2]);    
     
     $img = base64_decode($newimgcode);
     $file = UPLOAD_DIR . uniqid() . '.jpg';
     $success = file_put_contents($file, $img);
     $reply_message = ''.$newimgcode[0].'';
     //$reply_message = 'https://drive.google.com/drive/folders/14CMkXV0pz_xezmJ8DCYdpPmT_MxTx_6Y?usp=sharing';
     if ($temx_tm == "/image" || $temx_tm == "Coy/graph" || $temx_tm == "Cob/graph" || $temx_tm == "Cor/graph" || $temx_tm == "Cc/graph" || $temx_tm == "Ct/graph" || $temx_tm == "Cr/graph")
     {
       if ($temx_tm == "/image")
       {
         $reply_message = 'https://drive.google.com/drive/folders/14CMkXV0pz_xezmJ8DCYdpPmT_MxTx_6Y?usp=sharing';
       }
      if ($temx_tm == "Cr/graph")
       {
         $reply_message = 'https://thingspeak.com/channels/427743/charts/1?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&type=line&update=15';
       }
      if ($temx_tm == "Cc/graph")
       {
         $reply_message = 'https://thingspeak.com/channels/427743/charts/2?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&type=line&update=15';
       }
       if ($temx_tm == "Ct/graph")
       {
         $reply_message = 'https://thingspeak.com/channels/427743/charts/3?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&type=line&update=15';
       }
      if ($temx_tm == "Cor/graph")
       {
         $reply_message = 'https://thingspeak.com/channels/427743/charts/5?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&type=line&update=15';
       }
      if ($temx_tm == "Cob/graph")
       {
         $reply_message = 'https://thingspeak.com/channels/427743/charts/6?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&type=line&update=15';
       }
      if ($temx_tm == "Coy/graph")
       {
         $reply_message = 'https://thingspeak.com/channels/427743/charts/7?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&type=line&update=15';
       }
     }
     else
      $reply_message = 'ระบบได้รับข้อความ ('.$text.') ของคุณแล้วนะจะ กำลังทำการปรับ process';
    }
    else
     $reply_message = 'Manual Commanline: Count Rectangle[Cr], Count Triangle[Ct], Count Circle[Cc], Count Red[Cor], Count Blue[Cob], Count Yellow[Coy], Example : You want to count triangle use commanline "Ct",/image ';
  }
  else
    if ($temx_tm == "Count" || $temx_tm == "Cr" || $temx_tm == "Ct" || $temx_tm == "Cc" || $temx_tm == "Cr" || $temx_tm == "Cor" || $temx_tm == "Cob" || $temx_tm == "Coy")
    {
     $url = "https://api.thingspeak.com/channels/427743/feeds.xml?results=2";
     //$xml = simplexml_load_file($url);
     $xml = simplexml_load_string($url);
     $channel_name = (string) $xml->Data;
     $field7 = $xml->xpath('//feed/field7');
     $reply_message = 'ระบบได้รับข้อความ ('.$text.') ของคุณแล้วนะจะ กำลังทำการปรับ process';
    }
    else
     $reply_message = 'Manual Commanline: Count Rectangle[Cr], Count Triangle[Ct], Count Circle[Cc], Count Red[Cor], Count Blue[Cob], Count Yellow[Coy], Example : You want to count triangle use commanline "Ct" ,/image';
  }
  else
   if ($temx_tm == "Count" || $temx_tm == "Cr" || $temx_tm == "Ct" || $temx_tm == "Cc" || $temx_tm == "Cr" || $temx_tm == "Cor" || $temx_tm == "Cob" || $temx_tm == "Coy")
   {
    $url = "https://api.thingspeak.com/channels/427743/feeds.xml?results=2";
    $xml = simplexml_load_file($url);
    $channel_name = (string) $xml->Data;
    $field7 = $xml->xpath('//feed/field7');
    $reply_message = 'ระบบได้รับข้อความ ('.$text.') ของคุณแล้วนะจะ กำลังทำการปรับ process';
   }
   else
    $reply_message = 'Manual Commanline: Count Rectangle[Cr], Count Triangle[Ct], Count Circle[Cc], Count Red[Cor], Count Blue[Cob], Count Yellow[Coy], Example : You want to count triangle use commanline "Ct",/image ';
  if( strlen($reply_message) > 0 )
  {
   //$reply_message = iconv("tis-620","utf-8",$reply_message);
   $data = [
    'replyToken' => $reply_token,
    'messages' => [['type' => 'text', 'text' => $reply_message]]
   ];
   $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);

   $send_result = send_reply_message($API_URL, $POST_HEADER, $post_body,$temx_tm);
   echo "Result: ".$send_result."\r\n";
  }
 }
}
        
        

echo "OK";

function send_reply_message($url, $post_header, $post_body,$temx_tm)
{
 $ch = curl_init($url);
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
 $result = curl_exec($ch);
 curl_close($ch);
 
 $API_KEY = "3MVDVVH1L4NYFT9N";
 //$temp_tm= 30;
 $ThingsSpeakURL = "http://api.thingspeak.com/update?key=".$API_KEY."&field1=".$temx_tm;
 $curl_handle = curl_init($ThingsSpeakURL);
 curl_setopt( $curl_handle, CURLOPT_URL, $ThingsSpeakURL );
 curl_setopt( $curl_handle, CURLOPT_RETURNTRANSFER, true);
 curl_setopt( $curl_handle, CURLOPT_FOLLOWLOCATION, 1);
 curl_exec( $curl_handle );
 curl_close( $curl_handle );
 
 return $result;
}

?>
