<?php
$access_token = 't0XAsAbr3TrUARjo7IEKOt5NG5z6uYE8KmJ45cXH2cZo5T3F9Il4cz6LV6oYkosbfhWNdgBn7Uhan+2/AV6El/bfgKaYCsYr8rImuxnEq0YMbQdMHYEvue3HeFiyMy14fzmB1KiBtA1iwUfw9bbPVAdB04t89/1O/w1cDnyilFU=';// Get POST body content
$content = file_get_contents('php://input');// Parse JSON
$events = json_decode($content, true);// Validate parsed JSON dataif 
(!is_null($events['events'])) {	// Loop through each event	
  foreach ($events['events'] as $event) {		// Reply only when message sent is in 'text' format		
    if ($event['type'] == 'message' && $event['message']['type'] == 'text') {			// Get text sent			
      $text = $event['message']['text'];			// Get replyToken			
      $replyToken = $event['replyToken'];			// Build message to reply back			
      $messages = [				'type' => 'text',				'text' => $text			];			// Make a POST Request to Messaging API to reply to sender			
      $url = 'https://api.line.me/v2/bot/message/reply';			
      $data = [				'replyToken' => $replyToken,				'messages' => [$messages],			];			
      $post = json_encode($data);			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);			
      $ch = curl_init($url);			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);			
      $result = curl_exec($ch);			curl_close($ch);			echo $result . "";		}	
  }
}echo "OK";
