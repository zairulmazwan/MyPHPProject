<?php 
include("../HeaderNav.php"); 
include_once("CreateModuleInsertSQL.php");


if (isset($_POST['submit'])) 
{ 
    //print_r($_POST['year']);
    $moduleCreated = insertModule(); //THIS FUNCTION IS FROM CreateModuleSQL.php
    header("Location: successModule.php");  //route to this php page
}



?>

<script>   
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
    <main role="main" class="pb-3">
    <h2>Create Module</h2><br>
        
    <div class="row">
            <div class="col-6">
                <form method="post">
                   <div class="form-group col-md-6">
                        <label class="control-label labelFont">Module Code</label>
                        <input class="form-control" type="text" name = "mcode">
                      
                   </div>

                   <div class="form-group col-md-6">
                        <label class="control-label labelFont">Module Name</label>
                        <input class="form-control" type="text" name = "mname">
                        
                   </div>

                   <div class="form-group col-md-4">
                        <label class="control-label labelFont">Module Level</label>
                        <select name="mlevel" class="form-control">
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                   </div>

                   <div class="form-group col-7">
                        <label class="control-label font-weight-bold labelFont">Course : </label>
                        <select type = "text" name="course[]" class="form-control" placeholder="Enter module name" multiple="multiple" size = 4>
                            <option value="Software Engineering">Software Engineering</option>
                            <option value="Software Engineering">Computer Science</option>
                            <option value="Software Engineering">Forensics</option>
                            <option value="Software Engineering">Networking</option>
                            <option value="Software Engineering">Artificial Intelligence</option>
                            <option value="Computing">Computing</option>
                        </select>
                    </div>

                    <div class="form-group col-7">
                        <label class="control-label font-weight-bold labelFont">Module Year : </label><br>
                       
                            <div style="display: inline-block; margin-left: 5px">
                            <input type="checkbox" name ="yearAll" id="selectAll"  onClick="toggle(this)" class="form-check-inline"/>Select all<br>
                            <?php
                                for ($i=0; $i<4; $i++):?>
                               <input type="checkbox" name="year[]" value="<?php echo ($i+1);?>" class="form-check-inline" /><?php echo $i+1;?><br />
                               <?php endfor; ?>
                            </div>
                    </div>

                    <div class="form-group col-7">
                        <label class="control-label font-weight-bold labelFont">Status : </label><br>
                            <div style="display: inline-block;">
                                <input type="radio" name="status" value="Active" class="form-check-inline">Active
                                <input type="radio" name="status" value="Close" class="form-check-inline" style="margin-left: 20px">Close
                            </div>
                    </div>

                   <div class="form-group col-md-4">
                        <input class="btn btn-primary" type="submit" value="Create Module" name ="submit">
                   </div>
                </form>
            </div>
        </div>

    </main>
</div>



<?php
    include("../Footer.php"); 
?>