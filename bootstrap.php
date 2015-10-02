<?php

/**
 * Any common functionality, e.g starting the session or requiring functions.class.php
 */
session_start();

// --------------------------------------------------------------------------

//  The base URL for this page
$baseUrl = '/';

// --------------------------------------------------------------------------

/**
 * Define all the supported currencies
 *
 * @joseph
 */
$currencies = array(
    array(
        'name' => 'GBP',
        'symbol' => '£',
        'selected' => true
    ),
    array(
        'name' => 'EUR',
        'symbol' => '€',
        'selected' => false
    ),
    array(
        'name' => 'USD',
        'symbol' => '$',
        'selected' => false
    )
);

// --------------------------------------------------------------------------

/**
 * The general "Campaign" is an object which will store any donations
 * made outside of a campaign or cause.
 *
 * @joseph: This is hardcoded so that the JS can bind to the object's properties easily.
 *          but go ahead and update the lorem ipsum.
 */
$campaignsGeneral = array(
    'name'        => 'General Donation',
    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
    'department'  => 'Donation'
);

//var_dump($campaignsAll);
// $campaignsAll = csv_to_array('temp-funds.csv');

/*
* This series of nested loops recursively grabs all of the campaigns, if the campaign has attributes it grabs all attributes for the campaign being iterated over 
* and if the attribute has options it does the same for the attribute being iterated over. It then pushes the components to an multidimensional array.
*
* @Pablo the array is ordered in a hierarchical format. The campaign main details are located at the root of the array and the attributes and options are nested in the $fund['attribute']
*and $fund['attribute']['index']['option'] (where index represents a sequential integer). This should make it reasonably easy to traverse the array using for loops. I have included some examples below
*
* Examples:
*
* $fund['name'] - Returns the name of the currently iterated fund
*
* $fund['attributes']['0']['machine_name'] - Returns the machine name of the first attribute belonging to the currently iterated fund
*
* $fund['attributes']['0']['options']['1']['title'] - Returns the title of the second option of the first attribute belonging to the currently iterated fund
*
* Hopefully this should make it reasonably easy to retrieve data from related tables
*
* I use Krumo to look at data within complex arrays as I find it much easier than PHP's native array_dump() which is frankly a bit shite,
* i've committed krumo's files so if you want to use it just correct the path and URL inside the ini file.
*/

	
//Get Attributes
$fund= array();
$attribute_array = array();
foreach ($cart->funds as &$campaign) {
	if ($campaign['has_attributes'] == '1') {
		$sql = "SELECT * FROM attributes WHERE fund_id = ?";
		$query = $cart->db->prepare($sql);
		$query->execute(array($campaign['fund_id']));
		$attribute = $query->fetchAll();
		
		//Get options
		foreach ($attribute as &$attribute) {
			if($attribute['has_options'] == "1") {
				$sql = "SELECT * FROM options WHERE parent_id = ?";
				$query = $cart->db->prepare($sql);
				$query->execute(array($attribute['attribute_id']));
				$option = $query->fetchAll();
				
				$attribute['options'] = $option;								
				$attribute_array = array_merge($attribute, $attribute['options']);
				
				
				
			} else if ($attribute['has_options'] == "0") {				
				$attribute_array = $attribute;					
				$campaign['attributes'][] = $attribute_array;
				
			}
			
		}
		
		$campaign['attributes'][] = $attribute_array;
			
		
		
				
		$fund[] = array_push($fund, array_merge($campaign, $campaign['attributes']));		
		
		
	} else if ($campaign['has_attributes'] == '0'){
	
		$fund[] = array_push($fund, $campaign);
	
	}
}	
	

	
foreach($fund as $key=>$value) {
		if (is_int($value)) {
			unset($fund[$key]);		
			$fund_indexed = array_values($fund);
			
		}
	}

// echo $fund_indexed['1']['attributes']['0'];
	
$campaignsAll = $fund_indexed;
