<?php 
	include("securimage/securimage.php");
	$sec_code = md5(uniqid(time()));
	$return_var = "";

	switch($_REQUEST["function"])
	{
		case "get_capcha_images":
			$return_var .= "<img src='securimage/securimage_show.php?sid=".$sec_code."'>";
		break;
	}
	echo($return_var);
?>