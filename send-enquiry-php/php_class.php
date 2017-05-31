<?php
class db_connect
{
	var $conn;
	
	//This method is used to remove slashes added using the addslash function
	function strip_slashes($value)
	{		
		reset($value);
		while (list($key, $val) = each($value))
		{
		  $value[$key] = (stripslashes($val));
		}
		return $value;
	}
	
	//This method is used to snatize a string for safe database entry
	function sanatize_string($value)
	{		
		$value = htmlentities(addslashes(strip_tags(trim($value))));		
		return $value;
	}
	
	//This method checks if a variable has been set in an array if yes the returns value else returns blank
	function check_value($array,$variable,$return="")
	{
		if(isset($array[$variable]))
		{
			return($array[$variable]);
		}
		else
		{
			return($return);
		}	
	}
	
	// This method compares a variable1 with variable 2 and if same returns variable 3 else returns variable 1 itself
	function sring_compare($compare,$with,$return)
	{
		if($compare != $with)
		{
			return($compare);
		}
		else
		{
			return($return);
		}	
	}
	
	// This method compares a variable1 with variable 2 and if same returns [return1] else returns [return2]
	function return_compare($compare,$with,$return1,$return2)
	{
		if($compare == $with)
		{
			return($return1);
		}
		else
		{
			return($return2);
		}	
	}
	
	//This method combines 2 arrays to create a new array taking array 1 for keys and array 2 for values
	function combine_array($array_1,$array_2)
	{
		$new_array = array();		
		$i = 0;	
		while($i < count($array_1))
		{	
			$key = $array_1[$i];		
			$new_array = array_merge($new_array,array("'".$key."'"=>$array_2[$i]));
			$i++;			
		}		
		return $new_array;
	}
	
	//This function checks for the specified variables to see if they are numbers only
	function sanatize_query()
	{
		$array = $_GET;
		$count = count($_GET);
		$permitted = " 1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ*#_.";
		$querystring = "?";
		$isOk = true;
		
		foreach($array as $key => $val)
		{				
				if(strlen($val) <= 0)
				{					
					$val = "0";
					$isOk = false;
				}
				
				$fdata = "";
				for($i=0;$i<strlen($val);$i++)
				{
					$char = substr($val,$i,1);
					
					if($char == ' ')
					{
						$fdata .= ' ';
						continue;
					}
										
					if(strpos($permitted,$char))
					{									
						$fdata .= $char; 						
					}
					else
					{
						$isOk = false;
					}
				}
				$querystring .= $key."=".$fdata."&";								
		}		
		$querystring = substr($querystring,0,strlen($querystring)-1);
		if(!$isOk)
		{
		
			header("location:".$_SERVER['PHP_SELF']."$querystring");
			die("Not OK");
		}		
		return true;
	}
	
	function sanatize_value($value)
	{
		$permitted = " 1234567890";				
		
		$fdata = "";				
		for($i=0; $i < strlen($value);$i++)
		{			
			$char = substr($value,$i,1);						
			if(strpos($permitted,$char))
			{
				$fdata .= $char;												
			}						
		}
		
		if(strlen(trim($fdata)) <= 0)
		{					
			$fdata = "0";
		}
				
		return $fdata;
	}
					 
}
//************This class is used to perform image manupulation functions**************
class img_manup
{
	
	var $folderpath;
	
	//This function initializes the path to the folder conatining the image or where the image needs to be uploaded
	function img_manup($folderpath)
	{
		$this->folderpath = $folderpath;
	}
	
	//This function checks if an image exists or else returns default image
	function get_image($file_name) 
	{
		if(!empty($file_name))
		{
			return $file_name; 	
		}
		else
		{
			return $this->folderpath."/no_image.jpg";
		}
	}
	
	// This function returns the height and width of the image as an array
	function get_size($filename)
	{
		$imagepath = $this->folderpath ."/".$filename;
		$imagesize = getimagesize($imagepath);
		
		return $imagesize;
	}	
}
//**************This class is used for performing file manupulation******************
class file_manup
{
	var $folderpath;
	var $content;
	var $mime_type = array('pdf' => 'application/pdf', 'doc' => 'application/msword', 'png' => 'image/png','jpg' => 'image/jpeg', 
					       'jpeg' => 'image/jpeg','gif' => 'image/gif', 'swf' => 'application/x-shockwave-flash', 'flv' => 'video/x-flv');
	
