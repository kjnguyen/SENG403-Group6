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
    add_company($name, $address, $description, $manager_name, $phone_no, $email, $password, $username);
    header("Location: index.php");
////        die();
    exit();
}
?>
