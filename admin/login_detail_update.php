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
						<a href="./index.php"><?php $Lang_Home; ?></a> <span class="divider">/</span> 
					</li>
					<li>
                                          <a href="./login_detail_edit.php"><?php echo $Lang_Edit_Login_Details; ?></a> <span class="divider">/</span>
        </li>
        <li>
          <a href ="#"><b><?php echo $Lang_Confirmation; ?></b></a>
        </li>
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
                        
                        <?php
                            //PHP stuff here
                            //Check for valid username, id and permission
                            //Check for valid access
                            if (!isset($_POST['Ref_PG']) || $_POST['Ref_PG'] != "update_login_detail") {
                                ShowErrMsg($Lang_Error.$Lang_No_Direct_Access);
                                goto EXEFinished;
                            } else {
                                //Unset
                                unset($_POST['Ref_PG']);
                            }
                            //If user is not admin, user id must match to his own
                            if ($_POST['User_ID'] != $_SESSION['Authed_UserID'] && $_SESSION['Authed_Permission'] != 1) {
                                ShowErrMsg($Lang_Error.$Lang_No_Permission);
                                goto EXEFinished;
                            }
                            //Check for valid userid
                            if (!is_numeric($_POST['User_ID'])) {
                                ShowErrMsg($Lang_Error.$Lang_Invalid_User_ID);
                                goto EXEFinished;
                            }
                            $resp = preg_match("/[.]/", $_POST['User_ID']);
                            if ($resp > 0) {
                                ShowErrMsg($Lang_Error.$Lang_Invalid_User_ID);
                                goto EXEFinished;
                            }
                            //If user is not admin, username must match to his own
                            if ($_POST['Username'] != $_SESSION['Authed_Username'] && $_SESSION['Authed_Permission'] != 1) {
                                ShowErrMsg($Lang_Error.$Lang_No_Permission_Mod_Username);
                                goto EXEFinished;
                            }
                            //Check for valid username
                            if (isset($_POST['Username']) && $_POST['Username'] != "") {
                                $resp = preg_match("/[^A-Za-z0-9]/", $_POST['Username']);
                                if ($resp > 0) {
                                    ShowErrMsg($Lang_Error.$Lang_Invalid_User_Name);
                                    goto EXEFinished;
                                }
                            }
                            //Check for valid email
                            if (isset($_POST['Email']) && $_POST['Email'] != "") {
                                if (!filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL)) {
                                    ShowErrMsg($Lang_Error.$Lang_Invalid_Email_Adr);
                                    goto EXEFinished;
                                }
                            }
                            //Check for matching password
                            if (isset($_POST['Password']) || isset($_POST['Cfm_Password'])) {
                                if ($_POST['Password'] != $_POST['Cfm_Password']) {
                                    ShowErrMsg($Lang_Error.$Lang_Pswd_Mismatch);
                                    goto EXEFinished;
                                }
                            }
                            //Check for empty fields
                            if ((!isset($_POST['Username']) || $_POST['Username'] == "") && (!isset($_POST['Email']) || $_POST['Email'] == "") && (!isset($_POST['Password']) || $_POST['Password'] == "")) {
                                ShowErrMsg($Lang_Error.$Lang_Nothing_Being_Changed);
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
                            if (!(@$query->execute())) {
                                ShowErrMsg($Lang_Error.$Lang_Updated_Failed);
                                @mysqli_close($mysqlconn);
                                goto EXEFinished;
                            }
                            
                            //Success
                            echo '<div class="alert alert alert-success">';
                            echo 'Profile successfully updated!';
                            echo '</div>';
                            
                            //Update current login data if username is the same
                            if ($_SESSION['Authed_UserID'] == $TargetedID) {
                                $_SESSION['Authed_Username'] = $Username;
                                $_SESSION['Authed_Email'] = $Email;
                            }
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
