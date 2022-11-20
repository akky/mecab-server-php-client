<?php
declare(strict_types=1);

namespace Akky\Tests;

use PHPUnit\Framework\TestCase;
use Akky\MecabClient;

use GuzzleHttp\RequestOptions;
use GuzzleHttp\Client as GuzzleClient;

class MecabClientTest extends TestCase
{
    const JSON_DEPTH_LIMIT = 300;

    /**  */
    public function testSomething(): void
    {
        $this->assertTrue(true);
    }

    /**  */
    public function testGuzzleCall(): void
    {
        $baseUrl = 'http://localhost:8080/';
        $config = [

        ];
        $guzzleClient = new GuzzleClient(['base_uri' => $baseUrl]+ $config);

        $method = 'POST';
        $headers = [
            'Accept-Encoding'           => 'gzip, deflate, br',
            'Accept-Language'           => 'ja,en-US;q=0.8,en;q=0.6',
            'Upgrade-Insecure-Requests' => '1',
            'User-Agent'                => 'PHP-Mecab-Client 1.0',
            'Content-Type'              => 'application/json',
            'Accept'                    => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
            'Cache-Control'             => 'max-age=0',
        ];
        $params = [
        
        ];
        $options = [
            'json' => [
                'texts' => [
                    '日本語ですよ',
                    'これが二文目のリクエストです。',
                ]
            ]
        ];
        if (sizeOf($params) > 0) {
            $contentKey = strtoupper($method) == 'GET' ? RequestOptions::QUERY : RequestOptions::JSON;
            $options = [$contentKey => $params] + $options;
        }

        if (sizeof($headers) > 0) {
            $options = [RequestOptions::HEADERS => $headers] + $options;
        }

        $path = '/parse';
        $response = $guzzleClient->request($method, $path, $options);

        $body = json_decode((string) $response->getBody(), false, static::JSON_DEPTH_LIMIT, JSON_THROW_ON_ERROR);
var_dump($body);
        $this->assertTrue(true);
    }


}