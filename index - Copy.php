<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/mainTemplate.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Bootstrap - Prebuilt Layout</title>
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

<?php 
$user_n ="";

if(isset($_SESSION) && $_SESSION['loged']==0){
	//$user_n = $_SESSION["uname"];
	header("Location: /EventsApp/login.php");
	}
else{
	
	}

?>
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
        <li><a href="myEvents.php">My Events</a></li>
        <?php 
        if(isset($_SESSION) && $_SESSION['loged']==1){
        echo '<li><a href="/EventsApp/includes/db.php?do=logout" class="login "><span class="glyphicon glyphicon-user " aria-hidden="true"></span>Logout '. $_SESSION['uname'].'</a></li>';
        }else if(isset($_SESSION) && $_SESSION['loged']==0){
        
        echo '';
        }
        
        ?>
        
        
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
$mydata = getEvents();

foreach($mydata as $data){
	echo '
	<div class="col-lg-12 col-xs-12 event_bg events_list">
	  <div class="col-lg-1 col-xs-12"> <div class="h1">12<br><span class="h3">MAR</span></div>
      </div>
	  <div class="col-lg-7 col-xs-12">
	  <div class="h2"><';
	$data['name']; 
	
	echo '</div>';		
		
}


?>


	<div class="col-lg-12 col-xs-12 event_bg events_list">
	  <div class="col-lg-1 col-xs-12"> <div class="h1">12<br><span class="h3">MAR</span></div>
      </div>
	  <div class="col-lg-7 col-xs-12">
	    <div class="h2">Dinner at The Meadows</div>
	    <div class="h4">
<p><span class="glyphicon glyphicon-time" aria-hidden="true"></span><span class="event_text">9.00 pm</span><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span><span class="event_text">Content for New div Tag Goes Here</span></p>
<p class="event_disc"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus in lacus id sem
posuere sodales. Morbi dapibus sem quam, ut congue nisl lacinia ac. </p>
<a href="event_details.php">More</a>
</div>


</div>
<div class="col-lg-4 col-xs-12">
<button id="book" type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal" >Book</button> 
<button type="button" class="btn btn-danger btn-lg">Decline</button>



</div>
	</div>
	<div class="col-lg-12 col-xs-12 event_bg events_list">
	  <div class="col-lg-1 col-xs-12">
	    <div class="h1">12<br>
	      <span class="h3">MAR</span></div>
      </div>
	  <div class="col-lg-7 col-xs-12">
	    <div class="h2">Dinner at The Meadows</div>
	    <div class="h4">
	      <p><span class="glyphicon glyphicon-time" aria-hidden="true"></span><span class="event_text">8.00 pm</span><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span><span class="event_text">The Meadows 80 Northcorp Bvd Broadmeadows</span></p>
	      <p class="event_disc"> Content for New div Tag Goes Here </p><a href="event_details.php">More</a>
        </div>
      </div>
	  <div class="col-lg-4 col-xs-12">
	    
		<button type="button" class="btn btn-warning btn-lg">Remove Booking (2)</button>
      </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">EVENT CONFIRMATION</h4>
      </div>
      <div class="modal-body">
        
         <form>
          <div class="form-group">
            <label for="recipient-name" class="control-label">No of attendies:</label>
            <select class="form-control">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button  id="book" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" data-dismiss="modal">Book</button>
      </div>
    </div>
  </div>
</div>
<script src="js/jquery-1.9.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('#book').click(function(){
            $.ajax({
                url:'includes/db.php',
				data:{"do":"new_user"},
				type:'GET',
                success: function(Response){
                    
                }
            });
        });
    });
    </script>
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
