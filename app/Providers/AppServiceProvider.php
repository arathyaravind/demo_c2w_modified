<?php

namespace App\Providers;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        {
            DB::listen(function(QueryExecuted $event) {
                Log::info(
                    'SQL Query',
                    [
                        $event->sql,
                        $event->bindings,
                        $event->time,
                    ]
                );
            });
        }
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
