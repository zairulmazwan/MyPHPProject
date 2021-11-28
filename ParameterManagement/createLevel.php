<?php
     include("../Nav/Admin/loggedHeaderAdmin.php");
     include("../Session/session.php");
     require_once("createLevelSql.php");
     
     $path = "../Admin/LoginAdmin.php"; //this path is to pass to checkSession function from session.php 
     
    session_start(); //must start a session in order to use session in this page.
    if (!isset($_SESSION['name'])){
        session_unset();
        session_destroy();
        header("Location:".$path);//return to the login page
    }
   
    $user = $_SESSION['name'];
    checkSession ($path); //calling the function from session.php
        
     
     $levelErr = $desErr = $createMsg = "";

    if(isset($_POST['submit'])){

        if ($_POST["level"]==""){
            $levelErr="Level is required";
        }

        if ($_POST["description"]==""){
            $desErr="Level description is required";
        }

        if($_POST["level"]!="" && $_POST["description"]!=""){
            
            createLevel ($_POST["level"], $_POST["description"]);
        } 
    }


?>

<div class="container bgColor">
    <main role="main" class="pb-5">
        <h2>Parameter Creation : Level</h2>

        <form method="post">

                <div class="form-group col-1">
                    <label class="control-label">Level</label>
                    <input type="text" class="form-control" name="level"/>
                    <span class="text-danger"><?php echo $levelErr;?></span>
                </div>

                <div class="form-group col-5">
                    <label class="control-label">Level Description</label>
                    <input type="text" class="form-control" name="description"/>
                    <span class="text-danger"><?php echo $desErr;?></span>
                </div>

                <div class="form-group col-10">
                    <button type="submit" name="submit" class="btn btn-primary">Create Course</button>
                </div>

                <div class="form-group col-10">
                    <label style="color: red"><?php echo $createMsg; ?></label>
                </div>
        </form>
        <h4>Created Level</h4>
        <div class="row">
            <div class="col-6">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <td>#</td>
                            <td>Level</td>
                            <td>Description</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <?php 
                        $db = new SQLite3('C:\xampp\Data\StudentModule.db');
                        $sql = "SELECT * FROM Level ORDER BY Level ASC";
                        $stmt = $db->query($sql);
                        while ($row=$stmt->fetchArray()){
                            $res [] = $row;
                        }
                        for ($i=0; $i<count($res); $i++):?>
                        <tr>
                            <td><?php echo $i+1 ?></td>
                            <td><?php echo $res[$i]['Level'] ?></td>
                            <td><?php echo $res[$i]['Description'] ?></td>
                            <td><a href="UpdateLevel.php?Id=<?php echo $res[$i]['Id'] ?>">Update</a> | <a href="DeleteLevel.php?Id=<?php echo $res[$i]['Id'] ?>">Delete</a></td>
                        </tr>
                        <?php endfor; ?>
                </table>
            </div>
        </div>

    </main>
</div>





<?php
    include("../Nav/loggedFooter.php");
?>