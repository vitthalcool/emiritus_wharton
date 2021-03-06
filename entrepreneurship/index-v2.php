<!DOCTYPE html>
<html>
<head>
	<title>Entrepreneurship Acceleration Program: Scaling Your Business | Wharton Executive Education</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="https://execed-emeritus.wharton.upenn.edu/favicon.ico" type="image/x-icon">
	<link rel="icon" href="https://execed-emeritus.wharton.upenn.edu/favicon.ico" type="image/x-icon">
	<meta name="description" content="Entrepreneurship Acceleration Program: Scaling Your Business Seed funding of $25,000 for the winner and $10,000 for the runner-up in the pitch competition!"/>
	
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style_new.css">
	<link rel="stylesheet" type="text/css" href="assets/css/responsive_new.css?v=0.0.1">
	<!--<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700" rel="stylesheet">-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="assets/css/slick.css"/>
	<link rel="stylesheet" type="text/css" href="assets/css/slick-theme.css"/>
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
					trackEvent('click','EAP LP','FormSubmit','Form_Submit')
					
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
						 <a href="https://execed-emeritus.wharton.upenn.edu/entrepreneurship/index-v2.php" target="_blank" onclick="trackEvent('click','EAP LP','Reload','Partner Logo')"><img src="assets/images/logo.png" alt="wharton" title="wharton" class="img-responsive"> </a>
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
					<div class="col-md-7 col-sm-6 no_pad">
						<div class="banner-content p-l-7">
							<h1><span>Entrepreneurship Acceleration Program:</span> Scaling Your Business</h1>
							<h4>Seed funding of $25,000 for the winner and $10,000 for the runner-up in the pitch competition!</h4>
						</div>
					</div>
					<div id="2" class="col-md-5 form-div no_pad form-section">
							<form class="form-horizontal contact-form form-bg" role="form" id="frm" name="frm" method="POST" action="submit.php">
								<h2>&nbsp;&nbsp;GET PROGRAM INFO</h2>
									
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
							</form>
					</div>
				</div>
			</div>
		</div>
		<div class="container info-row">
			<div class="col-md-4 col-sm-4 no_pad">
				<div class="info-box clearfix">
					<div class="img-holder">
						<img src="assets/images/start.png" alt="Starts on" title="Starts on">
					</div>
					<div class="img-content">
						<h3>Starts on</h3>
						<p>August 23, 2018</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 no_pad">
				<div class="info-box clearfix">
					<div class="img-holder">
						<img src="assets/images/duration.png" alt="Duration" title="Duration">
					</div>
					<div class="img-content">
						<h3>Duration</h3>
						<p>3 months, online<br/> 
						<span class="f18">3–4 hours per week</span>
						</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 no_pad">
				<div class="info-box clearfix">
					<div class="img-holder">
						<img src="assets/images/fee.png" alt="Program Fees" title="Program Fees">
					</div>
					<div class="img-content">
						<h3>program fees</h3>
						<p>$2,600</p>
						<!-- <h6 class="info">
							<a href="javascript:void(0)" onclick="trackEvent('click','EAP LP','Pop Up','Flexi Pay')" data-toggle="modal" data-target="#myModal"> <img src="assets/images/info_icon.png" alt="info" title="info" class="">&nbsp;<i class="bm">Flexible payment available</i></a>
						</h6> -->
					</div>
				</div>
			</div>
		</div>
		
		<div class="container padtop">
				<h1 class="heading">Why Enroll in Wharton’s <br/><i>Entrepreneurship Acceleration Program</i>?</h1>
				<p class="text-center intro-text">
					There’s no shortage of pitfalls for startups and their founders. The 90 percent failure rate of startups is enough to make you think about keeping your day job &mdash; forever. Here are three of the most highly cited reasons why startups fail:
				</p>
				<div class="row counter-row">
						<div class="col-md-4 col-sm-4">
							<div class="abt-content bb-a">
								<h3>Failure Reason #1</h3>
								<p>Selling a product or service no one wants</p>
								</div>
						</div>
						<div class="col-md-4 col-sm-4 b-r-f-1">
							<div class="abt-content bb-a">
								<h3>Failure Reason #2</h3>
								<p>Wrong business model and not scalable </p>
									<p class="source">SOURCE: FORBES</p>
								</div>
							</div>
						<div class="col-md-4 col-sm-4">
								<div class="abt-content">
									<h3>Failure Reason #3</h3>
									<p>Lack of adequate funding to fuel growth</p>
								</div>
							</div>
				</div> 
				
				
					<p class="text-left intro-text intro-success">
						Dramatically increase the odds of success by learning how to:
					</p>
					<div class="row text-left">
						<div class="col-md-12 intro-text">
							<div class="col-md-6 col-sm-6">
								<ul>
									<li>Pick the right business model</li>
									<li>Build the right team</li>
								</ul>	
							</div>
							<div class="col-md-6 col-sm-6">
								<ul>
									<li>Choose the right financing approach</li>
									<li>Ramp up sales and scale the business</li>
								</ul>
							</div>
						</div>	
					</div>
				
				<div class="marb92 mb92">
					<a href="#2" onclick="trackEvent('click','EAP LP','ScrollUp','Download Brochure')"><button class="btn btn-default download-btn"> DOWNLOAD BROCHURE</button></a>
				</div>
			</div>
			
			<!-- <div class="video-wrapper youtubevideo">
				<div class="aspect-ratio">
					<img src="assets/images/placeholder_video.jpg" class="img-responsive">
				</div>
			</div> -->
			
				<div class="container">
						<h1 class="heading">Your Learning Experience</h1>
								<div class="display_desktop text-center clearfix">

							<ul class="no-style">

								<li class="col20">

									<div class="box-section blue">

									<img src="assets/images/Business.png" alt="Your Business or Idea" title="Your Business or Idea">

									</div>

									<h3>YOUR BUSINESS <br/>OR IDEA</h3>

									<p class="data-section">Regardless of stage of maturity</p>

								</li>

								<li class="col20">

									<div class="box-section">

									<img src="assets/images/real-world.png" alt="Real-World Examples" title="Real-World Examples">

									</div>

									<h3>REAL-WORLD <br>EXAMPLES</h3>

									<p class="data-section">Delivered through a mix of recorded and live online lectures with faculty and guests</p>

									

								</li>

								<li class="col20">

									<div class="box-section blue">

									<img src="assets/images/application.png" alt="Discussion Boards" title="Discussion Boards">

									</div>

									<h3>DISCUSSION<br/>BOARDS</h3>

									<p class="data-section">Moderated by subject-matter experts</p>

									

								</li>

								<li class="col20">

									<div class="box-section">

									<img src="assets/images/money.png" alt="Seed Money for Pitch Winners" title="Seed Money for Pitch Winners">

									</div>

									<h3>SEED MONEY FOR<br/>PITCH WINNERS</h3>

									<p class="data-section">Awarded to top two pitches, and everyone improves in the process</p>

									

								</li>

							</ul>						

						</div>
			
					</div>
					
				<div class="bg_grey">
					<div class="content-wrapper">	
						<div class="row">
							<div class="col-md-12">
								<h1 class="heading">Program Topics</h1>
								<div class="col-md-6 col-sm-6">
									<div class="syllabus">
										<ul>
											<li><span class="ul-head">Module 1:</span> Evidence-based Entrepreneurship</li>
											<li><span class="ul-head">Module 2:</span> Building the Right Team</li>
											<li><span class="ul-head">Module 3:</span> Lawyers, Advisors, and Mentors</li>
											<li><span class="ul-head">Module 4:</span> Gearing Up for Scale</li>
											<li><span class="ul-head">Module 5:</span> Customer Acquisition and Demand Generation</li>
											<li><span class="ul-head">Module 6:</span> Pricing and Distribution Strategies</li>								
										</ul>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 your-learning-mt">
									<div class="syllabus">
										<ul>
											<li><span class="ul-head">Module 7:</span> Business Models and Customer Lifetime Value</li>
											<li><span class="ul-head">Module 8:</span> Financing: Funding and Valuation</li>
											<li><span class="ul-head">Module 9:</span> Financing: Venture Capital vs. Alternative Funding Channels</li>
											<li><span class="ul-head">Module 10:</span> Elements of the Pitch</li>
											<li><span class="ul-head">Module 11:</span> Business Plan Competition</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>							
						<a href="#2" onclick="trackEvent('click','EAP LP','ScrollUp','Download Syllabus')" target="_blank"><button class="btn btn-default download-btn">DOWNLOAD SYLLABUS</button></a>
						
					<p class="text-left note-section">
						<i>Note: Seed funding cannot be used for personal expenses. It must be used to develop the business cited in the final pitch. The seed funding will not dilute equity positions.</i>
					</p>
				</div>
				
			<div class="container">
				<h1 class="heading">Interviews and Industry Examples</h1>				
				<div class="col-md-12 Interviews">
					The Wharton <i>Entrepreneurship Acceleration Program</i> features in-depth interviews with company founders and representatives from startups and established venture capitalist firms.
				</div>
				
				<div class="col-md-12 li-style clearfix">
					<div class="col-md-4 col-sm-4">
						<ul>
							<li>Big Ass Fans</li>
							<li>Forerunner Ventures</li>
						</ul>	
					</div>
					<div class="col-md-4 col-sm-4">
						<ul>
							<li>Greylock Partners</li>
							<li>Stringr</li>
						</ul>
					</div>
				</div>	
				
				<div class="col-md-12 Industry-Example">
					The online program also features examples of startups and established companies that were once startups. It will cover multiple industries, including consumer packaged goods, ecommerce, internet, media and entertainment, and technology.
				</div>
				
				<div class="col-md-12 li-style">
					<div class="col-md-4 col-sm-4">
						<ul>
							<li>Adobe</li>
							<li>Intel</li>
							<li>Qualcomm</li>
							<li>Aerocardal</li>
							<li>Harry’s Blades</li>
						</ul>	
					</div>
					<div class="col-md-4 col-sm-4">
						<ul>
							<li>Dollar Shave Club</li>
							<li>Jet.com</li>
							<li>The Walt Disney Company</li>
							<li>Bandar Foods</li>
							<li>Silicon Valley Bank</li>
						</ul>
					</div>
					<div class="col-md-4 col-sm-4">
						<ul>
							<li>IBM</li>
							<li>Kickstarter</li>
							<li>Xiaomi</li>
							<li>Belle-V Kitchen</li>
							<li>Wholly Moly</li>
						</ul>
					</div>
				</div>	

				<p class="text-left note-section">
					<i>Note: All product and company names are trademarks or registered trademarks of their respective holders. Use of them does not imply any affiliation with or endorsement by them.</i>
				</p>
			</div>	
		<div class="container-fluid" id="faculty">	
			<div class="container" >
					<h1 class="heading mart50 marb0">Program Faculty</h1>
					<div class="row p-50 container-row">
						<div class="faculty-slider">
							<div class="col-md-4">
								<fieldset>
									<legend align="center" class="img-circle"><img src="assets/images/Karl-Ulrich.jpg" alt="Karl Ulrich" title="Karl Ulrich"></legend>
									<h5 class="txt-color">Karl Ulrich</h5>
									<p class="data">CIBC Endowed Professor; Professor of Operations, Information and Decisions; Professor of Management; and Vice Dean of Entrepreneurship and Innovation</p>
								</fieldset>
							</div>
							<div class="col-md-4">
								<fieldset class="col-4">
									<legend align="center" class="img-circle"><img src="assets/images/Ethan-Mollick.jpg" alt="Ethan Mollick" title="Ethan Mollick"></legend>
									<h5 class="txt-color">Ethan Mollick</h5>
									<p class="data">Associate Professor of Management</p>
								</fieldset>
							</div>
							<div class="col-md-4">
								<fieldset class="col-4">
									<legend align="center" class="img-circle"><img src="assets/images/Kartik-Hosanagar.jpg" alt="Kartik Hosanagar" title="Kartik Hosanagar"></legend>
									<h5 class="txt-color">Kartik Hosanagar</h5>
									<p class="data">John C. Hower Professor; Professor of Operations, Information and Decisions</p>
								</fieldset>
							</div>
							<div class="col-md-4">
								<fieldset class="col-4">
									<legend align="center" class="img-circle"><img src="assets/images/Lori-Rosenkopf.jpg" alt="Lori Rosenkopf" title="Lori Rosenkopf"></legend>
									<h5 class="txt-color">Lori Rosenkopf</h5>
									<p class="data">Simon and Midge Palley Professor; Professor of Management; and Vice Dean and Director, Wharton Undergraduate Division</p>
								</fieldset>
							</div>
							<div class="col-md-4">
							<fieldset>
								<legend align="center" class="img-circle"><img src="assets/images/Laura-Huang.jpg" alt="Laura Huang" title="Laura Huang"></legend>
								<h5 class="txt-color">Laura Huang</h5>
								<p class="data">Associate Professor of Business Administration, Harvard Business School; formerly Assistant Professor of Management and Entrepreneurship at Wharton</p>
							</fieldset>
						</div>
						<div class="col-md-4">
							<fieldset>
								<legend align="center" class="img-circle"><img src="assets/images/David-Hsu.jpg" alt="David Hsu" title="David Hsu"></legend>
								<h5 class="txt-color">David Hsu</h5>
								<p class="data">Richard A. Sapp Professor; Professor of Management</p>
						</fieldset>
						</div>
						<div class="col-md-4">
							<fieldset>
								<legend align="center" class="img-circle"><img src="assets/images/David-Bell.jpg" alt="David Bell" title="David Bell"></legend>
								<h5 class="txt-color">David Bell</h5>
								<p class="data">Xinmei Zhang and Yongge Dai Professor; Professor of Marketing</p>
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
							<img src="assets/images/certificate_new.png" alt="Entrepreneurship Acceleration Program: Scaling Your Business" title="Entrepreneurship Acceleration Program: Scaling Your Business"class="img-responsive">
						</div>	
					</div>
				<p class="certificate-line"><i>All certificate images are for illustrative purposes only and may be subject to change at the discretion of the Wharton School.</i></p>	
			</div>
		</div>
		<div class="top-footer">
			<div class="text-center">
				<a href="https://emeritus-admissions.secure.force.com/StudentPrograms?pid=01t0I0000067qUP" onclick="trackEvent('click','EAP LP','Redirect','Apply Now')" target="_blank"><button class="btn btn-default apply-btn">Apply Now</button></a>
				<h3>Early applications are encouraged. Seats fill up quickly!</h3>
				<h5>Flexible payment options available. <a href="#" onclick="trackEvent('click','EAP LP','Pop Up','Flexi Pay')" class="applynow" data-toggle="modal" data-target="#myModal">Click here</a> to learn more.</h5>
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
              <h5>The following payment options are available for the <i>Entrepreneurship Acceleration Program</i>:</h5>
				<ul class="ul_style">Pay in Full</ul>
					<li>Pay the entire course fee of <b>$2,600</b> at once.</b>
					</li>
				</ul>

				<ul class="ul_style">Pay in 2 installments</ul>
					<li>The first installment of <b>$1,432</b> is <b>due immediately</b>.
					</li>
					<li>The final installment of <b>$1,220</b> is to be paid by <b>Sep 21, 2018</b>.
					</li>
				</ul>

				<ul class="ul_style">Pay in 3 installments</ul>
					<li>The first installment of <b>$1,092</b> is <b>due immediately</b>.
					</li>
					<li>The second installment of <b>$819</b> is to be paid by  <b>Sep 21, 2018</b>.
					</li>
					<li>The final installment of <b>$819</b> is to be paid by <b>Oct 12, 2018</b>.
					</li>
				</ul>
            </div>
          </div>
<script async type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script async  type="text/javascript" src="assets/js/bootstrap.js"></script>
<script type="text/javascript" src="//script.crazyegg.com/pages/scripts/0071/5326.js" async="async"></script>
<script async type="text/javascript" src="assets/js/slick.min.js"></script>
<script async type="text/javascript" src="assets/js/com.js"></script>
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
			trackEvent('Play', 'EAP LP', 'Watch Video', 'Play Video', false);
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