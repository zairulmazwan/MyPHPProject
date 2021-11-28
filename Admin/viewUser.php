<?php 

include("../HeaderNav.php"); 
include_once("viewUserSQL.php");

$user = getUsers ();

?>

<div class="container pb-5">
    <main role="main" class="pb-3">
        <h2>View User</h2><br>

        <?php if(isset($_GET['deleted'])): ?>
            <div class="alert alert-danger alert-dismissible fade show col-10" role="alert" style="font-weight: bold;">
                The user has been deleted
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-10">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <td>User ID</td>
                        <td>First Name</td>
                        <td>Last Name</td>
                        <td>Username</td>
                        <td>Role</td>
                        <td>Status</td>
                        <td>Actions</td>
                    </thead>

                    <?php
                        for ($i=0; $i<count($user); $i++):
                    ?>
                    <tr>
                        <td><?php echo $user[$i]['userId']?></td>
                        <td><?php echo $user[$i]['firstName']?></td>
                        <td><?php echo $user[$i]['lastName']?></td>
                        <td><?php echo $user[$i]['UserName']?></td>
                        <td><?php echo $user[$i]['Role']?></td>
                        <td><?php echo $user[$i]['Status']?></td>
                        <td><a href="updateUser.php?uid=<?php echo $user[$i]['userId']; ?>">Update</a> | <a href="deleteUser.php?uid=<?php echo $user[$i]['userId']; ?>">Delete</a></td>
                    </tr>
                    <?php endfor;?>
                </table>    
            </div>

            <div class="col-10" style="font-weight: bold; font-size: 18px;"> 
                <a href="createUser.php">Create User</a>
            </div>
        </div>

       

    </main>
</div>

<?php
    include("../Footer.php"); 
?>