<?php

include("../Nav/loggedHeader.php");

$result = $_REQUEST['createStudent'];

?>


<div class="container pb-6">
    <main role="main">
      <?php
        if($result):?>

        <h2>A user successfully created</h2>
        <?php else:?>
            <h2>A user was not successfully created</h2>
        <?php endif; ?>
            <br>

        <div>
            <a href="CreateStudent.php">Create student</a>
            <a href="ViewFilterStudent.php" style="margin: 35px;">View Students</a>
        </div>
    </main>
</div>



<?php
include("../Footer.php");
?>