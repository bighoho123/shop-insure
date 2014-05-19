<?php
// WARNING
// 
// This Omnium SOAP web service is abit of a train wreck. No real errors given (not often), and is difficult to figure out whats going on.
// Generally any problem is: Invalid or empty field values, or Missing fieldnames
// It won't even tell you if your username / pass is wrong, just cryptic error.
//
// If making changes, do one new field/change at a time, then test, add another change, test, etc
//
// Their documentation also fails to mention certain unrequired And REQUIRED fields, so you would never figure if that was the issue without calling one of their programmers 
// to look at your last request and diagnose for you. They seem to save all soap requests.
 


// User name and pass for omnium
$omniumuser = 'USERNAME';
$omniumpass = 'PASSWORD';


// Advisor ID for omnium, fails without it!
$omniumadvisoridentifier = 'test@worksorted.com.au'; // needed to get premiums



$buyBackOptions = array(
						'L' => 'Lowest Premium',
						'F' => 'Fastest Buy Back',
						'0' => 'Zero year, immediate',
						'1' => '1 year',
						'3' => '3 years',
						'4' => '4 years',
						'N' => 'None'
						
					);
					

$incomeProtectionBenefitPeriodOptions = array ('1'		=> '1 year',
												'2'		=> '2 years',
												'5'		=> '5 years',
												'55'	=> 'To age 55',
												'60'	=> 'To age 60',
												'65'	=> 'To age 65',
												'70'	=> 'To age 70'
												);


$businessExpensesBenefitPeriodOptions  = array ('1'		=> '1 year');

$incomeProtectionWaitingPeriodOptions = array('14' 		=> '14 days',
												'30' 	=> '30 days',
												'60' 	=> '60 days',
												'90' 	=> '90 days',
												'180' 	=> '180 days',
												'365' 	=> '1 year',
												'730' 	=> '2 years'
												);


$businessExpensesWaitingPeriodOptions = array('14' 		=> '14 days',
												'30' 	=> '30 days',
												'60' 	=> '60 days',
												'90' 	=> '90 days'												
												);


  
    
	// $wsdl = 'http://dev.omnilife.com.au/OmniLifeWebService/OmniLifeWebService.asmx?wsdl'; // v1.x API deprecated
	$wsdl = "http://uat.omnilife.com.au/api/2/OmniLifeWebService.asmx?wsdl";
	
    $soapclient = new SoapClient($wsdl, array(
                            "trace"=>1,
                            "exceptions"=>0
							
							));
							

$results = getOccupationDataSelectOptionsHtml();

function getDisabilityBuyBackSelectOptionsHtml()
{

	global $buyBackOptions;
	
	$optionsHtml = '';
					
	foreach ($buyBackOptions as $key => $value)
	{
		$optionsHtml .= "<option value='$key'>$value</option>";
	}
	
	return $optionsHtml;

}

function getIncomeProtectionBenefitPeriodSelectOptionsHtml()
{
	global $incomeProtectionBenefitPeriodOptions;	
	$optionsHtml = '';
					
	foreach ($incomeProtectionBenefitPeriodOptions as $key => $value)
		$optionsHtml .= "<option value='$key'>$value</option>";
		
	return $optionsHtml;
}


function getIncomeProtectionWaitingPeriodSelectOptionsHtml()
{
	global $incomeProtectionWaitingPeriodOptions;	
	$optionsHtml = '';
					
	foreach ($incomeProtectionWaitingPeriodOptions as $key => $value)
		$optionsHtml .= "<option value='$key'>$value</option>";
		
	return $optionsHtml;
}

function getBusinessExpensesBenefitPeriodSelectOptionsHtml()
{
	global $businessExpensesBenefitPeriodOptions;	
	$optionsHtml = '';
					
	foreach ($businessExpensesBenefitPeriodOptions as $key => $value)
		$optionsHtml .= "<option value='$key'>$value</option>";
		
	return $optionsHtml;
}
	
