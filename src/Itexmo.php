<?php

namespace CreatvStudio\Itexmo;

use Exception;
use Zttp\Zttp;
use GuzzleHttp\Client;
use CreatvStudio\Itexmo\Message;
use Tightenco\Collect\Support\Collection;
use CreatvStudio\Itexmo\Exceptions\ItexmoRequestException;

class Itexmo
{
    protected $baseUrl = 'https://www.itexmo.com/php_api/';

    protected $apiCode;

    protected $password;

    protected $message;

    public function __construct($apiCode, $password = null) {
        $this->apiCode = $apiCode;
        $this->password = $password;
        $this->message = new Message;
    }

    public function to($to)
    {
        $this->message->to = $to;

        return $this;
    }

    public function content($content)
    {
        $this->message->content = $content;

        return $this;
    }

    public function sender($sender)
    {
        $this->message->sender = $sender;

        return $this;
    }

    public function server($server)
    {
        $this->message->server = $server;

        return $this;
    }

    public function priority($priority)
    {
        $this->message->priority($priority);

        return $this;
    }

    public function message($name = null, $default = null)
    {
        if (! $name) {
            return $this->message->toArray();
        }

        return $this->message->get($name, $default);
    }

    public function http()
    {
        return new Client(['base_uri' => $this->baseUrl]);
    }

    public function send($params = null)
    {
        if (! is_null($params) && ! is_array($params)) {
            throw new Exception('$params is expected to be an array');
        }

        if (! is_null($params)) {
            $this->message = new Message($params);
        }

        try {
            $response  = $this->http()->post('api.php', [
                'form_params' => $this->getMessageRequestParams(),
            ]);

            if (trim($response->getBody()) !== '0') {
                throw new ItexmoRequestException('Itexmo response error: '.$response->getBody());
            }

            return $this->message;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function status()
    {
        return Zttp::get($this->url('serverstatus.php'), [
            'apicode' => $this->apiCode,
        ])->json();
    }

    public function url($edge)
    {
        return trim($this->baseUrl, '/') . '/' . trim($edge, '/');
    }

    public function getMessageRequestParams()
    {
        $params = [
            '1' => $this->message->get('to'),
            '2' => $this->message->get('content'),
            '3' => $this->apiCode,
            '5' => $this->message->get('priority'),
            '6' => $this->message->get('sender'),
            '7' => $this->message->get('server'),
            'passwd' => $this->password,
        ];

        return (new Collection($params))->filter(function($item) {
            return ! is_null($item);
        })->toArray();
    }
}
