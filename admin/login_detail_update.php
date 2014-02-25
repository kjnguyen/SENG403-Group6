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
                        
                        <?php
                            //PHP stuff here
                            //Check for valid username, id and permission
                            //Check for valid access
                            if (!isset($_POST['Ref_PG']) || $_POST['Ref_PG'] != "update_login_detail") {
                                ShowErrMsg("Error: No direct access to this page.");
                                goto EXEFinished;
                            }
                            //If user is not admin, user id must match to his own
                            if ($_POST['User_ID'] != $_SESSION['Authed_UserID'] && $_SESSION['Authed_Permission'] != 1) {
                                ShowErrMsg("Error: You do not have permission to perform this action!");
                                goto EXEFinished;
                            }
                            //Check for valid userid
                            if (!is_int($_POST['User_ID'])) {
                                ShowErrMsg("Error: Invalid user ID.");
                                goto EXEFinished;
                            }
                            //If user is not admin, username must match to his own
                            if ($_POST['Username'] != $_SESSION['Authed_Username'] && $_SESSION['Authed_Permission'] != 1) {
                                ShowErrMsg("Error: You do not have permission to modfiy username field.");
                                goto EXEFinished;
                            }
                            //Check for valid username
                            if (isset($_POST['Username']) && $_POST['Username'] != "") {
                                $resp = preg_match("/[^A-Za-z0-9]/", $_POST['Username']);
                                if ($resp > 0) {
                                    ShowErrMsg("Error: Username contains invalid characters. Only letters and numbers are allowed!");
                                    goto EXEFinished;
                                }
                            }
                            //Check for valid email
                            if (isset($_POST['Email']) && $_POST['Email'] != "") {
                                if (!filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL)) {
                                    ShowErrMsg("Error: Invalid email address.");
                                    goto EXEFinished;
                                }
                            }
                            //Check for matching password
                            if (isset($_POST['Password']) || isset($_POST['Cfm_Password'])) {
                                if ($_POST['Password'] != $_POST['Cfm_Password']) {
                                    ShowErrMsg("Error: Passwords mismatch!");
                                    goto EXEFinished;
                                }
                            }
                            //Check for empty fields
                            if ((!isset($_POST['Username']) || $_POST['Username'] == "") && (!isset($_POST['Email']) || $_POST['Email'] == "") && (!isset($_POST['Password']) || $_POST['Password'] == "")) {
                                ShowErrMsg("Error: You are not changing anything...");
                                goto EXEFinished;
                            }
                            
                            //Mysql Stuff
                            include_once '../mysqlcon.php';
                            $mysqlconn = getSQLConnection();
                            
                            //query
                            $TargetedID = $_POST['User_ID'];
                            $Username = $_POST['Username'];
                            $Email = $_POST['Email'];
                            $query = "UPDATE User SET ID='$TargetedID'";
                            //email
                            if (isset($_POST['Email']) && $_POST['Email'] != "") {
                                $query = $query.", email='$Email'";
                            }
                            //Check if we need to updat password
                            if (isset($_POST['Password']) && $_POST['Password'] != "") {
                                $SHAPswd = hash('sha512', $_POST['Password']);
                                $query = $query.", password='$SHAPswd'";
                            }
                            //Check if admin
                            if ($_SESSION['Authed_Permission'] == 1) { //Admin only
                                //username
                                if (isset($_POST['Username']) && $_POST['Username'] != "") {
                                    $query = $query.", username='$Username'"; //
                                }
                                
                            }
                            //Other
                            $query = $query." WHERE ID='$TargetedID'";
                            
                            //Prepare
                            @$query = $mysqlconn->prepare($query);
                            if (!$query) {
                                ShowErrMsg("Error: Database prepare statement failed.");
                                @mysqli_close($mysqlconn);
                                goto EXEFinished;
                            }
                            
                            //Execute mysql
                            @$query->execute();
                            //Check execution successfull
                            if (!$query) {
                                ShowErrMsg("Error: Update login detail failed, this could caused by duplicated email or username.");
                                @mysqli_close($mysqlconn);
                                goto EXEFinished;
                            }
                            
                            //Success
                            echo '<div class="alert alert alert-success">';
                            echo 'Profile successfully updated!';
                            echo '</div>';
EXEFinished:
                        ?>
                        
                        <!-- Go back button -->
                        <a href="./login_detail_edit.php" class="btn btn-info">Go Back</a>
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

    
<?php
    include('footer.php');
    
    //Some function use from above code
    function ShowErrMsg($Msg) {
        echo '<div class="alert alert-error">';
        echo $Msg;
        echo '</div>';
    }
?>
