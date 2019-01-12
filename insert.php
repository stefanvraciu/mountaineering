<?php  
	session_start();
	include("config.php");
	$table = $_POST['table'];
	if(isset($_SESSION['login_user']))
	{
		switch($table)
		{
			case 'mountains':
				$sql = "INSERT INTO mountains(Name, Height, Location) VALUES('".$_POST["mtname"]."', '".$_POST["mthgt"]."', '".$_POST["mtloc"]."')"; 
				break;
			case 'climbers':
				$sql = "INSERT INTO climbers(Name, Country, Date_of_birth) VALUES('".$_POST["cname"]."', '".$_POST["cloc"]."', '".$_POST["cdob"]."')"; 
				break;

			case 'expeditions':
			{
				$cname = $_POST['cname'];
				$mname = $_POST['mname'];
				$sel1 = "SELECT c.ID FROM climbers AS c WHERE c.Name LIKE '%".$cname."%' LIMIT 1";
				$sel2 = "SELECT m.ID FROM mountains AS m WHERE m.Name LIKE '%".$mname."%' LIMIT 1";

				$r1 = mysqli_query($db, $sel1);
				$cid = mysqli_fetch_array($r1, MYSQLI_BOTH);
				$r2 = mysqli_query($db,$sel2);
				$mid = mysqli_fetch_array($r2, MYSQLI_BOTH);
				echo $mid[0].' '.$cid[0].' ';

				$sql = "INSERT INTO expeditions(mountain_id, climber_id, expeditions.date, notes) VALUES(".$mid[0].", ".$cid[0].", '".$_POST['edat']."', '".$_POST['enot']."')";
				break;
			}
		}
		 
		if(mysqli_query($db, $sql))  
		{  
		     echo 'Data inserted successfully!';  
		}
		else
		{
			echo 'There was an error! Please try again!';
		}
	}
	else
		echo 'You do not have the right to edit the table!';

?>