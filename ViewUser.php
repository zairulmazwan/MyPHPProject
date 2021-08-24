<html>
<head>View User</head>

<body>
<h1>List of Users</h2>

<h2>List of Users from database</h2>

<table>
<thead>
	<td>Username</td>
	<td>Name</td>
	<td>Status</td>
</thead>

<?php
	
	include ('getUser.php');
	$array_users = getUsers();
	//echo "len ".count($array_users);
	//print_r($array_users);
	
?>
<?php for ($i=0; $i<count($array_users); $i++):?>
<tr>
	<td><?php echo $array_users[$i]['Username']?></td>
	<td><?= $array_users[$i]["Name"]?></td>
	<td><?= $array_users[$i]["Status"]?></td>
</tr>
<?php endfor; ?>
</table>

</body>

</html>