<?php
/*
	---------------------------------------------------
	Coding done by  Version 1.0
	---------------------------------------------------
*/
require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;

function getEmailStatus($emailId = '')
{
	$url 	 	 = 'https://bpi.briteverify.com/emails.json?apikey=16254e3c-13ac-4eb1-9604-7f1c1fac90ad&address='.$emailId;
	
	
	try
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT ,3); 
		curl_setopt($curl, CURLOPT_TIMEOUT, 60);
		curl_setopt($curl, CURLOPT_HEADER, 0); 
		$json_response = curl_exec($curl);
		curl_close($curl);
	} catch (Exception $ex) {
		curl_close($curl);
	}
	
	return json_decode($json_response,true);
}

function saveAPILog($phone = '',$response = '')
{
	$con=mysqli_connect("localhost","whartonu_program","k4jTui1SKXmplndM","whartonu_programs") or die("cannot connect");
	$query=mysqli_query($con,"INSERT INTO api_log(phone,response,date) VALUES ('".$phone."','".$response."','".date('Y-m-d H:i:s')."')");
}

$salutation		=isset($_POST['salutation'])?trim($_POST['salutation']):'';
$firstname		=isset($_POST['first_name'])?trim($_POST['first_name']):'';
$lastname		=isset($_POST['last_name'])?trim($_POST['last_name']):'';
$company		=isset($_POST['company'])?trim($_POST['company']):'';;
$city			=isset($_POST['city'])?trim($_POST['city']):'';
$state			=isset($_POST['state'])?trim($_POST['state']):'';
$country		=isset($_POST['country'])?trim($_POST['country']):'';
$phone			=isset($_POST['mobile'])?trim($_POST['mobile']):'';
$email			=isset($_POST['email'])?trim($_POST['email']):'';
$workexp		=isset($_POST['workexp'])?trim($_POST['workexp']):'';
$attenddate		=isset($_POST['attenddate'])?trim($_POST['attenddate']):'';
$finance		=isset($_POST['finance'])?trim($_POST['finance']):'';
$designation	=isset($_POST['designation'])?trim($_POST['designation']):'';


$source			=isset($_POST['utm_source'])?trim($_POST['utm_source']):'';
$medium			=isset($_POST['utm_medium'])?trim($_POST['utm_medium']):'';
$term			=isset($_POST['utm_term'])?trim($_POST['utm_term']):'';
$content		=isset($_POST['utm_content'])?trim($_POST['utm_content']):'';
$campaign		=isset($_POST['utm_campaign'])?trim($_POST['utm_campaign']):'';
$matchtype		=isset($_POST['matchtype'])?trim($_POST['matchtype']):'';
$network		=isset($_POST['network'])?trim($_POST['network']):'';
$creative		=isset($_POST['creative'])?trim($_POST['creative']):'';
$keyword		=isset($_POST['keyword'])?trim($_POST['keyword']):'';
$placement		=isset($_POST['placement'])?trim($_POST['placement']):'';
$random			=isset($_POST['random'])?trim($_POST['random']):'';
$copy			=isset($_POST['copy'])?trim($_POST['copy']):'';
$adposition		=isset($_POST['adposition'])?trim($_POST['adposition']):'';
$url			=isset($_POST['url'])?trim($_POST['url']):'';

$MIT_Email_Consent			='';

$Phone_verified = '';
$email_verified = '';
$arr_email_status = array();

/*
$skip_verify =  (isset($_POST['skip_verify']) && $_POST['skip_verify'])?$_POST['skip_verify']:0;

if($_POST['otpcode'] == $_POST['hid_otpcode'])
{
	$Phone_verified = 'Verified';
}

if($skip_verify == 1)
{
	$Phone_verified = 'Skipped';
}
else if($skip_verify == 2)
{
	$Phone_verified = 'Error';
}
*/
if(!empty($email))
{
	$arr_email_status = getEmailStatus($email);
	saveAPILog('Email',json_encode($arr_email_status));
}

if(isset($arr_email_status['status']) && $arr_email_status['status'] == 'valid')
{
	$email_verified = 'YES';
}
else if(isset($arr_email_status['status']) && $arr_email_status['status'] == 'unknown')
{
	$email_verified = 'UN';
}
else if(isset($arr_email_status['status']) && $arr_email_status['status'] == 'accept_all')
{
	$email_verified = 'UN';
}
else{
	$email_verified = 'NO';
}



