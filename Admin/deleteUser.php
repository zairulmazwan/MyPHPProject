<?php 

include("../HeaderNav.php"); 

$db = new SQLite3('C:\xampp\Data\StudentModule.db');
$sql = "SELECT UserName, firstName, lastName, Role FROM User WHERE userId=:uid";
$stmt = $db->prepare($sql);
$stmt->bindParam(':uid', $_GET['uid'], SQLITE3_TEXT);
$result= $stmt->execute();
$arrayResult = [];

while($row=$result->fetchArray(SQLITE3_NUM)){
    $arrayResult [] = $row;
}

if (isset($_POST['delete'])){

    $db = new SQLite3('C:\xampp\Data\StudentModule.db');

    $stmt = "DELETE FROM User WHERE userId = :stdID";
    $sql = $db->prepare($stmt);
    $sql->bindParam(':stdID', $_POST['uid'], SQLITE3_TEXT);

    $sql->execute();
    header("Location:viewUser.php?deleted=true");
}


?>

<div class="container pb-5">
    <main role="main" class="pb-3">
        <h2>Delete User for <?php echo $_GET['uid'];?></h2><br>
        <h4 style="color: red;">Are you sure want to delete this user?</h4><br>
        
        <div class="row">
            <div class="col-md-2 f">
                <label style="font-size: 20px; color:blue; font-weight: bold;">User Name</label>
            </div>
            <div class="col-md-6">
                <label style="font-size: 20px;"><?php echo $arrayResult[0][0] ?></label>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2 f">
                <label style="font-size: 20px; color:blue; font-weight: bold;">First Name</label>
            </div>
            <div class="col-md-6">
                <label style="font-size: 20px;"><?php echo $arrayResult[0][1] ?></label>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2 f">
                <label style="font-size: 20px; color:blue; font-weight: bold;">Last Name</label>
            </div>
            <div class="col-md-6">
                <label style="font-size: 20px;"><?php echo $arrayResult[0][2] ?></label>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2 f">
                <label style="font-size: 20px; color:blue; font-weight: bold;">Role</label>
            </div>
            <div class="col-md-6">
                <label style="font-size: 20px;"><?php echo $arrayResult[0][3] ?></label>
            </div>
        </div>

        <div class="row">
            <div class="col-5">
                <form method="post">
                    <input type="hidden" name="uid" value = "<?php echo $_GET['uid'] ?>"><br>
                    <input type="submit" value="Delete" class="btn btn-danger" name="delete"><a href="viewUser.php" style="font-weight: bold; padding-left: 30px;">Back</a>
                </form>
            </div>
        </div>

    </main>
</div>



<?php
    include("../Footer.php"); 
?>