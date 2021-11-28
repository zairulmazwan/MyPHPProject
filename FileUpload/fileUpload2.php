<?php

 include("../HeaderNav.php");
    
        $message = "";
        $stdId = "CS001";

     // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            
        $target_dir = "C:/xampp/Data/Tutorial/"; //to specify the directory 
        $target_file = $target_dir.basename($_FILES["file"]["name"]); //fileToUpload - is from the form -input name
        $uploadOk = 1;
        //$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


       $check = getimagesize($_FILES["file"]["tmp_name"]); //tmp_name to get the file path 
       if ($check !== false) {
         //$message .="File is an image - " . $check["mime"] . ". ";
         $message .="File is an image - " . $_FILES["file"]["type"]. ". ";
         //echo "File is an image - " . $check["mime"] . ".";
         $uploadOk = 1;
       } else {
         $message .="File is not an image.";
         //echo "File is not an image.";
         $uploadOk = 0;
       }
     
       
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $message .= "Sorry, your file was not uploaded.";
        
        } else {
            
            //changing the file name according to the student ID
            $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION); //getting the file extension
            $fileName = $stdId.".".$extension; //joining the new file name with the extension
            
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$fileName)) {
                $message .="The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
                //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            } else {
                $message .="Sorry, there was an error uploading your file.";
                //echo "Sorry, there was an error uploading your file.";
            }
        
    }
   
}

?>

<div class="container bgColor">
    <main role="main" class="pb-3">
        <h2>:: Upload File Tutorial ::</h2>
        <br>
        <div class="row">
            <div class="col-10">
                <div class="form-group">
                    <form method="post" enctype="multipart/form-data">
                        <input type="file" name="file">
                        <input type="submit" name="submit" value="Upload" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>

        <div>
            <?php echo ($message!="") ? $message : ""; ?>
        </div>
    </main>
</div>



<?php
    include("../Footer.php");

?>