function getBusinessExpensesWaitingPeriodSelectOptionsHtml()
{
	global $businessExpensesWaitingPeriodOptions;	
	$optionsHtml = '';
					
	foreach ($businessExpensesWaitingPeriodOptions as $key => $value)
		$optionsHtml .= "<option value='$key'>$value</option>";
		
	return $optionsHtml;
}		
	
function getOccupationDataSelectOptionsHtml()
{
	/**************************************************
	 RESULT SNIPPET:
	
	 [GetOccupationDataResult] => stdClass Object
			(
				[OccupationCount] => 852
				[Occupations] => stdClass Object
					(
						[occupation] => Array
							(
								[0] => stdClass Object
									(
										[Id] => 2
										[Description] =>  Generic 1: University Qualified Professionals / Executives
									)
	
								[1] => stdClass Object
									(
										[Id] => 3
										[Description] =>  Generic 2: Other Qualified Professionals / Clerical
									)
	**************************************************/


	global $soapclient, $omniumuser, $omniumpass;

	$soapParams = array('GetOccupationData' => array(
														'xsDealerName' 		=>	$omniumuser,
														'xsDealerPassword'  => 	$omniumpass
													)
						);

	$result = $soapclient->__soapCall('GetOccupationData', $soapParams);
	
	//echo "<strong>REQUEST SENT:</strong>\n<pre>" . htmlentities(str_replace(array('>', '</'), array(">\n", "\n</"), $soapclient->__getLastRequest())) . "</pre>";
	//echo "<br><br><strong>RESULT:</strong><br>" . print_r($result);		
	
	
	$occupations = $result->GetOccupationDataResult->Occupations->occupation; // occupation is array of objects
	
	$optionsHtml = ''; 
	foreach ($occupations as $key => $value)
	{
		//echo "<br>ID: " . $value->Id . " VAL: " . $value->Description;
		$optionsHtml .= "<option value='{$value->Id}'>{$value->Description}</option>\n";
	}
	
	return $optionsHtml;
}


function getSupplierPDFs()
{
	global $soapclient, $omniumuser, $omniumpass;
	
							
	$soapParams = array('GetPdfFileData' => array(								
															'xsDealerName' 		=>	$omniumuser,
															'xsDealerPassword'  => 	$omniumpass,															
															'xsPdfDocType' 		=>  'PPDS'
												)
						);
												
	$result = $soapclient->__soapCall('GetPdfFileData', $soapParams);
	
					
							
	//echo "<strong>REQUEST SENT:</strong>\n<pre>" . htmlentities(str_replace(array('>', '</'), array(">\n", "\n</"), $soapclient->__getLastRequest())) . "</pre>";	
	//echo "<br><br><strong>RESULT:</strong><textarea>" . print_r($result, true) . "</textarea>";												
	
	
	$pdfs = $result->GetPdfFileDataResult->PdfFiles->pdffile;
	
	$supplierCodeAndPDSDocLink = array();
	
	foreach ($pdfs as $key => $pdf)
	{
		$supplierCodeAndPDSDocLink[$pdf->PdfSupplierCode] = 'http://www.omnilife.com.au/documents/' . $pdf->PdfFileName;
	}
	
	return $supplierCodeAndPDSDocLink;									
}

function getSupplierURLData()
{
	global $soapclient, $omniumuser, $omniumpass;
	
	/********* RESULT SNIPPET
	
[GetSupplierDataResult] => stdClass Object
        (
            [SupplierCount] => 14
            [Suppliers] => stdClass Object
                (
                    [supplier] => Array
                        (
                            [0] => stdClass Object
                                (
                                    [SupplierCode] => ACC
                                    [SupplierName] => TAL
                                    [SupplierProducts] => ACC8 ACC7 ACC6 ACC5 ACC4 ACC3 ACC2 ACC1 
                                    [SupplierID] => 3
                                    [SupplierURL] => www.tal.com.au
                                    [SupplierDiscountText] => Policy Rate
                                    [SupplierLogoURL] => static.omnilife.com.au/images/supplierlogo/100x57/ACC.png
                                    [SupplierCMAPRating] => NR
                                )


	*/
							
	$soapParams = array('getSupplierData' => array(								
															'xsDealerName' 		=>	$omniumuser,
															'xsDealerPassword'  => 	$omniumpass
												)
						);
												
	$result = $soapclient->__soapCall('getSupplierData', $soapParams);
	
																
	
	
	$suppliers = $result->GetSupplierDataResult->Suppliers->supplier;
	
	$supplierCodeAndLogoLink = array();
	
	foreach ($suppliers as $key => $supplier)
	{
		$supplierCodeAndLogoLink[$supplier->SupplierCode] = 'http://' . $supplier->SupplierLogoURL;
	}
	
	return $supplierCodeAndLogoLink;							
}