if(!empty($source))
{
	$cp_source = strtolower($source);
	if($cp_source=="advertisement")
		$lead_source="Advertisement";
	else if($cp_source=="facebook")
		$lead_source="Facebook";
	else if($cp_source=="linkedin")
		$lead_source="Linkedin";
	else if($cp_source=="web")
		$lead_source="Web";
	else if($cp_source=="eruditusemailer")
		$lead_source="Eruditus Emailer";
	else if($cp_source=="google")
		$lead_source="Google";
	else if($cp_source=="twitter")
		$lead_source="Twitter";
	else if($cp_source=="refereeprogramme")
		$lead_source="REFEREE-Programme";
	else if($cp_source=="headhonchos")
		$lead_source="HeadHonchos";
	else if($cp_source=="naukri")
		$lead_source="Naukri";
	else if($cp_source=="publicrelations")
		$lead_source="Public Relations";
	else if($cp_source=="externalreferral")
		$lead_source="External Referral";
	else if($cp_source=="Partner")
		$lead_source="Partner";
	else if($cp_source=="seminarinternal")
		$lead_source="Seminar - Internal";
	else if($cp_source=="seminarpartner")
		$lead_source="Seminar - Partner";
	else if($cp_source=="seminarpartner")
		$lead_source="Seminar - Partner";
	else if($cp_source=="tradeshow")
		$lead_source="Trade Show";
	else if($cp_source=="wordofmouth")
		$lead_source="Word of mouth";
	else if($cp_source=="Other")
		$lead_source="Other";
	else if($cp_source=="vccircle")
		$lead_source="VCCircle";
	else if($cp_source=="headhonchosdirect")
		$lead_source="Headhonchos Direct";
	else if($cp_source=="shineemailer")
		$lead_source="Shine.com Emailer";
	else if($cp_source=="yatraemailer")
		$lead_source="Yatra.com Emailer";
	else if($cp_source=="etemailer")
		$lead_source="ET.Com Emailer";
	else if($cp_source=="indiaclub")
		$lead_source="India Club";
	else if($cp_source=="gulftalent")
		$lead_source="Gulf Talent";
	else if($cp_source=="arabianbusiness")
		$lead_source="Arabian Business";
	else if($cp_source=="naukrigulf")
		$lead_source="NaukriGulf";
	else if($cp_source=="gulfnews")
		$lead_source="Gulf News";
	else if($cp_source=="fundoofinance")
		$lead_source="Fundoo-Finance";
	else if($cp_source=="fundoobfsi")
		$lead_source="Fundoo-BFSI";
	else if($cp_source=="indiainfoline")
		$lead_source="Indiainfoline";
	else if($cp_source=="moneycontrol")
		$lead_source="Money Control";
	else if($cp_source=="bayt")
		$lead_source="Bayt";
	else if($cp_source=="dic")
		$lead_source="DIC";
	else if($cp_source=="shiksha")
		$lead_source="Shiksha";
	else if($cp_source=="fundoohr")
		$lead_source="Fundoo-HR";
	else if($cp_source=="iimjobs")
		$lead_source="IIM Jobs";
	else if($cp_source=="fundoocio")
		$lead_source="Fundoo-CIO";
	else if($cp_source=="zawya")
		$lead_source="Zawya";
	else if($cp_source=="monster")
		$lead_source="Monster";
	else if($cp_source=="timesjobs")
		$lead_source="Times Jobs";
	else if($cp_source=="tunica labs")
		$lead_source="Tunica Labs";
	else if($cp_source=="google search")
		$lead_source="Google Search";
	else if($cp_source=="trade briefs")
		$lead_source="Trade Briefs";
	else if($cp_source=="proformics")
		$lead_source="Proformics";
	else if($cp_source=="adsizzlers")
		$lead_source="Adsizzlers";
	else if($cp_source=="opicle media")
		$lead_source="Opicle Media";

}



if(empty($lead_source))
	$lead_source = "Web";

