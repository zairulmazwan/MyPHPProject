<?php
     include("../Nav/Admin/loggedHeaderAdmin.php");
     include("InsertUploadFile.php");


     $message="";
     $stdName = $_GET["stdName"]; //getting this value from the previous page
     $stdId = $_GET["stdId"]; //getting this value from the previous page
     $fileName = "";
     $inserted = 0;

    
     
     // Check if image file is a actual image or fake image
     if(isset($_POST["submit"])) {

        $target_dir = "C:/xampp/Data/StudentPictures/"; //to specify the directory 
        $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]); //fileToUpload - is from the form -input name
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


       $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]); //tmp_name to get the file path 
       if ($check !== false) {
         $message .="File is an image - " . $check["mime"] . ". ";
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
        //echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        
        //changing the file name according to the student ID
        $extension = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION); //getting the file extension
        $fileName = $stdId.".".$extension; //joining the new file name with the extension
        
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.$fileName)) {
            $message .="The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            //echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        } else {
            $message .="Sorry, there was an error uploading your file.";
            //echo "Sorry, there was an error uploading your file.";
        }
        
    }
   
    $inserted = insertStudPicture($stdId, $fileName); //calling this function to insert the file name and student id into db
    echo "<script>alert('$message');</script>"; //to prompt an alert message on the browser
    if (!$inserted) { //if this is false
        echo "File was not inserted into database!";
    }
}

?>



<div class="container bgColor">
    <main role="main" class="pb-3">
    <h2>File Upload for (<?php echo $stdId.") ".$stdName; ?></h2>
    <div class="row">
        <div class="col-6">
            <form method="post" enctype="multipart/form-data"><br>
            Select student image to upload:<br><br>
                <input type="file" name="fileToUpload" id="fileToUpload" class="form-control-md">
                <input type="submit" value="Upload Image" name="submit" class="btn btn-primary">
            </form>
        </div>
       
    </div>
    <br>
    <div>
            <a href="../Admin/ViewFilterStudent.php">Back</a>
    </div>
    <br>
    <?php echo $message; 
    
    if ($inserted) :?>

    <br><br><a href="../Admin/ViewFilterStudent.php">Back to View Students</a>
    <?php endif; ?>

  


    </main>
</div>


<?php
    include("../Nav/loggedFooter.php");
?>