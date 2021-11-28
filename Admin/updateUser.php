<?php 

include("../HeaderNav.php"); 

$db = new SQLite3('C:\xampp\Data\StudentModule.db');
$sql = "SELECT * FROM User WHERE userId=:uid";
$stmt = $db->prepare($sql);
$stmt->bindParam(':uid', $_GET['uid'], SQLITE3_TEXT);
$result= $stmt->execute();
$arrayResult = [];

while($row=$result->fetchArray(SQLITE3_NUM)){
    $arrayResult [] = $row;
}

if (isset($_POST['submit'])){

    $db = new SQLite3('C:\xampp\Data\StudentModule.db');
    $sql = "UPDATE User SET Username = :uname, userId = :uid, firstName = :fname, lastName = :lname, Status = :status, Role = :role WHERE userId = :uid";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':uname',$_POST['uname'], SQLITE3_TEXT);
    $stmt->bindParam(':uid',$_POST['uid'], SQLITE3_TEXT);
    $stmt->bindParam(':fname',$_POST['fname'], SQLITE3_TEXT);
    $stmt->bindParam(':lname',$_POST['lname'], SQLITE3_TEXT);
    $stmt->bindParam(':status',$_POST['status'], SQLITE3_TEXT);
    $stmt->bindParam(':role',$_POST['role'], SQLITE3_TEXT);

    $stmt->execute();

    header('Location: viewUser.php');
}


?>

<div class="container pb-5">
    <main role="main" class="pb-3">
        <h2>Update User for <?php echo $_GET['uid'];?></h2><br>

        <div class="row">
            <div class="col-11">
                <form method="post">
                   <div class="form-group col-md-3">
                        <label class="control-label labelFont">Username</label>
                        <input class="form-control" type="text" name = "uname" value="<?php echo $arrayResult[0][1]; ?>">
                   </div>

                   <div class="form-group col-md-3">
                        <label class="control-label labelFont">User ID</label>
                        <input class="form-control" type="text" name = "uid" value="<?php echo $arrayResult[0][2]; ?>">
                   </div>

                   <div class="form-group col-md-3">
                        <label class="control-label labelFont">First Name</label>
                        <input class="form-control" type="text" name = "fname" value="<?php echo $arrayResult[0][3]; ?>">
                   </div>

                   <div class="form-group col-md-3">
                        <label class="control-label labelFont">Last Name</label>
                        <input class="form-control" type="text" name = "lname" value="<?php echo $arrayResult[0][4]; ?>">
                   </div>

                   <div class="form-group col-md-3">
                        <label class="control-label labelFont">Status</label>
                        <select name="status" class="form-control">
                           <option value="active" <?php echo ($arrayResult[0][6]=="active") ? "selected" : ""; ?>>Active</option>
                           <option value="closed" <?php echo ($arrayResult[0][6]=="closed") ? "selected" : ""; ?>>Closed</option>
                           <option value="blocked" <?php echo ($arrayResult[0][6]=="blocked") ? "selected" : ""; ?>>Blocked</option>
                        </select>
                   </div>

                   <div class="form-group col-md-3">
                        <label class="control-label labelFont">Role</label>
                        <select name="role" class="form-control">
                           <option value="admin" <?php echo ($arrayResult[0][7]=="admin") ? "selected" : ""; ?>>Admin</option>
                           <option value="staff" <?php echo ($arrayResult[0][7]=="staff") ? "selected" : ""; ?>>Staff</option>
                           <option value="student" <?php echo ($arrayResult[0][7]=="student") ? "selected" : ""; ?>>Student</option>
                        </select>
                   </div>

                   <div class="form-group col-md-3">
                       <input type="submit" name="submit" value="Update" class="btn btn-primary">
                   </div>
                   <div class="form-group col-md-3"><a href="viewUser.php">Back</a></div>
                </form>
            </div>
        </div>

    </main>
</div>



<?php
    include("../Footer.php"); 
?>