function getSupplierData()
{
	global $soapclient, $omniumuser, $omniumpass;
	
	/********* RESULT SNIPPET
	
[GetSupplierDataResult] => stdClass Object
        (
            [SupplierCount] => 14
            [Suppliers] => stdClass Object
                (
                    [supplier] => Array
                        (
                            [0] => stdClass Object
                                (
                                    [SupplierCode] => ACC
                                    [SupplierName] => TAL
                                    [SupplierProducts] => ACC8 ACC7 ACC6 ACC5 ACC4 ACC3 ACC2 ACC1 
                                    [SupplierID] => 3
                                    [SupplierURL] => www.tal.com.au
                                    [SupplierDiscountText] => Policy Rate
                                    [SupplierLogoURL] => static.omnilife.com.au/images/supplierlogo/100x57/ACC.png
                                    [SupplierCMAPRating] => NR
                                )


	*/
							
	$soapParams = array('getSupplierData' => array(								
															'xsDealerName' 		=>	$omniumuser,
															'xsDealerPassword'  => 	$omniumpass
												)
						);
												
	$result = $soapclient->__soapCall('getSupplierData', $soapParams);
	
																
	
	
	$suppliers = $result->GetSupplierDataResult->Suppliers->supplier;
	
	$supplierCodeAndLogoLink = array();
	
	foreach ($suppliers as $key => $supplier)
	{
		// $supplierCodeAndLogoLink[$supplier->SupplierCode] = 'http://' . $supplier->SupplierLogoURL;
		$supplierCodeAndLogoLink[$supplier->SupplierCode] = $supplier->SupplierName;
	}
	
	return $supplierCodeAndLogoLink;							
}

function getProductData(){
	global $soapclient,$omniumuser,$omniumpass;
	$soapParams = array('getProductData' => array(								
															'xsDealerName' 		=>	$omniumuser,
															'xsDealerPassword'  => 	$omniumpass
												)
						);
	$result = $soapclient->__soapCall('getProductData', $soapParams);

	$products = $result->GetProductDataResult->Products->product;
	

	
	return $products;	
}

					

