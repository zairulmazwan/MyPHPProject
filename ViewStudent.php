<html>
<head>View Student</head>

<body>

<div class="container bgColor">
    <main role="main" class="pb-3">

	<h1>List of Students</h2>

		<h2>List of students from database</h2>

		<table>
			<thead>
				<td>Student ID</td>
				<td>Student Name</td>
				<td>Student Course</td>
			</thead>

			<?php
				

				$db = new SQLite3('C:\xampp\Data\StudentModule.db');
				$rows = $db->query('SELECT * FROM Student');
				
			?>
			<?php
			while($row = $rows->fetchArray()):?>
			<tr>
				<td><?php echo $row['StdID']?></td>
				<td><?= $row['StdName']?></td>
				<td><?= $row['StdCourse']?></td>
			</tr>
			<?php endwhile; ?>
		</table>

	</main>
</div>




</body>

</html>