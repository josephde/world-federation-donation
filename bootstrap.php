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

// --------------------------------------------------------------------------

/**
 * This array contains all the campaigns/causes
 *
 * @joseph: you'll most likely want to populate this from the database; a
 * simple hack for the time being though.
 */

/**
 * @link http://gist.github.com/385876
 */
function csv_to_array($filename = '', $delimiter = ',')
{
    if (!file_exists($filename) || !is_readable($filename)) {
        return false;
    }

    $header = null;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== false) {

        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {

            if (!$header) {
                $header = $row;
            } else {
                $data[] = array_combine($header, $row);
            }
        }
        fclose($handle);
    }
    return $data;
}


$campaignsAll = csv_to_array('temp-funds.csv');
