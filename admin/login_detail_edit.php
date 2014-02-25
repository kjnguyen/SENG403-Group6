<?php
    define("INCLUDE_FILE", true);
    include('header.php');
    
    //Do not output anything before this line (Do not use echo or html code)
    //---------------------------------------------------
?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="./index.php">Home</a> <span class="divider">/</span> 
					</li>
					<li>
						<a href="#">Edit Login Details</a>
					</li>
				</ul>
			</div>

			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-picture"></i>Edit Login Details</h2>
						<div class="box-icon">
							<!-- <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> -->
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<!-- <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> -->
						</div>
					</div>
					<div class="box-content">
						
                        <form class="form-horizontal" method="post" action="login_detail_update.php">
						    <fieldset>
                                <legend>Please leave the field empty or same value if you do not want to change that field. [Except User ID]</legend>
                                <!--User id field-->
							    <div class="control-group">
                                    <?php if ($_SESSION['Authed_Permission'] == 1) { //For admin?>
                                        <label class="control-label">Targeted User ID: </label>
                                        <div class="controls">
                                            <input type="text" name="User_ID" value="<?php echo $_SESSION['Authed_UserID']; ?>" required>
                                            <p class="help-block">Your ID is: <?php echo $_SESSION['Authed_UserID']; ?></p>
                                        </div>
                                    <?php } else { //For non admin ?>
                                        <label class="control-label">User ID: </label>
                                        <div class="controls">
                                            <input type="text" name="User_ID" value="<?php echo $_SESSION['Authed_UserID']; ?>" required readonly>
                                            <p class="help-block">Your ID is: <?php echo $_SESSION['Authed_UserID']; ?></p>
                                        </div>
                                    <?php } ?>
							    </div>
                                <!--Username field-->
							    <div class="control-group">
                                    <?php if ($_SESSION['Authed_Permission'] == 1) { //For admin?>
                                        <label class="control-label">New Username: </label>
                                        <div class="controls">
                                            <input type="text" name="Username" value="<?php echo ""; ?>">
                                            <p class="help-block">Your current username is: <?php echo $_SESSION['Authed_Username']; ?></p>
                                        </div>
                                    <?php } else { //For non admin ?>
                                        <label class="control-label">Username: </label>
                                        <div class="controls">
                                            <input type="text" name="Username" value="<?php echo $_SESSION['Authed_Username']; ?>" readonly>
                                            <p class="help-block">Your username is: <?php echo $_SESSION['Authed_Username']; ?></p>
                                        </div>
                                    <?php } ?>
							    </div>
                                <!--email field-->
                                <div class="control-group">
							        <label class="control-label">New Email: </label>
							        <div class="controls">
                                        <?php if ($_SESSION['Authed_Permission'] == 1) { //For admin?>
                                            <input type="text" name="Email" value="<?php echo ""; ?>">
                                        <?php } else { //For non admin ?>
                                            <input type="text" name="Email" value="<?php echo $_SESSION['Authed_Email']; ?>">
                                        <?php } ?>
                                        <p class="help-block">Your current Email is: <?php echo $_SESSION['Authed_Email']; ?></p>
							        </div>
							    </div>
                                <!--password field-->
                                <div class="control-group">
							        <label class="control-label">New Password: </label>
							        <div class="controls">
                                        <input type="password" name="Password" value="">
                                        <p class="help-block">Leave empty for not change pswd.</p>
							        </div>
							    </div>
                                <!--Confirm password-->
                                <div class="control-group">
							        <label class="control-label">Confirm Password: </label>
							        <div class="controls">
                                        <input type="password" name="Cfm_Password" value="">
                                        <p class="help-block">Please confirm your password!</p>
							        </div>
							    </div>
                                <!--Something secret-->
                                <input type="hidden" name="Ref_PG" value="update_login_detail" />
                                <!--Buttons-->
							    <div class="form-actions">
							        <button type="submit" class="btn btn-primary">Save changes</button>
							        <button type="reset" class="btn">Cancel</button>
							    </div>
						    </fieldset>
					    </form>   
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

    
<?php
    include('footer.php');
?>
