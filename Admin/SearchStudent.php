<?php include("../HeaderNav.php"); 
      include ("getSearchStudent.php"); 
      $array_users = getSearchStudents();
      
      ?>

  <div class="container bgColor">
        <main role="main" class="pb-5">
        <h2>Admin : Search Student</h2><br>
     

            <div class="row">
                <div class="col-md-4">
                    <form method="post">
                        <!-- asp tags don't exist here <div asp-validation-summary="ModelOnly" class="text-danger"></div> -->
                        <div class="text-danger"></div>

                        <div class="form-group">
                            <label class="control-label">Search Student by Name : </label>
                            <input  class="form-control" onkeyup="showHint(this.value)" />
                        </div>

                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                   <table class = "table table-striped">
                        <thead class = "table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Student ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Course</th>
                                <th scope="col">Level</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>

                        <?php
                        $count=1;
                        for ($i=0; $i<count($array_users); $i++):?>
                            <tr>

                                <td><?php echo $i+1?></td>
                                <td><?= $array_users[$i]["StdID"]?></td>
                                <td><?= $array_users[$i]["StdName"]?></td>
                                <td><?php echo $array_users[$i]['StdCourse']?></td>
                                <td><?= $array_users[$i]["StdLevel"]?></td>
                                <td><?= $array_users[$i]["StdEmail"]?></td>
                            </tr>
                        <?php endfor; ?>
                   </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        function showHint(str) {
                var xhttp;
                if (str.length == 0) { 
                    document.getElementById("txtHint").innerHTML = "";
                    return;
                }
                xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xhttp.open("GET", "getSearchStudent.php?q="+str, true);
                xhttp.send();   
        }
</script>

<?php include("../Footer.php"); ?>