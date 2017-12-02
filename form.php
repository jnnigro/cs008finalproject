<?php 
include 'top.php';
//=============================================================================
//
// SECTION: 1 Initialize variables
//
// SECTION: 1a.
// We print out the post array so that we can see our form is working.
// if ($debug){ //late can uncomment
//print '<p>Post Array:</p><pre>';
//print_r($_POST);
//print '</pre>';
// }

//====================================
//
// SECTION: 1b Security
//
// define security variable to be used in SECTION 2a.

$thisURL = $domain . $phpSelf;


//=====================================
//
// SECTION 1c form variables
//
// Initialize variables one for each form element
// in the order they appear on the form

$name = "";

$email = "youremail@uvm.edu";

$phone = "";

$occasion = "";

$month = ""; //pick the option

$date = ""; //pick the option

$year = ""; //pick the option

$hour = ""; //pick the option

$minute = ""; //pick the option

$ampm = ""; //pick the option

$vanilla = false; //not checked
$chocolate = false;
$redvelvet = false;
$orange = false;
$lemon = false;

$buttercream = false;
$cremepat = false;
$ganache = false;
$freshfruit = false;
$jam = false;

$frosting = ""; //pick the option

$size = "";

$layers = "";

//====================================
//
// SECTION: 1d form error flags
//
// Initialize Error Flags one for each form element we validate
// in the order they appear in section 1c.
$nameERROR = false;

$emailERROR = false;

$phoneERROR = false;

$occasionERROR = false;

$monthERROR = false;

$dateERROR = false;

$yearERROR = false;

$hourERROR = false;

$minuteERROR = false;

$ampmERROR = false;

$spongeERROR = false;
$totalSpongeChecked = 0;

$fillingERROR = false;
$totalFillingChecked = 0;

$frostingERROR = false;

$sizeERROR = false;

$layersERROR = false;

//====================================
//
// SECTION: 1e misc variables
//
// create array to hold error messages filled (if any) in 2d desplayed in 3c.
$errorMsg = array();

// array used to hold form values that will be written to a CSV file
$dataRecord = array();

// have we mailed the information to the user?
$mailed=false;

