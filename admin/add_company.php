<?php
    define("INCLUDE_FILE", true);
    include('header.php');
    
    //Do not output anything before this line (Do not use echo or html code)
    //---------------------------------------------------
?>
<?php
if ($_SESSION['Authed_Permission'] != 1) {
    printf("<script>location.href='bad_permission.php'</script>");
}
?>


<div>
    <ul class="breadcrumb">
        <li>
            <a href="index.php"><?php echo $Lang_Home; ?></a> <span class="divider">/</span>
        </li>
        <li>
          <a href="#"><b><?php echo $Lang_Add_Company; ?></b></a>
        </li>
    </ul>
</div>

<div class="row-fluid sortable ui-sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title="">
                <h2><i class="icon-edit"></i> Add a Company</h2>

        </div>

        <div class="box-content">
            <form class="form-horizontal" name="add_company" method="post" action="process_add_company.php">
                <fieldset>
                  <div class="control-group">
                    <label class="control-label" for="focusedInput"><?php echo $Lang_Company_Name; ?></label>
                    <div class="controls">
                      <input class="input-xlarge focused" id="focusedInput" type="text" name="name" value="">
                    </div>
                  </div>
                    <div class="control-group">
                    <label class="control-label" for="focusedInput"><?php echo $Lang_Company_Adr; ?></label>
                    <div class="controls">
                      <input class="input-xlarge focused" id="focusedInput" type="text" name="address" value="">
                    </div>
                  </div>
                    
                    <div class="control-group">
                    <label class="control-label" for="focusedInput"><?php echo $Lang_Company_Mgr; ?></label>
                    <div class="controls">
                      <input class="input-xlarge focused" id="focusedInput" type="text" name="manager_name" value="">
                    </div>
                  </div>
                    <div class="control-group">
                    <label class="control-label" for="focusedInput"><?php echo $Lang_Company_Ph; ?></label>
                    <div class="controls">
                      <input class="input-xlarge focused" id="focusedInput" type="text" name="phone_no" value="">
                    </div>
                  </div>
                    <div class="control-group">
                    <label class="control-label" for="focusedInput"><?php echo $Lang_Company_Email; ?></label>
                    <div class="controls">
                      <input class="input-xlarge focused" id="focusedInput" type="text" name="email" value="">
                    </div>
                  </div>
                    <div class="control-group">
                    <label class="control-label" for="focusedInput"><?php echo $Lang_Company_Username; ?></label>
                    <div class="controls">
                      <input class="input-xlarge focused" id="focusedInput" type="text" name="username" value="">
                    </div>
                  </div>
                    <div class="control-group">
                    <label class="control-label" for="focusedInput"><?php echo $Lang_Company_Password; ?></label>
                    <div class="controls">
                      <input class="input-xlarge focused" id="focusedInput" type="password" name="password" value="">
                    </div>
                  </div>
                                                    <!--Confirm password-->
                    <div class="control-group">
                        <label class="control-label"><?php echo $Lang_Company_Cfm_Password; ?>: </label>
                        <div class="controls">
                    <input class="input-xlarge focused" id="focusedInput" type="password" name="Cfm_Password" value="">
                    <p class="help-block"><?php echo $Lang_Company_Cfm_Pswd_Msg; ?></p>
                        </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="textarea2"><?php echo $Lang_Company_Description; ?></label>
                      <div class="controls">
                            <textarea class="cleditor" id="textarea2" name="description" rows="3" style="display: none; width: 500px; height: 197px;"></textarea>
                    </div>
                    </div>
                      <input type="hidden" name="process_add_company" value='true'>

                  <div class="form-actions">
                    <button type="submit" class="btn btn-primary"><?php echo $Lang_Company_Add; ?></button>
                    <a href="index.php" class="btn"><?php echo $Lang_Company_Cancel; ?></a>
                  </div>
            </fieldset>
          </form>

        </div>
    </div><!--/span-->

</div>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<?php
    include('footer.php');
?>
