<?php

namespace App\Providers;

use PhpParser\Parser;
use PhpParser\ParserFactory;
use Illuminate\Support\ServiceProvider;
use DeGraciaMathieu\RapidBind\Facades\RapidBind;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        RapidBind::bind([
            'app/Domain/Ports',
        ]);

        $this->app->bind(Parser::class, function () {
            return (new ParserFactory())->createForHostVersion();
        });
    }
}
