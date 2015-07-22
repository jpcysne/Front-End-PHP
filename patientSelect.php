<?php

//session_start();

//require_once 'api.password.php';

//connect to the DB
//connect to the DB
$dbHost = "us-cdbr-azure-central-a.cloudapp.net";
$dbUser = "b125155e5e1df5";
$dbPass = "bba28a8d";
$dbName = "PACMySQLDatabase";
// 	$db = new mysqli( $dbHost, $dbUser, $dbPass, $dbName );

// $db = new mysqli( $dbHost, $dbUser, $dbPass, $dbName );

// if( $db->connect_errno )
//     die( "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error );

// if( !$db->set_charset( "utf8mb4" ) ) {
//     printf("Error loading character set utf8mb4: %s\n", $db->error);
// } 

$userid = $_SESSION['userId'];
$tablePrefix = "";
$userTable = $tablePrefix . "patientaccess";
$query = "SELECT * FROM {$userTable} WHERE userId={$userid}";
$result = $db->query( $query );
if( !$result ) {
	//an error occured
	die( "There was a problem executing the SQL query. MySQL error returned: {$db->error} (Error #{$db->errno})" );
}
if (isset($_POST['patId']))
{
	$_SESSION['patid']=$_POST['patId'];
   include("displayPlots.js");
 
}
else if (isset($_SESSION['patid']))
{
	include("displayPlots.js");
}
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>PAC Lab: View Patient Data</title>
	
	<link rel="stylesheet" href="patientSelect.css">
	
	<script language="javascript" type="text/javascript" src="flot/jquery.flot.resize.js"></script>

	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	
	
  </head>
  <body>
  	<nav class="navbar navbar-custom navbar-static-top">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <img src="logo_loyola2.jpg" alt="Loyola Chicago University logo" align="left" height="50">
  </div>
  <div class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.html">Home</a></li>
      <li class="navbar-brand">Loyola PAC Lab</a></li>
    </ul>
    </nav>
  	
  	<div id="middle">
  	<h1>View Patient Data</h1>
  	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="login">
      <p>Patient ID:
		<select name="patId" id="patId">
	<?php 
		foreach($result as $row){
			echo("<option>".$row['patientId']."</option>");
		}
	?>
			
		</select>
		<p class="login-submit">
      <button type="submit" class="login-button">Select</button>
    </p>
    </div>
    </form>
	</body>
	</html>
