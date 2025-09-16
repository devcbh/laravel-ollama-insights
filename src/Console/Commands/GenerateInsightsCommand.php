<?php

namespace Devcbh\OllamaInsights\Console\Commands;

use Illuminate\Console\Command;
use Devcbh\OllamaInsights\Facades\OllamaInsights;

class GenerateInsightsCommand extends Command
{
    protected $signature = 'ollama:insight 
                            {template : The insight template to use (data_analysis, trend_analysis, prediction, summary)}
                            {--model= : Specific Ollama model to use}
                            {--data= : JSON data to analyze}
                            {--file= : Path to JSON file containing data}';

    protected $description = 'Generate AI insights using Ollama';

    public function handle()
    {
        $template = $this->argument('template');
        $model = $this->option('model');
        $data = $this->getData();

        if (!$data) {
            $this->error('No data provided. Use --data or --file option.');
            return 1;
        }

        $this->info("Generating insight using template: {$template}");

        if ($model) {
            $this->info("Using model: {$model}");
        }

        $insight = OllamaInsights::generateInsight($template, $data, $model);

        if ($insight) {
            $this->newLine();
            $this->info('Insight generated:');
            $this->newLine();
            $this->line($insight);
            $this->newLine();
        } else {
            $this->error('Failed to generate insight. Check logs for details.');
            return 1;
        }

        return 0;
    }

    protected function getData(): ?array
    {
        if ($this->option('data')) {
            return json_decode($this->option('data'), true);
        }

        if ($this->option('file')) {
            $filePath = $this->option('file');
            if (file_exists($filePath)) {
                return json_decode(file_get_contents($filePath), true);
            }
            $this->error("File not found: {$filePath}");
            return null;
        }

        return null;
    }
}