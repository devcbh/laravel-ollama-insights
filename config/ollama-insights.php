<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Ollama Base URL
    |--------------------------------------------------------------------------
    |
    | The base URL for your Ollama API. Defaults to localhost:11434.
    |
    */
    'base_url' => env('OLLAMA_BASE_URL', 'http://localhost:11434'),

    /*
    |--------------------------------------------------------------------------
    | Default Model
    |--------------------------------------------------------------------------
    |
    | The default Ollama model to use for generating insights.
    |
    */
    'model' => env('OLLAMA_MODEL', 'llama2'),

    /*
    |--------------------------------------------------------------------------
    | Request Timeout
    |--------------------------------------------------------------------------
    |
    | Timeout in seconds for API requests to Ollama.
    |
    */
    'timeout' => env('OLLAMA_TIMEOUT', 30),

    /*
    |--------------------------------------------------------------------------
    | Insight Templates
    |--------------------------------------------------------------------------
    |
    | Pre-defined templates for different types of insights.
    |
    */
    'templates' => [
        'data_analysis' => 'Analyze this dataset and provide key insights: {data}',
        'trend_analysis' => 'Identify trends and patterns in this data: {data}',
        'prediction' => 'Based on this data, predict future outcomes: {data}',
        'summary' => 'Summarize this information concisely: {data}',
    ],
];