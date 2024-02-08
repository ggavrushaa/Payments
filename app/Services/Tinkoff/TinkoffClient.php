<?php

namespace App\Services\Tinkoff;

use Illuminate\Support\Facades\Http;
use App\Services\Tinkoff\TinkoffService;
use Illuminate\Http\Client\PendingRequest;
use App\Services\Tinkoff\Exceptions\TinkoffException;

class TinkoffClient
{
    public function __construct(
        public TinkoffService $tinkoff,
    ) {
        //
    }

    public static function make(TinkoffService $tinkoff): static
    {
        return new static($tinkoff);
    }


    public function post(string $url, array $data): array
    {
        $data['Token'] = $this->createToken($data);

        $response = $this->client()->post($url, $data);

        $response = $response->json();
        if($response['Success'] === false)
        {
            throw new TinkoffException($response['Details']);
        }

        return $response;
    }

    public function client(): PendingRequest
    {
        return Http::baseUrl('https://securepay.tinkoff.ru/v2');
    }

    public function createToken(array $data): string
    {
        unset($data['Token']);

        if(isset($data['Success'])) {
            $data['Success'] = $data['Success'] ? 'true' : 'false';
        }

        $token = $data;
        $token['Password'] = $this->tinkoff->config->password;  
        $token = collect($token)->sortKeys()->implode('');
        $token = hash('sha256', $token);

        return $token;
    }
}
