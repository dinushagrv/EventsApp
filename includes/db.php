<?php 


require_once('medoo.php');

function dbConnect(){
$database = new medoo([
	'database_type' => 'mysql',
	'database_name' => 'events',
	'server' => 'localhost',
	'username' => 'root',
	'password' => 'password',
	'charset' => 'utf8',

]);
return $database;
}

if($_GET){
		$database= dbConnect();
	
		if($_GET['do']=="new_user"){
	
		$database->insert("users", [
		"user_name" => "foo2",
		"user_pwd" => "foo@bar.com"
		]);
		}
		
		if($_GET['do']=="new_event"){
			$eventname =$_POST['ename'];
			echo $eventname;
				
		
		$database->insert("events", [
		"name" => $_POST['ename'],
		"discription" => $_POST['disc'],
		"time"=>$_POST['time'],
		"address"=>$_POST['address'],
		"day"=>$_POST['day'],
		"month"=>$_POST['month'],
		"year"=>$_POST['year'],
		"max_attendies" => $_POST['maxattendies']
		]);
		}

	if($_GET['do']=="add"){
		
		$event_id = $_GET['eid'];	
	}
	
	
}


function getEvents(){
	$db= dbConnect();
	return $db->select("events",["name","discription","time","address","day","month","year","id"]);
	
	}
	
//Checks whether a perticular user is attending this event
function hasResponded($eventID,$uid){
	$db= dbConnect();
	//return $db->select("event_decision",["userid" .=$uid,"AND","eventid".=$eventID,"attending".=."yes"]);
	}
function getEvent($eventID){
	//echo $eventID;
	$db = dbConnect();
    //return 	$db->query('SELECT * FROM events WHERE id='.strval($eventID));
	//echo $db ->select('events','*','id'.'='.strval($eventID));
	return $db ->select('events',["name","discription","time","address","day","month","year","id"],array('id'=> $eventID));
}



?>

