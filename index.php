<?PHP
require_once("./includes/fgcontactform.php");
require_once("./includes/captcha-creator.php");

$formproc = new FGContactForm();
$captcha = new FGCaptchaCreator('scaptcha');

$formproc->EnableCaptcha($captcha);

//1. Add your email address here.
//You can add more than one receipients.
$formproc->AddRecipient('info@tathva.org'); //<<---Put your email address here
//2. For better security. Get a random tring from this link: http://tinyurl.com/randstr
// and put it here
$formproc->SetFormRandomKey('n91LqHNvMrpoXte');


if(isset($_POST['submitted'])) {
   if($formproc->ProcessForm()) {
        $formproc->RedirectToURL("index.php?email=1#contact");
   }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Krishipurra</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile Specific Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <!-- FONT -->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
  <link href='http://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet' type='text/css'>

  <!-- CSS -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/custom.css">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="">

</head>
<body>
  <!-- Navigation Bar -->
  <nav class="navbar" style="position:absolute">
    <div class="container">
      <ul class="navbar-list">
        <li class="navbar-item"><a class="navbar-link" href="http://www.niravu.com" target="_blank">NIRAVU</a></li>
      </ul>
      <ul class="navbar-list" style="float:right">
        <li class="navbar-item"><a class="navbar-link" href="#contact">CONTACT US</a></li>
      </ul>
    </div>
  </nav>

  <div id="main-section" class="shadow">
    <div class="main-header">Krishipurra</div>
  </div>

  <div id="intro-section" class="shadow">
    <div class="container"><p>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
  </div>

  <div id="search-section">
    <div id="morphsearch" class="morphsearch" style="margin-left: auto;margin-right: auto">
      <form class="morphsearch-form" id="searchForm">
        <input class="morphsearch-input" type="search" placeholder="Start typing..." id="searchInput"/>
        <input class="morphsearch-submit" type="submit" id="searchSubmit" value="Search"/>
        <div class="twelve columns">
          <div class="button three columns advanced_trig" id="advanced_trigger">Advanced Options</div>
        </div>
        <div id="advanced" class="advanced">
          <div id="primary_cat" class="three columns" style="margin-left:0;margin-top:10px"></div>
          <div id="secondary_cat" class="three columns" style="margin-left:10px;margin-top:10px"></div>
        </div>
      </form>
      <div class="morphsearch-content" style="height:50%;width:100%">
        <div id="search_results" class="twelve columns" ></div>
      </div>
      <span class="morphsearch-close"></span>
    </div>
    <div class="overlay"></div>
  </div>

  <div id="primary-section" class="shadow">
    <div class="container" style="overflow:auto">
      <div class="grid">
          <div id="primary"></div>
        </div>
    </div>
  </div>

  <div id="contact" class="" style="">
    <form id='contactus' action='<?php echo $formproc->GetSelfScript(); ?>' method='post' accept-charset='UTF-8' class="six columns">
      <fieldset>
        <?php if(isset($_GET['email'])) {
            if($_GET['email'] == 1) {
              echo '<h5>Email Sent Successfully. Thank you.</h5>';
            }
          } ?>
        <h3 class="section-heading">Contact us</h3>
        <input type='hidden' name='submitted' id='submitted' value='1'/>
        <input type='hidden' name='<?php echo $formproc->GetFormIDInputName(); ?>' value='<?php echo $formproc->GetFormIDInputValue(); ?>'/>
        <input type='text'  class='spmhidip' name='<?php echo $formproc->GetSpamTrapInputName(); ?>' />


        <div><span class='error'><?php echo $formproc->GetErrorMessage(); ?></span></div>
        <div class='container'>
            <input type='text' name='name' placeholder="Enter your name here" id='name' value='<?php echo $formproc->SafeDisplay('name') ?>' maxlength="50" /><br/>
            <span id='contactus_name_errorloc' class='error'></span>
        </div>
        <div class='container'>
            <input type='text' name='email' placeholder="Enter your email address here" id='email' value='<?php echo $formproc->SafeDisplay('email') ?>' maxlength="50" /><br/>
            <span id='contactus_email_errorloc' class='error'></span>
        </div>
        <div class='container'>
            <span id='contactus_message_errorloc' class='error'></span>
            <textarea rows="10" cols="50" placeholder="Enter your message here" name='message' id='message'><?php echo $formproc->SafeDisplay('message') ?></textarea>
        </div>
        <div class='container'>
            <div><img alt='Captcha image' src='show-captcha.php?rand=1' id='scaptcha_img' /></div>
            <div class='short_explanation'>Can't read the image?
            <a href='javascript: refresh_captcha_img();'>Click here to refresh</a></div>
            <input type='text' placeholder="Enter the code shown above" name='scaptcha' id='scaptcha' maxlength="10" /><br/>
            <span id='contactus_scaptcha_errorloc' class='error'></span>
            
        </div>
        <div class='container'>
            <input type='submit' name='Submit' value='Submit' />
        </div>
      </fieldset>
    </form>
    <div class="six columns" style="text-align:left" id="address">
      <div class="ten columns">
        <h3>Address</h3>
        <p>Niravu vengeri E-19,</p> 
        <p>Vengeri (P.O.), Calicut-673010,  </p>
        <p>Kerala, India.</p>
        <p>+91 9447 276177</p>
        <p>info@niravu.com</p> 
      </div>
    </div>
  </div>

  <div id="footer-section"></div>
  

  <script type="text/javascript" src="scripts/jquery.js"></script>
  <script type="text/javascript" src="scripts/main.js"></script>
  <script type="text/javascript" src="scripts/classie.js"></script>
  <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
  <script type='text/javascript' src='scripts/fg_captcha_validator.js'></script>
  <script type='text/javascript' src="scripts/validate.js"></script>

</body>
</html>
