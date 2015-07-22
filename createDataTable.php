<?php
session_start();

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

$dataTypeName = $_POST['dataType'];
$dimensions = $_POST['dimensions'];
$units = $_POST['units'];

$sql1 = "CREATE TABLE IF NOT EXISTS {$dataTypeName} (
	`ID` int(11) NOT NULL AUTO_INCREMENT,
  	PRIMARY KEY (ID)
) ;";

$db->query($sql1);

foreach ($dimensions as $dim){
	$sql = "ALTER TABLE {$dataTypeName} ADD {$dim} int(11)";
	$db->query($sql);
}

include('addData.php');