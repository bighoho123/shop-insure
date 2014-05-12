<?php 
	include("../includes/omniumAPI.php");
	$insurer=isset($_POST['insurer'])?$_POST['insurer']:"ACC";

	$products=getProductData();

	$filteredProducts=array();
	foreach($products AS $product){
		// Name fitler
		if ($product->SupplierCode==$insurer){
			// Insurance Type filter (Now it is always life insurance)
			if ($product->hasTRM){
				array_push($filteredProducts,$product);
			}
		}
	}
	echo "<option value='' disabled selected>Select your cover product...</option>";
	foreach($filteredProducts AS $product) {
		echo "<option value='".$product->ProductCode."'>".$product->ProductName."</option>";
	}
?>