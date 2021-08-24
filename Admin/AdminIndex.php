<?php 
 include("../Nav/Admin/loggedHeaderAdmin.php");
 include("../Session/session.php");
 
 session_start(); //must start a session in order to use session in this page.
 $path = "LoginAdmin.php"; //this path is to pass to checkSession function from session.php 
 if (!isset($_SESSION['name'])){
	session_unset();
	session_destroy();
	header("Location:".$path);//return to the login page
 }
 $user = $_SESSION['name'];
 checkSession ($path); //calling the function from session.php
 
 ?>

 
<style>
	.menulist a:link, a:visited {
	background-color: #f44336;
	color: white;
	padding: 14px 25px;
	text-align: center;
	text-decoration: none;
	display: inline-block;
	height: 100%;
	}

	.menulist a:hover, a:active {
	background-color: red;
	}
 </style>

	<div class="container bgColor">
		
        <main role="main" class="pb-3">
		<h1>Welcome to the Admin Page</h2><br>
		<div><p>Hello <?php echo ucfirst($user); ?></p></div>

			<?php
				print "This page appears after successful logged in!";
 			?>
			<br><br>
			 <div class="row menulist">
				 <div class="col-2"><a href="CreateStudent.php">Create Student</a></div>
				 <div class="col-2"><a href="#">Manage Student User Access</a></div>
				 <div class="col-2"><a href="ViewFilterStudent.php">View Student</a></div>
				<div class="col-2"><a href="#p" >Update Student</a></div>
				<div class="col-2"><a href="#">Delete Student</a></div>
			 	
			 </div>
		</main>
	</div>

<?php include("../Nav/loggedFooter.php");
//test github?>

