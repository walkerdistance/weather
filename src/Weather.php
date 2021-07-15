<?php
/**
 * 2021-07-14 1:19 下午
 */

namespace Walkerdistance\Weather;

use GuzzleHttp\Client;
use Walkerdistance\Weather\Exceptions\InvalidArgumentException;
use Walkerdistance\Weather\Exceptions\HttpException;

class Weather
{
    /**
     * 高德天气API使用到的API key
     * @var string
     */
    protected $key;

    /**
     * 定义初始化 client 的参数
     * @var array
     */
    protected $guzzleOptions = [];
    /**
     * 定义 请求地址
     * @var string
     */
    protected $url;

    public function __construct(string $key,string $url)
    {
        $this->key = $key;
        $this->setUrl($url);
    }

    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }

    public function setHttpOptions(array $options)
    {
        $this->guzzleOptions = $options;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getWeather(string $city, $type = 'base', $format = 'json')
    {
        if (!\in_array(\strtolower($type), ['base', 'all'])) {
            throw new InvalidArgumentException('参数 type 的值 只允许为 base/all');
        }
        if (!\in_array(\strtolower($format), ['xml','json'])) {
            throw new InvalidArgumentException('参数 format 的值 只允许为 xml/json');
        }
        $query = array_filter([
            'key' => $this->key,
            'city' => $city,
            'output' => $format,
            'extensions' => $type,
        ]);
        try {
            $response = $this->getHttpClient()->get($this->url, [
                'query' => $query,
            ])->getBody()->getContents();

            return $format === 'json' ? json_decode($response) : $response;
        } catch (\Exception $exception) {
            throw new HttpException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}