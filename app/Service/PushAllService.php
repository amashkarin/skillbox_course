<?php

namespace App\Service;


use GuzzleHttp\Client;


class PushAllService
{
    protected $apiId;
    protected $apikey;

    public function __construct($apiId, $apikey)
    {
        $this->apiId = $apiId;
        $this->apikey = $apikey;
    }


    public function sendPush($title, $body = '')
    {
        $validator = \Validator::make(compact('title', 'body'), [
            'title' => 'required|max:80',
            'body' => 'max:500',
        ]);

        if ($validator->fails()){
            throw new \Exception(implode(', ', $validator->getMessageBag()->all()));
        }

        $url = 'https://pushall.ru/api.php';
        $sendData = [
            'type' => 'self',
            'id' => $this->apiId,
            'key' => $this->apikey,
            'text' => $body,
            'title' => $title,
        ];

        $httpClient = new Client([
            'base_uri' => $url
        ]);

        $response = $httpClient->post('', [
            'form_params' => $sendData
        ]);

        return $response;
    }
}
