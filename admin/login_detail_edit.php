<?php
   /*
    * This file was written by Jack L (http://jack-l.com)
    * Please do not change without my permission!
    * You may use any part of the follow code on your other projects or programs.
    * Please send me Email if you have any questions related to this page.
    */

    define("INCLUDE_FILE", true);
    include('header.php');
    
    //Do not output anything before this line (Do not use echo or html code)
    //---------------------------------------------------
?>
			<div>
				<ul class="breadcrumb">
					<li>
						<a href="index.php"><?php echo $Lang_Home;?></a> <span class="divider">/</span> 
					</li>
					<li>
                                          <a href="#"><b><?php echo $Lang_Edit_Login_Details; ?></b></a>
					</li>
				</ul>
			</div>

			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-picture"></i><?php echo $Lang_Edit_Login_Details; ?></h2>
						<div class="box-icon">
							<!-- <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> -->
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<!-- <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> -->
						</div>
					</div>
					<div class="box-content">
						
                        <form class="form-horizontal" method="post" action="login_detail_update.php">
						    <fieldset>
                                <legend><?php echo $Lang_Leave_Field_Empty_For_No_Change; ?></legend>
                                <!--User id field-->
							    <div class="control-group">
                                    <?php if ($_SESSION['Authed_Permission'] == 1) { //For admin?>
                                        <label class="control-label"><?php echo $Lang_Targeted_User_ID ?>: </label>
                                        <div class="controls">
                                            <input type="text" name="User_ID" value="<?php echo $_SESSION['Authed_UserID']; ?>" required>
                                            <p class="help-block"><?php echo $Lang_Your_ID ?>: <?php echo $_SESSION['Authed_UserID']; ?></p>
                                        </div>
                                    <?php } else { //For non admin ?>
                                        <label class="control-label"><?php echo $Lang_User_ID; ?>: </label>
                                        <div class="controls">
                                            <input type="text" name="User_ID" value="<?php echo $_SESSION['Authed_UserID']; ?>" required readonly>
                                            <p class="help-block"><?php echo $Lang_Your_ID ?>: <?php echo $_SESSION['Authed_UserID']; ?></p>
                                        </div>
                                    <?php } ?>
							    </div>
                                <!--Username field-->
							    <div class="control-group">
                                    <?php if ($_SESSION['Authed_Permission'] == 1) { //For admin?>
                                        <label class="control-label"><?php echo $Lang_New_Usr_Name; ?>: </label>
                                        <div class="controls">
                                            <input type="text" name="Username" value="<?php echo ""; ?>">
                                            <p class="help-block"><?php echo $Lang_Your_Cur_Usr_Name; ?>: <?php echo $_SESSION['Authed_Username']; ?></p>
                                        </div>
                                    <?php } else { //For non admin ?>
                                        <label class="control-label"><?php echo $Lang_Usr_Name; ?>: </label>
                                        <div class="controls">
                                            <input type="text" name="Username" value="<?php echo $_SESSION['Authed_Username']; ?>" readonly>
                                            <p class="help-block"><?php echo $Lang_Your_Cur_Usr_Name; ?>: <?php echo $_SESSION['Authed_Username']; ?></p>
                                        </div>
                                    <?php } ?>
							    </div>
                                <!--email field-->
                                <div class="control-group">
							        <label class="control-label"><?php echo $Lang_New_Email; ?>: </label>
							        <div class="controls">
                                        <?php if ($_SESSION['Authed_Permission'] == 1) { //For admin?>
                                            <input type="text" name="Email" value="<?php echo ""; ?>">
                                        <?php } else { //For non admin ?>
                                            <input type="text" name="Email" value="<?php echo $_SESSION['Authed_Email']; ?>">
                                        <?php } ?>
                                        <p class="help-block"><?php echo $Lang_Your_Cur_Email; ?>: <?php echo $_SESSION['Authed_Email']; ?></p>
							        </div>
							    </div>
                                <!--password field-->
                                <div class="control-group">
							        <label class="control-label"><?php echo $Lang_New_Pswd; ?>: </label>
							        <div class="controls">
                                        <input type="password" name="Password" value="">
                                        <p class="help-block"><?php echo $Lang_Leave_Empty_For_No_Change_Pswd; ?></p>
							        </div>
							    </div>
                                <!--Confirm password-->
                                <div class="control-group">
							        <label class="control-label"><?php echo $Lang_Cfm_Pswd ?>: </label>
							        <div class="controls">
                                        <input type="password" name="Cfm_Password" value="">
                                        <p class="help-block"><?php echo $Lang_Cfm_Pswd2; ?></p>
							        </div>
							    </div>
                                <!--Something secret-->
                                <input type="hidden" name="Ref_PG" value="update_login_detail" />
                                <!--Buttons-->
							    <div class="form-actions">
							        <button type="submit" class="btn btn-primary"><?php echo $Lang_Save; ?></button>
							        <button type="reset" class="btn"><?php echo $Lang_Reset; ?></button>
							    </div>
						    </fieldset>
					    </form>   
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

    
<?php
    include('footer.php');
?>
