<?php 
  session_start(); 
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<!--Mandatory meta for Bootstrap-->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="icon" href="../images/icon.png">
		<!--Bootstrap-->
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/frontpage.css">


		<title>Climbers database
        <?php
          if(isset($_SESSION['login_user']))
                  {
                      echo ' admin '.$_SESSION['login_user'];
                  }
          ?>
    </title>
	</head>

	<body>
	<!--Navigation Menu-->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      	<div class="container">
	        <a class="navbar-brand" href="../index.html">Mountaineering</a>
	        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
	          <span class="navbar-toggler-icon"></span>
	        </button>
       	 	<div class="collapse navbar-collapse" id="navbarResponsive">
	          	<ul class="navbar-nav ml-auto">
                 <?php 
                  if(isset($_SESSION['login_user']))
                  {
                      echo '<li class="nav-item">
                            <a class="nav-link" href="../scripts/logout.php">Log out</a>
                            </li>';
                  }
                ?>
	           	 	<li class="nav-item">
	              		<a class="nav-link" href="../index.php">Home</a>
	            	</li>
	            	<li class="nav-item">
	              		<a class="nav-link" href="mountains.php">Mountains</a>
	            	</li>
	            	<li class="nav-item active">
	              		<a class="nav-link" href="#">Famous climbers
                      <span class="sr-only">(current)</span>
                    </a>
	            	</li>
	           	 	<li class="nav-item">
	             	 	<a class="nav-link" href="expeditions.php">Expeditions</a>
	            	</li>
	          	</ul>
        	</div>
      	</div>
   	 </nav>

     <!-- Header with Background Image -->
    <header class="business-header img-3">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="display-3 text-center text-white mt-4"><strong>Search the most famous climbers</strong></h1>
          </div>
        </div>
      </div>
    </header>

     <!--Search form-->
     <div class="container">
        <p>Here you can search the database for famous climebrs. You can search by name or by country.</p><br>

        <form id="inForm">
          <!--Query data-->
          <div class="form-group">
            <label for="querydata">Insert the searched term</label>
            <input type="text" class="form-control" id="querydata" name="querydata" aria-describedby="inHelp" placeholder="Enter term">
            <small id="inHelp" class="form-text text-muted">Your input depends on the option chosen below</small>
          </div>
          <!--/.Query data-->

          <!--Criteria selection-->
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="criteria" id="name" value="name" checked>
            <label class="form-check-label" for="name">
              By name
            </label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="criteria" id="country" value="country">
            <label class="form-check-label" for="country">
              By country
            </label>
          </div>
          <!--/.Criteria selection-->
          <br>

          <button type="button" name="submit" id="submit" class="btn btn-primary">Submit</button>
        </form>
        <br>
        <div id = "live_data"></div>
        <span id="result"> </span>
     </div>

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
    <script src="../js/bootstrap.min.js"></script>..
	</body>

</html>

<!--LIVE TABLE jquery-->
<script>  
$(document).ready(function(){ 
    function fetch_data()  
    {  
        var criteria = $('input[name=criteria]:checked', '#inForm').val();
        var querydata = $('input[name=querydata]', '#inForm').val(); 
        $.ajax({  
            url:"../scripts/select.php",  
            method:"POST", 
            data:{table:'climbers', criteria:criteria, qdata:querydata},
            dataType: "text",   
            success: function(data){  
                $('#live_data').html(data);
            }  
        });  
    }  
    $(document).on('click', '#submit', function(){
      fetch_data();
    });
    $(document).on('click', '#btn_add', function(){  
        var cname = $('#clname').text();  
        var cloc = $('#clloc').text();
        var cdob = $('#cldob').text();    
        if(cname == '')  
        {  
            alert("Enter climber name!");  
            return false;  
        }  
        if(cloc == '')  
        {  
            alert("Enter climber country!");  
            return false;  
        } 
        if(cdob == '')  
        {  
            alert("Enter climber date of birth!");  
            return false;  
        } 
        $.ajax({  
            url:"../scripts/insert.php",  
            method:"POST",  
            data:{cname:cname, cloc:cloc, cdob:cdob, table:'climbers'},  
            dataType:"text",  
            success:function(data)  
            {  
                alert(data);  
                fetch_data();  
            }  
        })  
    });  
    
  function edit_data(id, text, column_name)  
    {  
        $.ajax({  
            url:"../scripts/edit.php",  
            method:"POST",  
            data:{id:id, text:text, column_name:column_name, table:'climbers'},  
            dataType:"text",  
            success:function(data){  
            //alert(data);
            $("#result").html("<div class='alert alert-success'>"+data+"</div>").fadeTo(1000, 500).slideUp(500); 
           fetch_data();} 
        });  
    }

    $(document).on('blur','.clname', function(){  
        var id = $(this).data("id1");  
        var cname = $(this).text(); 
        edit_data(id, cname, "Name");
    });  
    $(document).on('blur', '.clloc', function(){  
        var id = $(this).data("id2");  
        var cloc = $(this).text();  
        edit_data(id,cloc, "Country");  
    });
    $(document).on('blur', '.cldob', function(){  
        var id = $(this).data("id3");  
        var cdob = $(this).text();  
        edit_data(id,cdob, "Date_of_birth");  
    });   

   $(document).on('click', '.btn_delete', function(){  
        var id=$(this).data("id4");  
        if(confirm("Are you sure you want to delete this?"))  
        {  
            $.ajax({  
                url:"../scripts/delete.php",  
                method:"POST",  
                data:{id:id, table:'climbers'},  
                dataType:"text",  
                success:function(data){  
                    alert(data);  
                    fetch_data();  
                }  
            });  
        }  
    });  
});  
</script>