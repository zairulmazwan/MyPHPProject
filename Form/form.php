<?php
 include("../Nav/Admin/loggedHeaderAdmin.php");

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
<script>
    // $(document).ready(function(){
    //     $("#form1 #selectAll").click(function(){
    //         $("#form1 input[type='checkbox']").prop('checked', this.checked);
    //     });
    // });


    function toggle (source){
    var checkBoxes = document.querySelectorAll("input[name^='year[']");
       
        for(var i=0; i<checkBoxes.length; i++) 
        {
            if (checkBoxes[i].type == "checkbox")
                checkBoxes[i].checked = source.checked;

        }
    }

</script>



<div class="container pb-5">
    <main role="main">
        <h2>Create Module</h2><br>

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

                        <select type = "text" name="level" class="form-control">
                             <option value=-1>Select Level</option>
                             <?php for ($i=3; $i<7; $i++): ?>
                             <option value = <?php echo $i; ?>><?php echo $i; ?></option>
                             <?php endfor; ?>
                        </select>
                        <span class="text-danger"></span>
                    </div>

                    <div class="form-group col-7">
                        <label class="control-label font-weight-bold">Course : </label>
                        <select type = "text" name="course[]" class="form-control" placeholder="Enter module name" multiple="multiple" size = 4>
                            <?php 
                            for ($i=0; $i<count($course_array); $i++):?>
                            <option value=<?php echo '"'.$course_array[$i]['Course'].'"'?>><?php echo $course_array[$i]['Course'];?></option>
                            <?php endfor; ?>
                        </select>
                        <span class="text-danger"></span>
                    </div>

                    <div class="form-group col-7">
                        <label class="control-label font-weight-bold">Module Year : </label><br>
                       
                            <div style="display: inline-block; margin-left: 5px">
                            <input type="checkbox" name ="yearAll" id="selectAll" onClick="toggle(this)" class="form-check-inline"/>Select all<br>
                            <?php
                                for ($i=0; $i<4; $i++):?>
                               <input type="checkbox" id = "chx" name="year[]" value="<?php echo ($i+1);?>" class="form-check-inline" /><?php echo $i+1;?><br />
                               <?php endfor; ?>
                            </div>
                           
                        <span class="text-danger"></span>
                    </div>

                    <div class="form-group col-7">
                        <label class="control-label font-weight-bold">Status : </label><br>
                            <div style="display: inline-block;">
                                <input type="radio" name="status" value="Active" class="form-check-inline">Active
                                <input type="radio" name="status" value="Close" class="form-check-inline" style="margin-left: 20px">Close
                            </div>
                           
                        <span class="text-danger"></span>
                    </div>

                    <div class="form-group col-7">
                        <input type="submit" name="submit" value="Create Module" class="btn btn-secondary" />
                    </div>

                </form>
            </div>

        </div>
    </main>

</div>
<script src="../JavaScript/script.js"></script>

<?php
    include("../Footer.php");
?>