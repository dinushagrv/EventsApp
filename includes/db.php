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
	
		if(isset($_GET['do']) && $_GET['do']=="login"){
	
		loginUser($_POST['user'],$_POST['pass']);
		//$database-> select("users","");
		
		
	//	$database->insert("users", [
	//	"user_name" => "foo2",
	//	"user_pwd" => md5($_POST['pass']),
	//	]);
		}
		
		if(isset($_GET['do']) && $_GET['do']=="new_event"){
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
		
		header("Location: /EventsApp/index.php?message=New Event Sucessfully created");
		}
		
		

		if( isset($_GET['do']) && $_GET['do']=="add"){
		
		$event_id = $_GET['eid'];	
		}
		
		if(isset($_GET['do']) && $_GET['do']=="logout"){
			//var_dump($_SESSION["uname"]);
			
			//$_SESSION["loged"]=0;
			//$_SESSION["uname"]="";
			//session_destroy();
			//session_unset();
			//header("Location: /EventsApp/login.php");
			logout();
			
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

function loginUser($user, $pass){
	session_start();
	$database= dbConnect();
	if ($database->has("users", [
	"AND" => [
		"OR" => [
			"user_name" => $user
			//"email" => $pass
		],
		"user_pwd" => $pass
	]
		]))
	{
	echo "Password is correct.";
	session_start();
	$_SESSION["uname"]=$user;
	$_SESSION["loged"]=1;
	header("Location: /EventsApp/index.php?message=Login Successful");
	
	}
	else
	{
	echo "Password error.";
	}
	
	}
function logout(){
	session_destroy();
	
	}



?>

