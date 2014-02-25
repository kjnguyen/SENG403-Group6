<?php
    define("INCLUDE_FILE", true);
    $no_visible_elements=true;
    include('header.php');
?>

			<div class="row-fluid">
				<div class="span12 center login-header">
					<h2>Welcome!</h2>
                                        <a href="../index.php">Back to 4J Estate Marketplace</a>
				</div><!--/span-->
                                
			</div><!--/row-->
			
			<div class="row-fluid">
				<div class="well span5 center login-box">
					<div class="alert alert-info">
                                            <?php
                                            //Display login message or error message
                                            if (isset($_SESSION['Authed_Error'])) {
                                                if ($_SESSION['Authed_Error'] == -1) {
                                                    echo 'Internal server error. Please try again!';
                                                } else if ($_SESSION['Authed_Error'] == 0) {
                                                    echo 'Successfully logged out.';
                                                } else if ($_SESSION['Authed_Error'] == 1) {
                                                    echo 'Invalid login request. Please try again!';
                                                } else if ($_SESSION['Authed_Error'] == 2) {
                                                    echo 'Invalid username. Please try again!';
                                                } else if ($_SESSION['Authed_Error'] == 3) {
                                                    echo 'Invalid username or password!';
                                                } else if ($_SESSION['Authed_Error'] == 4) {
                                                    echo 'You are not logged in, please login first!';
                                                } else {
                                                    echo 'Please enter your username and password to login.';
                                                }
                                                unset($_SESSION['Authed_Error']);
                                            } else {
                                                echo 'Please enter your username and password to login.';
                                            }
                                            ?>
                                            
					</div>
					<form class="form-horizontal" action="auth.php" method="post">
						<fieldset>
							<div class="input-prepend" title="Username or Email" data-rel="tooltip">
								<span class="add-on"><i class="icon-user"></i></span><input autofocus class="input-large span10" name="username" id="username" type="text" value="" />
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password" data-rel="tooltip">
								<span class="add-on"><i class="icon-lock"></i></span><input class="input-large span10" name="password" id="password" type="password" value="" />
							</div>
							<div class="clearfix"></div>

							<!-- This part is not required
                            <div class="input-prepend">
							<label class="remember" for="remember"><input type="checkbox" id="remember" />Remember me</label> 
							</div> -->
							<div class="clearfix"></div>

							<p class="center span5">
							<button type="submit" class="btn btn-primary">Login</button>
							</p>
						</fieldset>
					</form>
				</div><!--/span-->
			</div><!--/row-->
            
<?php
    include('footer.php');
?>
