<?php 
	session_start();


		
		if(@$_SESSION['admin_authenticate']==true){
			//header('Location: control_panel.php');
			echo'<script>window.location="control_panel.php";</script>';
		}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Reset Password</title>

    <!-- Bootstrap -->
    <link href="admin_css/bootstrap.css" rel="stylesheet">
    <!-- Admin CSS -->
    <link href="admin_css/admin_layout.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  
  	<!-- Admin Header -->
    <div id="adminHeaderWide" class="clearfix">
    	<div class="container">
            <!-- Navbar -->
            <nav class="navbar navbar-inverse">
              <div class="container-fluid">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                        
                  </button>
                  <a class="navbar-brand" href="index.php">
                    <img src="admin_img/vetere_logo.jpg" alt="Vetere" class="brandImg img-responsive" />
                  </a>
                </div>
                
                </div>
              </div>
            </nav>
            <!-- End Navbar -->
        </div>
    </div>
    <!-- End Admin Header-->
  
  	<!-- Admin Content Wide -->
    <div id="adminContentWide" class="clearfix">
    	<div class="container">
			
			<!-- MESSAGES AND PROCESS -->
			<div class="row">
				<div class="col-xs-12">
					<div class="message_header text-center">
						<?php
							if(@$_POST['submit']){
								if(@$_POST['old_password']=='' || @$_POST['new_password']=='' || @$_POST['new_password_reenter']==''){
									?>
									<div class="row">
										<div class="col-xs-12">
											<div class="message_header text-center">
												<p class="text-danger custom-text-danger">All the fields must be filled in!</p>
											</div>
										</div>
									</div>
									<?php
								}
								else{
									$ENTERED_OLD_PASS = $_POST['old_password'];
									//open db connection
									include_once "db_connect.php";
									
									$get_old_pass_str = "SELECT * FROM admin_details";
									$OLD_PASS = mysqli_query($con,$get_old_pass_str);
									
									if(mysqli_num_rows($OLD_PASS)>0){
										$PASS_ROW = mysqli_fetch_array($OLD_PASS);
										$ADMIN_ORG_PASS = $PASS_ROW['admin_password_org'];
										//check if old password entered correct
										if($ADMIN_ORG_PASS==$ENTERED_OLD_PASS){
											//check if new pass and re enter new pass matches
											$ENTERED_NEW_PASS = $_POST['new_password'];
											$RE_ENTERED_NEW_PASS = $_POST['new_password_reenter'];
											
											if($ENTERED_NEW_PASS==$RE_ENTERED_NEW_PASS){
												$CHANGED_PASSWORD = mysqli_real_escape_string($con,$ENTERED_NEW_PASS);
												$HASHED_NEW_PASSWORD = sha1($CHANGED_PASSWORD);
												
												//Update the CHANGED password
												$update_changed_pass_str = "UPDATE admin_details SET admin_password='$HASHED_NEW_PASSWORD', admin_password_org='$CHANGED_PASSWORD'";
												if(mysqli_query($con,$update_changed_pass_str)){
													?>
													<div class="row">
														<div class="col-xs-12">
															<div class="message_header text-center">
																<p class="text-success custom-text-success">Password changed succesfully! <br/><a href="login.php">Login with the new password</a></p>
															</div>
														</div>
													</div>
													<?php
												}
												
											}
											else{
												?>
												<div class="row">
													<div class="col-xs-12">
														<div class="message_header text-center">
															<p class="text-danger custom-text-danger">New password and re enter new password doesn't match!</p>
														</div>
													</div>
												</div>
												<?php
											}
										}
										else{
											?>
											<div class="row">
												<div class="col-xs-12">
													<div class="message_header text-center">
														<p class="text-danger custom-text-danger">You entered a wrong old password!</p>
													</div>
												</div>
											</div>
											<?php
										}
									}
								}
							}
						?>	
					</div>
				</div>
			</div>
			<!-- END MESSAGES AND PROCESS -->	
			
        	<div class="row">
            	<div class="col-xs-12">
                	<div class="adminContent generalBox">
                        <!-- Forgot Password -->
                        <h3>Reset Password!</h3>
                        <!--<h4>Enter the email ID in which you want your password to be forwarded!</span></h4>-->
                        <form role="form" action="reset_password.php" method="post">
                          <div class="form-group">
                            <label for="old_password">Enter Old Password:</label>
                            <input name="old_password" type="password" class="form-control" id="old_password" required>
                          </div>
						  <div class="form-group">
                            <label for="new_password">Enter new password:</label>
                            <input name="new_password" type="password" class="form-control" id="new_password" required>
                          </div>
						  <div class="form-group">
                            <label for="new_password_reenter">Re enter new password:</label>
                            <input name="new_password_reenter" type="password" class="form-control" id="new_password_reenter" required>
                          </div>
                          <input type="submit" name="submit" class="btn btn-default red_btn" value="Reset Password">
                        </form>
						<br/>
                        <a href="forgot_password.php">Forgot password</a>
                        <!-- End Forgot Password -->
                       
                    </div>    
                </div>
            </div>
        </div>
    </div>
    <!-- End Admin Content Wide -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="admin_js/bootstrap.js"></script>
     <!-- Pop Over Script -->
	<script>
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover(); 
    });
    </script>
    <!-- End Pop Over Script -->
    
  </body>
</html>