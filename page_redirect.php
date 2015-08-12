<?php

    require_once('include/db.inc.php');
    require_once('include/mysql_db.class.php');
    require_once('include/session.inc.php');

    function generatePassword ($length = 8)
    {
        $password = "";
        $possible = "0123456789abcdefghijklmnopqrstuvwxyz";
        
        $i = 0;
        
        while ($i < $length) {
            $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
            
            if (!strstr($password, $char)) {
                $password .= $char;
                $i++;
            }
        }
        return $password;
    }

    if (!isset($_SESSION['pure']))
        header("Location: /index.php");

     if (isset($_POST['city']))
    {
        if ($_POST['city'] != '' && $_POST['email'] != '')
        {
            
          if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
            {
              $pwgen = generatePassword();
              $verify_code = generatePassword();
              $pwgen = md5($pwgen);
              
              $_POST['email'] = mysql_escape_string($_POST['email']);
              $_POST['city'] = mysql_escape_string($_POST['city']);
              $_POST['state'] = mysql_escape_string($_POST['state']);
              
              $query="INSERT INTO users (email, password, city, state, verify_id, date_added) VALUES ('$_POST[email]','$_POST[pwgen]','$_POST[city]','$_POST[state]','$verify_code',NOW())";
              $result = $db->query($query);
              $ins_id = $db->insert_id($result);
              
              //INSERT BREEDS
              
              $_SESSION['pure'] = mysql_escape_string($_SESSION['pure']);
              $_SESSION['second'] = mysql_escape_string($_SESSION['second']);
              
              $firstbreed_arr = explode(" ", $_SESSION['pure']);
              $secondbreed_arr = explode(" ", $_SESSION['second']);
              
              foreach ($firstbreed_arr as $first) {
                  $query = "INSERT INTO firstbreed (user_id, breed, city, state, date_added) VALUES ('$ins_id','$first', '$_POST[city]', '$_POST[state]', NOW())";
                  $result = $db-> query($query);
              }
              
               foreach ($secondbreed_arr as $second) {
                  $query = "INSERT INTO secondbreed (user_id, sec_breed, city, state, date_added) VALUES ('$ins_id','$second', '$_POST[city]', '$_POST[state]', NOW())";
                  $result = $db-> query($query);
              }
              
              
              
              $subject = "Pawful - Please verify your email address.";
              
              $message = "
              
Hello,

Thank you for signing up with us.  Please click the following link to verify your email address.

http://urlofwebsiteid" . $verify_code . "

If you did not sign up to our website, please ignore this email.

Thank you,
pawful.com

";
              $headers = "From:  pawful.com <contact@pawful.com>\r\n";
              
              mail($_POST['email'], $subject, $message, $headers);
              
              $success = '1';
              
          }
            else {
                $error_msg = "Please enter a valid email.";
            }
            
        }
        else {
            $error_msg = 'You are missing a field.';
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
    
    <link href="css/1140.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300' rel='stylesheet' type='text/css'>
    
</head>
<body>
    
    <div class="container12">
        
        <?php include "nav.php"; ?>
        
        <?php if (!isset($success)) { ?>
        
        <h1 id="home"><strong>Great!</strong> Just one more step</h1>
        
        <form action="" method="POST">
        
            <?php if (isset($error_msg)) { ?>
                <div class="alert"><?php echo $error_msg; ?></div>
            <?php } ?>
            
            <div class="row">
            
                <div class="column3">
                    
                    <input type="text" class="large-fld" name="email" value="" placeholder="Email Address">
                
                </div>
                
                <div class="column3">
                    
                    <input type="text" class="large-fld" name="city" value="" placeholder="City">
                
                </div>
                
                <div class="column3">
                    
                    <select name="state" class="large-fld">
                        
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                        <option value="AZ">Arizona</option>
                        <option value="AR">Arkansas</option>
                        <option value="CA">California</option>
                        <option value="CO">Colorado</option>
                        <option value="CT">Connecticut</option>
                        <option value="DE">Delaware</option>
                        <option value="DC">District of Columbia</option>
                        <option value="FL">Florida</option>
                        <option value="GA">Georgia</option>
                        <option value="HI">Hawaii</option>
                        <option value="ID">Idaho</option>
                        <option value="IL">Illinois</option>
                        <option value="IN">Indiana</option>
                        <option value="IA">Iowa</option>
                        <option value="KS">Kansas</option>
                        <option value="KY">Kentucky</option>
                        <option value="LA">Louisiana</option>
                        <option value="ME">Maine</option>
                        <option value="MD">Maryland</option>
                        <option value="MA">Massachusetts</option>
                        <option value="MI">Michigan</option>
                        <option value="MN">Minnesota</option>
                        <option value="MS">Mississippi</option>
                        <option value="MO">Missouri</option>
                        <option value="MT">Montana</option>
                        <option value="NE">Nebraska</option>
                        <option value="NV">Nevada</option>
                        <option value="NH">New Hampshire</option>
                        <option value="NJ">New Jersey</option>
                        <option value="NM">New Mexico</option>
                        <option value="NY">New York</option>
                        <option value="NC">North Carolina</option>
                        <option value="ND">North Dakota</option>
                        <option value="OH">Ohio</option>
                        <option value="OK">Oklahoma</option>
                        <option value="OR">Oregon</option>
                        <option value="PA">Pennsylvania</option>
                        <option value="RI">Rhode Island</option>
                        <option value="SC">South Carolina</option>
                        <option value="SD">South Dakota</option>
                        <option value="TN">Tennessee</option>
                        <option value="TX">Texas</option>
                        <option value="UT">Utah</option>
                        <option value="VT">Vermont</option>
                        <option value="VA">Virginia</option>
                        <option value="WA">Washington</option>
                        <option value="WV">West Virginia</option>
                        <option value="WI">Wisconsin</option>
                        <option value="WY">Wyoming</option>
                        
                    </select>

                </div>
                
                <div class="column3">
                    
                    <input type="submit" class="large-btn large-magnify" name="step2" value="Continue">
                
                </div>
                
            </div>
        
        </form>
        
        <p id="home-info"><span>Notice</span>:  If dog is purebreed, leave second blank.  If dog is more than two types, use the two that are most present.</p>
        
        <?php } else { ?>
        
            <h1 id="home"><strong>Almost there..</strong>     Please check your email to verify your account.</h1>
        
        <?php } ?>
        
    </div>
    
</body>
</html>