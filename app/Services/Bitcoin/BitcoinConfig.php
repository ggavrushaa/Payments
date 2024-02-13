<?php

namespace App\Services\Bitcoin;

readonly class BitcoinConfig
{
 public function __construct(
     public string $url,
     public string $user,
     public string $password,
 ) {

 }
}
