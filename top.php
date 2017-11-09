<?php
$phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");
// break the url up into an array, then pull out just the filename
$path_parts = pathinfo($phpSelf);

?>	
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>CS008 Final Project</title>
        <meta charset="utf-8">
        <meta name="author" content="Jennifer Nigro, Bennett Cazayoux, Ed Taylor">
        <meta name="description" content="Recipe and Custom Cake Ordering Website">
        <meta name="viewport" content="width=device-width, initial-scale=1">        
        <link href="https://fonts.googleapis.com/css?family=Croissant+One" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet"> 
        <link rel="stylesheet" href="../css/custom3.css" type="text/css" media="screen">
            
        <?php
        $debug = false;
        //
        // This if statement allows us in the classroom to see what our variables are
        // This is NEVER done on a live site
        if (isset($_GET["debug"])) {
            $debug = true;
        }
        
        //=========================================================================
        //
    //PATH SETUP
        //
    
    $domain = '//';
    
    $server = htmlentities($_SERVER['SERVER_NAME'], ENT_QUOTES, 'UTF-8');
    
    $domain .=$server;
    
    
    if ($debug) {
            //
            print '<p>php Self: ' . $phpSelf;
            print '<p>Path Parts<pre>';
            print_r($path_parts);
            print '</pre></p>';
        }
        
        //=========================================================================
        //
    // include all libraries.
    //
    // common mistake: not have the lib folder with these files.
    // google difference between require and include
    //
        print PHP_EOL . '<!-- include libraries -->' . PHP_EOL;
        
        require_once('lib/security.php');
    
        // notice this if statement only includes the functions if it is
        // form page. A common mistake is to make a form and call the page
        // join.php which means you need to change it below or deliete the if
        if ($path_parts['filename'] == "form") {
            print PHP_EOL . '<!-- include form libraries --!>' . PHP_EOL;
            include 'lib/validation-functions.php';
            include 'lib/mail-message.php';
        }    
    
    print PHP_EOL . '<!-- finished including libraries -->' . PHP_EOL;
        ?>

    </head>
    <!-- ######################     Start of Body   ############################ -->

    <?php
    print '<body id="' . $path_parts['filename'] . '">';

    include 'header.php';
    include 'nav.php';

    if ($debug) {
        print '<p>DEBUG MODE IS ON</p>';
    }
    ?>