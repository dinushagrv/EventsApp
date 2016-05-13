<?php 


require_once('medoo.php');


$db = '';

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

$db = dbConnect();

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
		
		if( isset($_GET['do']) && $_GET['do']=="book"){
				$userid = $_GET['uid'];
				$event_id = $_GET['eid'];
				bookEvent($userid,$event_id);
				//header("Location: /EventsApp/index.php?message=Event booked sucessfully!");
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
		
		if( isset($_GET['do']) && $_GET['do']=="dec"){
		
		$event_id = $_GET['eid'];
		$username = $_GET['uid'];
		
		declineEvent($username,$event_id);	
		//header("Location: /EventsApp/index.php?message=Event Declined!");
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
	$db= dbConnect();
	if ($db->has("users", [
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
	session_start();
	session_destroy();
	header("Location: /EventsApp/login.php");
	}
//Get No of attendies 	
function getAttendance($eventID){
	$db = dbConnect();
	return $db ->count('event_decision',['AND' => ['eventid'=> $eventID ,'attending'=>'yes']]) + $db->sum("event_decision","extra_attendies",['AND' =>['eventID' =>$eventID,'attending'=>'yes']]);
	}
	
//Get 
function getAttendanceList($event_id){
	$db = dbConnect();
	//$db->select(['users u', 'event_decision ed'],["user_name"],["event_id" => $event_id]);
	//return $db->query('SELECT display_name FROM users u, event_decision ed WHERE u.user_id = ed.userid && && ed.attending="yes" && ed.eventid='.$event_id);
	return $db->query("SELECT display_name FROM users u, event_decision ed WHERE u.user_name = ed.user_name && ed.attending='yes' && ed.eventid=".$event_id);
	}
function getNonAttendanceList($event_id){
	$db = dbConnect();
	//$db->select(['users u', 'event_decision ed'],["user_name"],["event_id" => $event_id]);
	//return $db->query('SELECT display_name FROM users u, event_decision ed WHERE u.user_id = ed.userid && && ed.attending="yes" && ed.eventid='.$event_id);
	return $db->query("SELECT display_name FROM users u, event_decision ed WHERE u.user_name = ed.user_name && ed.attending='no' && ed.eventid=".$event_id);
	}
	
	
function declineEvent($username,$eventId){
	//var_dump($username);
	//var_dump($eventId);
	$db = dbConnect();
	$isBooked =$db ->query("SELECT count(*) FROM event_decision WHERE user_name='".$username."' && eventid=".$eventId);
	$results=$isBooked->fetchAll();
	
	
	var_dump($isBooked->fetchAll());
	var_dump($results[0][0]);
	if($results[0][0]==0){
		$db->insert('event_decision',['user_name'=>$username,
		'eventid'=>$eventId,
		'attending'=>'no',
		'extra_attendies'=>'0'
		]);
		header("Location: /EventsApp/index.php?message=Event Declined Successfully");
	}else{
		//$update = $db->update('event_decision',['attending'=>'no'],['user_name'=>$username,'eventid'=>$eventId]);
		$update =$db ->query("UPDATE event_decision SET attending='no' WHERE user_name='".$username."' && eventid=".$eventId);
		var_dump($update);
		if($update==1){
		header("Location: /EventsApp/index.php?message=Event Declined Successfully");
		}
		
		}
	}
function bookEvent($username,$eventId){
	$db =dbConnect();
	$isBooked =$db ->query("SELECT count(*) FROM event_decision WHERE user_name='".$username."' AND eventid=".$eventId);
	$results=$isBooked->fetchAll();
	$count = intval($results[0][0]);
	//var_dump($count);
	//var_dump($username);
	//var_dump($eventId);
	if($count==0){
		echo 'in if';
	$res= $db->insert("event_decision",["user_name"=>$username,"eventid"=>$eventId,"attending"=>"yes","extra_attendies"=>0]);
	//var_dump($res);
	header("Location: /EventsApp/index.php?message=Event Changed sucessfully!");
	
	}else{
		$update =$db ->query("UPDATE event_decision SET attending='yes' WHERE user_name='".$username."' && eventid=".$eventId);
		header("Location: /EventsApp/index.php?message=Event Changed sucessfully!");
		
		}
	
	//header("Location: /EventsApp/index.php?message=Login Successful");
	
	}
function getNotAttending($eventID){
		$db = dbConnect();
	return $db ->count('event_decision',['AND' => ['eventid'=> $eventID ,'attending'=>'no']]) + $db->sum("event_decision","extra_attendies",['AND' =>['eventID' =>$eventID,'attending'=>'no']]);
	
	}
	
function getDisplayName($username){
		$db = dbConnect();
		return $db->select("users","display_name",["user_name"=>$username]);
		
		}
function isBookedMessage($username, $eventID){
		$db = dbConnect();
		//$isBooked =$db ->query("SELECT count(*) FROM event_decision WHERE user_name='".$username."' AND eventid=".$eventId.'AND attending=');
		$isBooked = $db->count("event_decision",['AND' => ['user_name'=>$username,'eventid' =>$eventID,'attending'=>'yes']]);
		
		//var_dump($isBooked);
		if($isBooked==1){
			return '<span class="alert alert-warning">  <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> You have already booked for this event!</span>';
			}
	}
function isBooked($username, $eventID){
	$db = dbConnect();
	
	$isBooked = $db->count("event_decision",['AND' => ['user_name'=>$username,'eventid' =>$eventID,'attending'=>'yes']]);
	if($isBooked==1){
		return 1;
		}else{
		return 0;
		}
	
	
	}
	






?>

