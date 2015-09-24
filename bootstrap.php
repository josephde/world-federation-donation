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
    'name'        => 'Donation',
    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
    'department'  => 'Donation'
);

// --------------------------------------------------------------------------

/**
 * This array contains all the campaigns/causes
 *
 * @joseph: you'll most likely want to populate this from the XML file
 */
$campaignsAll = array(
    array(
        'name' => 'Abacus',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        'department' => 'Donation'
    ),
    array(
        'name' => 'Biscuit',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        'department' => 'Donation'
    ),
    array(
        'name' => 'Crumpet',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        'department' => 'Donation'
    ),
    array(
        'name' => 'Yemen Appeal',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non pharetra ligula, eu rutrum mi.',
        'department' => 'Health'
    ),
    array(
        'name' => 'Third one',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non pharetra ligula, eu rutrum mi.',
        'department' => 'Health'
    ),
    array(
        'name' => 'Water fund',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non pharetra ligula, eu rutrum mi.',
        'department' => 'Health'
    ),
    array(
        'name' => 'Tableegh',
        'description' => 'https://www.world-federation.org/content/tableegh',
        'department' => 'Donation'
    ),
    array(
        'name' => 'Darjeeling',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        'department' => 'Donation'
    )
);
