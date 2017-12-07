<?php

include 'top.php';





//============Security

$thisURL = $domain . $phpSelf;

//==========Form Variables

$recipe = "";

//=======Form Error Flags

$recipeERROR = false;

//======Misc Variables
// create array to hold error messages filled (if any) in 2d desplayed in 3c.
$errorMsg = array();
// array used to hold form values that will be written to a CSV file
$dataRecord = array();
// have we mailed the information to the user?
$mailed=false;

if(isset($_POST["btnSubmit"])){
    if (!securityCheck($thisURL)) {
    $msg = '<p>Sorry you cannot access this page. ';
    $msg.= 'Security breach detected and reported.</p>';
    die($msg);
    }
    
    //Sanitize data
    $recipe = htmlentities($_POST["txtRecipe"], ENT_QUOTES, "UTF-8");
    $dataRecord = $recipe;
    
    //Validate data
    if($recipe!= ""){
        if(!verifyAlphaNum($recipe)){
            $errorMsg[]="There appear to be errors in your comment.";
            $recipeERROR = TRUE;                 
        }
    }
    //Passed Validation
    if (!$errorMsg) {
        if ($debug){
            print PHP_EOL . '<p>Form is valid</p>';
        }
        //==================================
        //
        // SECTION: 2e Save Data
        //
        // This block saves the data to a CSV file.
        $myFolder = '../data/';
        $myFileName = 'recipe-suggestion';
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
        $to = 'james.cazayoux@uvm.edu'; // the person who filled out the form
        $cc = '';
        $bcc = '';
        $from = 'CS008 Final Project <jnnigro@uvm.edu>';
        // subject of mail should make sense to your form
        $subject = 'Your Custom Cake Order';
        $mailed = sendMail($to, $cc, $bcc, $from, $subject, $message);
    }    
}
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
}
?>

<p class="mission-statement">Welcome to our food blog! We seek to give you great recipes for whatever meal you'd like at whatever time of day!</p>
<section class="wrapper">
    <section class="featured-recipes">
        <h2>Featured Recipes</h2>
        <img class='image-smoothie-bowl' src="images/smoothie-bowl.JPG" alt="">
        <p class="smoothie-bowl">Smoothie Bowl</p>
        <img src="images/cinnamon-rolls.jpg" alt="">
        <p class="cinnamon-rolls">Cinnamon Rolls</p>
        <img src="images/blackened-chicken-salad.JPG" alt="">
        <p class="blackened-chicken">Blackened Chicken Salad</p>
        <img src="images/thai-shrimp.jpg" alt="">
        <p class="thai-shrimp">Thai Shrimp</p>
        <img src="images/vegan-chai.jpg" alt="">
        <p class="vegan-chai">Vegan Chai</p>
        <img src="images/rainbow-pops.jpg" alt="">
        <p class="rainbow-pops">Rainbow Pops</p>
    </section>
    <aside>
        <section class="the-team">
            <h5>Meet the Team</h5>
            <section class="jennifer">
                <img src="images/jennifer.jpg">
                <p>Jennifer is currently a Junior Psychology major at UVM.
                    She has written numerous articles for Spoon University, and 
                    also got one of her recipes published in Blue Apron. Her culinary
                    passions are the most diverse on the team. She also likes working 
                    with pre-schoolers.</p>
            </section>
            <section class="edward">
                <img src="images/edward.jpg">
                <p>Edward is currently a Junior Business major at UVM. He is also an
                    RA on the athletic campus and loves to read.</p>
            </section>
            <section class="bennett">
                <img src="images/bennett.jpg">
                <p>Bennett is currently a Junior Data Science major at UVM. He has 
                    experience working in restaurants, specifically working with pizza and
                    burritos.</p>
            </section>
        </section>
        <section class="cake-order">
            <div class="flexslider">
                <ul class="slides">
                    <li>
                        <img src="images/chocolate-cake.jpg" alt="" >
                    </li>
                    <li>
                        <img src="images/lemon-clementine-cake.jpg" alt="" >
                    </li>
                    <li>
                        <img src="images/beer-cake.JPG" alt="" >
                    </li>
                    <li>
                        <img src="images/darius-cake.jpg" alt="" >
                    </li>
                    <li>
                        <img src="images/bride-cake.jpg" alt="" >
                    </li>
                    <li>
                        <img src="images/ganache-cake.jpg" alt="" >
                    </li>
                    <li>
                        <img src="images/walaa-cake.PNG" alt="" >              
                    </li>
                    <li>
                        <img src="images/swear-cake.JPG" alt="" >
                    </li>
                </ul>
            </div>
            <p>Got an upcoming event and you like what you see? Follow <a href="form.php">this link</a> 
            to put in a custom cake offer, and we will have it ready on the date and time you specifiy</p>
        </section>
        <section class="leave-a-comment">
            <p>Got a recipe you'd like us to make? We'd love to hear it! Make sure to leave a comment and we'll get right on it!</p>
            <form action="<?php print $phpSelf; ?>"
                  id="frmRecipe"
                  method="post">
                <fieldset>
                    <legend></legend>
                    <p>
                        <label class="recipe-suggestion" for="txtRecipe"></label>
                        <textarea <?php if($recipeERROR) print 'class="mistake"';?>
                            id="txtRecipe"
                            maxlength="150"
                            name="txtRecipe"
                            onfocus="this.select()"
                            placeholder="suggestion"
                            tabindex="100"
                            value ='<?php print $recipe; ?>'></textarea>
                    </p>
                </fieldset>
                <fieldset class="buttons">
                    <legend></legend>
                    <input class="button" id="btnSubmit" name="btnSubmit" type="submit" value="Submit" >
                </fieldset>
            </form>
                
        </section>
    </aside>                     
</section>




<?php
include 'footer.php';
?>
