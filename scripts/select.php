<?php  
 include('config.php');
 session_start();
 $output = '';  
 $crit = $_POST['criteria'];
 $table=$_POST['table'];
 $data = $_POST['qdata'];
 switch($table)
 {
  /******************************************************************************************************************************************************************/
    case "mountains":
    {
      if(isset($_SESSION['login_user']))
      {
          $output .= '  
                   <table class="table table-striped table-hover table-responsive-lg" id="mtable">  
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Height</th>
                            <th scope="col">Country</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>';
          }
          else
          {
               $output .= '  
                   <table class="table table-striped table-hover table-responsive-lg" id="mtable">  
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Height</th>
                            <th scope="col">Country</th>
                          </tr>
                        </thead>
                        <tbody>';
          }
          switch($crit)
          {
            case "name": $query = "SELECT * FROM mountains AS m WHERE m.Name LIKE ('%".$data."%')";
                         break;
            case "heightdown": $query = "SELECT * FROM mountains AS m WHERE m.Height <= $data";
                               break;
            case "heightup": $query = "SELECT * FROM mountains AS m WHERE m.Height >= $data";
                             break;
            case "country": $query = "SELECT * FROM mountains AS m WHERE m.Location LIKE ('%".$data."%')";
                            break;
          }
          $result = mysqli_query($db, $query) or die('Query failed:'.mysqli_error());
           $rows = mysqli_num_rows($result);
           if(isset($_SESSION['login_user']))
           { 
              if($rows > 0)  
              {  
                  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))  
                  {  
                       $output .= '  
                            <tr>  
                                 <th scope="row"> '.$row["ID"].'</th>  
                                 <td class="mtnname" data-id1="'.$row["ID"].'" contenteditable>'.$row["Name"].'</td>  
                                 <td class="mtnhgt" data-id2="'.$row["ID"].'" contenteditable>'.$row["Height"].'</td>  
                                 <td class="mtnloc" data-id3="'.$row["ID"].'" contenteditable>'.$row["Location"].'</td>
                                 <td><button type="button" name="delete_btn" data-id4="'.$row["ID"].'" class="btn btn-sm btn-danger btn_delete">x</button></td>  
                            </tr>  
                       ';  
                  }  
                  $output .= '  
                       <tr>  
                            <td></td>  
                            <td id="mtnname" contenteditable></td>  
                            <td id="mtnhgt" contenteditable></td>
                            <td id="mtnloc" contenteditable></td>    
                            <td><button type="button" name="btn_add" id="btn_add" class="btn btn-sm btn-success">+</button></td>  
                       </tr>  
                  ';  
             }  
             else  
             {  
                  $output .= '
                      <tr>  
                            <td colspan = "4"> NO DATA AVAILABLE</td>      
                       </tr> 
                       <tr>  
                            <td></td>  
                            <td id="mtnname" contenteditable></td>  
                            <td id="mtnhgt" contenteditable></td>
                            <td id="mtnloc" contenteditable></td>    
                            <td><button type="button" name="btn_add" id="btn_add" class="btn btn-sm btn-success">+</button></td>  
                       </tr>  ';  
            }
           }
           else
           {
            if($rows > 0) 
            {
              while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))  
                {  
                     $output .= '  
                          <tr>  
                              <th scope="row"> '.$row["ID"].'</th>  
                               <td>'.$row["Name"].'</td>  
                               <td>'.$row["Height"].'</td>  
                               <td>'.$row["Location"].'</td> 
                          </tr>  
                     ';  
                }  
            } 
           else  
           {  
                $output .= '
                    <tr>  
                          <td colspan = "4"> NO DATA AVAILABLE</td>      
                     </tr> ';
           }
           }  
           $output .= '</tbody></table>'; 
          break;
    }

/******************************************************************************************************************************************************************/
    case "climbers":
    {
          if(isset($_SESSION['login_user']))
         {
          $output .= '  
                   <table class="table table-striped table-hover table-responsive-lg" id="mtable">  
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Country</th>
                            <th scope="col">Date of birth</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>';
          }
          else
          {
               $output .= '  
                   <table class="table table-striped table-hover table-responsive-lg" id="mtable">  
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Country</th>
                            <th scope="col">Date of birth</th>
                          </tr>
                        </thead>
                        <tbody>';
          }
          switch($crit)
          {
            case "name": $query = "SELECT * FROM climbers AS c WHERE c.Name LIKE ('%".$data."%')";
                         break;
            case "country": $query = "SELECT * FROM climbers AS c WHERE c.Country LIKE ('%".$data."%')";
                               break;
          }
          $result = mysqli_query($db, $query) or die('Query failed:'.mysqli_error());
           $rows = mysqli_num_rows($result);
           if(isset($_SESSION['login_user']))
           { 
              if($rows > 0)  
              {  
                  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))  
                  {  
                       $output .= '  
                            <tr>  
                                 <th scope="row"> '.$row["ID"].'</th>  
                                 <td class="clname" data-id1="'.$row["ID"].'" contenteditable>'.$row["Name"].'</td>  
                                 <td class="clloc" data-id2="'.$row["ID"].'" contenteditable>'.$row["Country"].'</td>  
                                 <td class="cldob" data-id3="'.$row["ID"].'" contenteditable>'.$row["Date_of_birth"].'</td>
                                 <td><button type="button" name="delete_btn" data-id4="'.$row["ID"].'" class="btn btn-sm btn-danger btn_delete">x</button></td>  
                            </tr>  
                       ';  
                  }  
                  $output .= '  
                       <tr>  
                            <td></td>  
                            <td id="clname" contenteditable></td>  
                            <td id="clloc" contenteditable></td>
                            <td id="cldob" contenteditable></td>    
                            <td><button type="button" name="btn_add" id="btn_add" class="btn btn-sm btn-success">+</button></td>  
                       </tr>  
                  ';  
             }  
             else  
             {  
                  $output .= '
                      <tr>  
                            <td colspan = "4"> NO DATA AVAILABLE</td>      
                       </tr> 
                       <tr>  
                            <td></td>  
                            <td id="clname" contenteditable></td>  
                            <td id="clloc" contenteditable></td>
                            <td id="cldob" contenteditable></td>    
                            <td><button type="button" name="btn_add" id="btn_add" class="btn btn-sm btn-success">+</button></td>  
                       </tr>  ';  
            }
           }
           else
           {
            if($rows > 0) 
            {
              while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))  
                {  
                     $output .= '  
                          <tr>  
                              <th scope="row"> '.$row["ID"].'</th>  
                               <td>'.$row["Name"].'</td>  
                               <td>'.$row["Country"].'</td>  
                               <td>'.$row["Date_of_birth"].'</td> 
                          </tr>  
                     ';  
                }  
            } 
           else  
           {  
                $output .= '
                    <tr>  
                          <td colspan = "4"> NO DATA AVAILABLE</td>      
                     </tr> ';
           }
           }  
           $output .= '</tbody></table>'; 
           break;
         }

