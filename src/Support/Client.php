<?php
/**
 * Created by PhpStorm.
 * User: yemeishu
 * Date: 2018/2/20
 * Time: 下午4:46
 */

namespace Fanly\Msgrobot\Support;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

class Client {
    public function httpPostJson(string $accesstoken, array $data = []) {
        info(json_encode($data));
        info($accesstoken);
        $client = new GuzzleClient();
        $promise = $client->requestAsync('POST',
            'https://oapi.dingtalk.com/robot/send',
            [
                'query' => ['access_token' => $accesstoken],
                'headers' => [
                    'Accept' => 'application/json'
                ],
                'json' => $data
            ]);
        $promise->then(
            function (ResponseInterface $res) {
                info($res->getStatusCode());
            },
            function (RequestException $e) {
                info($e->getMessage());
            }
        );
        $promise->wait();
    }
}