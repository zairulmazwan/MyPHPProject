<?php 
require("../HeaderNav.php");

    $userID = $_GET['uid'];

    $db = new SQLITE3('C:\xampp\Data\StudentModule.db');
    $sql = "SELECT * FROM User WHERE UserName = :uName";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':uName', $userID, SQLITE3_TEXT);
    $result = $stmt->execute();

    $data = [];//prepare an empty array first
    while ($row = $result->fetchArray()){ // use fetchArray(SQLITE3_NUM) - another approach
        $data [] = $row; //adding a record until end of records
    }


?>

	<div class="container bgColor">
        <main role="main" class="pb-3">
		<h1>Update Users</h1><br>

       <h3>You are updating <?php echo $userID; ?></h3>

       

		</main>
	</div>

<?php require("../Footer.php");?>

