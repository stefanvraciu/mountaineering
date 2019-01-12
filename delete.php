<?php  
	session_start();
	include("config.php");

	if($_POST['table']=='expeditions') $id = "exp_id";
	else $id = "ID";

	$sql = "DELETE FROM ".$_POST['table']." WHERE ".$id." = '".$_POST["id"]."'";  
	if(isset($_SESSION['login_user']))
	{
		if(mysqli_query($db, $sql))  
		{  
			echo 'Data Deleted';  
		}  
		else
			echo 'There was an error with your delete!';
	}
	else
		echo 'You do not have the right to delete this!';
 ?>