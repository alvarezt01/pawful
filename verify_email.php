<?php

    require_once('include/db.inc.php');
    require_once('include/mysql_db.class.php');
    require_once('include/session.inc.php');

    if (isset($_GET['eid'])) {
        $query = "SELECT * FROM users WHERE verify_id='$_GET[eid]'";
        $exists = $db->fetch_row($query);
        
        if ($exists['email'] != '') {
            $query = "UPDATE users SET verified = '1' WHERE verify_id='$_GET[eid]'";
            $result = $db->query($query);
            
            $success = '1';
            
            user_login($exists['email'], $exists['password'])
            
            header("Location: /main_res");
            
        } else {
            
            header("Location: /index.php");
            
        }
    }

?>

<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="robots" content="index,follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Pawful - Raise the Perfect Pet</title>
    
    <link href="/css/1140.css" rel="stylesheet" type="text/css">
    <link href="/css/style.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300' rel='stylesheet' type='text/css'>
    
</head>
<body>
    
    <div class="container12">
        
        <?php include "nav.php"; ?>
        
        
        
    </div>
    
</body>
</html>