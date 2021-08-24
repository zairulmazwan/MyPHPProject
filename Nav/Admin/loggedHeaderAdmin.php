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
  </head>

<body class="bgColor" onload=display_ct();>
	<header>
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
								<a class="nav-link text-dark" href="../Admin/AdminIndex.php">
									<img border="0" alt="User Icon" src="/MyPHPProject/Icons/home-icon.png" width="30" height="30">
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link text-dark" href="/MyPHPProject/Admin/AdminIndex.php">Manage Students</a>
							</li>
							<li class="nav-item">
								<a class="nav-link text-dark" href="/MyPHPProject/Admin/AdminModuleIndex.php">Manage Modules</a>
							</li>
							<li class="nav-item">
								<a class="nav-link text-dark" href="/MyPHPProject/Admin/AdminParameterIndex.php">Manage Parameter</a>
							</li>
							<li class="nav-item">
								<a class="nav-link text-dark" href="/MyPHPProject/Admin/logout.php?user=admin">Logout</a>
							</li>
							<li class="nav-item">
								<a class="nav-link text-dark" style="padding-left: 65px;" id="clock"><?php //$date = date("d F Y"); echo $date; ?></a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
	</header>
	<script src="../JavaScript/script.js"></script>