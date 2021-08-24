<?php 
    include("../Nav/loggedHeader.php");
    include("../Session/session.php");
 
    $path = "Login.php"; //this path is to pass to checkSession function from session.php 
        
    session_start(); //must start a session in order to use session in this page.
    if (!isset($_SESSION['name'])){
        session_unset();
        session_destroy();
        header("Location:".$path);//return to the login page
    }
    $user = $_SESSION['name'];
    $userID = $_SESSION['stdID'];
    checkSession ($path); //calling the function from session.php

    //echo getcwd();

    $db = new SQLite3 ('C:\xampp\Data\StudentModule.db');
    $sql = 'SELECT * FROM Student WHERE StdID=:stdID';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':stdID',$userID, SQLITE3_TEXT);

    $result = $stmt->execute();
    $studRes = [];
    while($row=$result->fetchArray()){

        $studRes [] = $row;
    }
?>
<script>

    function getImgScr(){
        var x = document.getElementById("myImg").src;
        return x;
    }

</script>
<!--
<h2>Picture</h2>
<img id="displayImg" src="..\\FileUpload\\StudentImage\\Ali.png" alt="Image not found" style=" max-width:180px;" class="rounded"/>
-->

<div class="container bgColor">
    <main role="main" class="pb-3">
    <h1>Student Profile for <?php echo $userID ?></h2><br>
        
        <br>
            <div style="padding-left: 10px;">
                <div class="form-group row">   
                    <div class="col-4 col-span">
                            <!--<label  style="font-size: 20px; color: blue; padding-left: 30px;">Picture here</label>-->
                           
                            <img id = "stdImg" src="imageProfile.php?id=<?php echo $userID ?>" alt="Image not found" style=" max-width:180px;" class="rounded" width="150" height="170"/>
                        
                           <p><span class="text-danger"><?php echo "Student does not have a profile picture";?></span></p>    
                        
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-2">
                        <label style="font-weight: bold; font-size: 20px;">Student Name</label>
                    </div>   
                   
                    <div class="col-10">
                            <label  style="font-size: 20px; color: blue; padding-left: 30px;"><?php echo ucfirst($studRes[0]['StdName']); ?></label>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-2">
                        <label style="font-weight: bold; font-size: 20px;">Student Course</label>
                    </div>   
                    
                    <div class="col-10">
                            <label  style="font-size: 20px; color: blue; padding-left: 30px;"><?php echo ucfirst($studRes[0]['StdCourse']); ?></label>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-2">
                        <label style="font-weight: bold; font-size: 20px;">Student Level</label>
                    </div>   
                    
                    <div class="col-10">
                            <label  style="font-size: 20px; color: blue; padding-left: 30px;"><?php echo ($studRes[0]['StdLevel']); ?></label>
                    </div>
                </div>

                <div class="form-group row"> 
                    <div class="col-2">
                        <label style="font-weight: bold; font-size: 20px;">Student Email</label>
                    </div>  
                    
                    <div class="col-10">
                            <label  style="font-size: 20px; color: blue; padding-left: 30px;"><?php echo ($studRes[0]['StdEmail']); ?></label>
                    </div>
                </div>

                
            </div>
            
      

            
    </main>
</div>



<?php include("../Nav/loggedFooter.php");?>