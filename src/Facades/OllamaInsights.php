<?php

namespace Devcbh\OllamaInsights\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string|null generateCompletion(string $prompt, string|null $model = null)
 * @method static string|null generateInsight(string $templateKey, array $data, string|null $model = null)
 * @method static array listModels()
 *
 * @see \Devcbh\OllamaInsights\Services\OllamaService
 */
class OllamaInsights extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Devcbh\OllamaInsights\Services\OllamaService::class;
    }
}