//=============================================================================
//
// SECTION: 2 Process for when the form is submitted
//
if (isset($_POST["btnSubmit"])) {

//====================================
//
//Section: 2a Security
//
if (!securityCheck($thisURL)) {
    $msg = '<p>Sorry you cannot access this page. ';
    $msg.= 'Security breach detected and reported.</p>';
    die($msg);
}


//=====================================
//
// SECTION: 2b Sanitize (clean) data
// remove any potential JavaScript or html code from users on the
// form. Note it is best to follow the same order as declared in section 1c.
$name = htmlentities($_POST["txtName"], ENT_QUOTES, "UTF-8");
$dataRecord[] = $name;

$email = filter_var($_POST["txtEmail"], FILTER_SANITIZE_EMAIL);
$dataRecord[] = $email;

$phone = htmlentities($_POST['telPhone'], ENT_QUOTES, "UTF-8");
$dataRecord[] = $phone;

$occasion = filter_var($_POST["txtOccasion"], FILTER_SANITIZE_EMAIL);
$dataRecord[] = $occasion;

$month = htmlentities($_POST["lstMonth"],ENT_QUOTES,"UTF-8");
$dataRecord[] = $month;

$date = htmlentities($_POST["lstDate"],ENT_QUOTES,"UTF-8");
$dataRecord[] = $date;

$year = htmlentities($_POST["lstYear"],ENT_QUOTES,"UTF-8");
$dataRecord[] = $year;

$hour = htmlentities($_POST["lstHour"],ENT_QUOTES,"UTF-8");
$dataRecord[] = $hour;

$minute = htmlentities($_POST["lstMinute"],ENT_QUOTES,"UTF-8");
$dataRecord[] = $minute;

$ampm = htmlentities($_POST["lstAMPM"],ENT_QUOTES,"UTF-8");
$dataRecord[] = $ampm;

//note: if a check box is not checked it is not sent in the POST array.
if (isset($_POST["chkVanilla"])) {
    $vanilla = true;
    $totalChecked++;
} else {
    $vanilla = false;
}
$dataRecord[] = $vanilla;

if (isset($_POST["chkChocolate"])) {
    $chocolate = true;
    $totalChecked++;
} else {
    $chocolate = false;
}
$dataRecord[] = $chocolate;

if (isset($_POST["chkRedVelvet"])) {
    $redvelvet = true;
    $totalChecked++;
} else {
    $redvelvet = false;
}
$dataRecord[] = $redvelvet;

if (isset($_POST["chkOrange"])) {
    $orange = true;
    $totalChecked++;
} else {
    $orange = false;
}
$dataRecord[] = $orange;

if (isset($_POST["chkLemon"])) {
    $lemon = true;
    $totalChecked++;
} else {
    $lemon = false;
}
$dataRecord[] = $lemon;

if (isset($_POST["chkButtercream"])) {
    $buttercream = true;
    $totalChecked++;
} else {
    $buttercream = false;
}
$dataRecord[] = $buttercream;

if (isset($_POST["chkCremePat"])) {
    $cremepat = true;
    $totalChecked++;
} else {
    $cremepat = false;
}
$dataRecord[] = $cremepat;

if (isset($_POST["chkGanache"])) {
    $ganache = true;
    $totalChecked++;
} else {
    $ganache = false;
}
$dataRecord[] = $ganache;

if (isset($_POST["chkFreshFruit"])) {
    $freshfruit = true;
    $totalChecked++;
} else {
    $freshfruit = false;
}
$dataRecord[] = $freshfruit;

if (isset($_POST["chkJam"])) {
    $jam = true;
    $totalChecked++;
} else {
    $jam = false;
}
$dataRecord[] = $jam;

$frosting = htmlentities($_POST["lstFrosting"],ENT_QUOTES,"UTF-8");
$dataRecord[] = $frosting;

$size = htmlentities($_POST['radSize'], ENT_QUOTES, "UTF-8");
$dataRecord[] = $size;

$layers = htmlentities($_POST['radLayers'], ENT_QUOTES, "UTF-8");
$dataRecord[] = $layers;

//====================================
//
// SECTION: 2c Validation
//
// Validation section. Check each value for possible errors, empty or
// not what we expect. You will need an IF block for each element you will
// check (see above section 1c and 1d). The if blocks should also be in the
// order that the elements appear on your form so that the error messages
// will be in the order they appear. errorMsg will be displayed on the form. see section 3b. The error flag ($emailERROR) will be used in section 3c.
if ($name == "") {
    $errorMsg[] = "Name is required";
    $nameERROR = true;
} elseif (!verifyAlphaNum($name)) {
    $errorMsg[] = "Your first name appears to have an extra character.";
    $nameERROR = true;
}

if ($email =="") {
    $errorMsg[] = 'Email is required';
    $emailERROR = true;
} elseif (!verifyEmail($email)) {
    $errorMsg[] = 'Your email address appears to be incorrect.';
    $emailERROR = true;
}

if ($phone == "") {
    $errorMsg[] = "Phone Number is required";
    $phoneERROR = true;
} elseif (!verifyAlphaNum($phone)) {
    $errorMsg[] = "Your telephone number appears to have an extra character.";
    $phoneERROR = true;
}

if ($occasion = "") {
    $errorMsg[] = "Occasion is required";
    $occasionERROR = true;
} elseif (!verifyAlphaNum($occasion)) {
    $errorMsg[] = "Your occasion description appears to have extra characters that are not allowed.";
    $occasionERROR = true;
    }

// listbox: none if you set a default value. here just checking if they picked one.
// could check to see if method is == to one of the ones you have, similar to radio buttons
if($month == ""){
    $errorMsg[] = "Please choose a month.";
    $monthERROR = $true;
}

if($date == ""){
    $errorMsg[] = "Please choose a date.";
    $dateERROR = $true;
}

if($year == ""){
    $errorMsg[] = "Please choose a year.";
    $yearERROR = $true;
}

if($hour == ""){
    $errorMsg[] = "Please choose an hour.";
    $hourERROR = $true;
}

if($minute == ""){
    $errorMsg[] = "Please choose a minute.";
    $minuteERROR = $true;
}

if($ampm == ""){
    $errorMsg[] = "Please choose AM or PM.";
    $ampmERROR = $true;
}

if($totalChecked <1) {
    $errorMsg[] = "Please choose at least one flavor of sponge.";
    $spongeERROR = true;
}

if($totalChecked <1) {
    $errorMsg[] = "Please choose at least one type of filling.";
    $fillingERROR = true;
}

if($frosting == ""){
    $errorMsg[] = "Please choose a frosting.";
    $frostingERROR = $true;
}

if($size != "6inround" AND $size != "8inround" AND $size != "9inround" AND $size != "11x13inrectangle" AND $size != "1/2sheet") {
    $errorMsg[] = "Please choose a size.";
    $sizeERROR = true;
}

if($layers != "1" AND $layers != "2" AND $layers != "3" AND $layers != "4") {
    $errorMsg[] = "Please choose your desired number of layers.";
    $layersERROR = true;
}

//=================================
//
// SECTION: 2d Process Form - Passed Validation
//
// Process for when the form passes validation (the errorMsg array is empty)
//
if (!$errorMsg) {
    if ($debug)
        print PHP_EOL . '<p>Form is valid</p>';


//==================================
//
// SECTION: 2e Save Data
//
// This block saves the data to a CSV file.
$myFolder = '../data/';

$myFileName = 'customorder';

$fileExt = '.csv';

$filename = $myFolder . $myFileName . $fileExt;
if ($debug) print PHP_EOL . '<p>filename is ' . $filename;

// now we just open the file for append
$file = fopen($filename, 'a');

// write the forms informations
fputcsv($file, $dataRecord);

// close the file
fclose($file);


//==================================
//
// SECTION: 2f Create message
//
// build a message to display on the screen in section 3a and to mail
// to the person filling out the form (section 2g).
$message = '<h2>Your Custom Cake Order</h2>';

foreach ($_POST as $htmlName => $value) {

    $message .= "<p>";
    // breaks up the form names into words. for example
    // txtFirstName becomes First Name
    $camelCase = preg_split('/(?=[A-Z])/', substr($htmlName, 3));

    foreach ($camelCase as $oneWord) {
        $message .= $oneWord . ' ';
    }    

    $message .= ' = ' . htmlentities($value, ENT_QUOTES, "UTF-8") . '</p>';

}

//===================================
//
// SECTION: 2g Mail to user
//
// Process for mailing a message which contains the forms data
// the message was built in section 2f.
$to = $email; // the person who filled out the form
$cc = '';
$bcc = '';

$from = 'CS008 Final Project <jnnigro@uvm.edu>';

// subject of mail should make sense to your form
$subject = 'Your Custom Cake Order';

$mailed = sendMail($to, $cc, $bcc, $from, $subject, $message);


}   // ends if form is valid

}   // ends if form was submitted.

