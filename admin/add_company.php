<?php
    define("INCLUDE_FILE", true);
    include('header.php');
    
    //Do not output anything before this line (Do not use echo or html code)
    //---------------------------------------------------
?>

<?php
    define("add_utils.php", True);
    include_once 'add_utils.php';
    
    if($_POST['process_add_company'] == 'true') {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $description = $_POST['description'];
        $manager_name = $_POST['manager_name'];
        $phone_no = $_POST['phone_no'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $username = $_POST['username'];
        
//        echo $name.'<br>';
//        echo $address.'<br>';
//        echo $description;
//        echo $manager_name;
//        echo $phone_no;
//        echo $email;
//        echo $password;
//        echo $username;
        //add_company($name, $address, $description, $manager_name, $phone_no, $email, $password, $username);
        header("Location: index.php");
//        die();
        exit();
    }
    
?>

<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">Home</a> <span class="divider">/</span>
        </li>
        <li>
            <a href="#">Blank</a>
        </li>
    </ul>
</div>

<div class="row-fluid sortable ui-sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title="">
                <h2><i class="icon-edit"></i> Add a Company</h2>

        </div>

        <div class="box-content">
            <form class="form-horizontal" name="add_company" method="post" action="add_company.php">
                <fieldset>
                  <div class="control-group">
                    <label class="control-label" for="focusedInput">Company Name</label>
                    <div class="controls">
                      <input class="input-xlarge focused" id="focusedInput" type="text" name="name" value="">
                    </div>
                  </div>
                    <div class="control-group">
                    <label class="control-label" for="focusedInput">Company Address</label>
                    <div class="controls">
                      <input class="input-xlarge focused" id="focusedInput" type="text" name="address" value="">
                    </div>
                  </div>
                    <div class="control-group">
                      <label class="control-label" for="textarea2">Company Description</label>
                      <div class="controls">
                            <textarea class="cleditor" id="textarea2" name="description" rows="3" style="display: none; width: 500px; height: 197px;"></textarea>
                    </div>
                    <div class="control-group">
                    <label class="control-label" for="focusedInput">Manager</label>
                    <div class="controls">
                      <input class="input-xlarge focused" id="focusedInput" type="text" name="manager_name" value="">
                    </div>
                  </div>
                    <div class="control-group">
                    <label class="control-label" for="focusedInput">Phone Number</label>
                    <div class="controls">
                      <input class="input-xlarge focused" id="focusedInput" type="text" name="phone_no" value="">
                    </div>
                  </div>
                    <div class="control-group">
                    <label class="control-label" for="focusedInput">Email</label>
                    <div class="controls">
                      <input class="input-xlarge focused" id="focusedInput" type="text" name="email" value="">
                    </div>
                  </div>
                    <div class="control-group">
                    <label class="control-label" for="focusedInput">Username</label>
                    <div class="controls">
                      <input class="input-xlarge focused" id="focusedInput" type="text" name="username" value="">
                    </div>
                  </div>
                    <div class="control-group">
                    <label class="control-label" for="focusedInput">Password</label>
                    <div class="controls">
                      <input class="input-xlarge focused" id="focusedInput" type="password" name="password" value="">
                    </div>
                  </div>

                      <input type="hidden" name="process_add_company" value='true'>

                  <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <a href="index.php" class="btn">Cancel</a>
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