$thankyoupage = "business-analytics-thankyou.html";
$lead_id 	  = '';
if(empty($firstname) || empty($lastname) || empty($country) || empty($workexp) ||  empty($phone) || empty($email) )
{
	header("Location: ../business-analytics-es.php");
	exit;
}
else
{
	
?>
<!DOCTYPE html>
<html>
<head>
<title>BUSINESS ANALYTICS: FROM DATA TO INSIGHTS</title>
</head>
<body>
<center>
	<img src="images/ajax-loader.gif" class="loading, please wait..."/>
</center>
<?php
$msg = '<table>';
$msg .= "<tr><td height='10' colspan='3'></td></tr>";
$msg .= "<tr><td height='2' colspan='3' bgcolor='#e5e5e5'></td></tr>";
$msg .= "<tr><td height='10' colspan='3'></td></tr>";
$msg .= "<tr><td bgcolor='#eaeaea' style='padding-left:3px;' colspan='3'><font face='helvetica' size='2' style='line-height:1.7' style='line-height:1.5' color='#000000'><b>Personal Information</b>:</font></b></td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Salutation</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $salutation </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>First Name</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $firstname </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Last Name</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $lastname </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Company</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $company </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Designation</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $designation </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>City</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $city </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Country</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $country </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Work Experience</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $workexp </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>When are you planning to attend program</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $attenddate </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>How will you be financing your program</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $finance </td></tr><br />";


$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Mobile Phone Number</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $phone </td></tr><br />";

/*$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Phone Status</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $Phone_verified </td></tr><br />";*/

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Email</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $email </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Email Status</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $email_verified </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Source</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $source </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Medium</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $medium </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Term</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $term </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Content</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $content </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Campaign</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $campaign </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Matchtype</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $matchtype </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Network</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $network </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Creative</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $creative </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Keyword</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $keyword </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Placement</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $placement </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Random</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $random </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Copy</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $copy </td></tr><br />";

$msg .= "<tr><td style='padding-left:5px;' width='200'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>Adposition</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'><b>:</b></font></td><td valign='top'><font face='helvetica' size='2' style='line-height:1.7' color='#000000'> $adposition </td></tr><br />";



$msg .= "</td></tr></table>";
$date=date('Y-m-d H:i:s');

$detect = new Mobile_Detect;
if($detect->isMobile() || $detect->isTablet())
{
	if(isset($campaign))
		$subject="BUSINESS ANALYTICS Query - [".$campaign."] [".$lead_source."] [".$country."] - M";
	else
		$subject="BUSINESS ANALYTICS Query - [".$lead_source."] [".$country."] - M";
}
else
{
	if(isset($campaign))
		$subject="BUSINESS ANALYTICS Query - [".$campaign."] [".$lead_source."] [".$country."]";
	else
		$subject="BUSINESS ANALYTICS Query - [".$lead_source."] [".$country."]";
}


$con=mysqli_connect("localhost","whartonu_program","k4jTui1SKXmplndM","whartonu_programs") or die("cannot connect");
$query=mysqli_query($con,"INSERT INTO  wharton_ba(vd_leadid, salutation,firstname,lastname,company,designation,city,country,phone,phone_status,email,email_status,workexp,attenddate,finance,subject,date,source,medium,term,content,campaign,matchtype,network,creative,keyword,placement,random,copy,adposition,url,email_consent) VALUES ('".$lead_id."','".$salutation."','".$firstname."','".$lastname."','".$company."','".$designation."','".$city."','".$country."','".$phone."','".$Phone_verified."','".$email."','".$email_verified."','".$workexp."','".$attenddate."','".$finance."','".$subject."','".$date."','".$source."','".$medium."','".$term."','".$content."','".$campaign."','".$matchtype."','".$network."','".$creative."','".$keyword."','".$placement."','".$random."','".$copy."','".$adposition."','".$url."','".$MIT_Email_Consent."')");

/*
$from="admissions@emeritus.org";
$mailheaders ="From: $email\nContent-Type: text/html; charset=iso-8859-1";
$to = "trilokchand.modi@gmail.com";
//$to = "cool.jigs@gmail.com";

mail($to,$subject, wordwrap($msg), $mailheaders);
*/

//$mailheaders1 ="From: $from\nContent-Type: text/html; charset=iso-8859-1";
//mail($email, "MIT EPGM Program - Thank You!", $msg1, $mailheaders1);

//header("Location: thankyou.html");
}
?>
<form class="form-horizontal mCustomScrollbar" role="form" id="frm" name="frm" action="http://www2.emeritus.org/l/134351/2018-04-11/3qrb7h" method="post">
<input type="hidden" name="retURL" value="https://execed-emeritus.wharton.upenn.edu/<?php echo $thankyoupage;?>">						
<input type="hidden" name="lead_source" value="<?php echo $lead_source;?>">	
<input type="hidden" id="first_name" name="first_name" value="<?php echo $firstname;?>">				
<input type="hidden" id="last_name" name="last_name" value="<?php echo $lastname;?>">		
<input type="hidden" id="email" name="email" value="<?php echo $email;?>">
<input type="hidden" id="mobile" name="mobile" value="<?php echo $phone;?>">
<input type="hidden" id="country" name="Country" value="<?php echo $country;?>">
<input type="hidden" id="work_experience" name="work_experience" value="<?php echo $workexp;?>">
<input type="hidden" id="utm_campaign" name="utm_campaign" value="<?php echo $campaign;?>">
<input type="hidden" id="utm_content" name="utm_content" value="<?php echo $content;?>">
<input type="hidden" id="utm_medium" name="utm_medium" value="<?php echo $medium;?>">
<input type="hidden" id="utm_source" name="utm_source" value="<?php echo $source;?>">
<input type="hidden" id="utm_term" name="utm_term" value="<?php echo $term;?>">
<input type="hidden" id="email_verified" name="Email_verified" value="<?php echo $email_verified;?>">
</form>
<script>
document.frm.submit();
</script>
</body>
</html>
