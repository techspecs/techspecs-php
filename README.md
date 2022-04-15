![TechSpecs Logo](https://i.imgur.com/JwSpZO8.jpg)
![TechSpecs Logo](https://i.imgur.com/JZ3GqAU.jpg)

# Introducing TechSpecs PHP

This php library provides automatic access to the standardized technical specifications of the world's consumer electronics, including the latest smartphones, tablets, smartwatches, laptops, and more. 


## Documentation

-   See the [TechSpecs API Docs](https://techspecs.readme.io)

## API Key

-   Get a TechSpecs [API Key](https://developer.dashboard.techspecs.io/)


## Requirements

-   PHP 7.4+
-   Composer


## Installation

```sh
composer require techspecs/techspecs-php
```

## Usage

The library needs to be configured with your account's api key and base which is
available in your [TechSpecs Dashboard](https://developer.dashboard.techspecs.io/). 

Set `$techSpecsKey` to your key value and `$techSpecsBase` to your base value.

### Basic Search
#### Search for a device by specifying it's model name, version number or features 

```php
require 'vendor/autoload.php';

// Importing the SDK class
use TechSpecsSDK\TechSpecsSDK;

// TechSpecs API Key
$techSpecsKey = 'techspecs_api_key';

// TechSpecs base https://apis.dashboard.techspecs.io/{techspecs_base}
$techSpecsBase = 'a8TD3mkN49fhg2y';

// Instantiate the Library
$techSpecs = new TechSpecsSDK($techSpecsBase, $techSpecsKey);

// product name or version number to search
$keyword = 'iPhone 13';

// product category to search
$category = ['all'];

// choose between "pretty" or "raw" mode for viewing response
$response = $techSpecs->search($keyword, $category, 'pretty');

// print the search results
print($response);

```

### Advanced Search
#### List all products by brand, category and release date
```php
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

```

### Product Details

```php
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

```

### List all brands
```php
require 'vendor/autoload.php';

// Importing the SDK class
use TechSpecsSDK\TechSpecsSDK;

// TechSpecs API Key
$techSpecsKey = 'techspecs_api_key';

// TechSpecs base https://apis.dashboard.techspecs.io/{techspecs_base}
$techSpecsBase = 'a8TD3mkN49fhg2y';

// Instantiate the Library
$techSpecs = new TechSpecsSDK($techSpecsBase, $techSpecsKey);

// choose between "pretty" or "raw" mode for viewing response
$response = $techSpecs->brands('pretty');

// print the search results
print($response);

```
### List all categories    
```php
require 'vendor/autoload.php';

// Importing the SDK class
use TechSpecsSDK\TechSpecsSDK;

// TechSpecs API Key
$techSpecsKey = 'techspecs_api_key';

// TechSpecs base https://apis.dashboard.techspecs.io/{techspecs_base}
$techSpecsBase = 'a8TD3mkN49fhg2y';
// Instantiate the Library
$techSpecs = new TechSpecsSDK($techSpecsBase, $techSpecsKey);

// choose between "pretty" or "raw" mode for viewing response
$response = $techSpecs->categories('pretty');

// print the list of all categories
print($response);

This PHP SDK provides access to the standardized technical specifications of over 19,000 consumer electronics devices, including the latest smartphones, tablets, smartwatches, laptops, and more.
```


