<!DOCTYPE html>
<html>
<head>
	<title>Business Analytics: From Data to Insights</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="https://execed-emeritus.wharton.upenn.edu/favicon.ico" type="image/x-icon">
	<link rel="icon" href="https://execed-emeritus.wharton.upenn.edu/favicon.ico" type="image/x-icon">
	<meta name="description" content="Wharton’s Business Analytics: From Data to Insights Program: Learn how analytics can help improve the decision-making process."/>
	<link rel="stylesheet" type="text/css" href="https://execed-emeritus.wharton.upenn.edu/business-analytics/css/style_new.css?v=0.0.5">
	<link rel="stylesheet" type="text/css" href="https://execed-emeritus.wharton.upenn.edu/business-analytics/css/responsive_new.css?v=0.0.5">
	<link rel="stylesheet" type="text/css" href="https://execed-emeritus.wharton.upenn.edu/business-analytics/css/bootstrap.css">
	<!--<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700" rel="stylesheet">-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://execed-emeritus.wharton.upenn.edu/business-analytics/css/slick.css"/>
	<link rel="stylesheet" type="text/css" href="https://execed-emeritus.wharton.upenn.edu/business-analytics/css/slick-theme.css"/>
	<link rel="stylesheet" href="https://emeritus.org/programmes/common/gdpr.css">
	<script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="18cbc6a5-e442-42ee-b072-932c605536f9" type="text/javascript" async></script>

<!-- Tracking Code start-->
		<!-- Tracking Code start-->
<!--Google tracking code new starts-->
		<style>.async-hide { opacity: 0 !important} </style>
        <script>(function(a,s,y,n,c,h,i,d,e){s.className+=' '+y;h.start=1*new Date;
        h.end=i=function(){s.className=s.className.replace(RegExp(' ?'+y),'')};
        (a[n]=a[n]||[]).hide=h;setTimeout(function(){i();h.end=null},c);h.timeout=c;
        })(window,document.documentElement,'async-hide','dataLayer',4000,
        {'GTM-PZHRQJ3':true});</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-71668354-1', 'auto', {'allowLinker': true});
		ga('require', 'linker');
		ga('linker:autoLink', ['www2.emeritus.org','www.emeritus.org','emeritus.gsb.columbia.edu','eim.mit.edu'] );
		ga('set', 'anonymizeIp', true);
        ga('require', 'GTM-PZHRQJ3');
		ga('send', 'pageview');
</script>

<!--Google tracking code ends-->


<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NX2MRZJ');</script>
<!-- End Google Tag Manager -->
	<script>
		function trackEvent(event, category, action, label) {
            ga('send', 'event', category, action, label);
            console.log('GA==' + event + '==' + category + '==' + action + '==' + label);
        }  
		
		function populateOTP()
		{
			$('#resendBtn').html('Resend');
			$('#otpcode_section').fadeIn(1000);
			$('#hid_otpcode').val('');
			$('#skip_verify').val('0');
		}

		function generateOTPValue()
		{
			$('#hid_otpcode').val('');
			$('#skip_verify').val('0');
			$('#skip-verify').hide();
			$('#otpText').html('');
			
			$('#otpcode_section').show();
			$.post("sendOtp.php",$( "input[name=\'mobile\']" ).closest("form").serialize(), function (data) {				
				if (data.msg == "success") { 
					//alert(data.error);
					$('#otpText').html(data.error);
					$("#hid_otpcode").val(data.code);
					$("#hid_phoneno").val(data.phone);
					
					$('#resendBtn').html('Resend');
					generateOTP = 1;
					setTimeout(function(){ $('#skip-verify').show(); }, 10000);
				}
				else
				{
					$('#skip_verify').val('2');
					$('#otpcode_section').fadeOut(1000);
					$("#hid_phoneno").val(data.phone);
					$('#resendBtn').html('Resend');
					//alert(data.error);
					return false;
				}
			}, "json");
		}

		function skipVerify()
		{
			$('#otpcode_section').fadeOut(1000);
			$('#otpcode').attr('disabled','disabled');
			$('#skip_verify').val('1');
		}
		
		
		$(document).ready(function (){
			var is_otp_required = "0";
			var submitted = false;
			$("#frm").validate({ 
				rules: {
					first_name: {
						required: true,
						specialChar:true
					},
					last_name: {
						required: true,
						specialChar:true
					},
					country:{
						required: true,
						notEqual: "-1"
					},
					city: {
						required: true,
						specialChar:true
					},
					workexp: {
						required: true,
					},
					email:{
						required: true,
						email:true,
						customemail:true
					},
					mobile: {
						required: true,
						digits: true,
						rangelength:  function(element){
										if($("#country").val()=='India'){
											return [10, 10];
										}
										else{
											return [5, 20];
										}
									},			
					}/*,
					terms:{
						required: true,
					}*/
				}, 
				messages: {
					salutation: {
						required: "Please provide salutation"
					},
					first_name: {
						required: "Please provide your first name",
						specialChar:"Please provide only alphanumeric values",
					},
					last_name: {
						required: "Please provide your last name",
						specialChar:"Please provide only alphanumeric values",
					},
					company:{
						required: "Please provide company name",
						specialChar:"Please provide only alphanumeric values",
					},
					country:{
						required: "Please provide country name",
						notEqual: "Please provide country name",
					},
					state:{
						required: "Please provide state name",
					},
					city:{
						required: "Please provide city name",
						specialChar:"Please provide only alphanumeric values",
					},
					workexp: {
						required: "Please provide work exp",
					},
					email:{
						required: "Please provide your email",
						email: "Please provide valid email",
						customemail: "Please provide valid email",
					},
					code: {
						required: "Please provide country code",
						digits: "Please provide only digits (0 - 9) in country code",
						rangelength: "Please provide valid country code",			
					},
					mobile: {
						required: "Please provide your phone no",
						digits: "Please provide only digits (0 - 9) in phone no",
						rangelength: "Please provide valid phone no",		
					},
					otpcode: {
						required: "Please provide OTP Code / enter your phone no to generate new OTP code",
						equalTo: "Please provide valid OTP / enter your phone no to to generate new OTP code"
					},
					terms:{
						required: 'Please accept terms & condition',
					}				
				},
				/*showErrors: function(errorMap, errorList) {
					if (submitted) {
						var summary = "You have the following errors: \n";
						$.each(errorList, function() { summary += " * " + this.message + "\n"; });
						alert(summary);
						submitted = false;
					}
					this.defaultShowErrors();
				},          
				invalidHandler: function(form, validator) {
					submitted = true;
				},*/
				 errorPlacement: function(error, element){
					if(element.attr("name") == 'otpcode')
					{
						$('#otpText').html('');
						error.appendTo( element.parent().siblings('.error-text') );
					}
					else
					{
						error.appendTo( element.siblings(".error-text") );;
					}
				},
				submitHandler: function(form){
					//$('#frm')[0].submit(); // 
					trackEvent('click','BA LP','FormSubmit','Form_Submit')
					
					var btn = $('input[type="submit"]');
					btn.val("Processing...");
					btn.attr("disabled",true);
					form.submit();
					
				}
            });
											
			//custom validation rule
			$.validator.addMethod("customemail", 
				function(value, element) {
					if ($.trim(value) != ""){
						var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
					return pattern.test(value);
					}     
					else
					{
						return true;
					}
				}, 
				"Please provide valid email format"
			);
			
			jQuery.validator.addMethod("specialChar", function(value, element) {
				 return this.optional(element) || /([0-9a-zA-Z\s])$/.test(value);
			  }, "Please Fill Correct Value in Field.");

			jQuery.validator.addMethod("notEqual", function(value, element, param) {
			  return this.optional(element) || value != param;
			},"Please select valid country");

		});

		
		</script>
