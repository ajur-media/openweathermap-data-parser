<?php
/**
 * OpenWeatherMap-PHP-API — A php api to parse weather data from http://www.OpenWeatherMap.org .
 *
 * @license MIT
 *
 * Please see the LICENSE file distributed with this source code for further
 * information regarding copyright and licensing.
 *
 * Please visit the following links to read about the usage policies and the license of
 * OpenWeatherMap before using this class:
 *
 * @see http://www.OpenWeatherMap.org
 * @see http://www.OpenWeatherMap.org/terms
 * @see http://openweathermap.org/appid
 */

namespace AJUR\OpenWeatherMap;

use AJUR\OpenWeatherMap\Util\City;

/**
 * Class WeatherHistory.
 */
class WeatherHistory implements \Iterator
{
    /**
     * The city object. IMPORTANT: Not all values will be set
     *
     * @var Util\City
     */
    public $city;

    /**
     * The time needed to calculate the request data.
     *
     * @var float
     */
    public $calctime;

    /**
     * An array of {@link WeatherHistory} objects.
     *
     * @var array
     *
     * @see WeatherForecast The WeatherForecast class.
     */
    private $histories;

    /**
     * @internal
     */
    private $position = 0;

    public function __construct($weatherHistory, $query)
    {
        if (isset($weatherHistory['list'][0]['city'])) {
            $country = $weatherHistory['list'][0]['city']['country'];
            $population = $weatherHistory['list'][0]['city']['population'];
        } else {
            $country = null;
            $population = null;
        }

        $this->city = new City(
            $weatherHistory['city_id'],
            (is_string($query)) ? $query : null,
            $query['lat'] ?? null,
            $query['lon'] ?? null,
            $country,
            $population
        );
        $this->calctime = $weatherHistory['calctime'];

        $utctz = new \DateTimeZone('UTC');
        foreach ($weatherHistory['list'] as $history) {
            $units = isset($history['rain']) ? array_keys($history['rain']) : [0 => null];

            $this->histories[] = new History(
                $this->city,
                $history['weather'][0],
                [
                    'now' => $history['main']['temp'],
                    'min' => $history['main']['temp_min'],
                    'max' => $history['main']['temp_max']
                ],
                $history['main']['pressure'],
                $history['main']['humidity'],
                $history['clouds']['all'],
                isset($history['rain']) ? [
                    'val' => $history['rain'][($units[0])],
                    'unit' => $units[0]
                ] : null,
                $history['wind'],
                \DateTime::createFromFormat('U', $history['dt'], $utctz));
        }
    }

    /**
     * @internal
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * @internal
     */
    public function current()
    {
        return $this->histories[$this->position];
    }

    /**
     * @internal
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * @internal
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * @internal
     */
    public function valid()
    {
        return isset($this->histories[$this->position]);
    }
}
