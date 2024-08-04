<?php

namespace App\Providers;

use PhpParser\Parser;
use PhpParser\ParserFactory;
use App\Domain\Ports\FileRepository;
use App\Domain\Ports\AnalyzerService;
use Illuminate\Support\ServiceProvider;
use App\Infrastructure\Services\AnalyzerServiceAdapter;
use App\Infrastructure\Repositories\FileRepositoryAdapter;

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
        $this->app->bind(AnalyzerService::class, AnalyzerServiceAdapter::class);
        $this->app->bind(FileRepository::class, FileRepositoryAdapter::class);

        $this->app->bind(Parser::class, function () {
            return (new ParserFactory())->createForHostVersion();
        });
    }
}