</head>
<body>
	<div class="wrapper">
		<div class="container-fluid" id="header">
			<div class="container">
				<header class="header">
					<div class="row">
					  <div class="col-sm-6">
						 <a href="https://execed-emeritus.wharton.upenn.edu/" target="_blank" onclick="trackEvent('click','BA LP','Reload','Partner Logo')"><img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/logo.png" alt="wharton" title="wharton" class="img-responsive"> </a>
					  </div>
					  <div class="col-sm-6 certificte text-right">
								<h1>ONLINE CERTIFICATE PROGRAM</h1>
					  </div>
					</div>
				</header>
			</div>	
		</div>
		<div class="banner"> 
			<div class="banner-bg">
				<div class="container df">
					<div class="col-md-7 no_pad">
						<div class="banner-content p-l-7">
							<h1>BUSINESS ANALYTICS:</h1>
							<h2>FROM DATA TO INSIGHTS</h2>
						</div>
					</div>
					<div id="2" class="col-md-5 form-div no_pad">
							<form class="form-horizontal contact-form" role="form" id="frm" name="frm" method="POST" action="https://execed-emeritus.wharton.upenn.edu/business-analytics/submit.php">
								<h2>&nbsp;&nbsp;GET PROGRAM INFO</h2>
								<div id="fields">
									<?php
									if(strtolower(trim($_GET['utm_source'])) == 'linkedin')
									{
										?>
										
										<div class="row">
											<div class="col-xs-12">
												<div class="form-group">
													<label class="control-label col-xs-4 col-sm-3 col-md-4"></label>
													<div class="col-xs-8 col-sm-9 col-md-8">
														<script src="https://www.linkedin.com/autofill/js/autofill.js" type="text/javascript" async></script><script type="IN/Form2" data-form="frm" data-field-firstname="first_name" data-field-lastname="last_name" data-field-phone="mobile" data-field-email="email" data-field-country="country"></script>
													</div>
												</div>
											</div>
										</div>
										<?php
									}								
									?>
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-3 col-md-4">First Name*</label>
										<div class="col-xs-8 col-sm-9 col-md-8">
											<input type="text" class="text" id="first_name" placeholder="" name="first_name">
											<span class="error-text"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-3 col-md-4">Last Name*</label>
										<div class="col-xs-8 col-sm-9 col-md-8">
											<input type="text" class="text" id="last_name" placeholder="" name="last_name">
											<span class="error-text"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-3 col-md-4">Email*</label>
										<div class="col-xs-8 col-sm-9 col-md-8">
											<input type="email" class="text" id="email" placeholder="" name="email">
											<span class="error-text"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-3 col-md-4">Mobile No.*</label>
										<div class="col-xs-8 col-sm-9 col-md-8">
											<input type="text" class="text" id="mobile" placeholder="" name="mobile">
											<span class="error-text"></span>
											<span class="small"><!--(e.g.: 9988776623)--></span>
										</div>
										
									</div>
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-3 col-md-4">Work Experience*</label>
										<div class="col-xs-8 col-sm-9 col-md-8">
											<select  id="workexp" name="workexp" title="Work Experience" class="select">
												<option value=""></option>
												<option value="Less than 5 Years">Less than 5 Years</option>
												<option value="5-10 Years">5-10 Years</option>
												<option value="10-15 Years">10-15 Years</option>
												<option value="15-20 Years">15-20 Years</option>
												<option value="&gt; 20 Years">> 20 Years</option>
											</select>
											<span class="error-text"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-xs-4 col-sm-3 col-md-4">Country*</label>
										<div class="col-xs-8 col-sm-9 col-md-8">
											<select type="text" id="country" name="country" class="select">
											</select>
											<span class="error-text"></span>
										</div>
									</div>
									<!-- <div class="form-group small pd-checkbox">
											<label class="control-label col-xs-4 col-sm-3 col-md-4"></label>
											<div class="col-xs-8 col-sm-9 col-md-8">
												<span class="value"><span><input type="checkbox" name="terms" id="terms" value="I allow MIT Sloan to send me email updates on Executive Education Programs"><label class="inline" for="terms" >I allow MIT Sloan to send me email updates on Executive Education Programs</label>
												</span></span>
											</div>
									</div> -->
									<div class="form-group" id="gdpr-consent" style="display:none;"> 
										
										<div class="col-sm-12">
											<label class="checkbox-inline">
											  <input type="checkbox" value="I would like to receive email & other communications from EMERITUS & its university partners about this course and other relevant courses." name="agree" id="agree">I would like to receive email & other communications from EMERITUS & its university partners about this course and other relevant courses.
											</label>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-12">
											<input type="submit" class="btn btn-default download-btn" value="DOWNLOAD BROCHURE >"/>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-12">
											<p><small>Your details will not be shared with third parties.</small>
											<strong><small><a href="//emeritus.org/privacy-policy/" target="_blank">Privacy Policy</a></small></strong>
											</p>
										</div>
									</div>
									<input type="hidden" name="skip_verify" id="skip_verify" value="0">
									<input type="hidden" name="utm_source" value="<?php echo $_GET['utm_source'];?>">
									<input type="hidden" name="utm_medium" value="<?php echo $_GET['utm_medium'];?>">
									<input type="hidden" name="utm_term" value="<?php echo $_GET['utm_term'];?>">
									<input type="hidden" name="utm_content" value="<?php echo $_GET['utm_content'];?>">
									<input type="hidden" name="utm_campaign" value="<?php echo $_GET['utm_campaign'];?>">
									<input type="hidden" name="matchtype" value="<?php echo $_GET['matchtype'];?>">
									<input type="hidden" name="network" value="<?php echo $_GET['network'];?>">
									<input type="hidden" name="creative" value="<?php echo $_GET['creative'];?>">
									<input type="hidden" name="keyword" value="<?php echo $_GET['keyword'];?>">
									<input type="hidden" name="placement" value="<?php echo $_GET['placement'];?>">
									<input type="hidden" name="random" value="<?php echo $_GET['random'];?>">
									<input type="hidden" name="copy" value="<?php echo $_GET['copy'];?>">
									<input type="hidden" name="adposition" value="<?php echo $_GET['adposition'];?>">
									<input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI'];?>">
								</div>
							</form>
					</div>
				</div>
			</div>
		</div>
		<div class="container info-row">
			<div class="col-md-4 col-sm-4 no_pad">
				<div class="info-box clearfix">
					<div class="img-holder">
						<img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/start.png" alt="Starts on" title="Starts on">
					</div>
					<div class="img-content">
						<h3>Starts on</h3>
						<p>July 19, 2018</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 no_pad">
				<div class="info-box clearfix">
					<div class="img-holder">
						<img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/duration.png" alt="Duration" title="Duration">
					</div>
					<div class="img-content">
						<h3>Duration</h3>
						<p> 3 months, online<br/> 
						<span class="f18">6–8 hours per week</span>
						</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 no_pad">
				<div class="info-box clearfix">
					<div class="img-holder">
						<img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/fee.png" alt="Program Fees" title="Program Fees">
					</div>
					<div class="img-content">
						<h3>program fees</h3>
						<p>$2,450</p>
						<!--<h6 class="info">
							<a href="javascript:void(0)" onclick="trackEvent('click','CBSVI LP','Pop Up','Price-Flexi')" data-toggle="modal" data-target="#myModal"> <img src="business-analytics/images/info_icon.png" alt="info" title="info" class="">&nbsp;<i class="bm">Avail Flexible Payment</i></a>
						</h6>-->
					</div>
				</div>
			</div>
		</div>
		
		<div class="container padtop">
				<h1 class="heading">Why Study Business Analytics?</h1>
				<p class="text-center intro-text">
					Wharton's three-month online program — <i class="intro">Business Analytics: From Data to Insights </i>— arms managers and leaders with the tools needed to break away from the pack. Take the opportunity to turn data into a competitive advantage.
				</p>
				<div class="row counter-row">
						<div class="col-md-4 col-sm-4">
							<div class="abt-content bb-a">
								<h3>2X</h3>
								<p>The amount of data doubles every three years as various digital sources continue to make information available</p>
								<p class="source">SOURCE: MCKINSEY & COMPANY</p>
								</div>
						</div>
						<div class="col-md-4 col-sm-4 b-r-f-1">
							<div class="abt-content bb-a">
								<h3>1.5 Million</h3>
								<p>A significant shortage of managers and analysts who can effectively use analytical concepts to make decisions is predicted for 2018
								</p>
									<p class="source">SOURCE: MCKINSEY & COMPANY</p>
								</div>
							</div>
						<div class="col-md-4 col-sm-4">
								<div class="abt-content">
									<h3>75%</h3>
									<p>Three-quarters of companies are missing the skills and technology to make the best use of the data they collect</p>
									<p class="source">SOURCE: PWC</p>
								</div>
							</div>
				</div> 
					<div class="marb92 mb92">
						<a href="#2" onclick="trackEvent('click','BA LP','ScrollUp','Download Brochure')"><button class="btn btn-default download-btn"> DOWNLOAD BROCHURE</button></a>
					</div>
				</div>
			
		<!--  <div class="video-wrapper youtubevideo">
				<div class="aspect-ratio">
					<img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/placeholder_video.jpg"/ class="img-responsive">
				</div>
			</div> -->
			
				<div class="bg_grey">
					<div class="content-wrapper">
						<h1 class="heading">Your Learning Experience</h1>
						<div class="row icon-row display_desktop">
							<img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/3_01.png" alt="Your Learning Experience" title="Your Learning Experience"class="img-responsive"/>
						</div>
						<div class="row icon-row">
							<div class="col20 box hidden-xs">
								
							</div>
							<div class="col20 box">
								<img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/3_06.png" alt="Live Teaching Sessions by Wharton Faculty" title="Live Teaching Sessions by Wharton Faculty">
								<h4>
									4 Live Teaching Sessions by Wharton Faculty
								</h4>
							</div>
							
							<div class="col20 box">
								<img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/simulation.png" alt="Data Analytics Simulation" title="Data Analytics Simulation">
								<h4>
									1 Data Analytics Simulation
								</h4>
							</div>
							<div class="col20 box hidden-xs">
								
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="syllabus">
									<ul>
										<li><span class="ul-head">Orientation Module:</span> Orientation and Introduction to Business Analytics
										</li>
										<li><span class="ul-head">Module 1:</span> Descriptive Analytics: Gathering Insights
										</li>
										<li><span class="ul-head">Module 2:</span> Descriptive Analytics: Describing and Forecasting Future Events</li>
										<li><span class="ul-head">Module 3:</span> Predictive Analytics: Making Predictions Using Data</li>
										<li><span class="ul-head">Module 4:</span> Predictive and Prescriptive Analytics: Application and Toolkit</li>
										<li><span class="ul-head">Module 5:</span> Predictive Analytics: Tools for Decision Making</li>
									</ul>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 your-learning-mt">
								<div class="syllabus">
									<ul>
										<li><span class="ul-head">Module 6:</span> Predictive Analytics: Using Data to Predict Employee Performance</li>
										<li><span class="ul-head">Module 7:</span> Prescriptive Analytics: Providing Recommendations to Change Behavior</li>
										<li><span class="ul-head">Module 8:</span> Prescriptive Analytics: Determining the Most Favorable  Outcomes</li>
										<li><span class="ul-head">Module 9:</span> Application of Analytics for Business</li>
									</ul>
								</div>
							</div>
							<div class="col-sm-12 border">
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 text-left subcontent">
								<span class="ul-head">Methods and Tools: </span>
							</div>
							<div class="col-md-6 col-sm-6 secont-section">
								<div class="syllabus">
										<ul>
											<li>
												<ul>
													<li><span class="ul-head-title">Data Collection Methods</span>
															 <table width="100%" border="0" cellspacing="0" align="center" cellpadding="0">
																	<tbody>
																		<tr>
																			<td class="li_style" width="5%" valign="top">
																				<table width="100%" valign="top" border="0" cellspacing="0" cellpadding="0">
																					<tbody valign="top">
																						<tr>
																							<td width="100%" valign="top" align="left"> <img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/bullet.png"> </td>
																						</tr>
																					</tbody>
																				</table>
																			</td>
																			<td width="98%" valign="top">
																				<table width="100%" valign="top" border="0" cellspacing="0" cellpadding="0">
																					<tbody>
																						<tr>
																							<td class="li_style">Descriptive Data Collection: Surveys, Net Promoter Score (NPS), and Self-Reports</td>
																						</tr>
																					</tbody>
																				</table>
																			</td>
																		</tr>
																	</tbody>
																</table>
															 <table width="100%" border="0" cellspacing="0" align="center" cellpadding="0">
																	<tbody>
																		<tr>
																			<td class="li_style" width="5%" valign="top">
																				<table width="100%" valign="top" border="0" cellspacing="0" cellpadding="0">
																					<tbody valign="top">
																						<tr>
																							<td width="100%" valign="top" align="left"> <img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/bullet.png"> </td>
																						</tr>
																					</tbody>
																				</table>
																			</td>
																			<td width="98%" valign="top">
																				<table width="100%" valign="top" border="0" cellspacing="0" cellpadding="0">
																					<tbody>
																						<tr>
																							<td class="li_style"> Passive Data Collection </td>
																						</tr>
																					</tbody>
																				</table>
																			</td>
																		</tr>
																	</tbody>
																</table>
															 <table width="100%" border="0" cellspacing="0" align="center" cellpadding="0">
																	<tbody>
																		<tr>
																			<td class="li_style" width="5%" valign="top">
																				<table width="100%" valign="top" border="0" cellspacing="0" cellpadding="0">
																					<tbody valign="top">
																						<tr>
																							<td width="100%" valign="top" align="left"> <img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/bullet.png"> </td>
																						</tr>
																					</tbody>
																				</table>
																			</td>
																			<td width="98%" valign="top">
																				<table width="100%" valign="top" border="0" cellspacing="0" cellpadding="0">
																					<tbody>
																						<tr>
																							<td class="li_style"> Media Data Collection: Radio, Television, Mobile, etc.</td>
																						</tr>
																					</tbody>
																				</table>
																			</td>
																		</tr>
																	</tbody>
																</table>
													</li>
													<li><span class="ul-head-title">A/B Testing</span> </li>
													<li><span class="ul-head-title">Correlation and Causation </span> </li>
													<li><span class="ul-head-title">Forecasting</span>	
														<table width="100%" border="0" cellspacing="0" align="center" cellpadding="0">
																	<tbody>
																		<tr>
																			<td class="li_style" width="5%" valign="top">
																				<table width="100%" valign="top" border="0" cellspacing="0" cellpadding="0">
																					<tbody valign="top">
																						<tr>
																							<td width="100%" valign="top" align="left"> <img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/bullet.png"> </td>
																						</tr>
																					</tbody>
																				</table>
																			</td>
																			<td width="98%" valign="top">
																				<table width="100%" valign="top" border="0" cellspacing="0" cellpadding="0">
																					<tbody>
																						<tr>
																							<td class="li_style"> Objective and Subjective </td>
																						</tr>
																					</tbody>
																				</table>
																			</td>
																		</tr>
																	</tbody>
																</table>
														<table width="100%" border="0" cellspacing="0" align="center" cellpadding="0">
																	<tbody>
																		<tr>
																			<td class="li_style" width="5%" valign="top">
																				<table width="100%" valign="top" border="0" cellspacing="0" cellpadding="0">
																					<tbody valign="top">
																						<tr>
																							<td width="100%" valign="top" align="left"> <img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/bullet.png"> </td>
																						</tr>
																					</tbody>
																				</table>
																			</td>
																			<td width="98%" valign="top">
																				<table width="100%" valign="top" border="0" cellspacing="0" cellpadding="0">
																					<tbody>
																						<tr>
																							<td class="li_style"> Strand or Seasonal Variation </td>
																						</tr>
																					</tbody>
																				</table>
																			</td>
																		</tr>
																	</tbody>
																</table>
														<table width="100%" border="0" cellspacing="0" align="center" cellpadding="0">
																	<tbody>
																		<tr>
																			<td class="li_style" width="5%" valign="top">
																				<table width="100%" valign="top" border="0" cellspacing="0" cellpadding="0">
																					<tbody valign="top">
																						<tr>
																							<td width="100%" valign="top" align="left"> <img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/bullet.png"> </td>
																						</tr>
																					</tbody>
																				</table>
																			</td>
																			<td width="98%" valign="top">
																				<table width="100%" valign="top" border="0" cellspacing="0" cellpadding="0">
																					<tbody>
																						<tr>
																							<td class="li_style"> Exponential Smoothing</td>
																						</tr>
																					</tbody>
																				</table>
																			</td>
																		</tr>
																	</tbody>
																</table>
														<table width="100%" border="0" cellspacing="0" align="center" cellpadding="0">
																	<tbody>
																		<tr>
																			<td class="li_style" width="5%" valign="top">
																				<table width="100%" valign="top" border="0" cellspacing="0" cellpadding="0">
																					<tbody valign="top">
																						<tr>
																							<td width="100%" valign="top" align="left"> <img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/bullet.png"> </td>
																						</tr>
																					</tbody>
																				</table>
																			</td>
																			<td width="98%" valign="top">
																				<table width="100%" valign="top" border="0" cellspacing="0" cellpadding="0">
																					<tbody>
																						<tr>
																							<td class="li_style"> Descriptive Statistics</td>
																						</tr>
																					</tbody>
																				</table>
																			</td>
																		</tr>
																	</tbody>
																</table>
														<table width="100%" border="0" cellspacing="0" align="center" cellpadding="0">
																	<tbody>
																		<tr>
																			<td class="li_style" width="5%" valign="top">
																				<table width="100%" valign="top" border="0" cellspacing="0" cellpadding="0">
																					<tbody valign="top">
																						<tr>
																							<td width="100%" valign="top" align="left"> <img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/bullet.png"> </td>
																						</tr>
																					</tbody>
																				</table>
																			</td>
																			<td width="98%" valign="top">
																				<table width="100%" valign="top" border="0" cellspacing="0" cellpadding="0">
																					<tbody>
																						<tr>
																							<td class="li_style"> Trends and Seasonality </td>
																						</tr>
																					</tbody>
																				</table>
																			</td>
																		</tr>
																	</tbody>
																</table>
														<table width="100%" border="0" cellspacing="0" align="center" cellpadding="0">
																	<tbody>
																		<tr>
																			<td class="li_style" width="5%" valign="top">
																				<table width="100%" valign="top" border="0" cellspacing="0" cellpadding="0">
																					<tbody valign="top">
																						<tr>
																							<td width="100%" valign="top" align="left"> <img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/bullet.png"> </td>
																						</tr>
																					</tbody>
																				</table>
																			</td>
																			<td width="98%" valign="top">
																				<table width="100%" valign="top" border="0" cellspacing="0" cellpadding="0">
																					<tbody>
																						<tr>
																							<td class="li_style"> New Product </td>
																						</tr>
																					</tbody>
																				</table>
																			</td>
																		</tr>
																	</tbody>
																</table>
													</li>
												</ul>
											</li>
										</ul>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 secont-section">
								<div class="syllabus">
										<ul>
											<li>
												<ul>
													<li><span class="ul-head-title">Regression Analysis </span>
													</li>
													<li><span class="ul-head-title">Simulation Toolkit </span>
															 <table width="100%" border="0" cellspacing="0" align="center" cellpadding="0">
																	<tbody>
																		<tr>
																			<td class="li_style" width="5%" valign="top">
																				<table width="100%" valign="top" border="0" cellspacing="0" cellpadding="0">
																					<tbody valign="top">
																						<tr>
																							<td width="100%" valign="top" align="left"> <img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/bullet.png"> </td>
																						</tr>
																					</tbody>
																				</table>
																			</td>
																			<td width="98%" valign="top">
																				<table width="100%" valign="top" border="0" cellspacing="0" cellpadding="0">
																					<tbody>
																						<tr>
																							<td class="li_style"> Analysis ToolPak</td>
																						</tr>
																					</tbody>
																				</table>
																			</td>
																		</tr>
																	</tbody>
																</table>
															 <table width="100%" border="0" cellspacing="0" align="center" cellpadding="0">
																	<tbody>
																		<tr>
																			<td class="li_style" width="5%" valign="top">
																				<table width="100%" valign="top" border="0" cellspacing="0" cellpadding="0">
																					<tbody valign="top">
																						<tr>
																							<td width="100%" valign="top" align="left"> <img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/bullet.png"> </td>
																						</tr>
																					</tbody>
																				</table>
																			</td>
																			<td width="98%" valign="top">
																				<table width="100%" valign="top" border="0" cellspacing="0" cellpadding="0">
																					<tbody>
																						<tr>
																							<td class="li_style"> Solver Optimization Tool </td>
																						</tr>
																					</tbody>
																				</table>
																			</td>
																		</tr>
																	</tbody>
																</table>
													</li>
													<li><span class="ul-head-title">Data Visualization and Interpretation</span>
													</li> 
													<li><span class="ul-head-title">Optimization Models </span> 
													</li>
													<li><span class="ul-head-title">Decision Trees </span>
													</li>	
													
												</ul>
											</li>
										</ul>	
									</div>
								</div>
							</div>
					</div>							
						<a href="#2" onclick="trackEvent('click','BA LP','ScrollUp','Download Syllabus')" target="_blank"><button class="btn btn-default download-btn">DOWNLOAD SYLLABUS</button></a>
				</div>
				
			<div class="container">
				<h1 class="heading">Industry Examples</h1>				
				<div class="row p-50 container-row">
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="alumni_featured">
    						<div class="alumni_featured_image" align="left"><img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/Ind1.jpg" alt="Consumer Packaged Goods" title="Consumer Packaged Goods" class="img-responsive"></div>
							<div class="alumni_featured_band">
    						    <h5 class="alumni_featured_name">Consumer Packaged Goods</h5>
								 <p class="alumni_featured_data">
									How is Starbucks identifying which customers to give deals to in order to maximize return on investment (RoI)?</p> 
							</div>		
  						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="alumni_featured">
    						<div class="alumni_featured_image" align="left"><img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/Ind2.jpg" alt="Financial Services" title="Financial Services" class="img-responsive"></div>
							<div class="alumni_featured_band">
    							<h5 class="alumni_featured_name">Financial Services</h5>
								 <p class="alumni_featured_data">
									How does American Express use social media data to predict whether you are going to give up your American Express card?</p>
							</div>		
  						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="col-4 alumni_featured">
    						<div class="alumni_featured_image" align="left"><img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/Ind3.jpg" alt="Media" title="Media" class="img-responsive"></div>   
							<div class="alumni_featured_band">
    							<h5 class="alumni_featured_name">Media</h5>
								 <p class="alumni_featured_data">
									How is Netflix using metadata tagging to know what you watch and to create relevant content?</p>
							</div>									
  						</div>
					</div>
					
					<div class="col-md-4 col-sm-4 col-xs-12 load_more_show">
						<div class="alumni_featured">
    						<div class="alumni_featured_image" align="left"><img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/Ind4.jpg" alt="Retail" title="Retail" class="img-responsive"></div>
							<div class="alumni_featured_band">
    						    <h5 class="alumni_featured_name">Retail</h5>
								 <p class="alumni_featured_data">
									Why were stores either selling out of <i>Time</i> magazine or only selling a small fraction of their inventory?</p> 
							</div>		
  						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 load_more_show">
						<div class="alumni_featured">
    						<div class="alumni_featured_image" align="left"><img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/Ind5.jpg" alt="Apparel" title="Apparel" class="img-responsive"></div>
							<div class="alumni_featured_band">
    							<h5 class="alumni_featured_name">Apparel</h5>
								 <p class="alumni_featured_data">
									How has Kohl's been using analytics for smartphone targeting?</p>
							</div>		
  						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 load_more_show">
						<div class="col-4 alumni_featured">
    						<div class="alumni_featured_image" align="left"><img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/Ind6.jpg" alt="Technology" title="Technology" class="img-responsive"></div>   
							<div class="alumni_featured_band">
    							<h5 class="alumni_featured_name">Technology</h5>
								 <p class="alumni_featured_data">
									How could Amazon potentially ship before you buy?</p>
							</div>									
  						</div>
					</div>
					<div class="clearfix"></div>
					<div class="col-md-12 col-sm-12 col-xs-12 text-right">
						<a href="" onclick="trackEvent('click','BA LP','Open','Load More')" class="load_more" id="loadMore">Load More</a>
					</div>
				</div>
			</div>	
		<div class="container-fluid" id="faculty">	
			<div class="container" >
					<h1 class="heading mart50 marb0">Program Faculty</h1>
					<div class="row p-50 container-row">
						<div class="faculty-slider">
							<div class="col-md-4">
								<fieldset>
									<legend align="center" class="img-circle"><img src="//execed-emeritus.wharton.upenn.edu/business-analytics/images/christopher.png" alt="Christopher D. Ittner" title="Christopher D. Ittner"></legend>
									<h5 class="txt-color">Christopher D. Ittner</h5>
									<p class="data" style="margin:0px;"><b>Faculty Director</b></p>
									<p class="data">EY Professor of Accounting; Chairperson, Accounting Department</p>
								</fieldset>
							</div>
							<div class="col-md-4">
								<fieldset>
									<legend align="center" class="img-circle"><img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/Peter.jpg" alt="Peter Fader" title="Peter Fader"></legend>
									<h5 class="txt-color">Peter Fader</h5>
									<p class="data">Frances and Pei-Yuan Chia Professor; Professor of Marketing</p>
								</fieldset>
							</div>
							<div class="col-md-4">
								<fieldset>
									<legend align="center" class="img-circle"><img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/Raghu.jpg" alt="Raghuram Iyengar" title="Raghuram Iyengar"></legend>
									<h5 class="txt-color">Raghuram Iyengar</h5>
									<p class="data">Associate Professor of Marketing and Faculty Co-director, Wharton Customer Analytics Initiative</p>

								</fieldset>
							</div>
							<div class="col-md-4">
								<fieldset class="col-4">
									<legend align="center" class="img-circle"><img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/Senthil.jpg" alt="Senthil Veeraraghavan" title="Senthil Veeraraghavan"></legend>
									<h5 class="txt-color">Senthil Veeraraghavan</h5>
									<p class="data">Professor of Operations, Information and Decisions</p>
								</fieldset>
							</div><div class="col-md-4">
							<fieldset>
								<legend align="center" class="img-circle"><img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/Savin.jpg" alt="Sergei Savin" title="Sergei Savin"></legend>
								<h5 class="txt-color">Sergei Savin</h5>
								<p class="data">Associate Professor of Operations, Information and Decisions</p>
							</fieldset>
						</div>
						<div class="col-md-4">
							<fieldset>
								<legend align="center" class="img-circle"><img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/Ron.jpg" alt="Ron Berman" title="Ron Berman"></legend>
								<h5 class="txt-color">Ron Berman</h5>
								<p class="data">Assistant Professor of Marketing</p>
						</fieldset>
						</div>
						<div class="col-md-4">
							<fieldset>
								<legend align="center" class="img-circle"><img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/Noah.jpg" alt="Noah Gans" title="Noah Gans"></legend>
								<h5 class="txt-color">Noah Gans</h5>
								<p class="data">Anheuser-Busch Professor of Management Science</p>
						</fieldset>
						</div>
						<div class="col-md-4">
							<fieldset>
								<legend align="center" class="img-circle"><img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/Eric.jpg" alt="Eric Bradlow" title="Eric Bradlow"></legend>
								<h5 class="txt-color">Eric Bradlow</h5>
								<p class="data">The K.P. Chao Professor; Professor of Marketing, Economics, Education, and Statistics</p>
						</fieldset>
						</div>
						<div class="col-md-4">
							<fieldset>
								<legend align="center" class="img-circle"><img src="https://execed-emeritus.wharton.upenn.edu/business-analytics/images/Mathew.jpg" alt="Matthew Bidwell" title="Matthew Bidwell"></legend>
								<h5 class="txt-color">Matthew Bidwell</h5>
								<p class="data">Associate Professor of Management</p>
						</fieldset>
						</div>

					</div>
				</div>
			</div>
			</div>
		<div class="margin-section">
			<div class="clearfix">
					<div class="certificate-text col-sm-6">
						<div class="padl80 text-left">
							<h1 class="heading no-marg">Certificate</h1>
							<p>Earn a digital Wharton certificate upon successful completion of the online program. 
							</p>
							
						</div>
					</div>
					<div class="certificate-img col-sm-6">
						<div class="padr80">
							<img src="//execed-emeritus.wharton.upenn.edu/business-analytics/images/certificate_new.jpg" alt="Business Analytics: from Data to Insights Certificate" title="Business Analytics: from Data to Insights Certificate"class="img-responsive">
						</div>	
					</div>
				<p class="certificate-line"><i>All certificate images are for illustrative purposes only and may be subject to change at the discretion of the Wharton School.</i></p>	
			</div>
		</div>
		<div class="top-footer">
			<div class="text-center">
				<a href="https://emeritus-admissions.secure.force.com/StudentPrograms?pid=01t0I000004lceN" onclick="trackEvent('click','BA LP','ScrollUp','Apply Now')" target="_blank"><button class="btn btn-default apply-btn">Apply Now</button></a>
				<h3>Early applications are encouraged. Seats fill up quickly!</h3>
				<h5>Flexible Payment options available. <a href="#" onclick="trackEvent('click','BA LP','Pop Up','Flexi Pay')" class="applynow" data-toggle="modal" data-target="#myModal">Click here</a> to know more.</h5>
			</div>
		</div>
		<footer class="text-center">
			<div class="container m-tb-50">
				<!--<ul class="social-network social-circle  m-tb-50">
					<li><a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
					<li><a href="#" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
					<li><a href="#" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
				</ul>-->
				<p class="fotter-line"><i>This online certificate program does not grant academic credit or a degree from the Wharton School of the University of Pennsylvania.</i></p>
				<img src="//emeritus.org/programmes/Design-Thinking-fbn/assets-data/images/footer-logo.png" alt="EMERITUS Institute of Management" title="EMERITUS Institute of Management">
				<p class="footer_p text-center">
					Wharton Executive Education is collaborating with online education provider EMERITUS Institute of Management to offer a portfolio of high-impact programs for working professionals. With over 7,500 alumni from more than 120 countries, EMERITUS delivers management education programs with a live-teaching model coupled with group work and graded assignments. Through this collaboration, we are able to offer broad access to the world-class knowledge for which the Wharton School is known, in an engaging and interactive digital environment.
				</p>
			</div>
		</footer>
	</div>
	<div class="model_box">
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header text-center">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <div class="clearfix content_h5">
              <h5>The Flexible Payment option allows a student to pay the program fee in installments. This option is made available in the application form and should be selected before making the payment.</h5>
            </div>
            <div class="clearfix content_p">
              <h5>The following payment options are available for the <i>Business Analytics</i> program:</h5>
				<ul class="ul_style">Pay in Full</ul>
					<li>Pay the entire course fee of <b>$2,450</b> at once.</b>
					</li>
				</ul>

				<ul class="ul_style">Pay in 2 installments</ul>
					<li>The first installment of <b>$1,349</b> is <b>due immediately</b>.
					</li>
					<li>The final installment of <b>$1,150</b> is to be paid by <b>Aug 17, 2018</b>.
					</li>
				</ul>

				<ul class="ul_style">Pay in 3 installments</ul>
					<li>The first installment of <b>$1,029</b> is <b>due immediately</b>.
					</li>
					<li>The second installment of <b>$772</b> is to be paid by  <b>Aug 17, 2018</b>.
					</li>
					<li>The final installment of <b>$772</b> is to be paid by <b>Sep 07, 2018</b>.
					</li>
				</ul>
            </div>
          </div>
