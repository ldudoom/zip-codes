<?php

namespace App\Providers;

use App\Interfaces\DataFilterInterface;
use App\Interfaces\DataLoadInterface;
use App\Interfaces\ParsingDataInterface;
use App\Services\DataFilter;
use App\Services\DataLoad;
use App\Services\ParsingData;
use Illuminate\Support\ServiceProvider;

class ServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DataFilterInterface::class, DataFilter::class);
        $this->app->bind(DataLoadInterface::class, DataLoad::class);
        $this->app->bind(ParsingDataInterface::class, ParsingData::class);
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
