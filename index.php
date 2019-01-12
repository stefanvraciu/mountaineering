<?php 
  session_start(); 
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<!--Mandatory meta for Bootstrap-->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="icon" href="images/icon.png">
		<!--Bootstrap-->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/frontpage.css">


		<title>Mountaineering - Your alpine support</title>
	</head>

	<body>
	<!--Navigation Menu-->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      	<div class="container">
	        <a class="navbar-brand" href="#">Mountaineering</a>
	        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
	          <span class="navbar-toggler-icon"></span>
	        </button>
       	 	<div class="collapse navbar-collapse" id="navbarResponsive">
	          	<ul class="navbar-nav ml-auto">
                <?php 
                  if(isset($_SESSION['login_user']))
                  {
                      echo '<li class="nav-item">
                            <a class="nav-link" href="scripts/logout.php">Log out</a>
                            </li>';
                  }
                  if(!isset($_SESSION['login_user']))
                  {
                      echo '<li class="nav-item" data-toggle="modal" data-target="#loginmodal">
                      <a class="nav-link" href="#" data-toggle="modal" data-target="#loginmodal">Administrator panel</a>
                    </li>';
                  }
                ?>
	           	 	<li class="nav-item active">
	              		<a class="nav-link" href="#">Home
	                		<span class="sr-only">(current)</span>
	              		</a>
	            	</li>
	            	<li class="nav-item">
	              		<a class="nav-link" href="pages/mountains.php">Mountains</a>
	            	</li>
	            	<li class="nav-item">
	              		<a class="nav-link" href="pages/climbers.php">Famous climbers</a>
	            	</li>
	           	 	<li class="nav-item">
	             	 	<a class="nav-link" href="pages/expeditions.php">Expeditions</a>
	            	</li>
	          	</ul>
        	</div>
      	</div>
   	 </nav>

    <!--Modal for login-->
    <form action="scripts/login.php" method="POST">
    <div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="loginModalLabel">Login as administrator</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <div class="modal-body">
            <!--User data-->
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="username" name="username" aria-describedby="inHelp" placeholder="Enter username">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" aria-describedby="inHelp" placeholder="Enter password">
            </div>
           </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             <button type="submit" class="btn btn-primary">Login</button>
           </div>
         </div>
       </div>
    </div>
    </form>
    <!--./Modal for login-->

    <!-- Header with Background Image -->
    <header class="business-header img-1">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
          	<h1 class="display-3 text-center text-white mt-4"><strong>Welcome to Mountaineering!</strong></h1>
          </div>
        </div>
      </div>
    </header>

    <!-- Page Content -->
    <div class="container">

      <div class="row">
        <div class="col-sm-8">
          <h2 class="mt-4">What is this site about</h2>
          <p>This site contains a database of all the mountains in the world (according to Wikipedia) as well as a database of famous climbers and their expeditions.</p>
          <p>You can search mountains by country, height, name, search climbers and expeditions and get recommendations of specific equippment depending on selected mountains.</p>
          <p>
            <a class="btn btn-primary btn-lg" href="pages/mountains.php">Search the database &raquo;</a>
          </p>
        </div>
        <div class="col-sm-4">
          <h2 class="mt-4">Contact</h2>
          <address>
            <strong>Mountaineering Co.</strong>
            <br>Str. Observatorului 34
            <br>Cluj-Napoca, RO 400423
            <br>
          </address>
          <address>
            <abbr title="Phone">P:</abbr>
            (+40) 727 861 933
            <br>
            <abbr title="Email">E:</abbr>
            <a href="contact@mountaineering.com">contact@mountaineering.com</a>
          </address>
        </div>
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-sm-4 my-4">
          <div class="card">
            <img class="card-img-top" src="images/k2front.jpg" alt="K2">
            <div class="card-body">
              <h4 class="card-title">Mountains of the world</h4>
              <p class="card-text">Search throuh all the mountains of the world by name, height or country. Learn the top of mountains between given ranges and compare their details.</p>
            </div>
            <div class="card-footer">
              <a href="pages/mountains.php" class="btn btn-primary">Search mountains</a>
            </div>
          </div>
        </div>
        <div class="col-sm-4 my-4">
          <div class="card">
            <img class="card-img-top" src="images/climbfront.jpg" alt="Climber">
            <div class="card-body">
              <h4 class="card-title">Famous climbers</h4>
              <p class="card-text">Search famous climbers by name or country and learn details about them and their expeditions.</p>
            </div>
            <div class="card-footer">
              <a href="pages/climbers.php" class="btn btn-primary">Search climbers</a>
            </div>
          </div>
        </div>
        <div class="col-sm-4 my-4">
          <div class="card">
            <img class="card-img-top" src="images/expfront.jpg" alt="Expedition">
            <div class="card-body">
              <h4 class="card-title">Famous expeditions</h4>
              <p class="card-text">Learn which climbers were the first to conquer the greatest peaks of the world and learn details about their expeditions.</p>
            </div>
            <div class="card-footer">
              <a href="pages/expeditions.php" class="btn btn-primary">Search expeditions</a>
            </div>
          </div>
        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Mountaineering Co. <br>2018</p>
      </div>
      <!-- /.container -->
    </footer>

		<!--jQuery-->
	   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	</body>

</html>