<script async type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script async  type="text/javascript" src="https://execed-emeritus.wharton.upenn.edu/business-analytics/js/bootstrap.js"></script>
<script type="text/javascript" src="//script.crazyegg.com/pages/scripts/0071/5326.js" async="async"></script>
<script async type="text/javascript" src="https://execed-emeritus.wharton.upenn.edu/business-analytics/js/slick.min.js"></script>
<script async type="text/javascript" src="https://execed-emeritus.wharton.upenn.edu/business-analytics/js/com.js"></script>
<script type="text/javascript" src="https://emeritus.org/programmes/common/js/countries-new.js"></script>
<script async type="text/javascript" src="https://emeritus.org/programmes/common/gdpr.js?v=0.0.1"></script>
<script> 
populateCountries("country");

	var tag = document.createElement('script'); 
	tag.src = "//www.youtube.com/player_api"; 
	var firstScriptTag = document.getElementsByTagName('script')[0]; 
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	
	var player; 
	function onYouTubePlayerAPIReady() { 
	player = new YT.Player('player', { 
	height: '700', 
	width: '100%', 
	videoId: 'mi0yND2utX0', 
	playerVars: {rel: 0},
	events: { 
	'onReady': onPlayerReady, 
	'onStateChange': onPlayerStateChange 
	} 
	}); 
	}
	function onPlayerReady(event) { 
	/// event.target.playVideo(); 
	} 
	
	function onPlayerStateChange(event) { 
		if (event.data ==YT.PlayerState.PLAYING) 
		{
			trackEvent('Play', 'BA LP', 'Watch Video', 'Play Video', false);
		} 
	} 
	</script> 
