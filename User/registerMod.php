<?php 
    include ("../Nav/loggedHeader.php");
    include_once("getModule2.php");

    $modules = getModule();
    $level = array("All","3","4","5","6","7","8");
 
?>

<script>
    function toggle (source){
    var checkBoxes = document.querySelectorAll("input[name^='moduleCheck[]']");
       
        for(var i=0; i<checkBoxes.length; i++) 
        {
            if (checkBoxes[i].type == "checkbox")
                checkBoxes[i].checked = source.checked;

        }
    }
</script>


<div class="container container-fluid pb-5">
    <main role="main">
        <h2>Register Module Page</h2><br>

        <div class="row">
        <div class="col-md-6">
            <form method="post">
                <div class="form-group">
                    <label class="control-label" style="font-weight: bold;">Filter by level : </label>
                    <select type="text" style="width:80px;" name="filterLevel" class="form-control">
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

        <div class="row">
            <div class="col-md-10">
                <form method="post" id="form1" action="registerModuleResult.php">
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <td>#</td>
                            <td>Module Code</td>
                            <td>Module Name</td>
                            <td>Level</td>
                            <td><input class="" type="checkbox" id="selectAll" name = "allModules" onClick="toggle(this)">Register</td>
                        </thead>
                        <?php for ($i=0; $i<count($modules); $i++):?>
                        <tr>
                            <td><?php echo $i+1; ?></td>
                            <td><?php echo $modules[$i]['ModuleCode']; ?></td>
                            <td><?php echo $modules[$i]['ModuleName']; ?></td>
                            <td><?php echo $modules[$i]['ModuleLevel']; ?></td>
                            <td><input class="" type="checkbox" name="moduleCheck[]" value= <?php echo $modules[$i]['ModuleCode']; ?>></td>
                        </tr>
                        <?php endfor; ?>
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