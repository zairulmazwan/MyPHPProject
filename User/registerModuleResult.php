<?php 
    include ("../Nav/loggedHeader.php");


    $moduleCodes = $_POST['moduleCheck'];
  
    $db = new SQLite3('C:\xampp\Data\StudentModule.db');
    $results = [];

    for ($i=0; $i<count($moduleCodes); $i++){
        $sql = "SELECT * FROM Module WHERE ModuleCOde = :mCode";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':mCode', $moduleCodes[$i], SQLITE3_TEXT);
        $rows = $stmt->execute();

        while($row = $rows->fetchArray()){
            $results [] = $row;
        }

    }
?>



<div class="container container-fluid pb-5">
    <main role="main">
      <h2>Register Module Result</h2><br>
        <?php 
           for ($i=0; $i<count($results); $i++){
               $no = $i+1;
               echo "<h3>Module $no</h3>";
               echo "Module Code : ".$results[$i]['ModuleCode']."<br>";
               echo "Module Name : ".$results[$i]['ModuleName']."<br>";
               echo "Module Level : ".$results[$i]['ModuleLevel']."<br>";
               echo "Module Course : ".$results[$i]['ModuleCourse']."<br>";
               echo "Module Year : ".$results[$i]['ModuleYear']."<br>";
               echo "Module Status : ".$results[$i]['ModuleStatus']."<br><br>";
           }
        
        ?>


    </main>
</div>

<?php
include ("../Nav/loggedFooter.php");
?>