<?php 
    include ("../Nav/loggedHeader.php");
    include ("../Session/session.php");
    require_once ("getModule.php");

    $path = "../User/Login.php"; //this path is to pass to checkSession function from session.php. If the session is expired or no session, it will route to this page

    session_start(); //must start a session in order to use session in this page.
      if (!isset($_SESSION['name'])){
          session_unset();
          session_destroy();
          header("Location:".$path);//return to the login page
      }
     
      $user = $_SESSION['name'];
      checkSession ($path); //calling the function from session.php

      $level = array("All","3","4","5","6","7","8");
 
?>

<div class="container container-fluid pb-5">
    <main role="main">
      <h2>Register Module Page</h2><br>
      <h4>Student ID : <?php echo $_SESSION['stdID'];?></h4>
      <h4>Student Name : <?php echo $_SESSION['name'];?></h4>
      <br>
      <div class="row">
        <div class="col-md-6">
            <form method="post">
                <div class="form-group">
                    <label class="control-label" style="font-weight: bold;">Filter by level : </label>
                    <select type="text" style="width:80px;" name="filterLevel">
                        <?php for ($i=0; $i<count($level); $i++): ?>
                        <option <?php if (isset($_POST['filterLevel']) && ($level[$i]==$_POST['filterLevel'])) echo "selected"; ?> ><?php echo $level[$i];?></option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" name="submit" value="filter" class="btn btn-primary">Filter</button>      
                </div>
            </form>
        </div>
      </div>

      <?php 
        //getting the module from database
        //print_r($_POST['filterLevel']);
        $moduleArray = getModule();
        //print_r($moduleArray);
      ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
<script>
    $(document).ready(function(){
        $("#form1 #selectAll").click(function(){
            $("#form1 input[type='checkbox']").prop('checked', this.checked);
        });
    });
</script>

    <div class="row">
        <div class="col-10">
            <form method="post" id="form1" action="registerModule2.php">
            <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Module Code</th>
                            <th>Module Name</th>
                            <th>Level</th>
                            <th><input type="checkbox" name ="moduleAll" id="selectAll" class="form-check-inline"/>Select all<br></th>
                        </tr>
                    </thead>  
                    <?php 
                        for ($i=0; $i<count($moduleArray); $i++): 
                    ?>
                    <tr>
                        
                        <td><?php echo $i+1; ?></td>
                        <td><?php echo $moduleArray[$i]['ModuleCode']; ?></td>
                        <td><?php echo $moduleArray[$i]['ModuleName']; ?></td>
                        <td><?php echo $moduleArray[$i]['ModuleLevel']; ?></td>
                        <td><input type="checkbox" name="selectModule[]" value="<?php echo $moduleArray[$i]['ModuleCode']; ?>"></td>
                    </tr>     
                    <?php endfor; ?> 

                    <?php if (count($moduleArray)==0) : ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger" role="alert">
                                <?php echo "Record not found!"; ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endif;?>
            </table>
                <div class="form-group">
                        <button type="submit" name="submitModule" class="btn btn-primary">Register Module</button>      
                    </div>
            </form>
        </div>
    </div>

    </main>
</div>

<?php
include ("../Nav/loggedFooter.php");
?>