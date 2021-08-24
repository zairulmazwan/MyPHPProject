<?php include("../Nav/Admin/loggedHeaderAdmin.php"); 
      require_once("FilterStudent.php");
      include("../Session/session.php");

      $level = array("All","3","4","5","6","7");

      $path = "../Admin/LoginAdmin.php"; //this path is to pass to checkSession function from session.php 
     
      session_start(); //must start a session in order to use session in this page.
      if (!isset($_SESSION['name'])){
          session_unset();
          session_destroy();
          header("Location:".$path);//return to the login page
      }
     
      $user = $_SESSION['name'];
      checkSession ($path); //calling the function from session.php


      if(isset($_GET['updated'])){
        echo "<script>alert('".($_GET['updated'] ? "Student Updated Successfully" : "Not sucessful update")."');</script>";
      }
 
      
?>

  <div class="container container-fluid pb-5">
        <main role="main">
        <h2>Admin : View and Filter Student</h2><br>
     
            <div class="row">
                <div class="col-md-6">
                    <form method="post">
                        <!-- asp tags don't exist here <div asp-validation-summary="ModelOnly" class="text-danger"></div> -->
                        <div class="form-group">
                            <label class="control-label">Filter Student by Level : </label>
                            <select type="text" style="width:80px;" name="filterLevel">
                                <?php for ($i=0; $i<count($level); $i++): ?>
                                    <option <?php if(isset($_POST['filterLevel']) && ($level[$i]==$_POST['filterLevel'])) echo "selected"; ?>><?php echo $level[$i] ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div class="form-group">
                          <button type = "submit" name="submit" value = "Filter" class="btn btn-primary">Filter</button>
                        </div>

                        <div class="form-group">
                          <a href="AdminIndex.php">Back</a>
                        </div>

                    </form>
                </div>
            </div>

            <?php $array_users = filterStudent(); //this is needed for when the paged is loaded, all students will be populated ?>

            <div class="row">
                <div class="col-md-12">
                   <table class = "table table-striped">
                        <thead class = "table-dark">
                            <tr>
                                <td scope="col">#</th>
                                <td scope="col">Student ID</th>
                                <td scope="col">Name</th>
                                <td scope="col">Course</th>
                                <td scope="col">Level</th>
                                <td scope="col">Email</th>
                                <td scope="col">Action</th>
                            </tr>
                        </thead>

                        <?php
                         $emptyMsg="";
                        if (count($array_users)<1) 
                        {
                            $emptyMsg = "There is no record found!";
                        }
                        ?>
                        <span class="text-danger"> <?php echo $emptyMsg;?></span>
                        <?php
                        for ($i=0; $i<count($array_users); $i++):?>
                            <tr>

                                <td><?php echo ($i+1)?></td>
                                <td><?= $array_users[$i]["StdID"]?></td>
                                <td><?= $array_users[$i]["StdName"]?></td>
                                <td><?php echo $array_users[$i]['StdCourse']?></td>
                                <td><?= $array_users[$i]["StdLevel"]?></td>
                                <td><?= $array_users[$i]["StdEmail"]?></td>
                                <td><?php echo '<a href="../FileUpload/FileUpload.php?stdId='. $array_users[$i]["StdID"].'&stdName=' . $array_users[$i]["StdName"] . '">Upload Picture </a>';?>
                                <?php echo '| '.'<a href="../Admin/UpdateStudent.php?stdId='. $array_users[$i]["StdID"].'&stdName=' . $array_users[$i]["StdName"] . '">Update Student </a>';?></td>
                            </tr>
                        <?php endfor; ?>
                   </table>
                </div>
            </div>
            
        </main>
    </div>

    <?php 
        if (isset($_POST['submit'])) 
        { 
            $array_user = filterStudent();   
        }
    ?> 



<?php include("../Footer.php"); ?>