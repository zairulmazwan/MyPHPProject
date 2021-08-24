<!doctype html>
<html lang="en">
  <head>
    <title>Module Management System</title>
    <!-- Required meta tags -->
    <meta charset="utf-8"> <!--http-equiv="refresh" content="17" to refresh html page for session refresh-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/MyPHPProject/site.css" /><!-- use an absolute path, because you are requiring/including this file in other php files not in root -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 

<!--
	<script type="text/javascript"> 
		function display_c(){
			var refresh=1000; // Refresh rate in milli seconds
			mytime=setTimeout('display_ct()',refresh)
			}

			function display_ct() {

			const months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
			const days = ["Mon","Tue","Wed","Thu","Fri","Sat","Sun"];
			var x = new Date()
			var x1=  days[x.getDay()]+", "+months[x.getMonth()]+ " " + x.getDate() + " " + x.getFullYear(); 
			x1 = x1 + " - " +  x.getHours( )+ ":" +  x.getMinutes() + ":" +  x.getSeconds();
			document.getElementById('clock').innerHTML = x1;
			display_c();
		}
	</script>
-->
  </head>

<body class="bgColor" onload=display_ct();>
	<header onload="display_ct()">
			<nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-light bg-white border-bottom box-shadow mb-3">
				<div class="container">
					<a class="navbar-brand" href="/MyPHPProject/index.php">Module Management System</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbarSupportedContent"
							aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="navbar-collapse collapse d-sm-inline-flex flex-sm-row-reverse">
						<ul class="navbar-nav flex-grow-1">
							<li class="nav-item">
								<a class="nav-link text-dark" href="/MyPHPProject/User/UserIndex.php">
									<img border="0" alt="User Icon" src="/MyPHPProject/Icons/home-icon.png" width="30" height="30">
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link text-dark" href="../User/studProfile.php">My Profile</a>
							</li>
							<li class="nav-item">
								<a class="nav-link text-dark" href="../User/myModule.php">My Modules</a>
							</li>
							<li class="nav-item">
								<a class="nav-link text-dark" href="../User/registerModule.php">Register Module</a>
							</li>
							<li class="nav-item">
								<a class="nav-link text-dark" href="/MyPHPProject/Admin/logout.php?user=student">Logout</a>
							</li>
							<li class="nav-item">
								<a class="nav-link text-dark" style="padding-left: 170px;" id="clock"><?php //$date = date("d F Y"); echo $date; ?></a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
	</header>

	<script src="../JavaScript/script.js"></script>
