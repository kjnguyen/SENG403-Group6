<?php
session_start();

define("modify_utils.php", true);
include "modify_utils.php";

// Check token
if($_POST['token'] != $_SESSION['token'])
{
  echo "Bad token";
  die();
}

// Check permissions
if(!check_permission($_POST['id']))
{
  echo "Bad Permissions";
  die();
}

?>