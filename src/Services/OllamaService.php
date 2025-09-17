<?php

namespace Devcbh\OllamaInsights\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OllamaService
{
    protected string $baseUrl;
    protected int $timeout;
    protected string $model;
    protected ?string $bearerToken;

    public function __construct(string $baseUrl, int $timeout, string $model, ?string $bearerToken = null)
    {
        $this->baseUrl = $baseUrl;
        $this->timeout = $timeout;
        $this->model = $model;
        $this->bearerToken = $bearerToken;
    }

    public function generateCompletion(string $prompt, ?string $model = null): ?string
    {
        try {
            $model = $model ?? $this->model;

            $http = Http::timeout($this->timeout);

            if ($this->bearerToken) {
                $http = $http->withToken($this->bearerToken);
            }

            $response = $http->post("{$this->baseUrl}/api/generate", [
                'model' => $model,
                'prompt' => $prompt,
                'stream' => false,
            ]);


            if ($response->successful()) {
                return $response->json('response');
            }

            Log::error('Ollama API error', [
                'status' => $response->status(),
                'response' => $response->body(),
            ]);

            return null;

        } catch (\Exception $e) {
            Log::error('Ollama service error: ' . $e->getMessage());
            return null;
        }
    }

    public function generateInsight(string $templateKey, array $data, ?string $model = null): ?string
    {
        $template = config("ollama-insights.templates.{$templateKey}");

        if (!$template) {
            throw new \InvalidArgumentException("Template '{$templateKey}' not found.");
        }

        $prompt = str_replace('{data}', json_encode($data, JSON_PRETTY_PRINT), $template);

        return $this->generateCompletion($prompt, $model);
    }

    public function listModels(): array
    {
        try {
            $http = Http::timeout($this->timeout);

            if ($this->bearerToken) {
                $http = $http->withToken($this->bearerToken);
            }

            $response = $http->get("{$this->baseUrl}/api/tags");

            if ($response->successful()) {
                return $response->json('models', []);
            }

            return [];

        } catch (\Exception $e) {
            Log::error('Failed to fetch Ollama models: ' . $e->getMessage());
            return [];
        }
    }
}