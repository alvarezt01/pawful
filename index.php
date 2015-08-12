<?php

    require_once('include/db.inc.php');
    require_once('include/mysql_db.class.php');
    require_once('include/session.inc.php');

    if (isset($_POST['pure']))
    {
        if ($_POST['pure'] != '' && $_POST['second'] != '')
        {
            
            $character_cnt_pure = strlen($_POST['pure']);
            $character_cnt_second = strlen($_POST['second']);
            
            if ($character_cnt_pure > '2' && $character_cnt_second > '1') {
                
                $_SESSION['pure'] = $_POST['pure'];
                $_SESSION['second'] = $_POST['second'];
                
                header("Location: /page_redirect.php");
                
            }
            else {
                $error_msg = 'You need to enter more than three letters.';
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
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,700' rel='stylesheet' type='text/css'>
    
</head>
<body>
    
    <div class="container12">
        
        <?php include "nav.php"; ?>
        
        <h1 id="home">Need help? Find the answer to your bark.</h1>
        
        <form action="" method="POST">
        
            <?php if (isset($error_msg)) { ?>
                <div class="alert"><?php echo $error_msg; ?></div>
            <?php } ?>
            
            <div class="row">
            
                <div class="column5">
                    
                    <select name="pure" class="large-fld">
                        
                        <option value="Affenpi">Affenpinscher</option>
                        <option value="AireTer">Airedale Terrier</option>  
                        <option value="Akita">Akita</option> 
                        <option value="AlaskMa">Alaskan Malamute</option>
                        <option value="AmePitT">American Pit Bull Terrier</option>
                        <option value="AmeStaT">American Staffordshire Terrier</option>
                        <option value="BassHnd">Basset Hound</option>
                        <option value="Beagle">Beagle</option>
                        <option value="BernMtn">Bernese Mountain Dog</option>
                        <option value="BrdrCol">Border Collie</option>
                        <option value="Boxer">Boxer</option>
                        <option value="BullTer">Bull Terrier</option>
                        <option value="Bulldog">Bulldog</option>
                        <option value="BulMstf">Bullmastiff</option>
                        <option value="CaimTer">Caim Terrier</option>
                        <option value="CavKCSp">Cavalier King Charles Spaniel</option>
                        <option value="CheBRet">Chesapeake Bay Retriever</option>
                        <option value="Chihuah">Chihuahua</option>
                        <option value="ChowCho">Chow Chow</option>
                        <option value="CockSpa">Cocker Spaniel</option>
                        <option value="Dchshnd">Dachshund</option>
                        <option value="DbrPins">Doberman Pinscher</option>
                        <option value="EngCSpa">English Cocker Spaniel</option>
                        <option value="EngMstf">English Mastiff</option>
                        <option value="EngSSpa">English Springer Spaniel</option>
                        <option value="FCRet">Flat-Coated Retriever</option>
                        <option value="FrnBD">French Bulldog</option>
                        <option value="GerShep">German Shepherd</option>
                        <option value="GldnRet">Golden Retriever</option>
                        <option value="GrtDane">Great Dane</option>
                        <option value="GrfnBrx">Griffon Bruxellois</option>
                        <option value="JckRTer">Jack Russell Terrier</option>
                        <option value="LabrRet">labrador Retriever</option>
                        <option value="Malinoi">Malinois</option>
                        <option value="Maltese">Maltese</option>
                        <option value="Nwfndln">Newfoundland</option>
                        <option value="PemWCrg">Pembroke Welsh Corgi</option>
                        <option value="Pitbull">Pit bull</option>
                        <option value="Pointer">Pointer</option>
                        <option value="Pmrnian">Pomeranian</option>
                        <option value="Poodle">Poodle</option>
                        <option value="Pug">Pug</option>
                        <option value="Rtweilr">Rotweiler</option>
                        <option value="ScotTer">Scottish Terrier</option>
                        <option value="SharPei">Shar Pei</option>
                        <option value="ShetShp">Shetland Sheepdog</option>
                        <option value="ShihTzu">Shih Tzu</option>
                        <option value="SbrnHsk">Siberian Husky</option>
                        <option value="StfBTer">Staffordshire Bull Terrier</option>
                        <option value="TbtnSpa">Tibetan Spaniel</option>
                        <option value="YorkTer">Yorkshire Terrier</option>
                        
                    </select>
                
                </div>
                
                <div class="column5">
                    
                     <select name="second" class="large-fld">
                    
                        <option value="na">Purebreed</option>
                        <option value="Affenpi">Affenpinscher</option>
                        <option value="AireTer">Airedale Terrier</option>  
                        <option value="Akita">Akita</option> 
                        <option value="AlaskMa">Alaskan Malamute</option>
                        <option value="AmePitT">American Pit Bull Terrier</option>
                        <option value="AmeStaT">American Staffordshire Terrier</option>
                        <option value="BassHnd">Basset Hound</option>
                        <option value="Beagle">Beagle</option>
                        <option value="BernMtn">Bernese Mountain Dog</option>
                        <option value="BrdrCol">Border Collie</option>
                        <option value="Boxer">Boxer</option>
                        <option value="BullTer">Bull Terrier</option>
                        <option value="Bulldog">Bulldog</option>
                        <option value="BulMstf">Bullmastiff</option>
                        <option value="CaimTer">Caim Terrier</option>
                        <option value="CavKCSp">Cavalier King Charles Spaniel</option>
                        <option value="CheBRet">Chesapeake Bay Retriever</option>
                        <option value="Chihuah">Chihuahua</option>
                        <option value="ChowCho">Chow Chow</option>
                        <option value="CockSpa">Cocker Spaniel</option>
                        <option value="Dchshnd">Dachshund</option>
                        <option value="DbrPins">Doberman Pinscher</option>
                        <option value="EngCSpa">English Cocker Spaniel</option>
                        <option value="EngMstf">English Mastiff</option>
                        <option value="EngSSpa">English Springer Spaniel</option>
                        <option value="FCRet">Flat-Coated Retriever</option>
                        <option value="FrnBD">French Bulldog</option>
                        <option value="GerShep">German Shepherd</option>
                        <option value="GldnRet">Golden Retriever</option>
                        <option value="GrtDane">Great Dane</option>
                        <option value="GrfnBrx">Griffon Bruxellois</option>
                        <option value="JckRTer">Jack Russell Terrier</option>
                        <option value="LabrRet">labrador Retriever</option>
                        <option value="Malinoi">Malinois</option>
                        <option value="Maltese">Maltese</option>
                        <option value="Nwfndln">Newfoundland</option>
                        <option value="PemWCrg">Pembroke Welsh Corgi</option>
                        <option value="Pitbull">Pit bull</option>
                        <option value="Pointer">Pointer</option>
                        <option value="Pmrnian">Pomeranian</option>
                        <option value="Poodle">Poodle</option>
                        <option value="Pug">Pug</option>
                        <option value="Rtweilr">Rotweiler</option>
                        <option value="ScotTer">Scottish Terrier</option>
                        <option value="SharPei">Shar Pei</option>
                        <option value="ShetShp">Shetland Sheepdog</option>
                        <option value="ShihTzu">Shih Tzu</option>
                        <option value="SbrnHsk">Siberian Husky</option>
                        <option value="StfBTer">Staffordshire Bull Terrier</option>
                        <option value="TbtnSpa">Tibetan Spaniel</option>
                        <option value="YorkTer">Yorkshire Terrier</option>
                        
                    </select>
                
                </div>
                
                <div class="column2">
                    
                    <input type="submit" class="large-btn large-magnify" name="step1" value="Search">
                
                </div>
                
            </div>
        
        </form>
        
        <p id="home-info"><span>Notice</span>:    If dog is more than two types, use the two that are most present. <br> Don't see your breed?  <a href="Contact_url">Let us know</a>.</p>
        
    </div>
    
</body>
</html>