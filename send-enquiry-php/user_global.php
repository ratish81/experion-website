<?php 
require("php_class.php");
//error_reporting(0);
session_start();
$photos = "../photos/";
$docs	= "../docs/";
$base_url 		= "/";
date_default_timezone_set('Asia/Kolkata');
$db_object 	= new db_connect();
//$smtp_mailer = new smtp_mailer("webmail.nelito.com","enquiry@nelito.com","nelito12#$");
function redirect($url)
{
	global $db_object;
	header("Location: $url");
}
/*function send_email($to,$from,$subject,$body)
{				
	global $smtp_mailer;
	$attachments = "";
	if($smtp_mailer->send_mail($from,$to,$attachments,$subject,$body))
	{
		return true;
	}
	else
	{
		return false;
	}
}*/
/*function send_email($to,$from,$subject,$body)
{				
	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
	
	// More headers
	//$headers .= "From: $from"."\r\n"."Reply-To: $reply"."\r\n";						
					
	mail($to,$subject,$body,$headers);
}
*/
function send_email($to,$from,$subject,$body,$attachments = "")
{				
	global $smtp_mailer;
	//$attachments = "";
	if($smtp_mailer->send_mail($from,$to,$attachments,$subject,$body))
	{
		return true;
	}
	else
	{
		return false;
	}
}
?>