<!-- Tracking Code Start--> 
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NX2MRZJ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->



<!-- Tracking Code end-->

<!-- begin Pardot Website Tracking code -->

<script type="text/javascript">
piAId = '64132';
piCId = '2042';
piHostname = 'pi.pardot.com'; 

(function() {
	function async_load(){
		var s = document.createElement('script'); s.type = 'text/javascript';
		s.src = ('https:' == document.location.protocol ? 'https://pi' : 'http://cdn') + '.pardot.com/pd.js';
		var c = document.getElementsByTagName('script')[0]; c.parentNode.insertBefore(s, c);
	}
	if(window.attachEvent) { window.attachEvent('onload', async_load); }
	else { window.addEventListener('load', async_load, false); }
})();
</script>
<script>
var sr = 3;
	$(function () {
    $(".load_more_show").slice(0, 0).show();
    $("#loadMore").on('click', function (e) {
        e.preventDefault();
        $(".load_more_show:hidden").slice(0, 3).slideDown();
		sr	= sr+3;
        if ($(".load_more_show:hidden").length == 0) {
            $("#load").fadeOut('slow');
        }
		if(sr == 6)
		{
			$("#loadMore").hide();
		}
		
       
    });
});

function resetHeight()
{
 var maxHeight = 0;
 $(".alumni_featured_band").each(function(){
    if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
 });
 $(".alumni_featured_band").height(maxHeight);
 $(".alumni_featured_band").css('background','#004785');
 $(".alumni_featured_band").css('padding-bottom','20px');
}

$(window).on('resize', function() {
 resetHeight()
});
resetHeight();
</script>
<!-- end Pardot Website Tracking code -->
</body>
</html>