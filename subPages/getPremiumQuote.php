<?php 
	include("../includes/omniumAPI.php");

	// Get the POST data
	$firstname=$_POST['firstname'];
	$surname=$_POST['surname'];
	$dob=$_POST['dob'];
	list($dd,$mm,$yy)=explode("/", $dob);
	$dob=$dd.".".$mm.".".$yy;
	$gender=$_POST['gender'];
	$smoker=$_POST['smoke'];
	$premiumStructure=$_POST['premiumStructure'];
	$benefit=$_POST['benefit'];
	$occupationId=$_POST['occupation'];
	$premiumFreq=$_POST['premiumFreq'];
	$importance=isset($_POST['importance'])?$_POST['importance']:0; // 0 Quality 1 Price


	//Some optional field
	$annualincome=0;
	$tpd_coveramount="";
	$tpd_buyback="";
	$tpd_doubletpd="";
	$tpd_occupationtype="";
	$tra_coveramount="";
	$tra_buyback="";
	$tra_doubletrauma="";
	$tra_traumareinstatements="";
	$tra_level="";
	$inc_monthlycoveramount="";
	$inc_benefitperiod="";
	$inc_waitingperiod="";
	$inc_accidentbenefit="";
	$inc_agreedvalue="";
	$inc_increasingclaim="";
	$inc_level="";
	$bus_monthlycoveramount="";
	$bus_benefitperiod="";
	$bus_waitingperiod="";

	$result=getQuotes(
		$firstname, $surname, $dob, $gender, "NSW", $smoker, $annualincome, $occupationId, $premiumStructure, 
		$benefit, // life insurance
		$tpd_coveramount, $tpd_buyback, $tpd_doubletpd, $tpd_occupationtype, // disability insurance
		$tra_coveramount, $tra_buyback, $tra_doubletrauma, $tra_traumareinstatements, $tra_level, // trauma insurance
		$inc_monthlycoveramount, $inc_benefitperiod, $inc_waitingperiod, $inc_accidentbenefit, $inc_agreedvalue, $inc_increasingclaim, $inc_level, // income insurance
		$bus_monthlycoveramount, $bus_benefitperiod, $bus_waitingperiod // business insurance
		);
	
	$products=getProductData();
	$productMapping=array();
	foreach($products AS $product){
		$productMapping[$product->ProductCode]=$product->ProductName;
	}	

	$sortArray=array();
	foreach($result AS $resultElement){
		if ($importance==0) {
			array_push($sortArray,$resultElement['score']);
		} else {
			array_push($sortArray,$resultElement['premiums'][$premiumFreq]['total']);
		}
	}
	if ($importance==0) {
		array_multisort($sortArray,SORT_DESC,$result);
	} else {
		array_multisort($sortArray,$result);
	}
?>
<table class="table table-condensed table-hover" style='width:100%'>
	<thead>
		<tr>
			<th>Product Name</th>
			<th>Insurer Name</th>
			<th>Premium</th>
			<th>Policy Fee</th>
			<th>Score</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($result AS $resultElement) { ?>
		<tr>
			<td>
				<a href='<?php echo $resultElement['pdsurl'] ?>'><?php echo $productMapping[trim($resultElement['productCode'])];?></a>
			</td>
			<td>
				<?php echo $resultElement['supplierName']; ?> <img style='width:24px' src='<?php echo $resultElement['logourl']; ?>'>
			</td>
			<td>
				<?php echo "$".number_format($resultElement['premiums'][$premiumFreq]['trm'],2); ?>
			</td>
			<td>
				<?php echo "$".number_format($resultElement['premiums'][$premiumFreq]['fee'],2); ?>
			</td>
			<td>
				<?php echo $resultElement['score']; ?>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<div style="width:100%;text-align:right">* The result has been sorted based on the preference you selected earlier.</div>
