<?php

namespace Salehhashemi\LaravelDomainExpert\Services;

use Illuminate\Support\Facades\Http;

class ServiceCall
{
    public function recommend(array $controllers, array $models): string
    {
        $response = Http::post('https://saleh-hashemi.ir/open-ai/domains', [
            'form_params' => [
                'controllers' => $controllers,
                'models' => $models,
            ],
        ]);

        $result = json_decode($response->json(), true);

        return $result['result'];
    }
}
