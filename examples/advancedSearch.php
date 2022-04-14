<?php
require 'vendor/autoload.php';

// Importing the SDK class
use TechSpecsSDK\TechSpecsSDK;

// TechSpecs API Key
$techSpecsKey = 'techspecs_api_key';

// TechSpecs base https://apis.dashboard.techspecs.io/{techspecs_base}
$techSpecsBase = 'a8TD3mkN49fhg2y';

// Instantiate the Library
$techSpecs = new TechSpecsSDK($techSpecsBase, $techSpecsKey);

// enter the page number to fetch results from
$page = 1;

/**
 * Type in the name of the brand you're looking for
 * or leave this field empty to see results from all brands
 */
$brand = ['Apple'];

/**
 * Type in the name of the category you're looking for
 * or leave this field empty to see results from all categories
 */
$category = ['smartphone'];

/**
 * Please provide a date range to narrow your search.
 * Leave this field empty to fetch all results from all dates
 */
$dateFrom = '2010-01-01'; // YYYY-MM-DD
$dateTo = '2022-03-15'; // YYYY-MM-DD

// Choose between "pretty" or "raw" mode for viewing response
$response = $techSpecs->products(
    $brand,
    $category,
    $dateFrom,
    $dateTo,
    $page,
    'pretty'
);

// Print the search results
print($response);
