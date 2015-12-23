<?php
require_once('includes/settings.php');

$requestType = $_SERVER['REQUEST_METHOD'];

if ($requestType == "POST" && isset($_POST['email']) && isset($_POST['password']))
{
	$userEmail = $_POST['email'];
	$password = $_POST['password'];
	
	$query = "SELECT * from user where email = '" . $userEmail . "' and password = md5('" . $password . "')";
	
	$resSet = mysqli_query($con, $query);
	
	$rows = mysqli_num_rows($resSet);
	
	if ($rows > 0)
	{
		for ($i=0; $i<$rows; $i++)
		{
			$resArr[$i] = mysqli_fetch_assoc($resSet);
			
			$_SESSION['user_id'] = $resArr[$i]['userId'];
			
		}
		
		$resArr["errorNo"] = 0;
		$resArr["count"] = $rows;
		
		print_r(json_encode($resArr));
	}
	else
	{
		$resArr = ["errorNo" => 1 , "description" => 'No records found', "count" => 0];
		print_r(json_encode($resArr));
	}
}


?>