/* Client Information for quote */
function getQuotes(
	$firstname = 'unknown', $lastname = 'unknown', $dob = '01.01.1970', $gender = 'M', $state, $smoker = true, $annualincome = 0, $occupationId, $premiumstructure = 'L', // client details & misc
	$trm_coveramount = 0, // life insurance
	$tpd_coveramount = 0, $tpd_buyback, $tpd_doubletpd, $tpd_occupationtype, // disability insurance
	$tra_coveramount = 0, $tra_buyback, $tra_doubletrauma, $tra_traumareinstatements, $tra_level, // trauma insurance
	$inc_monthlycoveramount = 0, $inc_benefitperiod, $inc_waitingperiod, $inc_accidentbenefit, $inc_agreedvalue, $inc_increasingclaim, $inc_level, // income insurance
	$bus_monthlycoveramount = 0, $bus_benefitperiod, $bus_waitingperiod // business insurance
	)
{				
	global $soapclient, $omniumuser, $omniumpass;
	global $omniumadvisoridentifier;
	

	
	$dobArr = explode('.', $dob); // d.m.y
	if (date('n') >= $dobArr[1] && date('j') >= $dobArr[0]) // if month and day today is after the birthday this year for this client..
		$ageNextBirthday = date('Y') - $dobArr[2] + 1;
	else
		$ageNextBirthday = date('Y') - $dobArr[2];
	
	// Misc dsupplier ata to send back along with quotes found
	$pdfData = getSupplierPDFs(); // Get PDS of suppliers
	$supplierData = getSupplierURLData(); // Get misc details, logo, home page, etc
	
							
	$soapParams = array('GetPortfolioResultPremium' => array(
	
															'xoQuoteReferences'	=> 	array(
																							'ExternalReferenceID'		=> '123abc'
																						),
																						
															'xsDealerName' 		=>	$omniumuser,
															'xsDealerPassword'  => 	$omniumpass,
															
															'xoAdviserData' 	=>  array(
															 								'xsAdviserIdentifier' 		=> $omniumadvisoridentifier,
																							'xsAdviserScoreWeightingUsed' => '', // no idea
																							'xiAdviserPriceWeighting'	=> '50',
																							'xiAdviserCommissionOptionID'=>'0',
																							'xiAdviserScoringType'=>'0'
																						),
															
															'xoClientData'		=>	array(
																							/* 'xsClientTitle				=> '' CANT FIND IN THEIR BAD PDF */ 
																							'xsClientFirstName'			=> $firstname,
																							'xsClientLastName'			=> $lastname,
																							'xsClientDOB'				=> $dob,
																							'xiClientANB'				=> $ageNextBirthday,
																							'xsClientGender'			=> $gender, // M or F
																							'xbClientSmoker'			=> $smoker,
																							'xiClientAnnualIncome'		=> $annualincome,
																							'xsOccupationID'			=> $occupationId,
																							'xbOccupationMapOverridden' => false
																							
																							
																						),
																						
															'xoQuoteData'		=> 	array(	
																							'xbPremOptInternalSuper'	=> false,
																							'xsPremOptLumpSumPremiumStructure' => $premiumstructure, // "S" for stepped or "L" for level
																							'xiPremOptTrmSumInsured'	=> $trm_coveramount,	
																							'xiPremOptTpdSumInsured'	=> $tpd_coveramount,
																							
																							'xsPremOptTpdOccupationType'=> $tpd_occupationtype, // "A" = Any, "O" = Own
																							'xsPremOptTpdBuyback'		=> $tpd_buyback,
																							'xsPremOptTpdDouble'		=> $tpd_doubletpd,
																							
																							'xiPremOptTraSumInsured'	=> $tra_coveramount,
																							
																							'xsPremOptTraBuyback'		=> $tra_buyback,
																							'xsPremOptTraDouble'		=> $tra_doubletrauma,
																							'xsPremOptTraTRR'			=> $tra_traumareinstatements,
																							'xsPremOptIncPremiumStructure'=>$premiumstructure,
																							
																							'xiPremOptIncMonthlyBenefit'=> $inc_monthlycoveramount,
																							
																							'xsPremOptIncAgreed'			=> $inc_agreedvalue,
																							'xsPremOptIncAIDS'			=> 'Y',
																							'xsPremOptIncABO'			=> $inc_accidentbenefit,
																							'xsPremOptIncICB'			=> $inc_increasingclaim,
																							'xsPremOptIncWaitingPeriod' => $inc_waitingperiod,
																							'xsPremOptIncBenefitPeriod' => $inc_benefitperiod,
																						 	'xsPremOptBusPremiumStructure'=>$premiumstructure,
																							
																							'xiPremOptBusMonthlyBenefit'=> $bus_monthlycoveramount,
																							
																							'xsPremOptBusAIDS'			=> 'Y',
																							'xsPremOptBusWaitingPeriod' => $bus_waitingperiod,																							
																					
																							'xsPremOptBusBenefitPeriod' => $bus_benefitperiod,
																							
																							
																							
																							'xsPremOptState'			=> $state, // SA, NSW, etc
																							'xiPremOptClientNum'		=> 1, // same as clientTot...?
																							'xiPremOptClientTot'		=> 1, // number of clients
																							'xiPremOptPremAvgYear'		=> 1, // leave as 1 seems best for random quotes
																							'xsINCLevel'				=> $tra_level, // C = cheaper, B = Best, used when finding product per supplier
																							'xsTRALevel'				=> $inc_level
																							
																						)
															)
						);
	// Call wsdl function
	$result = $soapclient->__soapCall('GetPortfolioResultPremium', $soapParams); 	
	
					
							
	
	
	
	$cleanedPortfolioArr = array();
	
	$portfolioArr = $result->GetPortfolioResultPremiumResult->PortfolioResults->portfolio; // array
	
	
	foreach ($portfolioArr as $key => $supplier)
	{
	

		if ($supplier->hasTRM === false)
			continue;// Suplier had nothing for this combo of products (or something).
		
		$premiums = $supplier->PremiumArray->premiums; //0 = yearly, 1 = half-yearly, 2 = quarterly, 3 = monthly

		$cleanedPortfolioArr[$supplier->SupplierCode] = 
		
		array(
				'logourl' 	=> (!empty($supplierData[$supplier->SupplierCode]) ? $supplierData[$supplier->SupplierCode] : ''),
			  	'pdsurl'	=> (!empty($pdfData[$supplier->SupplierCode]) ? $pdfData[$supplier->SupplierCode] : ''),
		
				'premiums' 	=> array(
					'0' =>  array('trm' 	=> 	$premiums[0]->PremiumTRM,
												'tpd' 	=>	$premiums[0]->PremiumTPD, 
												'tra' 	=>	$premiums[0]->PremiumTRA, 
												'inc' 	=>	$premiums[0]->PremiumINC, 
												'bus' 	=>	$premiums[0]->PremiumBUS,
												'fee' 	=>	$premiums[0]->PremiumFEE, 
												'total' =>	$premiums[0]->PremiumTOT),
					'1' => array('trm'=> 	$premiums[1]->PremiumTRM,
												'tpd' 	=>	$premiums[1]->PremiumTPD, 
												'tra' 	=>	$premiums[1]->PremiumTRA, 
												'inc' 	=>	$premiums[1]->PremiumINC, 
												'bus' 	=>	$premiums[1]->PremiumBUS,
												'fee' 	=>	$premiums[1]->PremiumFEE, 
												'total' =>	$premiums[1]->PremiumTOT),
					'2' => array('trm'	=> 	$premiums[2]->PremiumTRM,
												'tpd' 	=>	$premiums[2]->PremiumTPD, 
												'tra' 	=>	$premiums[2]->PremiumTRA, 
												'inc' 	=>	$premiums[2]->PremiumINC, 
												'bus' 	=>	$premiums[2]->PremiumBUS,
												'fee' 	=>	$premiums[2]->PremiumFEE, 
												'total' =>	$premiums[2]->PremiumTOT),
					'3' => array('trm' 	=> 	$premiums[3]->PremiumTRM,
												'tpd' 	=>	$premiums[3]->PremiumTPD, 
												'tra' 	=>	$premiums[3]->PremiumTRA, 
												'inc' 	=>	$premiums[3]->PremiumINC, 
												'bus' 	=>	$premiums[3]->PremiumBUS,
												'fee' 	=>	$premiums[3]->PremiumFEE, 
												'total' =>	$premiums[3]->PremiumTOT)
					),
				'score' => $supplier->ScoreRaw,
				'productCode' => $supplier->PortfolioProducts,
				'supplierName' => $supplier->SupplierName,
		);
		
		
		
	}
	
	
	return $cleanedPortfolioArr;

}




