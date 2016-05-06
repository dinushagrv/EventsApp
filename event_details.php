<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/mainTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- InstanceBeginEditable name="doctitle" -->
<title>GRV-Event Booking</title>
<!-- InstanceEndEditable -->
<!-- Bootstrap -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">

      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      <a class="navbar-brand" href="/EventsApp">Event Booking</a>

      </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="defaultNavbar1">
      
      <ul class="nav navbar-nav navbar-right">
      	<li><a href="newEvent.php">New Event</a></li>
        <li><a href="#" class="login" data-toggle="modal" data-target="#login-modal"><span class="glyphicon glyphicon-user " aria-hidden="true"></span>Login</a></li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<div class="container">
<div class="row"><!-- InstanceBeginEditable name="Content" -->
<?php
require_once('includes/db.php');


if($_GET){
	
	if($_GET['eid']>=0){
	$event_id = $_GET['eid'];
	
	$mydata = getEvent($event_id);
	//echo var_dump($mydata);
	//$data_array = $mydata->fetchAll();
	 //echo strval($mydata);
	//$mydata[0][];
	}}


?>

  <div class="events_list event_bg">
    <div class="row">
      <div class="col-lg-1 col-xs-12">
      	<div class="h1 event_d_date"><?php echo $mydata[0]['day'];?><br>
	      <span class="h3"><?php echo $mydata[0]['month'];?></span></div>
        </div>
      <div class="col-lg-8 col-xs-12"><div class="h2"><?php echo $mydata[0]['name'];?></div>
      
      </div>
      <div class="col-lg-3 col-xs-12"><h2>
      
      <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal" >Book</button> 
	<button type="button" class="btn btn-danger btn-lg">Decline</button></h2></div>
    </div>
    <hr>
    <div class="row"><h4 class="event_d_title">EVENT DETAILS</h4><p><?php echo $mydata[0]['discription'];?></p></div>
    <hr>
    <div class="row">
      <div class="col-lg-6"><h4 class="event_d_title "><span class="glyphicon glyphicon-time" aria-hidden="true"></span><span class="event_d_title">TIME</span></h4><?php echo $mydata[0]['time'];?></div>
      <div class="col-lg-6"><h4 class="event_d_title"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span><span class="event_d_title">LOCATION</span></h4><?php echo $mydata[0]['address'];?></div>
    </div>
    <hr>
    <div class="row">
    
    <iframe width="100%" height="480" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q=<?php echo $mydata[0]['address']; ?>&output=embed"></iframe>
    </div>
    <hr>
    <div class="row">
      <div class="col-lg-6"><h4 class="event_d_title"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Attending</h4>
      <ul>
      	<li>Alan Clayton</li>
        <li>Andrew Gibson</li>
      </ul>
      
      </div>
      <div class="col-lg-6"><h4 class="event_d_title"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Declined</h4>
      <ul>
      	<li>John Doe</li>
        <li>Jane Doe</li>
      </ul>
      
      </div>
      </div>
<br>
    <div class=""></div>
  </div>
<!-- InstanceEndEditable --></div>
<!-- <hr> -->
<div class="row">
    
    <div class="text-center col-md-6 col-md-offset-3">
    
      <h4>
      <img src="images/grv_logo.png" width="157" height="58" alt=""/></h4>
      <p style="color: #c2c2c2;">Copyright &copy; 2016 &middot; GRV Information Management & Technology Dept.</p>
    </div>
  </div>
  <!--<hr> -->
</div>

<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    	  <div class="modal-dialog">
				<div class="loginmodal-container">
					<h1>Login to Your Account</h1><br>
				  <form action="includes/db.php" method="post">
					<input type="text" name="user" placeholder="Username">
					<input type="password" name="pass" placeholder="Password">
					<input type="submit" name="login" class="login loginmodal-submit" value="Login">
				  </form>
					
				  <div class="login-help">
					<a href="#">Register</a> - <a href="#">Forgot Password</a>
				  </div>
				</div>
			</div>
		  </div>
<script src="js/jquery-1.9.1.min.js"></script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) 
<script src="../js/jquery-1.11.3.min.js"></script>
--> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
</body>
<!-- InstanceEnd --></html>