	//This function initializes the path to the folder conatining the image or where the image needs to be uploaded
	function file_manup($folderpath)
	{
		$this->folderpath = $folderpath;
	}
	
	//This function validates a file against the array of extensions and if the file being uploaded is ok then uploads it
	function upload_file($sourcename, $tmpname, $dstnname, $ext_array, $mime="")
	{
		$file_ext  = explode(".",$sourcename);
		$file_ext = ".".$file_ext[count($file_ext)-1];		
		
		$ext_array = explode(",",$ext_array);
		$file_ok   = false;
		
		if($mime != "")
		{				
			foreach($ext_array as $key => $val)
			{				
				for($i=0; $i<count($this->mime_type); $i++)
				{					
					if($mime == $this->mime_type[$val])					{
						$file_ok = true;
						break;
					}
				}
			}
		}
		else
		{
			if($sourcename!="")
			{
				$file_ok	= true;
			}
			else
			{
				$file_ok	= false;
			}
			
		}
		
		if($file_ok == true)
		{
			$uploaddir = $this->folderpath;
			$uploadfile = $uploaddir.$dstnname.$file_ext;
			move_uploaded_file($tmpname, $uploadfile);
			return($dstnname.$file_ext);
		}
		else
		{
			return false;
		}					
	}
	
	//This function will be used to delete files passed as an array from a folder, returns count of total files and deleted files  
	function delete_file($file_list)
	{
		$file_list 	= explode(",",$file_list);
		reset($file_list);
		$int[0] = count($file_list);
		$int[1] = 0;
		while (list($key, $val) = each($file_list))
		{
			$file = $this->folderpath.$val;
			if(file_exists($file))
			{
				if(unlink($file))
				{
					$int[1]++;
				}
			}		  
		}
		return $int;
	}
	//This function is used to extract html from a different URL and update the $content property of the class with 
	//the extracted content
	function extract_html($filename)
	{
		$filename = $this->folderpath.$filename;
		if($file = fopen($filename,"r"))
		{
			$content = "";
		   	while(!feof($file))
		  	{
		  		$this->content = $this->content.fgets($file);
		 	}
			fclose($file);
			return($this->content);			
		}
		else
		{
			echo("File is not readable!");
			die();
		} 
	}
	
	//This function is used to replace specified tags within a {} with a list of words specified in an array
	function replace_tags($tags,$values) 
	{
		$tags 	= explode("|", $tags);
		$values = explode("|",$values);
		reset($tags);
		reset($values);
		for($i=0;$i<count($tags);$i++)
		{			
			$this->content = str_replace($tags[$i],$values[$i],$this->content);
		}
		return($this->content);
	}	 
}
//*************This class is used to perform various email related functions********************************
class smtp_mailer
{			
	var $smtphost, $smtpuser, $smtppass;
	
