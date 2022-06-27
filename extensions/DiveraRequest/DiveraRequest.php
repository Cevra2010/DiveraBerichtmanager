<?php

namespace Zis\Ext\DiveraRequest;

use Http;
use Illuminate\Http\Client\ConnectionException;

class DiveraRequest {


    CONST DIVERA_URL = 'https://www.divera247.com/api/';

    private $apiKey;
    private $method;
    private $version = 2;
    private $data;
    private $put = false;
    private $error = null;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function method($method) {
        $this->method = $method;
    }

    public function put($method) {
        $this->method = $method;
        $this->put = true;
    }

    public function setData($dataArray) {
        $this->data = $dataArray;
    }

    public function v1() {
        $this->version = 1;
    }

    public function execute() {
        $url = $this->buildUrl();
        try {
            if($this->data) {
                if($this->put) {
                    $request = Http::put($url, $this->data)->json();
                }
                else {
                    $request = Http::post($url, $this->data)->json();
                }
            }
            else {
                $request = Http::get($url)->json();
            }
            if(isset($request['success'])) {
                if($this->data) {
                    if($request["success"] == "true") {
                        return true;
                    }
                    else {
                        return false;
                    }
                }
                return $request["data"];
            }
            else {
                $status = $request['status'];
                if($status == 403) {
                    $this->error = "forbidden";
                    return false;
                }
            }
        }
        catch(ConnectionException $e) {
            $this->error = "connection";
        }
        return false;
    }

    private function buildUrl() {
        $url = self::DIVERA_URL;
        if($this->version == 2) {
            $url = $url."v2/";
        }
        $url = $url.$this->method."?accesskey=".$this->apiKey;

        return $url;
    }

    public function getErrorCode() {
        return $this->error;
    }
}
