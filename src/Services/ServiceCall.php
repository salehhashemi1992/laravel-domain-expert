<?php

namespace Salehhashemi\LaravelDomainExpert\Services;

use Illuminate\Support\Facades\Http;

class ServiceCall
{
    public function recommend(string $controllers, string $models): string
    {
        $response = Http::asForm()->post('https://saleh-hashemi.ir/open-ai/domains', [
            'controllers' => $controllers,
            'models' => $models,
        ]);

        return $response->body();
    }
}
