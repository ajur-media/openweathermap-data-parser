<?php

namespace AJUR;

use AJUR\OpenWeatherMap\CurrentWeather;
use AJUR\OpenWeatherMap\CurrentWeatherGroup;
use AJUR\OpenWeatherMap\Fetcher\FetcherInterface;
use AJUR\OpenWeatherMap\UVIndex;
use AJUR\OpenWeatherMap\WeatherForecast;
use AJUR\OpenWeatherMap\WeatherHistory;
use Psr\Log\LoggerInterface;

interface OpenWeatherMapInterface
{
    public function __construct(string $apiKey = '', FetcherInterface $fetcher = null, $cache = false, int $seconds = 600, LoggerInterface $logger = null);
    public function setLogger(LoggerInterface $logger = null): void;

    public function setApiKey(string $apiKey): void;
    public function getApiKey(): string;

    public function getWeather($query, string $units = 'imperial', string $lang = 'en', string $appid = ''): CurrentWeather;
    public function getWeatherGroup(array $ids, string $units = 'imperial', string $lang = 'en', string $appid = ''): CurrentWeatherGroup;

    public function getWeatherForecast($query, string $units = 'imperial', string $lang = 'en', string $appid = '', int $days = 1): WeatherForecast;
    public function getDailyWeatherForecast($query, string $units = 'imperial', string $lang = 'en', string $appid = '', int $days = 1): WeatherForecast;

    public function getWeatherHistory($query, \DateTime $start, int $endOrCount = 1, string $type = 'hour', string $units = 'imperial', string $lang = 'en', string $appid = ''): WeatherHistory;

    public function getCurrentUVIndex(float $lat, float $lon): UVIndex;
    public function getUVIndex(float $lat, float $lon, \DateTimeInterface $dateTime, string $timePrecision = 'day'): UVIndex;

    public function getRawWeatherData($query, string $units = 'imperial', string $lang = 'en', string $appid = '', string $mode = 'xml'): string;
    public function getRawWeatherGroupData($ids, $units = 'imperial', $lang = 'en', $appid = ''): string;

    public function getRawHourlyForecastData($query, string $units = 'imperial', string $lang = 'en', $appid = '', $mode = 'xml'): string;
    public function getRawDailyForecastData($query, $units = 'imperial', $lang = 'en', $appid = '', $mode = 'xml', $cnt = 16): string;

    public function getRawWeatherHistory($query, \DateTime $start, $endOrCount = 1, $type = 'hour', $units = 'imperial', $lang = 'en', $appid = ''): string;



}