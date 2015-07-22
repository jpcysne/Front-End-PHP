<?php
//connect to the DB
//connect to the DB
$dbHost = "us-cdbr-azure-central-a.cloudapp.net";
$dbUser = "b125155e5e1df5";
$dbPass = "bba28a8d";
$dbName = "PACMySQLDatabase";

$db = new mysqli( $dbHost, $dbUser, $dbPass, $dbName );

if( $db->connect_errno )
    die( "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error );

if( !$db->set_charset( "utf8mb4" ) ) {
    printf("Error loading character set utf8mb4: %s\n", $db->error);
} 

$dataType = $_POST['selection'];

//redirect to create new datatype if "other" is chosen
if ($dataType=='other'){
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=newDataType.php">';
}

//otherwise find the table with the expected data
else{
	$query = "SELECT * from {$dataType}";
	$result = $db->query($query);

	while( $row = $result->fetch_assoc() ) {
		echo $row['ID'];
		echo " ";
	}
}

//TODO: only current user's/userGroup's dataTypes
