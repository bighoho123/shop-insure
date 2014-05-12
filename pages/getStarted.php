<?php 
/*  The Get Started page for the ShopInsure app

	This get started page guides user to either upload a file to us or fill in there own form

	Author: Jinzhe Li <jinzhedna@gmail.com> 
*/	
	include("../includes/omniumAPI.php");
?>
	
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
<!-- Awesome font -->
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<!-- main JS libs -->
<script src="../js/libs/modernizr.min.js"></script>
<script src="../js/libs/jquery-1.10.0.js"></script>
<script src="../js/libs/jquery-ui.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="../js/jquery.steps.min.js"></script>
<script src="../js/jquery.customInput.js"></script>



<!-- Ajax Form -->
<script src="../js/jquery.form.js"></script> 
<!-- Style CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link href="../style.css" media="screen" rel="stylesheet">
<link rel="stylesheet" href="../css/jquery-steps.css">

<!-- Custome css -->
<!-- Datepicker -->
<script src="../js/jquery-ui.multidatespicker.js"></script>
<link href="../css/jquery-ui-1.8.20.custom.css" rel="stylesheet">

<!-- Placeholders -->
<script type="text/javascript" src="../js/jquery.powerful-placeholder.min.js"></script>
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
		   							Please upload a copy of your policy schedule so we can research on our insurance database and get back to you.
		   							<form id='fileUpload' method="POST" enctype="multipart/form-data" action="../widgetFunction/saveFile.php">
		   								<input type="file" style='float:right;margin-top:50px' name='upload' id='upload'>
		   								<input type="hidden" id="emailNameHidden" name="emailNameHidden">
										<input type="hidden" id="emailContactHidden" name="emailContactHidden">
										<input type="hidden" id="emailNoteHidden" name="emailNoteHidden">
		   							</form>
			   						
			   					</div>
			   					<div id='step2_form' class='form' style='display:none'>
			   						<form class="form-horizontal" role="form">
			   						  <!-- Firstname -->
									  <div class="form-group">
									    <label for="firstname" class="col-sm-4 control-label">Firstname</label>
									    <div class="col-sm-6">
									      <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Firstname">
									    </div>
									  </div>
									  <!-- Surname -->
									  <div class="form-group">
									    <label for="surname" class="col-sm-4 control-label">Surname</label>
									    <div class="col-sm-6">
									      <input type="text" class="form-control" id="surname" name="surname" placeholder="Surname">
									    </div>
									  </div>
									  <!-- DOB -->
									  <div class="form-group">
									    <label for="dob" class="col-sm-4 control-label">Date of Birth</label>
									    <div class="col-sm-6">
									      <input type="text" class="form-control" id="dob" name="dob" placeholder="Date of Birth">
									    </div>
									  </div>
									  <!-- Gender -->
									  <div class="form-group">
									    <label class="col-sm-4 control-label">Gender</label>
									    <div class="col-sm-2">
									    	<div class="input_styled inlinelist">
											    <div class="rowRadio col-sm-6">
											        <input type="radio" name="gender" value="M" id="gender_M">
											        <label for="gender_M">Male</label>
											    </div>
											    <div class="rowRadio col-sm-6">
											        <input type="radio" name="gender" value="F" id="gender_F">
											        <label for="gender_F">Female</label>
											    </div>
											</div>
									    </div>
									  </div>
									  <!-- Smoking? -->
									  <div class="form-group">
									    <label class="col-sm-4 control-label">Smoking Status</label>
									    <div class="col-sm-2">
									    	<div class="input_styled inlinelist">
											    <div class="rowRadio col-sm-6">
											        <input type="radio" name="smoke" value="1" id="smoke_1">
											        <label for="smoke_1">Yes</label>
											    </div>
											    <div class="rowRadio col-sm-6">
											        <input type="radio" name="smoke" value="0" id="smoke_0">
											        <label for="smoke_0">No</label>
											    </div>
											</div>
									    </div>
									  </div>
									  <!-- Job -->
									  <div class="form-group">
									    <label for="occupation" class="col-sm-4 control-label">Occupation</label>
									    <div class="col-sm-6">
									      <select style='background-color:transparent;color:#8e8071;' class="form-control" id="occupation" name="occupation">
									      	<option value="" disabled selected>Select your occupation...</option>
									      		<?php echo getOccupationDataSelectOptionsHtml(); ?>
									      </select>
									    </div>
									  </div>
									  <!-- Premium Structure -->
									  <div class="form-group">
									    <label for="premiumStructure" class="col-sm-4 control-label">Premium Structure</label>
									    <div class="col-sm-6">
									      <select style='background-color:transparent;color:#8e8071;' class="form-control" id="premiumStructure" name="premiumStructure">
									      	<option value="" disabled selected>Select your premium structure...</option>
									      	<option value="S">Stepped</option>
									      	<option value="L">Level</option>
									      </select>
									    </div>
									  </div>
									  <!-- Benefit Insured -->
									  <div class="form-group">
									    <label for="benefit" class="col-sm-4 control-label">Benefit / Sum Insured</label>
									    <div class="col-sm-6 input-group" style='padding-right:15px;padding-left:15px;'>
								    	  <span class="input-group-addon" style="">$</span>
									      <input type="text" class="form-control" id="benefit" name="benefit" placeholder="Benifit / Sum Insured">
									    </div>
									  </div>
									  <!-- Premium -->
									  <div class="form-group">
									    <label for="premium" class="col-sm-4 control-label">Premium</label>
									    <div class="col-sm-2">
									      <input type="text" class="form-control" id="premium" name="premium" placeholder="Premium">
									    </div>
									    <label for="premiumFreq" class="col-sm-1 control-label">Paid</label>
									    <div class="col-sm-2">
									      <select style='background-color:transparent;color:#8e8071;' class="form-control" id="premiumFreq" name="premiumFreq">
									      	<option value="0">yearly</option>
									      	<option value="1">half yearly</option>
									      	<option value="2">quarterly</option>
									      	<option value="3">monthly</option>
									      </select>
									    </div>
									  </div>
									</form>
			   					</div>
			   				</div>
			   				<!-- Step 3 -->
			   				<h1>More Details</h1>
		   					<div>
		   						<div id='step3_upload' class='upload' style='display:none'>
		   							<form class="form-horizontal" role="form">
				   						<!-- Email Name -->
										<div class="form-group">
										    <label for="emailName" class="col-sm-4 control-label">Name</label>
										    <div class="col-sm-6">
										      <input type="text" class="form-control" id="emailName" name="emailName" placeholder="Your name...">
										    </div>
										</div>
										<!-- Contact Method -->
										<div class="form-group">
										    <label for="emailContact" class="col-sm-4 control-label">Contact Details</label>
										    <div class="col-sm-6">
										      <input type="text" class="form-control" id="emailContact" name="emailContact" placeholder="Your preferred contact (phone/email)...">
										    </div>
										</div>
										<!-- Note -->
										<div class="form-group">
										    <label for="emailNote" class="col-sm-4 control-label">Note</label>
										    <div class="col-sm-6">
										      <textarea style='height:300px' type="text" class="form-control" id="emailNote" name="emailNote" placeholder="Things you want us to know..."></textarea>
										    </div>
										</div>
									</form>
			   					</div>
			   					<div id='step3_form'  class='form' style='display:none'>
			   						<form class="form-horizontal" role="form">
			   						<!-- Insurer -->
									<div class="form-group">
									    <label for="insurer" class="col-sm-4 control-label">Name of Insurer</label>
									    <div class="col-sm-6">
									      <select style='background-color:transparent;color:#8e8071;' class="form-control" id="insurer" name="insurer">
									      	<option value="" disabled selected>Select your insurer...</option>
									      	<?php 
									      		$suppliers=getSupplierData();
									      		foreach($suppliers AS $supplierCode => $supplierName){
									      			echo "<option value='$supplierCode'>$supplierName</option>";
									      		}
									      	?>
									      </select>
									    </div>
									</div>
									<!-- Cover Type -->
									<div class="form-group">
									    <label for="coverType" class="col-sm-4 control-label">Type of Cover</label>
									    <div class="col-sm-6">
									      <select style='background-color:transparent;color:#8e8071;' class="form-control" id="coverType" name="coverType">
									      	<option value="" disabled selected>Select your cover type...</option>
									      	<option value="trm">Life Cover</option>
									      </select>
									    </div>
									</div>
									<!-- Product -->
									<div class="form-group">
									    <label for="product" class="col-sm-4 control-label">Product</label>
									    <div class="col-sm-6">
									      <select style='background-color:transparent;color:#8e8071;' class="form-control" id="product" name="product">
									      	<option value="" disabled selected>Select your cover product...</option>
									      </select>
									    </div>
									</div>
									<!-- Importance -->
									<div class="form-group">
									    <label class="col-sm-4 control-label">What's more important to you?</label>
									    <div class="col-sm-4">
									    	<div class="input_styled inlinelist">
											    <div class="rowRadio col-sm-6">
											        <input type="radio" name="importance" value="1" id="importance_1">
											        <label for="importance_1">Premium Price</label>
											    </div>
											    <div class="rowRadio col-sm-6">
											        <input type="radio" name="importance" value="0" id="importance_0">
											        <label for="importance_0">Quality Policy</label>
											    </div>
											</div>
									    </div>
									</div>
									</form>
			   					</div>
			   				</div>
			   				<!-- Step 4 -->
			   				<h1>Result</h1>
		   					<div>
		   						<div id='step4_upload' class='upload' style='display:none'>
			   						<div class='center-block' style='width:200px;text-align:center'>
			   							<span style='font-size:30px;'><i class="fa fa-spinner fa-spin"></i> Processing...</span>
			   						</div>
			   					</div>
			   					<div id='step4_form' class='form' style='display:none'>
			   						<div class='center-block' style='width:200px;text-align:center'>
			   							<span style='font-size:30px;'><i class="fa fa-spinner fa-spin"></i> Loading...</span>
			   						</div>
			   					</div>
			   				</div>
	   					</div>
					</div>
				</div>
	        </div>
        </div>
    </div>

    <!-- Hidden Container -->
    <div style='display:none' id='preloader'>
    	<div class='center-block' style='width:200px;text-align:center'>
			<span style='font-size:30px;'><i class="fa fa-spinner fa-spin"></i> Loading...</span>
		</div>
    </div>
