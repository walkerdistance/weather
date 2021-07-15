<?php
/**
 * 2021-07-14 1:37 下午
 */

namespace Walkerdistance\Weather\Tests;


use GuzzleHttp\ClientInterface;
use PHPUnit\Framework\TestCase;
use Walkerdistance\Weather\Weather;

class WeatherTest extends TestCase
{
    protected static $key = 'f95704080f4b7ffdbf199a786ad9a8af';

    //测试天气
    public function testGetWeather()
    {

    }
    //参数 type 异常检查
    public function testGetWeatherWithInvalidType()
    {
        $weather = new Weather(self::$key);

    }
    //参数 format 异常检查
    public function testGetWeatherWithInvalidFormat()
    {

    }

    //http请求异常检查
    public function testGetWeatherWithHttp()
    {

    }

    public function testSetGuzzleOptions()
    {

    }

    public function testGetHttpClient()
    {
        $weather = new Weather(self::$key);
        //断言返回结果为 GuzzleHttp\ClientInterface 实例
        $this->assertInstanceOf(ClientInterface::class, $weather->getHttpClient());
    }

    public function testSetUrl()
    {

    }

    public function testGetUrl()
    {

    }
}