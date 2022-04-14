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

// TechSpecs product id
$techspecsId = '6186b047987cda5f88311983';

// choose between "pretty" or "raw" mode for viewing response
$response = $techSpecs->productDetail($techspecsId, 'pretty');

// print the specifications of the product
print($response);
