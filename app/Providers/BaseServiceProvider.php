<?php

namespace App\Providers;

use App\Interface\TicketInterface;
use App\Service\TicketService;
use Illuminate\Support\ServiceProvider;


class BaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TicketInterface::class, TicketService::class);
        $this->app->bind(TicketInterface::class, TicketService::class);
    }


    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
