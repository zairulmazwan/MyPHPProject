<?php 
require("../HeaderNav.php");

    $db = new SQLITE3('C:\xampp\Data\StudentModule.db');
    $sql = "SELECT * FROM User";
    $stmt = $db->prepare($sql);
    $result = $stmt->execute();

    $data = [];//prepare an empty array first
    while ($row = $result->fetchArray()){ // use fetchArray(SQLITE3_NUM) - another approach
        $data [] = $row; //adding a record until end of records
    }


?>

	<div class="container bgColor">
        <main role="main" class="pb-5">
		<h1>View Users</h1><br>

        <div class="row">
            <div class="col-8">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <th>#</th>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>First Name</th>
                        <th>Last Name</th> 
                        <th>Status</th>
                        <th>Role</th> 
                        <th>Actions</th> 
                    </thead>
                    <?php  for($i=0; $i<count($data); $i++): ?>
                    <tr>
                        <td><?php echo $i+1; ?></td>
                        <td><?php echo $data[$i]['userId']; ?></td>
                        <td><?php echo $data[$i]['UserName']; ?></td>
                        <td><?php echo $data[$i]['firstName']; ?></td>
                        <td><?php echo $data[$i]['lastName']; ?></td>
                        <td><?php echo $data[$i]['Status']; ?></td>
                        <td><?php echo $data[$i]['Role']; ?></td>
                        <td>
                           <a href="updateUser1.php?id=<?php echo $data[$i]['userId']; ?>">Update</a>
                        </td>
                    </tr>
                    <?php endfor; ?>



                </table>
            </div>
        </div>
		</main>
	</div>

<?php require("../Footer.php");?>