</body>
<script>
	function validateForm(){
		if (jQuery("#dob").val()==""){

			return false;
		}
		if (jQuery("#gender").val()==""){
			
			return false;
		}
		if (jQuery("#smoke").val()==""){
			
			return false;
		}
		if (jQuery("#occupation").val()==""){
			
			return false;
		}
		if (jQuery("#premiumStructure").val()==""){
			
			return false;
		}
		if (jQuery("#benefit").val()==""){
			
			return false;
		}
		return true;
	}

	var step=jQuery("#getStarted").steps({
		forceMoveForward:false,
		enableAllSteps:false,
    	transitionEffect:1,
    	onStepChanging:function(event, currentIndex, newIndex) {
    		if (newIndex==3) {
    			if (jQuery("[name='how']:checked").val()=="form"){
	    			jQuery("#step4_form").html(jQuery("#preloader").html());
	    			var params=new Array();
	    			jQuery("form").each(function(index, el) {
	    				params=params.concat(jQuery(this).serializeArray());
	    			});
	    			jQuery.ajax({
	    				url: '../subPages/getPremiumQuote.php',
	    				type: 'POST',
	    				dataType: 'html',
	    				data: params,
	    			})
	    			.done(function(data) {
	    				jQuery("#step4_form").html(data);
	    			});	
	    		} else {
	    			jQuery("#emailNameHidden").val(jQuery("#emailName").val());
	    			jQuery("#emailContactHidden").val(jQuery("#emailContact").val());
	    			jQuery("#emailNoteHidden").val(jQuery("#emailNote").val());
	    			if (jQuery("#emailContactHidden").val()==""){
	    				return false;
	    			} 
	    			var formData=new FormData(jQuery("#fileUpload")[0]);
	    			
	    			jQuery("#fileUpload").ajaxSubmit({
	    				success:function(data){
	    					jQuery("#step4_upload").html(data);
	    				}
	    			});
	    		}
    		} else if (newIndex==0) {
    			return true;
    		} else if (newIndex==1) {
    			// Check all the question has been answered
    			if (jQuery("[name='hasInsurance']:checked").val()==1){
    				if (jQuery("[name='how']:checked").length==0){
    					return false;
    				}
    			} else {
    				// Under constrcution
    				return false;
    			}
    		} else if (newIndex==2) {
    			
    			if (jQuery("[name='how']:checked").val()=="form"){
	    			return validateForm();
	    		} else {
	    			if (jQuery("#upload").val()!=""){
		    			return true;
		    		} else {
		    			return false;
		    		}
	    			
	    		}
    		}


    		if (currentIndex==0){
    			
    		} else if (currentIndex==1) {
    			

    		} else if (currentIndex==2) {

    			
    			
    		} 



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
		jQuery("#dob").datepicker({
			dateFormat:"dd/mm/yy",
		});

		jQuery("#insurer").change(function(){
			var insurer=jQuery("#insurer").val();
			jQuery.ajax({
			  url: '../subPages/getProductOptionHTML.php',
			  type: 'POST',
			  dataType: 'html',
			  data: {insurer:insurer},
			  success: function(data, textStatus, xhr) {
			    jQuery("#product").html(data);
			  }
			});
			
			
		})


	});

	

    

</script>
</html>