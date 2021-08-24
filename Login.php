 <?php include("HeaderNav.php"); ?>

  <div class="container bgColor">
        <main role="main" class="pb-3">
        <h2>Login Page</h2><br>
     

            <div class="row">
                <div class="col-md-4">
                    <form method="post" action="SelectUser.php">
                        <div asp-validation-summary="ModelOnly" class="text-danger"></div>

                        <div class="form-group">
                            <label class="control-label">Email</label>
                            
                            <input  class="form-control" type="text" value="<?=  $usrname;?>"/>
                            <span class="text-danger"></span>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Insert Password</label>
                            <input type="password" class="form-control" value="<?php echo $pwd;?>"/>
                            <span class="text-danger"></span>
                        </div>

                        <div class="form-group">
                            <!--<input type="submit" value="Login" class="btn btn-primary" />-->
                            <button type="submit" value="Login" id="SubmitButton" class="btn btn-primary">Login</button>
                            
                        </div>

                    </form>
                </div>
            </div>
        </main>
    </div>

<?php include("Footer.php") ?>