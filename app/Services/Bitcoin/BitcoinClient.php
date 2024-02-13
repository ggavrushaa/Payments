<?php

namespace App\Services\Bitcoin;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Services\Bitcoin\Exceptions\BitcoinException;

class BitcoinClient
{
    public function __construct(
        private readonly BitcoinConfig $config
    ) {

    }

    public function send(string $method, array $params = []): mixed
    {
        $response = Http::withBasicAuth(
            username: $this->config->user,
            password: $this->config->password,
        )->post($this->config->url, [
             'jsonrpc' => '1.0',
             'id' => (string) Str::uuid(),
             'method' => $method,
             'params' => $params,
         ]);

         if(!is_null($response->json('error'))) {
            throw new BitcoinException(
                $response->json('error')['message']
            );
         }
         
        return $response->json('result');
    }
}