	function smtp_mailer($smtphost, $smtpuser, $smtppass)
	{
		$this->smtphost = $smtphost;							// specify main and backup server [mail.kalptech.com]
		$this->smtpuser = $smtpuser;							// SMTP username [support@kalptech.com]
		$this->smtppass = $smtppass;							// SMTP password [ks0679*]
	}
	// This function is used for sending emails with attachments, it utilizes the PHP mailer base class functionality	
	function send_mail($from,$to,$attachments,$subject,$body)
	{
		if (!class_exists("phpmailer")) 
		{
			require("phpmailer/class.phpmailer.php");
		}
		
		$smtphost = $this->smtphost;
		$smtpuser = $this->smtpuser;
		$smtppass = $this->smtppass;
				
		$mail = new PHPMailer();	
		if(!empty($smtphost))
		{
			$mail->IsSMTP();                                   	// set mailer to use SMTP
			$mail->Host 	= $smtphost;  					
			$mail->SMTPAuth = true;     						// turn on SMTP authentication
			$mail->Username = $smtpuser;  				
			$mail->Password = $smtppass; 					
		}
		
		$from = explode(",",$from);								//Name,Email
		
		//$mail->From = $from[0];
		$mail->From = $from[0];
		
		if(isset($from[1]))
		{
			$mail->FromName = $from[1];
			$mail->AddReplyTo($from[0],$from[1]);
			
		}
		else
		{
			$mail->AddReplyTo($from[0]);			
		}
				
		
		$to	= explode(",",$to);								//Name,Email		
		$mail->AddAddress($to[0]);
		
		if(isset($to[1]))
		{
			$mail->AddCC($to[1]);					
		}
		
		if(isset($to[2]))
		{
			$mail->AddCC($to[2]);
		}
		
		if(isset($to[3]))
		{
			$mail->AddCC($to[3]);
		}
		
		if(isset($to[4]))
		{
			$mail->AddCC($to[4]);
		}
		$mail->WordWrap = 125;									// set word wrap to 50 characters
		
		if(!empty($attachments))
		{
			$attachments	= explode(",",$attachments);
			reset($attachments);
			for($i=0;$i<count($attachments);$i++)
			{		                                 					   	
				$mail->AddAttachment($attachments[$i]);         // add attachments
			}
		}
				
		$mail->IsHTML(true);                                  	// set email format to HTML
		
		$mail->Subject = strip_tags($subject);
		$mail->Body    = $body;
		$mail->AltBody = strip_tags($body);
		
		if(!$mail->Send())
		{		   
		   $error = "Message could not be sent. <br/>";
		   $error .= "MailTo: ".$to[0]."<br/>Subject: ".$subject."<br/>Body: ".$body."<br/>";
		   $error .= $mail->ErrorInfo." ".date("d/m/Y h:i")."<br/>";
		   
		   $file = fopen("mailer_error_log.txt","a");
		   fwrite($file,$error);
		   fclose($file);
		   
		   //echo "Message could not be sent. <br/>";
		   //echo "Mailer Error: " . $mail->ErrorInfo;
		   //exit;
		}
		//else
		//{
			//echo"Message has been sent successfully";
			
			$error = "Message successfully sent. <br/>";
		   	$error .= $to[0]." ".$subject."<br/>";
		   	$error .= date("d/m/Y h:i")."<br/>";
			
			$file = fopen("mailer_error_log.txt","a");		   	
			fwrite($file,$error);
		   	fclose($file);
			
			return true;
		//}		
	}
}
//This Class will be utilized to access a mailbox using PHP IMAP class library	
class imap_access
{	
	var $imapserver, $imapuser, $imappass, $imapconn;
	var $folders, $emailcount, $headers;
	
	//This is the constructor of the class
	function imap_access($imapserver, $imapuser, $imappass)
	{
		$this->imapserver 	= $imapserver; 	//{mail.kalptech.com:110/pop3}INBOX
		$this->imapuser 	= $imapuser;	//kalpesh@kalptech.com
		$this->imappass 	= $imappass;	//kalpum
	}
	
	function access_mail()
	{
		$this->imapconn		= @imap_open($this->imapserver, $this->imapuser, $this->imappass) or die(imap_last_error());		
		$this->folders 	= imap_listmailbox($this->imapconn, $this->imapserver, "*"); // This property returns the list of mail folders
		
		if ($this->folders == false) 
		{
			echo "Call to the folders failed!";
		} 
		
		$this->headers = imap_headers($this->imapconn);	//This property returns total messages in the form of an array	
		$this->emailcount = sizeof($this->headers); // This property returns the count of total messages				
	}
	
	//This function will close the connection to the opened imap mail box
	function close_conn()
	{
		imap_close($this->imapconn);	
	}
	
	//This function returns the headers of an email
	function msg_headers($msg_no)
	{
		$mailHeader = imap_headerinfo($this->imapconn, $msg_no);
		
		$msg_headers["recent"] 	= $mailHeader->Recent;
		$msg_headers["from"] 	= $mailHeader->fromaddress;
		$msg_headers["replyto"] = $mailHeader->reply_toaddress;
		$msg_headers["subject"] = strip_tags($mailHeader->subject);
		$msg_headers["date"] 	= $mailHeader->date;
		$msg_headers["Size"] 	= $mailHeader->Size;						
		
		return($msg_headers);
	}
	
	//This function returns the body of an email ***** Still there is some work to be done on this *****
	function msg_body($msg_no)
	{
		return imap_fetchbody($this->imapconn,$msg_no,1);
	}
}
?>