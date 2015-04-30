var frmvalidator  = new Validator("contactus");
frmvalidator.EnableOnPageErrorDisplay();
frmvalidator.EnableMsgsTogether();
frmvalidator.addValidation("name","req","Please provide your name");

frmvalidator.addValidation("email","req","Please provide your email address");

frmvalidator.addValidation("email","email","Please provide a valid email address");

frmvalidator.addValidation("message","maxlen=2048","The message is too long!(more than 2KB!)");

frmvalidator.addValidation("scaptcha","req","Please enter the code in the image above");

document.forms['contactus'].scaptcha.validator = new FG_CaptchaValidator(document.forms['contactus'].scaptcha, document.images['scaptcha_img']);

function SCaptcha_Validate() {
    return document.forms['contactus'].scaptcha.validator.validate();
}

frmvalidator.setAddnlValidationFunction("SCaptcha_Validate");

function refresh_captcha_img() {
    var img = document.images['scaptcha_img'];
    img.src = img.src.substring(0,img.src.lastIndexOf("?")) + "?rand="+Math.random()*1000;
}