//=============================================================================
//
// SECTION 3 Display Form
//
?>

<article id="main">

    <?php
    //==============================
    //
    // SECTION 3a.
    //
    // If it's the first time coming to the form or there are errors we are going
    // to display the form.
    if (isset($_POST["btnSubmit"]) AND empty($errorMsg)) { // closing off if marked with: end body submit
        print '<h2>Thank you for your order!</h2>';
    
        print '<p>For your records a copy of this data has ';
  
        if (!$mailed) {
            print "not ";
        }    
        print 'been sent:</p>';
        print '<p>To: ' . $email . '</p>';
    
        print $message;
    } else {
   
        print '<h2>Custom Cake Orders</h2>';
        print '<p class="form-description">Having an event or celebration? Leave the cake to us! Let us know what you want and we&#8217;ll do the rest. We will work with you at every step to ensure your cake is to your satisfaction.</p>';
    //
    //====================================
    //
    // SECTION 3b Error Messages
    //
    // display any error messages before we print out the form
    
    if (errorMsg) {
        print '<div id="errors">' . PHP_EOL;
        print '<ol>' . PHP_EOL;
    
        foreach ($errorMsg as $err) {
            print '<li>' . $err . '</li>' . PHP_EOL;
        }    
    
        print '</ol>' . PHP_EOL;
        print '</div>' . PHP_EOL;
    }
    
    //=============================
    //
    // SECTION 3c html Form
    //
    /* Display the HTML form. note that the action is to this same page. $phpSelf
     * is defined in top.php
     * NOTE the line:
     * value="<?php print $email; ?>
     * this makes the form sticky by displaying either the initial default value (line ??)
     * or the value they typed in (line ??)
     * NOTE this line:
     * <?php if($emailERROR) print 'class="mistake"'; ?>
     * this prints out a css class so that we can highlight the background etc. to
     * make it stand out that a mistake happened here.
     */
    ?>
    <img class="cake-collage" src="images/cake-collage.jpg" alt="collage of our cakes">
    <p><span class="mistake">* required field.</span></p>
    <form action="<?php print $phpSelf; ?>"
          id="frmRegister"
          method="post">

        <fieldset class="basic-info">
            <legend></legend>
            <p>
                <label class="required-text-field" for="txtName">Name:</label>
                <input <?php if ($nameERROR) print 'class="mistake"'; ?>
                       id="txtName"
                       maxlength="100"
                       name="txtName"
                       onfocus="this.select()"
                       placeholder="Enter your name"
                       tabindex="100"
                       type="text"
                       value="<?php print $name; ?>"
                >       
            </p>
            
            <p>
                <label class="required-text-field" for="txtEmail">Email:</label>
                <input
                    <?php if ($emailERROR) print 'class="mistake"'; ?>
                    id="txtEmail"
                    maxlength="100"
                    name="txtEmail"
                    onfocus="this.select()"
                    placeholder="Enter a valid email address"
                    tabindex="120"
                    type="email"
                    value=""
                    >
            </p>
            
            <p>
                <label class="required-text-field" for="telPhone">Phone:</label>
                <input
                    <?php if ($phoneERROR) print 'class="mistake"'; ?>
                    id="telPhone"
                    maxlength="100"
                    name="telPhone"
                    onfocus="this.select()"
                    placeholder="Enter your telephone number"
                    tabindex="140"
                    type="tel"
                    value=""
                    >
            </p>
            
            <p>
                <label class="required-text-field" for="txtOccasion">Occasion:</label>
                <input <?php if ($occasionERROR) print 'class="mistake"'; ?>
                       id="txtOccasion"
                       maxlength="100"
                       name="txtOccasion"
                       onfocus="this.select()"
                       placeholder="Enter your occasion"
                       tabindex="160"
                       type="text"
                       value="<?php print $occasion; ?>"
                >       
            </p>
        </fieldset>
        <fieldset class="occasion-date">
            <legend class="listbox <?php if ($monthERROR || $dateERROR || $yearERROR) print ' mistake'; ?>"></legend>
            <label  class="required-text-field">Date of Occasion:</label>
            <select id="month"
                    name="month"
                    tabindex="180" >
                <option <?php if($month=="month") print " selected "; ?> value="month">Month</option>
                <option <?php if($month=="january") print " selected "; ?> value="january">January</option>
                <option <?php if($month=="february") print " selected "; ?> value="february">February</option>
                <option <?php if($month=="march") print " selected "; ?> value="march">March</option>
                <option <?php if($month=="april") print " selected "; ?> value="april">April</option>
                <option <?php if($month=="may") print " selected "; ?> value="may">May</option>
                <option <?php if($month=="june") print " selected "; ?> value="june">June</option>
                <option <?php if($month=="july") print " selected "; ?> value="july">July</option>
                <option <?php if($month=="august") print " selected "; ?> value="august">August</option>
                <option <?php if($month=="september") print " selected "; ?> value="september">September</option>
                <option <?php if($month=="october") print " selected "; ?> value="october">October</option>
                <option <?php if($month=="november") print " selected "; ?> value="november">November</option>
                <option <?php if($month=="december") print " selected "; ?> value="december">December</option>
            </select>
            <select id="date"
                    name="date"
                    tabindex="190" >
                <option <?php if($date=="date") print " selected "; ?> value="date">Date</option>
                <option <?php if($date=="1") print " selected "; ?> value="1">1</option>
                <option <?php if($date=="2") print " selected "; ?> value="2">2</option>
                <option <?php if($date=="3") print " selected "; ?> value="3">3</option>
                <option <?php if($date=="4") print " selected "; ?> value="4">4</option>
                <option <?php if($date=="5") print " selected "; ?> value="5">5</option>
                <option <?php if($date=="6") print " selected "; ?> value="6">6</option>
                <option <?php if($date=="7") print " selected "; ?> value="7">7</option>
                <option <?php if($date=="8") print " selected "; ?> value="8">8</option>
                <option <?php if($date=="9") print " selected "; ?> value="9">9</option>
                <option <?php if($date=="10") print " selected "; ?> value="10">10</option>
                <option <?php if($date=="11") print " selected "; ?> value="11">11</option>
                <option <?php if($date=="12") print " selected "; ?> value="12">12</option>
                <option <?php if($date=="13") print " selected "; ?> value="13">13</option>
                <option <?php if($date=="14") print " selected "; ?> value="14">14</option>
                <option <?php if($date=="15") print " selected "; ?> value="15">15</option>
                <option <?php if($date=="16") print " selected "; ?> value="16">16</option>
                <option <?php if($date=="17") print " selected "; ?> value="17">17</option>
                <option <?php if($date=="18") print " selected "; ?> value="18">18</option>
                <option <?php if($date=="19") print " selected "; ?> value="19">19</option>
                <option <?php if($date=="20") print " selected "; ?> value="20">20</option>
                <option <?php if($date=="21") print " selected "; ?> value="21">21</option>
                <option <?php if($date=="22") print " selected "; ?> value="22">22</option>
                <option <?php if($date=="23") print " selected "; ?> value="23">23</option>
                <option <?php if($date=="24") print " selected "; ?> value="24">24</option>
                <option <?php if($date=="25") print " selected "; ?> value="25">25</option>
                <option <?php if($date=="26") print " selected "; ?> value="26">26</option>
                <option <?php if($date=="27") print " selected "; ?> value="27">27</option>
                <option <?php if($date=="28") print " selected "; ?> value="28">28</option>
                <option <?php if($date=="29") print " selected "; ?> value="29">29</option>
                <option <?php if($date=="30") print " selected "; ?> value="30">30</option>
                <option <?php if($date=="31") print " selected "; ?> value="31">31</option>
            </select>
            <select id="year"
                    name="year"
                    tabindex="200" >
                <option <?php if($year=="year") print " selected "; ?> value="year">Year</option>
                <option <?php if($year=="2017") print " selected "; ?> value="2017">2017</option>
                <option <?php if($year=="2018") print " selected "; ?> value="2018">2018</option>
            </select>
        </fieldset>
        <fieldset class="delivery-time">
            <legend class="listbox <?php if ($hourERROR || $minuteERROR || $ampmERROR) print ' mistake'; ?>"></legend>
            <label  class="required-text-field">Time of Delivery:</label>
            <select id="hour"
                    name="hour"
                    tabindex="220" >
                <option <?php if($hour=="hour") print " selected "; ?> value="hour">Hour</option>
                <option <?php if($hour=="1") print " selected "; ?> value="1">1</option>
                <option <?php if($hour=="2") print " selected "; ?> value="2">2</option>
                <option <?php if($hour=="3") print " selected "; ?> value="3">3</option>
                <option <?php if($hour=="4") print " selected "; ?> value="4">4</option>
                <option <?php if($hour=="5") print " selected "; ?> value="5">5</option>
                <option <?php if($hour=="6") print " selected "; ?> value="6">6</option>
                <option <?php if($hour=="7") print " selected "; ?> value="7">7</option>
                <option <?php if($hour=="8") print " selected "; ?> value="8">8</option>
                <option <?php if($hour=="9") print " selected "; ?> value="9">9</option>
                <option <?php if($hour=="10") print " selected "; ?> value="10">10</option>
                <option <?php if($hour=="11") print " selected "; ?> value="11">11</option>
                <option <?php if($hour=="12") print " selected "; ?> value="12">12</option>
            </select>
            <select id="minute"
                    name="minute"
                    tabindex="230" >
                <option <?php if($minute=="minute") print " selected "; ?> value="minute">Minute</option>
                <option <?php if($minute=="00") print " selected "; ?> value="00">00</option>
                <option <?php if($minute=="05") print " selected "; ?> value="05">05</option>
                <option <?php if($minute=="10") print " selected "; ?> value="10">10</option>
                <option <?php if($minute=="15") print " selected "; ?> value="15">15</option>
                <option <?php if($minute=="20") print " selected "; ?> value="20">20</option>
                <option <?php if($minute=="25") print " selected "; ?> value="25">25</option>
                <option <?php if($minute=="30") print " selected "; ?> value="30">30</option>
                <option <?php if($minute=="35") print " selected "; ?> value="35">35</option>
                <option <?php if($minute=="40") print " selected "; ?> value="40">40</option>
                <option <?php if($minute=="45") print " selected "; ?> value="45">45</option>
                <option <?php if($minute=="50") print " selected "; ?> value="50">50</option>
                <option <?php if($minute=="55") print " selected "; ?> value="55">55</option>
            </select>
            <select id="AMPM"
                    name="AM"
                    tabindex="240" >    
                <option <?php if($ampm=="AM") print " selected "; ?> value="AM">AM</option>
                <option <?php if($ampm=="PM") print " selected "; ?> value="PM">PM</option>
            </select>
        </fieldset>
        <fieldset class="sponge">
            <legend class ="checkbox <?php if ($spongeERROR) print ' mistake'; ?>">Sponge:</legend>
            <p>
                <label class="check-field">
                    <input <?php if ($vanilla) print " checked "; ?>
                        id="chkVanilla"
                        name="chkVanilla"
                        tabindex="260"
                        type="checkbox"
                        value="Vanilla"> Vanilla</label>
            </p>
            
            <p>
                <label class="check-field">
                    <input <?php if ($chocolate) print " checked "; ?>
                        id="chkChocolate"
                        name="chkChocolate"
                        tabindex="270"
                        type="checkbox"
                        value="Chocolate"> Chocolate</label>
            </p>
            
            <p>
                <label class="check-field">
                    <input <?php if ($redvelvet) print " checked "; ?>
                        id="chkRedVelvet"
                        name="chkRedVelvet"
                        tabindex="280"
                        type="checkbox"
                        value="RedVelvet"> Red Velvet</label>
            </p>
            
            <p>
                <label class="check-field">
                    <input <?php if ($orange) print " checked "; ?>
                        id="chkOrange"
                        name="chkOrange"
                        tabindex="290"
                        type="checkbox"
                        value="Orange"> Orange</label>
            </p>
            
            <p>
                <label class="check-field">
                    <input <?php if ($lemon) print " checked "; ?>
                        id="chkLemon"
                        name="chkLemon"
                        tabindex="300"
                        type="checkbox"
                        value="Lemon"> Lemon</label>
            </p>
        </fieldset>
        
        <fieldset class="filling">
            <legend class ="checkbox <?php if ($fillingERROR) print ' mistake'; ?>">Filling:</legend>
            <p>
                <label class="check-field">
                    <input <?php if ($buttercream) print " checked "; ?>
                        id="chkButtercream"
                        name="chkButtercream"
                        tabindex="320"
                        type="checkbox"
                        value="Buttercream"> Buttercream</label>
            </p>
            
            <p>
                <label class="check-field">
                    <input <?php if ($cremepat) print " checked "; ?>
                        id="chkCremePat"
                        name="chkCremePat"
                        tabindex="330"
                        type="checkbox"
                        value="CremePat"> Crème Pâtissière</label>
            </p>
            
            <p>
                <label class="check-field">
                    <input <?php if ($ganache) print " checked "; ?>
                        id="Ganache"
                        name="chkGanache"
                        tabindex="340"
                        type="checkbox"
                        value="Ganache"> Ganache</label>
            </p>
            
            <p>
                <label class="check-field">
                    <input <?php if ($freshfruit) print " checked "; ?>
                        id="chkFreshFruit"
                        name="chkFreshFruit"
                        tabindex="350"
                        type="checkbox"
                        value="FreshFruit"> Fresh Fruit</label>
            </p>
            
            <p>
                <label class="check-field">
                    <input <?php if ($jam) print " checked "; ?>
                        id="chkJam"
                        name="chkJam"
                        tabindex="360"
                        type="checkbox"
                        value="Jam"> Jam</label>
            </p>
        </fieldset>
        <fieldset class="frosting">
            <legend class="listbox <?php if ($frostingERROR) print ' mistake'; ?>"></legend>
            <label  class="required-text-field">Frosting:</label>
            <select id="frosting"
                    name="frosting"
                    tabindex="380" >
                <option <?php if($frosting=="select") print " selected "; ?> value="select">Select</option>
                <option <?php if($frosting=="buttercream") print " selected "; ?> value="buttercream">Buttercream</option>
                <option <?php if($frosting=="ganache") print " selected "; ?> value="ganache">Ganache</option>
                <option <?php if($frosting=="mirror") print " selected "; ?> value="mirror">Mirror Glaze</option>
            </select>
        </fieldset>
        <fieldset class="size">
            <legend class="radio <?php if ($sizeERROR) print ' mistake'; ?>">Size:</legend>
            <p>
                <label class="radio-field">
                    <input type="radio"
                           id="rad6round"
                           name="radSize"
                           value="6inround"
                           tabindex="400"
                           <?php if ($size == "6inround") echo ' checked="checked" '; ?>>
                    6in. round
                </label>
            </p>
            
            <p>
                <label class="radio-field">
                    <input type="radio"
                           id="rad8round"
                           name="radSize"
                           value="8inround"
                           tabindex="410"
                           <?php if ($size == "8inround") echo ' checked="checked" '; ?>>
                    8in. round
                </label>
            </p>
            
            <p>
                <label class="radio-field">
                    <input type="radio"
                           id="rad9round"
                           name="radSize"
                           value="9inround"
                           tabindex="420"
                           <?php if ($size == "9inround") echo ' checked="checked" '; ?>>
                    9in. round
                </label>
            </p>
            
            <p>
                <label class="radio-field">
                    <input type="radio"
                           id="rad11x13rectangle"
                           name="radSize"
                           value="11x13inrectangle"
                           tabindex="430"
                           <?php if ($size == "11x13inrectangle") echo ' checked="checked" '; ?>>
                    11x13in. rectangle
                </label>
            </p>
            
            <p>
                <label class="radio-field">
                    <input type="radio"
                           id="rad12sheet"
                           name="radSize"
                           value="1/2sheet"
                           tabindex="440"
                           <?php if ($size == "1/2sheet") echo ' checked="checked" '; ?>>
                    1/2 sheet
                </label>
            </p>
        </fieldset>
        
        <fieldset class="layers">
            <legend class="radio <?php if ($layersERROR) print ' mistake'; ?>">Layers:</legend>
            <p>
                <label class="radio-field">
                    <input type="radio"
                           id="rad1"
                           name="radLayers"
                           value="1"
                           tabindex="460"
                           <?php if ($layers == "1") echo ' checked="checked" '; ?>>
                    1
                </label>
            </p>
            
            <p>
                <label class="radio-field">
                    <input type="radio"
                           id="rad2"
                           name="radLayers"
                           value="2"
                           tabindex="460"
                           <?php if ($layers == "2") echo ' checked="checked" '; ?>>
                    2
                </label>
            </p>
            
            <p>
                <label class="radio-field">
                    <input type="radio"
                           id="rad3"
                           name="radLayers"
                           value="3"
                           tabindex="460"
                           <?php if ($layers == "3") echo ' checked="checked" '; ?>>
                    3
                </label>
            </p> 
            
            <p>
                <label class="radio-field">
                    <input type="radio"
                           id="rad4"
                           name="radLayers"
                           value="4"
                           tabindex="460"
                           <?php if ($layers == "4") echo ' checked="checked" '; ?>>
                    4
                </label>
            </p>
        </fieldset>
        
        <fieldset class="buttons">
            <legend></legend>
            <input class="button" id="btnSubmit" name="btnSubmit" tabindex="480" type="submit" value="Submit" >
        </fieldset>
    </form>

<?php
    } //end body submit
?>

</article>

<?php include 'footer.php'; ?>
