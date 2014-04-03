<<!DOCTYPE html>
<html>
<head>
	<title>Contact Us</title>
	<script language="javascript" type="text/javascript"><!--
function cfRadioSelected(r){
for (i=0;i<r.length;i++) {
if (r[i].checked)return true;
}
return false;
}
function cfErrorOn(k,d,m,s,f,b){
var df=document.getElementById(d);
df.innerHTML=m;
df.style.display=b;
if(s)k.select();
if(f)k.focus();
}
function cfErrorOff(d){
var f=document.getElementById(d);
f.innerHTML='';
f.style.display='none';
}
function cfCheckForm(form){
var major = parseInt(navigator.appVersion);
var agent = navigator.userAgent.toLowerCase();
if (agent.indexOf('msie')!=-1){
major = parseFloat(agent.split('msie')[1]);
}
if (agent.indexOf('mozilla')==0 && major<=4){
// Internet Explorer 4 or Netscape 4 and earlier.
return true;
} else if (agent.indexOf('opera')!=-1){
// Opera doesn't seem to do regular expressions properly.
return true;
}
var ec=0;
cfErrorOff('cf_error_referrer');
cfErrorOff('cf_error_regarding');
if (!form.message.value.match(new RegExp('.+', 'g'))){
cfErrorOn(form.message,'cf_error_message','You must enter a message.',true,true,'inline');
ec++;
} else {
cfErrorOff('cf_error_message');
}
if (!form.subject.value.match(new RegExp('^(?:(?:[^\\n\\r])+)$', 'g'))){
cfErrorOn(form.subject,'cf_error_subject','You must enter a subject.',true,true,'inline');
ec++;
} else {
cfErrorOff('cf_error_subject');
}
if (!form.name.value.match(new RegExp('^(?:(?:[^\\n\\r])*)$', 'g'))){
cfErrorOn(form.name,'cf_error_name','You must enter your name.',true,true,'inline');
ec++;
} else {
cfErrorOff('cf_error_name');
}
if (!form.confirm.value.match(new RegExp('^$', 'g'))){
cfErrorOn(form.confirm,'cf_error_confirm','This field should be left blank.',false,true,'inline');
ec++;
} else {
cfErrorOff('cf_error_confirm');
}
if (!form.email.value.match(new RegExp('^(?:(?:(?:(?:[\\!\\#-\\\\\\\'\\*\\+\\-\\/-9\\=\\?A-Z\\^-\\~]+)|(?:[\\"](?:[^\\"]|(?:[\\][\\"]))*[\\"]))(?:[\\.](?:(?:[\\!\\#-\\\\\\\'\\*\\+\\-\\/-9\\=\\?A-Z\\^-\\~]+)|(?:[\\"](?:[^\\"]|(?:[\\][\\"]))*[\\"])))*)[\\@](?:(?:[0-9a-zA-Z](?:(?:[0-9a-zA-Z-])*[0-9a-zA-Z])?)(?:[\\.](?:[0-9a-zA-Z](?:(?:[0-9a-zA-Z-])*[0-9a-zA-Z])?))+))$', 'g'))){
cfErrorOn(form.email,'cf_error_email','The email address you entered does not appear to be valid.',true,true,'inline');
ec++;
} else {
cfErrorOff('cf_error_email');
}
cfErrorOff('cf_error_to');

if(ec>0){
cfErrorOn('','cf_global_error',(ec==1?'Please correct the error to continue.':'Please correct all errors to continue.'),false,false,'block');
scroll(0,0);return false;
} else {
cfErrorOff('cf_global_error');
return true;
}
}
//--></script>
</head>
<body>

<?php
include "header.php";
?>

<div class="row">

    <div class="col-sm-4 col-sm-offset-4">
        
	<body class="contactform cf_body" id="cf_body">
	<h1 class="contactform cf_header" id="cf_titleheader">Contact Us</h1><br />
	<div class="contactform cf_instructions" id="cf_instructions">Fill out the form below to send your comments.</div><div id="cf_global_error" style="display:none;" class="contactform cf_error"></div><form class="contactform" id="cf_form" action="/contact.pl" method=POST onSubmit="return cfCheckForm(this);"><br />
	<span id="cf_error_to" style="display:none;" class="contactform cf_error cf_fielderror"></span> <input type="hidden" name="to" value="Web Admin">
	<div class="contactform cf_field"><span class="contactform cf_required">*</span> <label class="contactform cf_fieldlabel" for="email">Your email address:</label> <span id="cf_error_email" style="display:none;" class="contactform cf_error cf_fielderror"></span><div class="contactform cf_userentry"><input id="email" class="contactform cf_textentry" type="text" name="email" value=""></div></div><br />
	<div class="contactform cf_field"><label class="contactform cf_fieldlabel" for="name">Your name:</label> <span id="cf_error_name" style="display:none;" class="contactform cf_error cf_fielderror"></span><div class="contactform cf_userentry"><input id="name" class="contactform cf_textentry" type="text" name="name" value=""></div></div><br />
	<div class="contactform cf_field"><span class="contactform cf_required">*</span> <label class="contactform cf_fieldlabel" for="subject">Subject:</label> <span id="cf_error_subject" style="display:none;" class="contactform cf_error cf_fielderror"></span><div class="contactform cf_userentry"><input id="subject" class="contactform cf_textentry" type="text" name="subject" value=""></div></div><br />
	<div class="contactform cf_field"><span id="cf_error_message" style="display:none;" class="contactform cf_error cf_fielderror"></span><div class="contactform cf_userentry"><textarea id="message" class="contactform cf_textentry" wrap="virtual" name="message"></textarea></div></div><br />
	<span id="cf_error_regarding" style="display:none;" class="contactform cf_error cf_fielderror"></span> <input type="hidden" name="regarding" value="">
	<span id="cf_error_referrer" style="display:none;" class="contactform cf_error cf_fielderror"></span> <input type="hidden" name="referrer" value="-">
	<input class="contactform" id="cf_submit" type="submit" name="do" value="Send">
	<p class="contactform" id="cf_requiredexplain"><span class="contactform cf_required">*</span> denotes a required field.</p>
</form>
    </div>
    
</div>

<?php
include "footer.php";
?>
</body>
</html>