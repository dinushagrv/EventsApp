<?php 
require_once('medoo.php');

$database = new medoo([
	'database_type' => 'mysql',
	'database_name' => 'events',
	'server' => 'localhost',
	'username' => 'root',
	'password' => 'password',
	'charset' => 'utf8',

]);




if($_GET['do']=="new_user"){
	
	$database->insert("users", [
	"user_name" => "foo2",
	"user_pwd" => "foo@bar.com"
	]);
}

if($_GET['do']=="add"){
	
	$event_id = $_GET['eid'];
	
			
}

function getEvents(){
	
	return $database->select("events","*");

	}
?>