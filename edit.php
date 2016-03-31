<?php

	
	require_once("../../config.php");

	//the variable exists in the URL
	if(!isset($_GET["edit"])){
	
		//redirect user
		echo"redirect";
		
		header("Location: table.php");
		exit(); //dont execute further
		
			}else{	
		echo "User want to edit row:".$_GET["edit"];
		
		
		$mysql = new mysqli("localhost", $db_username, $db_password, "webpr2016_karoliinar");
		
		
		//maye user wants to update data after clicking the button
		if(isset($_GET["to"]) && isset($_GET["message"])){
		
			echo "User modified data, tries to save";
			
			//should be validataion?
			
			$stmt = $mysql->prepare("UPDATE messages_sample SET recipient=?, message=? WHERE id=?");
			
			echo $mysql->error; 
			
			$stmt->bind_param("ssi", $_GET["to"], $_GET["message"], $_GET["edit"]);
			
			if($stmt->execute()){
			
				echo "saved successfully";
				
				//option one- redirect
				header("Location: table.php");
				exit();
				
				//option two - update variables 
				//$recipient = $_GET["to"];
				//$message = $_GET["message"];
				//$id= $_GET["edit"];
				
			}else{
			
				echo $stmt->error;
			}
			
		}
		
		
		
		
		
		$stmt = $mysql->prepare("SELECT id, recipient, message FROM messages_sample WHERE id=?");
		
		echo $mysql->error; 
		
		//replace the ? mark
		$stmt->bind_param("i", $_GET["edit"]);
		
		//bind result data
		$stmt->bind_result($id, $recipient, $message);
		
		$stmt->execute();
		
		
		if($stmt->fetch()){
		
			echo $id." ".$recipient." ".$message;
		
		}else{
		
			//smth went wrong
			echo $stmt->error;
		
		}
	}
	

?> 
<br>
<a href="table.php">table</a>
<h2> First application </h2>

<form method="get">

	<input hidden name="edit" value="<?=$id;?>">

	<input name="edit" value="<?=$id;?>"><br></br>
	<label for="to">to:* </label>
	<input type="text" name="to" value="<?php echo $recipient; ?>"<br><br>
	
	<label for="message">Message:* </label>
	<input type="text" name="message" value="<?php echo $message; ?>"><br><br>
	
	<!-- This is the save button-->
	<input type="submit" value="Save to DB">

<form>

<p>Idea</p>
