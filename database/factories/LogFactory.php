<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class LogFactory extends Factory
{

    public function definition()
    {
        $service_names = ['USER-SERVICE', 'INVOICE-SERVICE', 'AUTH-SERVICE', 'PAYMENT-SERVICE'];
        $statuses = [201, 200, 400, 401, 403];
        $endpoints = ['/users', '/invoices', '/invoices/1', 'users/2'];
        $methods = ['GET', 'POST'];

        return [
            'service_name' => fake()->randomElements($service_names),
            'method' =>  fake()->randomElements($methods),
            'endpoint' => fake()->randomElements($endpoints),
            'status_code' => fake()->randomElements($statuses),
            'looged_at' => Carbon::today()->addDays(rand(1, 365)),

        ];
    }
}
