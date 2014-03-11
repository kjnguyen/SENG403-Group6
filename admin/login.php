<?php
   /*
    * This file was written by Jack L (http://jack-l.com)
    * Please do not change without my permission!
    * You may use any part of the follow code on your other projects or programs.
    * Please send me Email if you have any questions related to this page.
    */

    define("INCLUDE_FILE", true);
    $no_visible_elements=true;
    include('header.php');
?>

			<div class="row-fluid">
				<div class="span12 center login-header">
					<h2><?php echo $Lang_Welcome_To_Admin_Page; ?></h2>
                                        <a href="../index.php"><?php echo $Lang_Go_Back_To_Market; ?></a>
				</div><!--/span-->
                                
			</div><!--/row-->
			
			<div class="row-fluid">
				<div class="well span5 center login-box">
					<div class="alert alert-info">
                                            <?php
                                            //Display login message or error message
                                            if (isset($_SESSION['Authed_Error'])) {
                                                if ($_SESSION['Authed_Error'] == -1) {
                                                    echo $Internal_Server_Err;
                                                } else if ($_SESSION['Authed_Error'] == 0) {
                                                    echo $Successfully_Loggedout;
                                                } else if ($_SESSION['Authed_Error'] == 1) {
                                                    echo $Invalid_Login_Req;
                                                } else if ($_SESSION['Authed_Error'] == 2) {
                                                    echo $Invalid_Username;
                                                } else if ($_SESSION['Authed_Error'] == 3) {
                                                    echo $Lang_Pswd_Not_Match;
                                                } else if ($_SESSION['Authed_Error'] == 4) {
                                                    echo $Lang_Not_Logged_In;
                                                } else {
                                                    echo $Lang_Please_Enter_Data_To_Login;
                                                }
                                                unset($_SESSION['Authed_Error']);
                                            } else {
                                                echo $Lang_Please_Enter_Data_To_Login;
                                            }
                                            ?>
                                            
					</div>
					<form class="form-horizontal" action="auth.php" method="post">
						<fieldset>
							<div class="input-prepend" title="<?php echo $Lang_Username_or_Email; ?>" data-rel="tooltip">
								<span class="add-on"><i class="icon-user"></i></span><input autofocus class="input-large span10" name="username" id="username" type="text" value="" />
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="<?php echo $Lang_Password; ?>" data-rel="tooltip">
								<span class="add-on"><i class="icon-lock"></i></span><input class="input-large span10" name="password" id="password" type="password" value="" />
							</div>
							<div class="clearfix"></div>

							<!-- This part is not required
                            <div class="input-prepend">
							<label class="remember" for="remember"><input type="checkbox" id="remember" />Remember me</label> 
							</div> -->
							<div class="clearfix"></div>

							<p class="center span5">
							<button type="submit" class="btn btn-primary"><?php echo $Lang_Login; ?></button>
							</p>
                                                        <p class="center span5">
							<a href="request_account_info.html"><?php echo $Lang_Req_Account; ?></a>
							</p>
						</fieldset>
					</form>
				</div><!--/span-->
			</div><!--/row-->
            
<?php
    include('footer.php');
?>
