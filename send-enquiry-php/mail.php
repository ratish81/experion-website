<?php
include("user_global.php");
include("../securimage/securimage.php");

if(isset($_REQUEST['action']))
{
	$first_name  = $db_object->sanatize_string($_REQUEST['first_name']);
	$last_name 	 = $db_object->sanatize_string($_REQUEST['last_name']);
	$email 	 	 = $db_object->sanatize_string($_REQUEST['email']);
	$memebr_name    = ucwords($first_name." ".$last_name);
	
	$url_name = explode("?",$_SERVER['HTTP_REFERER']);
	if(trim($_REQUEST["captcha_code"]) != "" && isset($_REQUEST["captcha_code"]))
	{
		$img = new Securimage();
		$valid = $img->check($_REQUEST["captcha_code"]);
		if($valid != true) {
			redirect($url_name[0]."?error=The code is invalid.#contactform");
			die();
		} 
	}
	else
	{
		redirect($url_name[0]."?error=The code is invalid.#contactform");
		die();
	}
	
	$file_obj = new file_manup("./");
	$file_obj->extract_html("enquiry-format.html");
	$body = $file_obj->replace_tags("{name}|{email}","".ucfirst($memebr_name)."|$email");
	
	$subject  = "You have a new enquiry from ".ucwords($memebr_name);
	$headers = "MIME-Version: 1.0"."\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
	$headers .= "From: Experion <info@kalptech.com>"."\r\n";
	$headers .= "BCC: rajendra@kalptech.com, vighnesh29114@gmail.com\r\n";
	$to = "anindya@anonymousdigital.com";
	mail($to,$subject,$body,$headers);
	
	redirect($url_name[0]."?enquiry=succes");
	die();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>