//getHeadingData();

function getProductFeatures()
{

/** RESULT SNIPPET

[GetHeadingDataResult] => stdClass Object
        (
            [HeadingCount] => 199
            [Headings] => stdClass Object
                (
                    [heading] => Array
                        (
                            [0] => stdClass Object
                                (
                                    [HeadingCode] => ALL_PRODUCT_NAME
                                    [HeadingIndex] => 0
                                    [HeadingName] => Product Name
                                    [Explanation] => Product Name
                                    [CoverType] => ALL
                                    [SequenceNum] => 1000
                                    [isSimple] => 
                                    [SubHeadingCount] => 0
                                    [SubHeadingCodes] => stdClass Object
                                        (
                                        )

                                    [isKey] => 
                                    [hasText] => 1
                                    [isScored] => 
                                    [isWeighted] => 
                                    [isMajorTrauma] => 
                                )
*/

	global $soapclient, $omniumuser, $omniumpass;
	
							
	$soapParams = array('GetHeadingData' => array(								
															'xsDealerName' 		=>	$omniumuser,
															'xsDealerPassword'  => 	$omniumpass
												)
						);
												
	$result = $soapclient->__soapCall('GetHeadingData', $soapParams);
	
					
							
	echo "<strong>REQUEST SENT:</strong>\n<pre>" . htmlentities(str_replace(array('>', '</'), array(">\n", "\n</"), $soapclient->__getLastRequest())) . "</pre>";	
	echo "<br><br><strong>RESULT:</strong><textarea>" . print_r($result, true) . "</textarea>";												
	
	
	$data = $result->GetHeadingDataResult->Headings->heading;
	
	//covertypes = ALL, TRM, TPD, TRA, INC, BUS
	
	$featurecode_name_type = array();
	
	foreach ($data as $key => $value)
	{
		$featurecode_name_type[$value->HeadingCode] = array('name' => $value->HeadingName, 'covertype' => $value->CoverType);
	}
	//print_r($featurecode_name_type);
	return $featurecode_name_type;									



}

