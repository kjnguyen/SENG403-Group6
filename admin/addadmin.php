<?php
    /*
    * This file was written by Jack L (http://jack-l.com)
    * Please do not change without my permission!
    * You may use any part of the follow code on your other projects or programs.
    * Please send me Email if you have any questions related to this page.
    */

    //Include mysql connection file
    //This file should be please in the admin folder
    include_once '../mysqlcon.php';
    
    //Connect to mysql
    $mysqlconn = getSQLConnection();
    
    //Query, dont care about prepare. Check for empty table first
    @$query = $mysqlconn->prepare('SELECT COUNT(*) FROM User');
    
    //Execute
    @$query->execute();
    if (!$query) {
        echo 'Failed to create first admin account: DB CONN ERR';
        die();
    }
    
    //Get result
    @$query->bind_result($Count);
    @$query->fetch();
    
    //Match count, if not empty, stop
    if ($Count != 0) {
        echo 'Failed to create first admin account: Not empty';
        die();
    }
    
    //Create admin account
    //Define username and password
    $Username = 'admin';
    $Email = 'admin@example.com';
    $Permission = '1';
    $Password = hash('sha512', '1234567a');
    
    //Query
    unset($query);
    @$query = $mysqlconn->prepare('INSERT INTO User (email, password, permission, username) VALUES (\''.$Email.'\', \''.$Password.'\', \''.$Permission.'\', \''.$Username.'\')');
    if (!$query) {
        echo 'Failed to create first admin account: ADD QUERY F';
        die();
    }
    
    //Execute
    @$query->execute();
    if (!$query) {
        echo 'Failed to create first admin account: DB CONN ERR';
        die();
    }

    //Close connection
    mysqli_close($mysqlconn);
    echo 'Completed!';
?>