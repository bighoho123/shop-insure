<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html lang="en" class="no-js"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="author" content="">
<meta name="keywords" content="">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title></title>

<!-- main JS libs -->
<script src="../js/libs/modernizr.min.js"></script>
<script src="../js/libs/jquery-1.10.0.js"></script>
<script src="../js/libs/jquery-ui.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="../js/jquery.steps.min.js"></script>
<script src="../js/jquery.customInput.js"></script>

<!-- Style CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link href="../style.css" media="screen" rel="stylesheet">
<link rel="stylesheet" href="../css/jquery-steps.css">

<!-- Custome css -->

<!-- scripts -->
<script src="../js/general.js"></script>

<!-- Include all needed stylesheets and scripts here -->





<!--[if lt IE 9]><script src="js/respond.min.js"></script><![endif]-->
<!--[if gte IE 9]>
<style type="text/css">
    .gradient {filter: none !important;}
</style>
<![endif]-->
</head>

<body>
    <div class="body_wrap">
        <div class="container">
        	<!-- content -->
	        <div class="content " role="main">
	            <!-- row -->
	            <div class="row">
	                <div class="col-sm-12">
	                    <!-- Website Menu -->
	                    <div id="topmenu">
	                        <ul class="dropdown clearfix boxed">
	                            <li><a href="../pages/index.html"><i class="glyphicon glyphicon-shopping-cart"></i>ShopInsure</a></li>
	                            
	                            <li class="menu-level-0 pull-right"><a href="../pages/getStarted.php"><span>Get Started</span></a></li>
	                        </ul>
	                    </div>
	                    <!--/ Website Menu -->
	                </div>
	            </div>
	            <!--/ row -->
	            <div class="row">
	            	<div class="col-sm-12">
	   					<div id="getStarted">
	   						<!-- Step 1 -->
	   						<h1>Something about you</h1>
	   						<div>
		   						<div class="col-sm-6">
		   							Do you have an existing peronal life insurance policy?
		   						</div>
		   						<div class="col-sm-6">
		   							<div class="input_styled inlinelist">
									    <div class="rowRadio col-sm-3">
									        <input type="radio" name="hasInsurance" value="1" id="hasInsurance_1">
									        <label for="hasInsurance_1">Yes</label>
									    </div>
									    <div class="rowRadio radio-red col-sm-3">
									        <input type="radio" name="hasInsurance" value="0" id="hasInsurance_0">
									        <label for="hasInsurance_0">No</label>
									    </div>
									</div>
		   						</div>
		   						<div class='clearfix' style='height:150px'></div>
		   						<div class="col-sm-6 hasInsurance" style='display:none'>
		   							Would you prefer to upload your policy schedule or input your policy details?
		   						</div>
		   						<div class="col-sm-6 hasInsurance" style='display:none'>
		   							<div class="input_styled inlinelist">
									    <div class="rowRadio col-sm-4">
									        <input type="radio" name="how" value="form" id="how_form">
									        <label for="how_form">Fill in a Form <span class="glyphicon glyphicon-pencil"></span></label>
									    </div>
									    <div class="rowRadio col-sm-4">
									        <input type="radio" name="how" value="upload" id="how_upload">
									        <label for="how_upload">Upload <span class="glyphicon glyphicon-upload"></span></label>
									    </div>
									</div>
		   						</div>
		   						<div class='col-sm-12 hasntInsurance' style='display:none'>
		   							<h2 class="text-danger" style='text-align:center'><span class="glyphicon glyphicon-remove-circle"></span> Still Under Construction</h2>
		   						</div>
		   					</div>
		   					<!-- Step 2 -->
		   					<h1>Insurance Details</h1>
		   					<div>
		   						<div id='step2_upload' class='upload' style='display:none'>
			   						Upload
			   					</div>
			   					<div id='step2_form' class='form' style='display:none'>
			   						Form
			   					</div>
			   				</div>
			   				<!-- Step 3 -->
			   				<h1>Details</h1>
		   					<div>
		   						<div id='step3_upload' class='upload' style='display:none'>
			   						Upload
			   					</div>
			   					<div id='step3_form'  class='form' style='display:none'>
			   						Form
			   					</div>
			   				</div>
			   				<!-- Step 4 -->
			   				<h1>Result</h1>
		   					<div>
		   						<div id='step4_upload' class='upload' style='display:none'>
			   						Upload
			   					</div>
			   					<div id='step4_form' class='form' style='display:none'>
			   						Form
			   					</div>
			   				</div>
	   					</div>
					</div>
				</div>
	        </div>
        </div>
        <!--/ container -->
    </div>
    <!-- Hidden Container -->
    <div style='display:none'>

    </div>
</body>
<script>

	var step=jQuery("#getStarted").steps({
		forceMoveForward:true,
		enableAllSteps:false,
    	transitionEffect:1,
    	onStepChanging:function(event, currentIndex, newIndex) {
    		if (currentIndex==0){
    			// Check all the question has been answered
    			if (jQuery("[name='hasInsurance']:checked").val()==1){
    				if (jQuery("[name='how']:checked").length==0){
    					return false;
    				}
    			} else {
    				// Under constrcution
    				return false;
    			}
    		} else if (true) {

    		}
    		console.log("leaving "+currentIndex);
    		console.log("entering "+newIndex);
    		return true;
    	}
    });

	jQuery(document).ready(function($) {
		jQuery("[name='hasInsurance']").click(function(event) {
			var val=jQuery(this).val();
			if (val=="0"){
				jQuery(".hasntInsurance").fadeIn();
				jQuery(".hasInsurance").hide();
			} else {
				jQuery(".hasInsurance").fadeIn();
				jQuery(".hasntInsurance").hide();
			}
		});
	});

	jQuery(document).ready(function($) {
		jQuery("[name='how']").click(function(event) {
			var val=jQuery(this).val();
			if (val=="form"){
				jQuery(".form").show();
				jQuery(".upload").hide();
			} else {
				jQuery(".upload").show();
				jQuery(".form").hide();
			}
		});
	});
	

    

</script>
</html>