//getSubHeadingData('ACC3');

function getSubHeadingData($productcode)
{
	global $soapclient, $omniumuser, $omniumpass;
	
							
	$soapParams = array('GetSubHeadingData' => array(								
															'xsDealerName' 		=>	$omniumuser,
															'xsDealerPassword'  => 	$omniumpass
												)
						);
												
	$result = $soapclient->__soapCall('GetSubHeadingData', $soapParams);
	
					
							
	echo "<strong>REQUEST SENT:</strong>\n<pre>" . htmlentities(str_replace(array('>', '</'), array(">\n", "\n</"), $soapclient->__getLastRequest())) . "</pre>";	
	echo "<br><br><strong>RESULT:</strong><textarea>" . print_r($result, true) . "</textarea>";												
	
	/*
	$pdfs = $result->GetFeatureDataResult->PdfFiles->pdffile;
	
	$supplierCodeAndPDSDocLink = array();
	
	foreach ($pdfs as $key => $pdf)
	{
	
	}
	
	return $supplierCodeAndPDSDocLink;				*/					
}



//getFeaturesForProduct('ACC3');

function getFeaturesForProduct($productcode)
{
	global $soapclient, $omniumuser, $omniumpass;
	
							
	$soapParams = array('GetFeatureData' => array(								
															'xsDealerName' 		=>	$omniumuser,
															'xsDealerPassword'  => 	$omniumpass,
															'xsProductCode'		=> 'ACC3',
															'xsHeadingCode'		=> ''
												)
						);
												
	$result = $soapclient->__soapCall('GetFeatureData', $soapParams);
	
					
						
}


//getSubFeaturesForProduct('ACC3');

function getSubFeaturesForProduct($productcode)
{
	global $soapclient, $omniumuser, $omniumpass;
	
							
	$soapParams = array('GetSubFeatureData' => array(								
															'xsDealerName' 		=>	$omniumuser,
															'xsDealerPassword'  => 	$omniumpass,
															'xsProductCode'		=> 'ACC3',
															'xsSubHeadingCode'	=> ''
												)
						);
												
	$result = $soapclient->__soapCall('GetSubFeatureData', $soapParams);
	
					
							
	echo "<strong>REQUEST SENT:</strong>\n<pre>" . htmlentities(str_replace(array('>', '</'), array(">\n", "\n</"), $soapclient->__getLastRequest())) . "</pre>";	
	echo "<br><br><strong>RESULT:</strong><textarea>" . print_r($result, true) . "</textarea>";												
	
	/*
	$pdfs = $result->GetFeatureDataResult->PdfFiles->pdffile;
	
	$supplierCodeAndPDSDocLink = array();
	
	foreach ($pdfs as $key => $pdf)
	{
	
	}
	
	return $supplierCodeAndPDSDocLink;				*/					
}


						
?>