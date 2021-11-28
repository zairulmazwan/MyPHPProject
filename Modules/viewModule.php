<?php 
include("../Nav/Admin/loggedHeaderAdmin.php");
include("../Session/session.php");
include("getModule.php");

$path = "../Admin/LoginAdmin.php"; //this path is to pass to checkSession function from session.php 
    
session_start(); //must start a session in order to use session in this page.
if (!isset($_SESSION['name'])) {
    session_unset();
    session_destroy();
    header("Location:".$path);//return to the login page
}

$user = $_SESSION['name'];
checkSession($path); //calling the function from session.php
$emptyMsg = "";

?>
<?php 
//if (isset($_GET['updated'])) {//shoul we use if else statement before echo? YES, to check if the var is set or not.
//    echo "<script>alert('".($_GET['updated'] ? "Module Updated Successfully" : "Not sucessful update")."');</script>"; //what about false? ==> not succesful
    //i know ? in java. what we call this? Its a binary if it? Yeah, whats the name? i forgot the name in java i learned
    //Should i test it now? yes
    // (condition) ? (true) : (false);
    // its the same as:
    // if(condition) {
    //     true;
    // } else {
    //      false;
    // }
//}
?>
<main role="main" class="container bgColor pb-5">
    <div class="row">
        <div class="col-md-12">
            <h1>View Module</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p>Hello <?php echo ucfirst($user); ?></p>
        </div>
    </div>
    
    <?php if (isset($_GET['updated'])) : ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-<?php echo $_GET['updated'] ? 'success' : 'danger'; ?> alert-dismissible fade show" role="alert">
                <?php echo $_GET['updated'] ? "Module Updated Successfully" : "Module not updated"; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-12">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Module Code</th>
                        <th>Module Name</th>
                        <th>Module Level</th>
                        <th>Module Course</th>
                        <th>Module Year</th>
                        <th>Module Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <?php 
                $arrayModules = getModules();
                if (count($arrayModules)<1) : ?>
                <tr>
                    <td colspan="8">
                        <span class="text-danger">"There is no record found!"</span>
                    </td>
                </tr>
                <?php endif; ?>
                <?php for ($i=0; $i<count($arrayModules); $i++): ?>
                    <tr>
                        <td><?php echo $i+1;?></td>  
                        <td><?php echo $arrayModules[$i]['ModuleCode'] ?></td>  
                        <td><?php echo $arrayModules[$i]['ModuleName'] ?></td>  
                        <td><?php echo $arrayModules[$i]['ModuleLevel'] ?></td>  
                        <td><?php echo $arrayModules[$i]['ModuleCourse'] ?></td>  
                        <td><?php echo $arrayModules[$i]['ModuleYear'] ?></td>  
                        <td><?php echo $arrayModules[$i]['ModuleStatus'] ?></td> 
                        <td>
                            <a href="updateModule2.php?moduleCode=<?php echo $arrayModules[$i]['ModuleCode']; ?>">Update</a><a href="#" style="margin: 18px;">Delete</a>
                        </td>  
                    </tr>
                <?php endfor; ?></php>
            </table>
        </div>
    </div>
</main>

<?php include("../Nav/loggedFooter.php");?>