<?php

namespace Devcbh\OllamaInsights;

use Illuminate\Support\ServiceProvider;
use Devcbh\OllamaInsights\Console\Commands\GenerateInsightsCommand;
use Devcbh\OllamaInsights\Facades\OllamaInsights;
use Devcbh\OllamaInsights\Services\OllamaService;

class OllamaInsightsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/ollama-insights.php' => config_path('ollama-insights.php'),
            ], 'config');

            $this->commands([
                GenerateInsightsCommand::class,
            ]);
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/ollama-insights.php', 'ollama-insights');

        $this->app->singleton(OllamaService::class, function ($app) {
            return new OllamaService(
                config('ollama-insights.base_url'),
                config('ollama-insights.timeout'),
                config('ollama-insights.model'),
                config('ollama-insights.api_key')
            );
        });
    }
}
