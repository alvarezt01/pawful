<?php

    @session_start();

    require_once('include/db.inc.php');
    require_once('include/mysql_db.class.php');

    function user_login($email, $password) {
        global $db;
        $new_email = addslashes($email);
        $new_pw = $password;
        
        $query = "SELECT * FROM users WHERE email = '$new_email' AND password = '$new_pw' LIMIT 1";
        if (($arr_admin = $db->fetch_row($query)) == false)
            return false;
        
        $_SESSION['user_id'] = $arr_admin['id'];
        $_SESSION['email'] = $arr_admin['email'];
        
        return true;
    }

?>