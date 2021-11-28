<?php 

    include("../HeaderNav.php"); 
    require_once("CreateModuleInsertSQL.php");


        
    if (isset($_POST['submit'])) 
    { 
        print_r($_POST['year']);
        $moduleCreated = insertModule();
        // echo "result ".$moduleCreated;
        // $host  = $_SERVER['HTTP_HOST'];
        // $uri   = rtrim(dirname($_SERVER['PHP_SELF'], 2), '/\\');
        // $extra = '/Admin/SuccessCreateModule.php';
        // header("Location: http://$host$uri/$extra");   
        header("Location: SuccessCreateModule.php");  //the simplest way
        //exit();
    }
 

?>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<script>
    /*
    $(document).ready(function(){
        $("#form1 #selectAll").click(function(){
            $("#form1 input[type='checkbox']").prop('checked', this.checked);
        });
    });
    */
   
    function toggle (source){
    var checkBoxes = document.querySelectorAll("input[name^='year[]']");
       
        for(var i=0; i<checkBoxes.length; i++) 
        {
            if (checkBoxes[i].type == "checkbox")
                checkBoxes[i].checked = source.checked;

        }
    }
</script>

<div class="container pb-5">
    <main role="main">
        <h2>Admin : Create Module</h2><br>

        <div class="row pb-3">
            <div class="col-5">
                <form method="post" id="form1">

                    <div class="form-group col-6">
                        <label class="control-label font-weight-bold">Module Code : </label>
                        <input type = "text" name="moduleCode" class="form-control" placeholder="Enter module code"/>
                        <span class="text-danger"></span>
                    </div>

                    <div class="form-group col-12">
                        <label class="control-label font-weight-bold">Module Name : </label>
                        <input type = "text" name="moduleName" class="form-control" placeholder="Enter module name"/>
                        <span class="text-danger"></span>
                    </div>

                    <div class="form-group col-5">
                        <label class="control-label font-weight-bold">Module Level : </label>
                        <?php 
                      
                            $db = new SQLite3('C:\xampp\Data\StudentModule.db');
                            $sql = "SELECT * FROM Level ORDER BY Level ASC;";
                            $rows = $db->query($sql);

                            while($row=$rows->fetchArray()){

                                $level [] = $row;
                            }

                             //print_r($level);

                        ?>

                        <select type = "text" name="level" class="form-control">
                             <option value=-1>Select Level</option>
                             <?php for ($i=0; $i<count($level); $i++): ?>
                             <option value = <?php echo $level[$i]['Level'] ?>><?php echo $level[$i]['Level'] ?></option>
                             <?php endfor; ?>
                        </select>
                        <span class="text-danger"></span>
                    </div>

                    <?php

                        $db = new SQLite3('C:\xampp\Data\StudentModule.db');
                        $sql = "SELECT * FROM Courses ORDER BY Code ASC;";
                        $rows = $db->query($sql);

                        while($row=$rows->fetchArray()){

                            $course_array [] = $row;
                        }

                    ?>

                    <div class="form-group col-7">
                        <label class="control-label font-weight-bold">Course : </label>
                        <select type = "text" name="course[]" class="form-control" placeholder="Enter module name" multiple="multiple" size = 4>
                            <option value="Software Engineering">Software Engineering</option>
                            <option value="Software Engineering">Computer Science</option>
                            <option value="Software Engineering">Forensics</option>
                            <option value="Software Engineering">Networking</option>
                            <option value="Software Engineering">Artificial Intelligence</option>
                        </select>
                    </div>

                    <div class="form-group col-7">
                        <label class="control-label font-weight-bold">Module Year : </label><br>
                       
                            <div style="display: inline-block; margin-left: 5px">
                            <input type="checkbox" name ="yearAll" id="selectAll"  onClick="toggle(this)" class="form-check-inline"/>Select all<br>
                            <?php
                                for ($i=0; $i<4; $i++):?>
                               <input type="checkbox" name="year[]" value="<?php echo ($i+1);?>" class="form-check-inline" /><?php echo $i+1;?><br />
                               <?php endfor; ?>
                            </div>
                    </div>

                    <div class="form-group col-7">
                        <label class="control-label font-weight-bold">Status : </label><br>
                            <div style="display: inline-block;">
                                <input type="radio" name="status" value="Active" class="form-check-inline">Active
                                <input type="radio" name="status" value="Close" class="form-check-inline" style="margin-left: 20px">Close
                            </div>
                    </div>

                    <div class="form-group col-7">
                        <input type="submit" name="submit" value="Create Module" class="btn btn-secondary" />
                    </div>

                </form>
            </div>
        </div>
    </main>

</div>




<?php 
    include("../Footer.php");
?>