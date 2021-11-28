<?php require("HeaderNav.php");

 //getting the existing message from welcomeNote.txt
 $fileName = "C:/xampp/Data/WelcomeNote/WelcomeNote.txt";

 //$welcomeNote = file_get_contents($fileName, true);

 $readFile = fopen($fileName, "r") or die ("Unable to open a file");
 $text = [];
 while(!feof($readFile)){
     $text [] = fgets($readFile);
 }
 

?>

	<div class="container bgColor">
        <main role="main" class="pb-3">
		<h1>Welcome to Module Management System Sheffield Hallam University</h2><br>

			<?php
				for($i=0; $i<count($text); $i++){

					echo $text[$i]."<br>";
				}
			?>
		
		</main>
	</div>

<?php require("Footer.php");?>


