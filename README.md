OpenWeatherMap PHP API
======================

A PHP class to retrieve and parse weather data from [OpenWeatherMap.org](http://www.OpenWeatherMap.org). 

This library aims to normalise the provided data and remove some inconsistencies.
This library is neither maintained by OpenWeatherMap nor their official PHP API.

<!-- 
[![Build Status](https://travis-ci.org/cmfcmf/OpenWeatherMap-PHP-Api.svg?branch=master)](https://travis-ci.org/cmfcmf/OpenWeatherMap-PHP-Api)
[![license](https://img.shields.io/github/license/cmfcmf/OpenWeatherMap-PHP-Api.svg)](https://github.com/cmfcmf/OpenWeatherMap-PHP-Api/blob/master/LICENSE)
[![release](https://img.shields.io/github/release/cmfcmf/OpenWeatherMap-PHP-Api.svg)](https://github.com/cmfcmf/OpenWeatherMap-PHP-Api/releases)
[![codecov](https://codecov.io/gh/cmfcmf/OpenWeatherMap-PHP-Api/branch/master/graph/badge.svg)](https://codecov.io/gh/cmfcmf/OpenWeatherMap-PHP-Api)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/cmfcmf/OpenWeatherMap-PHP-Api/badges/quality-score.png?s=f31ca08aa8896416cf162403d34362f0a5da0966)](https://scrutinizer-ci.com/g/cmfcmf/OpenWeatherMap-PHP-Api/)
<br>
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/0addfb24-e2b4-4feb-848e-86b2078ca104/big.png)](https://insight.sensiolabs.com/projects/0addfb24-e2b4-4feb-848e-86b2078ca104)
-->

Installation
============
This library can be found on [Packagist](https://packagist.org/packages/cmfcmf/openweathermap-php-api).
The recommended way to install and use it is through [Composer](http://getcomposer.org).

    composer require ajur-media/openweathermap-data-parser


Example call
============
```php
<?php
use AJUR\OpenWeatherMap;
use AJUR\OpenWeatherMap\Exception as OWMException;

// Must point to composer's autoload file.
require 'vendor/autoload.php';

// Language of data (try your own language here!):
$lang = 'ru';

// Units (can be 'metric' or 'imperial' [default]):
$units = 'metric';

// Create OpenWeatherMap object. 
// Don't use caching (take a look into Examples/Cache.php to see how it works).
$owm = new OpenWeatherMap('YOUR-API-KEY');

try {
    $weather = $owm->getWeather('Berlin', $units, $lang);
} catch(OWMException $e) {
    echo 'OpenWeatherMap exception: ' . $e->getMessage() . ' (Code ' . $e->getCode() . ').';
} catch(\Exception $e) {
    echo 'General exception: ' . $e->getMessage() . ' (Code ' . $e->getCode() . ').';
}

echo $weather->temperature;
```

<!-- 
For more example code and instructions on how to use this library, please take a look into  the `Docs` folder. 

Make sure to get an API Key from http://home.openweathermap.org/ and put it into `Docs/ApiKey.ini`.
- `CurrentWeather.php` Shows how to receive the current weather.
- `WeatherForecast.php` Shows how to receive weather forecasts.
- `WeatherHistory.php` Shows how to receive weather history.
- `Cache.php` Shows how to implement and use a cache.
-->

License
=======
MIT — Please see the [LICENSE file](https://github.com/Cmfcmf/OpenWeatherMap-PHP-Api/blob/master/LICENSE)
distributed with this source code for further information regarding copyright and licensing.

**Please check out the following official links to read about the terms, pricing 
and license of OpenWeatherMap before using the service:**
- [OpenWeatherMap.org/terms](http://OpenWeatherMap.org/terms)
- [OpenWeatherMap.org/appid](http://OpenWeatherMap.org/appid)
