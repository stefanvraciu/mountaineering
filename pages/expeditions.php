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


		<title>Expeditions database <?php
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
	            	<li class="nav-item">
	              		<a class="nav-link" href="climbers.php">Famous climbers</a>
	            	</li>
	           	 	<li class="nav-item active">
	             	 	<a class="nav-link" href="#">Expeditions
                    <span class="sr-only">(current)</span>
                  </a>
	            	</li>
	          	</ul>
        	</div>
      	</div>
   	 </nav>

     <!-- Header with Background Image -->
    <header class="business-header img-4">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="display-3 text-center text-white mt-4"><strong>Search the most famous expeditions</strong></h1>
          </div>
        </div>
      </div>
    </header>

     <!--Search form-->
     <div class="container">
        <p>Here you can search the database for famous expeditions mainly on the world's 8 thousanders (mountains over 8000 meters). You can search by name of climber or by mountain name.</p><br>

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
            <input class="form-check-input" type="radio" name="criteria" id="name" value="cname" checked>
            <label class="form-check-label" for="name">
              By climber name
            </label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="criteria" id="mname" value="mname">
            <label class="form-check-label" for="country">
              By mountain name
            </label>
          </div>
          <!--/.Criteria selection-->
          <br>

          <button type="button" name="submit" id="submit" class="btn btn-primary">Submit</button>
        </form>
        <br>
          <?php
          if(isset($_POST["submit"]))
          {
            $data=$_POST["querydata"];
            $crit=$_POST["criteria"];

            # Connect
            $conn= mysqli_connect('localhost', 'vraciu', 'vraciu','proiectdb') or die('Could not connect: '.mysqli_error($conn));

            # Perform database query
            switch($crit)
            {
              case "cname": $query = "SELECT e.exp_id, c.Name, c.Country, m.Name, m.Height, e.date, e.notes FROM
                                      mountains AS m JOIN expeditions AS e ON m.ID=e.mountain_id
                                      JOIN climbers AS c ON c.ID=e.climber_id WHERE c.Name LIKE ('%".$data."%')";
                          break;
              case "mname": $query = "SELECT e.exp_id, c.Name, c.Country, m.Name, m.Height, e.date, e.notes FROM
                                      mountains AS m JOIN expeditions AS e ON m.ID=e.mountain_id
                                      JOIN climbers AS c ON c.ID=e.climber_id WHERE m.Name LIKE ('%".$data."%')";
                          break;
            }
            $result = mysqli_query($conn, $query) or die('Query failed:'.mysqli_error());

            echo "<table class=\"table table-striped table-hover table-responsive-lg\">";
            echo "<thead class=\"thead-dark\">
                <tr>
                  <th scope=\"col\">Expedition ID</th>
                  <th scope=\"col\">Climebr name</th>
                  <th scope=\"col\">Climber country</th>
                  <th scope=\"col\">Mountian name</th>
                  <th scope=\"col\">Height</th>
                  <th scope=\"col\">Date of expedition</th>
                  <th scope=\"col\">Notes on expedition</th>
                </tr>
                </thead>
                <tbody>";

            # Browse (or filter) through rows and display the desired information
                if(!isset($_SESSION['login_user']))
          {
            while ($row = mysqli_fetch_array($result, MYSQLI_BOTH))
            {
              echo "<tr>";
              echo "<th scope=\"row\">".$row[0]."</th>";
              echo "<td>".$row[1]."</td>";
              echo "<td>".$row[2]."</td>";
              echo "<td>".$row[3]."</td>";
              echo "<td>".$row[4]."</td>";
              echo "<td>".$row[5]."</td>";
              echo "<td>".$row[6]."</td>";
              echo "</tr>";
            }
          }
          else
          {
            while ($row = mysqli_fetch_array($result, MYSQLI_BOTH))
            {
              echo "<tr>";
              echo "<th scope=\"row\">".$row[0]."</th>";
              echo "<td contenteditable=\"true\">".$row[1]."</td>";
              echo "<td contenteditable=\"true\">".$row[2]."</td>";
              echo "<td contenteditable=\"true\">".$row[3]."</td>";
              echo "<td contenteditable=\"true\">".$row[4]."</td>";
              echo "<td contenteditable=\"true\">".$row[5]."</td>";
              echo "<td contenteditable=\"true\">".$row[6]."</td>";
              echo "</tr>";
            }
          }
          echo "</tbody></table>";
          }
          ?>
          <div id="live_data"></div>
          <span id="result"></span>
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
    <script src="../js/bootstrap.min.js"></script>
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
            data:{table:'expeditions', criteria:criteria, qdata:querydata},
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
        var mname = $('#mtname').text();    
        var edat = $('#edat').text(); 
        var enot = $('#enot').text(); 
        if(cname == '')  
        {  
            alert("Enter climber name!");  
            return false;  
        }  
        if(mname == '')  
        {  
            alert("Enter mountain name!");  
            return false;  
        } 
        if(edat == '')  
        {  
            alert("Enter enter expedition date!");  
            return false;  
        } 
        $.ajax({  
            url:"../scripts/insert.php",  
            method:"POST",  
            data:{cname:cname, mname:mname, edat:edat, enot:enot, table:'expeditions'},  
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
            data:{id:id, text:text, column_name:column_name, table:'expeditions'},  
            dataType:"text",  
            success:function(data){  
            //alert(data);
            $("#result").html("<div class='alert alert-success'>"+data+"</div>").fadeTo(1000, 500).slideUp(500); 
           fetch_data();} 
        });  
    }
 
    $(document).on('blur', '.edat', function(){  
        var id = $(this).data("id5");  
        var edat = $(this).text();  
        edit_data(id,edat, "date");  
    }); 
    $(document).on('blur', '.enot', function(){  
        var id = $(this).data("id6");  
        var enot = $(this).text();  
        edit_data(id, enot, "notes");  
    });   

   $(document).on('click', '.btn_delete', function(){  
        var id=$(this).data("id7");  
        if(confirm("Are you sure you want to delete this?"))  
        {  
            $.ajax({  
                url:"../scripts/delete.php",  
                method:"POST",  
                data:{id:id, table:'expeditions'},  
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