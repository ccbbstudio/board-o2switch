<?php
function redirection($url)
{
	header("Location: $url");	
}

function isJson($string) {
 json_decode($string);
 return json_last_error() === JSON_ERROR_NONE;
}

function get_http_response_code($domain) {
  $headers = get_headers($domain);
  return (int)substr($headers[0], 9, 3);
}

function xss_filter($data)
{
  $data = preg_replace('/[\x00-\x1F\x7F]/', '', $data);
  $data = preg_replace('/[<>\?\'\"\(\)\[\]]/', '', $data);
  $data = str_replace(['<', '>', '\'', '\"', ')', '('], '', $data);
  return $data;
}


function inputGet($key)
{
  return isset($_GET[$key]) ?  xss_filter($_GET[$key]) : null;
}

function inputPost($key)
{
  return isset($_POST[$key]) ?  xss_filter($_POST[$key]) : null;
}


function html_msg_error($msg){
  return "<div class='msg-error'>$msg</div>";
}

function html_msg_success($msg){
  return "<div class='msg-success'>$msg</div>";
}

function getDifference($date)
{
  $date_now = new DateTime("now");
  $date_new = new DateTime($date);

  $interval = $date_new->diff($date_now)->days;

  $txt = null;

  if ( $date_new <=  $date_now) {
   $txt = "<span class='tooltip'>
   <span class='date-tag date-red'>0</span>
   <span class='tooltiptext'>".$date_new->format('d-m-Y')."</span>
   </span>";

   return  $txt;
 }
 switch ($interval) {
  case ($interval <= 30):
  $txt = "<span class='tooltip'>
  <span class='date-tag date-orange'>$interval</span>
  <span class='tooltiptext'>".$date_new->format('d-m-Y')."</span>
  </span>";
  break;


  default:

  $txt = "<span class='tooltip'>
  <span class='date-tag date-green'>$interval</span>
  <span class='tooltiptext'>".$date_new->format('d-m-Y')."</span>
  </span>";
  break;
}

return $txt;
}