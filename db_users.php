<?php 

//Database details 

define ('DB_HOST', 'localhost'); 

//Username 

define ('DB_USERNAME', 'creative_esicdir'); 

//Pass 

define ('DB_PASS', 'esicdir'); 

//Database Name 

define ('DB_NAME', 'creative_esic_directory'); 



$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASS, DB_NAME);
 
// check connection
if ($conn->connect_error) {
  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
}


$sql='SELECT id, firstName, lastName, email FROM user';
 
$results=$conn->query($sql);
 
if($results === false) {
  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
} else {
  echo $rows_returned = $results->num_rows;
}

echo '<pre>';
foreach ($results as $key => $result) {
	///print_r($result);
	$id 		= $result->id;
	$firstName 	= $result->firstName;
	$lastName 	= $result->lastName;
	$email 		= $result->email;
 
	$sql="INSERT INTO hoosk_user (userID, firstName, lastName, email) VALUES ($id,$firstName,$lastName,$email)";
	 
	if($conn->query($sql) === false) {
	  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
	}else{
	  echo $last_inserted_id = $conn->insert_id;
	  echo $affected_rows = $conn->affected_rows;
	}

	$sql="UPDATE hoosk_user SET userID=  $id WHERE id = $id ";
	 
	if($conn->query($sql) === false) {
	  trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
	} else {
	  echo $affected_rows = $conn->affected_rows;
	}
}
?>
