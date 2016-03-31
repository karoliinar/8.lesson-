<?php
	//table.php
	
	//getting our config
	require_once("../../config.php");
 
 	//creat connetction
 	$mysql = new mysqli("localhost", $db_username, $db_password, "webpr2016_romil");
 	
 	//SQL sentence
 	$stmt = $mysql->prepare("SELECT id, recipient, message, created FROM messages_sample ORDER BY created DESC LIMIT 10");
 	
 	//if error is sentence
 	echo $mysql->error;
 	
 	//veriables for data for each row we will get
 	$stmt->bind_result($id, $recipient, $message, $created);
 	
 	//query
 	$stmt->execute();
 	
 	$table_html = "";
 	
 	//ass smth to string .=
 	$table_html .= "<table>";
 		$table_html .= "<tr>";
 			$table_html .= "<th>ID</th>";
 			$table_html .= "<th>Recipient</th>";
 			$table_html .= "<th>Message</th>";
 			$table_html .= "<th>Created</th>";
 			$table_html .= "<th>Edit</th>";
 	 	$table_html .= "</tr>";
 	
 	//GET RESULT
 	//we have multiple rowa
 	while($stmt->fetch()){
 	
		//DO SOMETHING FOR EACH ROW
		//echo $id." ".$message."<br>";
		$table_html .= "<tr>"; //start a new row
 			$table_html .= "<td>".$id."</td>"; //add columns
 			$table_html .= "<td>".$recipient."</td>";
 			$table_html .= "<td>".$message."</td>";
 			$table_html .= "<td>".$created."</td>";
 			$table_html .= "<td><a href='edit.php?edit=".$id."'>edit </a></td>";
 	 	$table_html .= "</tr>"; //End row
			
	}
	$table_html .= "</table>";
	echo $table_html;
		
?>
<a href="app.php">app</a>