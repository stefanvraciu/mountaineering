<?php  
	session_start();
	if(isset($_SESSION['login_user']))
	{
		include("config.php");
		$idv = $_POST["id"];  
		$text = $_POST["text"];  
		$column_name = $_POST["column_name"]; 
		$table = $_POST['table'];

		if($_POST['table']=='expeditions') $id = "exp_id";
		else $id = "ID";

		$sql = "UPDATE ".$table." SET ".$column_name."='".$text."' WHERE ".$id."=".$idv;  

		if(mysqli_query($db, $sql))  
		{  
			echo 'Data Updated';  
		}  
		else 
			echo 'Something went wrong!';
	}
	else
		echo 'You do not have the right to edit this!';
 ?>