/******************************************************************************************************************************************************************/
         case 'expeditions':
         {

            if(isset($_SESSION['login_user']))
           {
              $output .= '  
                       <table class="table table-striped table-hover table-responsive-lg" id="mtable">  
                            <thead class="thead-dark">
                              <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Climber name</th>
                                <th scope="col">Country</th>
                                <th scope="col">Mountain name</th>
                                <th scope="col">Height</th>
                                <th scope="col">Expedition date</th>
                                <th scope="col">Expedition notes</th>
                                <th scope="col">Actions</th>
                              </tr>
                            </thead>
                            <tbody>';
              }
              else
              {
                   $output .= '  
                       <table class="table table-striped table-hover table-responsive-lg" id="mtable">  
                            <thead class="thead-dark">
                              <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Climber name</th>
                                <th scope="col">Country</th>
                                <th scope="col">Mountain name</th>
                                <th scope="col">Height</th>
                                <th scope="col">Expedition date</th>
                                <th scope="col">Expedition notes</th>
                              </tr>
                            </thead>
                            <tbody>';
             }

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

            $result = mysqli_query($db, $query) or die('Query failed:'.mysqli_error());
           $rows = mysqli_num_rows($result);

           if(isset($_SESSION['login_user']))
           { 
              if($rows > 0)  
              {  
                  while($row = mysqli_fetch_array($result, MYSQLI_BOTH))  
                  {  
                       $output .= '  
                            <tr>  
                                 <th scope="row"> '.$row["exp_id"].'</th>  
                                 <td class="clname" data-id1="'.$row["exp_id"].'">'.$row[1].'</td>  
                                 <td class="clloc" data-id2="'.$row["exp_id"].'">'.$row[2].'</td>  
                                 <td class="mtname" data-id3="'.$row["exp_id"].'">'.$row[3].'</td>
                                 <td class="mthgt" data-id4="'.$row["exp_id"].'">'.$row[4].'</td>
                                 <td class="edat" data-id5="'.$row["exp_id"].'" contenteditable>'.$row[5].'</td>
                                 <td class="enot" data-id6="'.$row["exp_id"].'" contenteditable>'.$row[6].'</td>
                                 <td><button type="button" name="delete_btn" data-id7="'.$row["exp_id"].'" class="btn btn-sm btn-danger btn_delete">x</button></td>  
                            </tr>  
                       ';  
                  }  
                  $output .= '  
                       <tr>  
                            <td></td>  
                            <td id="clname" contenteditable></td>  
                            <td id="clloc"></td>
                            <td id="mtname" contenteditable></td> 
                            <td id="mthgt"></td>  
                            <td id="edat" contenteditable></td>  
                            <td id="enot" contenteditable></td>     
                            <td><button type="button" name="btn_add" id="btn_add" class="btn btn-sm btn-success">+</button></td>  
                       </tr>  
                  ';  
             }  
             else  
             {  
                  $output .= '
                      <tr>  
                            <td colspan = "4"> NO DATA AVAILABLE</td>      
                       </tr> 
                       <tr>  
                            <td></td>  
                            <td id="clname" contenteditable></td>  
                            <td id="clloc"></td>
                            <td id="mtname" contenteditable></td> 
                            <td id="mthgt"></td>  
                            <td id="edat" contenteditable></td>  
                            <td id="enot" contenteditable></td>     
                            <td><button type="button" name="btn_add" id="btn_add" class="btn btn-sm btn-success">+</button></td>   
                       </tr>  ';  
            }
           }
           else
           {
            if($rows > 0) 
            {
              while($row = mysqli_fetch_array($result, MYSQLI_BOTH))  
                {  
                     $output .= '  
                          <tr>  
                              <th scope="row"> '.$row["exp_id"].'</th>  
                              <td>'.$row[1].'</td>  
                              <td>'.$row[2].'</td>  
                              <td>'.$row[3].'</td>
                              <td>'.$row[4].'</td>
                              <td>'.$row[5].'</td>
                              <td>'.$row[6].'</td> 
                          </tr>  
                     ';  
                }  
            } 
           else  
           {  
                $output .= '
                    <tr>  
                          <td colspan = "4"> NO DATA AVAILABLE</td>      
                     </tr> ';
           }
           }  
           $output .= '</tbody></table>'; 

            break;
         }
}
 echo $output;  
?>