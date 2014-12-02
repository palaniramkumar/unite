<?php
session_start();
function get_file_extension($file_name) {
	return substr(strrchr($file_name,'.'),1);
}

$type=$_REQUEST["imagetype"];
$output_dir = "../uploads/$type/";
$ext=get_file_extension($_FILES["myfile"]["name"]);
$name=time().".".  $ext;
if($type=="profile"){
    $name=$_SESSION["uid"].".".$ext;
}
if($type=="resume"){
    $name=$_SESSION["uid"].".".$ext;
}
if(isset($_FILES["myfile"]))
{
	//Filter the file types , if you want.
	if ($_FILES["myfile"]["error"] > 0)
	{
	  echo "Error: " . $_FILES["file"]["error"] . "<br>";
	}
	else
	{
		//move the uploaded file to uploads folder;
    	move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir. $name);
    
   	 echo $name;
	}

}
?>