<?php
require_once('includes/settings.php');

$requestType = $_SERVER['REQUEST_METHOD'];

if ($requestType == "GET" && isset($_GET['todoList']))
{
	//echo json_encode($_GET['todoList']);
	
	$query = "SELECT * from todolist where userId = " . $_SESSION['user_id'];
	
	$resSet = mysqli_query($con, $query);
	
	$rows = mysqli_num_rows($resSet);
	
	if ($rows > 0)
	{
		for ($i=0; $i<$rows; $i++)
		{
			$resArr[$i] = mysqli_fetch_assoc($resSet);
		}
		
		$resArr["errorNo"] = 0;
		$resArr["count"] = $rows;
		
		print_r(json_encode($resArr));
	}
	else
	{
		$resArr = [ "errorNo" => 1 , "description" => 'No records found', "count" => 0];
		print_r(json_encode($resArr));
	}
	mysqli_close($con);
}

if ($requestType == "POST" && isset($_POST['item']) && $_POST['event'] == 'insert')
{
	$item = $_POST['item'];
	
	$query = "SELECT * from todolist where todoName = '" . $item . "' and userId = " . $_SESSION['user_id'];
	$resSet = mysqli_query($con, $query);
	$rows = mysqli_num_rows($resSet);
	
	
	if ($rows < 1)
	{
		$query = "INSERT INTO todolist(userId, todoName) VALUES(". $_SESSION['user_id'] . ",'" . $item . "')";
	
		$resSet = mysqli_query($con, $query);
	
		if ($resSet)
		{
			$resArr = [ "errorNo" => 0 , "description" => 'Record inserted successfully', "count" => 0];
			print_r(json_encode($resArr));
		}
		else
		{
			$resArr = [ "errorNo" => 1 , "description" => 'Error in inserting a data', "count" => 0];
			print_r(json_encode($resArr));
		}
	}
	else
	{
		$resArr = [ "errorNo" => 1 , "description" => 'Data exist in the database', "count" => 0];
		print_r(json_encode($resArr));
	}
}

if ($requestType == "POST" && isset($_POST['itemId']) && isset($_POST['item']) && $_POST['event'] == 'update')
{
	$itemId = $_POST['itemId'];
	$item = $_POST['item'];
	
	$query = "SELECT * from todolist where todoId = " . $itemId . " and userId = " . $_SESSION['user_id'];
	$resSet = mysqli_query($con, $query);
	$rows = mysqli_num_rows($resSet);
	
	if ($rows > 0)
	{
		$query = "UPDATE todolist set todoName = '" . $item . "' where userId = " . $_SESSION['user_id'] . " and todoId = " . $itemId;
	
		$resSet = mysqli_query($con, $query);
	
		if ($resSet)
		{
			$resArr = [ "errorNo" => 0 , "description" => 'Record updated successfully', "count" => 0];
			print_r(json_encode($resArr));
		}
		else
		{
			$resArr = [ "errorNo" => 1 , "description" => 'no data exist in the database', "count" => 0];
			print_r(json_encode($resArr));
		}
	}
	else
	{
		$resArr = [ "errorNo" => 1 , "description" => 'no data exist in the database', "count" => 0];
		print_r(json_encode($resArr));
	}	
}

if ($requestType == "POST" && isset($_POST['itemId']) && $_POST['event'] == 'delete')
{
	$itemId = $_POST['itemId']; 
	
	$query = "SELECT * from todolist where todoId = " . $itemId . " and userId = " . $_SESSION['user_id'];
	$resSet = mysqli_query($con, $query);
	$rows = mysqli_num_rows($resSet);
	
	if ($rows > 0)
	{
		$query = "DELETE from todolist where userId = " . $_SESSION['user_id'] . " and todoId = " . $itemId;
	
		$resSet = mysqli_query($con, $query);
	
		if ($resSet)
		{
			$resArr = [ "errorNo" => 0 , "description" => 'Record deleted successfully', "count" => 0];
			print_r(json_encode($resArr));
		}
		else
		{
			$resArr = [ "errorNo" => 1 , "description" => 'no data exist in the database', "count" => 0];
			print_r(json_encode($resArr));
		}
	}
	else
	{
		$resArr = [ "errorNo" => 1 , "description" => 'no data exist in the database', "count" => 0];
		print_r(json_encode($resArr));
	}
}

if ($requestType == "POST" && isset($_POST['itemId']) && $_POST['event'] == 'markAsComplete')
{
	$itemId = $_POST['itemId'];
	
	$query = "SELECT * from todolist where todoId = " . $itemId . " and userId = " . $_SESSION['user_id'];
	$resSet = mysqli_query($con, $query);
	$rows = mysqli_num_rows($resSet);
	
	if ($rows > 0)
	{
		$query = "UPDATE todolist set taskCompltd = 1 where userId = " . $_SESSION['user_id'] . " and todoId = " . $itemId;
	
		$resSet = mysqli_query($con, $query);
	
		if ($resSet)
		{
			$resArr = [ "errorNo" => 0 , "description" => 'Record updated successfully', "count" => 0];
			print_r(json_encode($resArr));
		}
		else
		{
			$resArr = [ "errorNo" => 1 , "description" => 'no data exist in the database', "count" => 0];
			print_r(json_encode($resArr));
		}
	}
	else
	{
		$resArr = [ "errorNo" => 1 , "description" => 'no data exist in the database', "count" => 0];
		print_r(json_encode($resArr));
	}	
}
?>