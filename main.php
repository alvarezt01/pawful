<?php

    require_once('include/db.inc.php');
    require_once('include/mysql_db.class.php');
    require_once('include/session.inc.php');

    if (isset($_SESSION['user_id']))
        header("Location: /index.php");

    function ago($time) {
        $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
        $lengths = array("60", "60", "24", "7", "4.35", "12", "10");
        
        $now = time();
        
            $difference = $now - $time;
            $tense  = "ago";
        
        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
            $difference /= $lengths[$j];
        }
        
        $difference = round($difference);
        
        if ($difference != 1) {
            $periods[$j] .= "s";
        }
        
        return "$difference $periods[$j] ago ";
    }

    $align_logo = "1";

    
    $query = "SELECT breed, city, state FROM firstbreed WHERE user_id = '$_SESSION[user_id]'";
    $firstbreed_arr = $db->fetch($query);

    $query = "SELECT sec_breed, city, state FROM secondbreed WHERE user_id = '$_SESSION[user_id]'";
    $secondbreed_arr = $db->fetch($query);

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
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,700' rel='stylesheet' type='text/css'>
    
</head>
<body>
    
    <div class="container12">
        
        <?php include "nav.php"; ?>

    </div>
    
    <div class="sub-menu">
    
        <div class="container12">
            
            <form action="" method="POST">
            
                <div class="column3">
                
                    <input type="text" class="small-fld" name="city" value="" placeholder="City">
                    
                </div>
                
                <div class="column3">
                
                   <select name="state" class="small-fld">
                        
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
                
                <div class="column2 ignore-section">
                
                    <input type="checkbox" name="ignore_location" value="1"><span class="gray-txt">Ignore Location</span>
                    
                </div>
                
                <div class="column4">
                
                    <input type="submit" class="small-btn" name="update_results" value="Update Results">
                    
                </div>
                
            </form>
             
        </div>
        
    </div>
    
<div class="gray-container">
    
    <div class="container12">
    
        <h1 id="full" class="main-titles"><strong>100% Matches</strong>  <span>(People with the same dog and the same problem)</span></h1>
        
        <div class="row">
            
            
            <?php


                foreach ($firstbreed_arr as $first) {
                    
                    if (!isset($_POST['state'])) {
                        $additional_query = "AND state = '$first[state]' AND city = '$first[city]'";
                    } elseif ($_POST['ignore_location'] != '1') {
                        $additional_query = "AND state = '$_POST[state]' AND city = '$_POST[city]'";
                    }
                    
                    $query = "SELECT *, UNIX_TIMESTAMP(date_added) as date_added FROM secondbreed WHERE user_id != '$_SESSION[user_id]' AND sec_breed = '$first[breed]' $additional_query";
                    $first_match_arr = $db->fetch($query);
                    
                    if (count($first_match_arr) != '0') {
                        
                        $found_results = '1';
                        
                        foreach ($first_match_arr as $first_match) {
                            $query = "SELECT * FROM users WHERE id = '$want_match[user_id]' LIMIT 1";
                            $user_info = $db->fetch_row($query);
                            
                            $query = "SELECT breed FROM firstbreed WHERE user_id = '$user_info[id]'";
                            $their_breed_arr = $db->fetch($query);
                            
                            foreach ($their_breed_arr as $their_breed) {
                                $f_breed_arr[] = $their_breed['breed'];
                            }
                            
                            $their_breed = implode(", ", $f_breed_arr);
                            
                            $query = "SELECT sec_breed FROM secondbreed WHERE user_id = '$user_info[id]'";
                            $their_sec_breed_arr = $db->fetch($query);
                            
                            foreach ($their_sec_breed_arr as $their_sec_breed) {
                                $s_breed_arr[] = $their_sec_breed['sec_breed'];
                            }
                            
                            $their_sec_breed = implode(", ", $s_breed_arr);
                            
                        
                        

            ?>
            
        
            <div class="column4">
            
                <div class="Dog-container">
                
                    <p class="doginfo">Type of Dog
                        <span><?php echo strtoupper($their_breed); ?></span>
                    </p>
                     <p class="doginfo">Problem
                        <span><?php echo strtoupper($their_sec_breed); ?></span>
                    </p>
                    
                    <div class="button-container">
                    
                        <button type="button">Contact This Person</button>
                    
                    </div>
                
                </div>
                
                <p class="timepost">POSTED <?php echo ago($first_match['date_added']);?> - <?php echo strtoupper($first_match['city']) . ', ' . $first_match['state']; ?></p>
                
            </div>
            
            
            <?php
                        unset($s_breed_arr); unset($f_breed_arr);
                }
                    }
                }

                    if (!isset($found_results)) {echo "Sorry, no results were found."; }
            ?>
            
        
        </div>
        
        <h1 id="half" class="main-titles"><strong>50% Matches</strong>  <span>(People with either the same dog or the same problem)</span></h1>
        
        <div class="row">
        
            <?php


                foreach ($secondbreed_arr as $first) {
                    
                    if (!isset($_POST['state'])) {
                        $additional_query = "AND state = '$first[state]' AND city = '$first[city]'";
                    } elseif ($_POST['ignore_location'] != '1') {
                        $additional_query = "AND state = '$_POST[state]' AND city = '$_POST[city]'";
                    }
                    
                    $query = "SELECT *, UNIX_TIMESTAMP(date_added) as date_added FROM firstbreed WHERE user_id != '$_SESSION[user_id]' AND breed = '$first[sec_breed]' $additional_query";
                    $first_match_arr = $db->fetch($query);
                    
                    if (count($first_match_arr) != '0') {
                        
                        $found_results2 = '1';
                        
                        foreach ($first_match_arr as $first_match) {
                            $query = "SELECT * FROM users WHERE id = '$want_match[user_id]' LIMIT 1";
                            $user_info = $db->fetch_row($query);
                            
                            $query = "SELECT breed FROM firstbreed WHERE user_id = '$user_info[id]'";
                            $their_breed_arr = $db->fetch($query);
                            
                            foreach ($their_breed_arr as $their_breed) {
                                $f_breed_arr[] = $their_breed['breed'];
                            }
                            
                            $their_breed = implode(", ", $f_breed_arr);
                            
                            $query = "SELECT sec_breed FROM secondbreed WHERE user_id = '$user_info[id]'";
                            $their_sec_breed_arr = $db->fetch($query);
                            
                            foreach ($their_sec_breed_arr as $their_sec_breed) {
                                $s_breed_arr[] = $their_sec_breed['sec_breed'];
                            }
                            
                            $their_sec_breed = implode(", ", $s_breed_arr);
                            
                        
                        

            ?>
            
        
            <div class="column4">
            
                <div class="Dog-container">
                
                    <p class="doginfo">Type of Dog
                        <span><?php echo strtoupper($their_breed); ?></span>
                    </p>
                     <p class="doginfo">Problem
                        <span><?php echo strtoupper($their_sec_breed); ?></span>
                    </p>
                    
                    <div class="button-container">
                    
                        <button type="button">Contact This Person</button>
                    
                    </div>
                
                </div>
                
                <p class="timepost">POSTED <?php echo ago($first_match['date_added']);?> - <?php echo strtoupper($first_match['city']) . ', ' . $first_match['state']; ?></p>
                
            </div>
            
            
            <?php
                        unset($s_breed_arr); unset($f_breed_arr);
                }
                    }
                }

                    if (!isset($found_results2)) {echo "Sorry, no results were found."; }
            ?>
        
        </div>
    
    </div>
    
</div>
    
</body>
</html>