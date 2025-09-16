```markdown
# Laravel Ollama Insights

[![Latest Version on Packagist](https://img.shields.io/packagist/v/your-vendor/laravel-ollama-insights.svg?style=flat-square)](https://packagist.org/packages/your-vendor/laravel-ollama-insights)
[![Total Downloads](https://img.shields.io/packagist/dt/your-vendor/laravel-ollama-insights.svg?style=flat-square)](https://packagist.org/packages/your-vendor/laravel-ollama-insights)
[![License](https://img.shields.io/packagist/l/your-vendor/laravel-ollama-insights.svg?style=flat-square)](https://packagist.org/packages/your-vendor/laravel-ollama-insights)

A powerful Laravel package that seamlessly integrates Ollama's AI capabilities into your application for generating intelligent insights, data analysis, and predictive modeling.

## ✨ Features

- 🤖 **Ollama Integration**: Full integration with Ollama API for local AI processing
- 📊 **Pre-built Templates**: Ready-to-use templates for common analysis tasks
- 🎯 **Custom Prompts**: Flexible custom prompt generation
- ⚡ **Artisan Commands**: CLI interface for easy usage
- 🔧 **Configurable**: Easy configuration via environment variables
- 📝 **Comprehensive Logging**: Detailed error handling and logging
- 🚀 **Laravel Native**: Built with Laravel best practices

## 🚀 Quick Start

### Installation
```
bash
composer require your-vendor/laravel-ollama-insights
```
### Publish Configuration
```
bash
php artisan vendor:publish --provider="YourVendor\\OllamaInsights\\OllamaInsightsServiceProvider" --tag="config"
```
### Environment Setup

Add to your `.env` file:
```
env
OLLAMA_BASE_URL=http://localhost:11434
OLLAMA_MODEL=llama2
OLLAMA_TIMEOUT=30
```
## 📖 Usage

### Basic Facade Usage
```
php
use YourVendor\OllamaInsights\Facades\OllamaInsights;

$salesData = [
'q1' => 15000,
'q2' => 18000,
'q3' => 21000,
'q4' => 19000
];

$insight = OllamaInsights::generateInsight('data_analysis', $salesData);
```
### Artisan Commands
```
bash
# Generate sales trend analysis
php artisan ollama:insight trend_analysis --data='{"sales":[100,150,200,250,300]}'

# Use specific model
php artisan ollama:insight prediction --data='{"growth":[5,8,12,15]}' --model=llama2

# From JSON file
php artisan ollama:insight summary --file=storage/data/user_activity.json
```
## 🎯 Available Templates

| Template | Description | Example Use Case |
|----------|-------------|------------------|
| `data_analysis` | Analyze datasets and provide key insights | Sales data analysis |
| `trend_analysis` | Identify patterns and trends | User growth patterns |
| `prediction` | Predict future outcomes | Revenue forecasting |
| `summary` | Create concise summaries | Report summarization |

## ⚙️ Configuration

The package configuration (`config/ollama-insights.php`) includes:
```
php
return [
'base_url' => env('OLLAMA_BASE_URL', 'http://localhost:11434'),
'model' => env('OLLAMA_MODEL', 'llama2'),
'timeout' => env('OLLAMA_TIMEOUT', 30),
'templates' => [
'data_analysis' => 'Analyze this dataset and provide key insights: {data}',
'trend_analysis' => 'Identify trends and patterns in this data: {data}',
'prediction' => 'Based on this data, predict future outcomes: {data}',
'summary' => 'Summarize this information concisely: {data}',
// Add your custom templates here
],
];
```
## 🔧 API Methods

### Generate Completion
```
php
OllamaInsights::generateCompletion(string $prompt, ?string $model = null): ?string
```
### Generate Insight
```
php
OllamaInsights::generateInsight(string $templateKey, array $data, ?string $model = null): ?string
```
### List Models
```
php
OllamaInsights::listModels(): array

## 📋 Prerequisites

1. **Ollama Installation**:
   ```bash
   # Install Ollama (see https://ollama.ai)
   curl -fsSL https://ollama.ai/install.sh | sh
   ```

2. **Download Models**:
   ```bash
   ollama pull llama2
   ollama pull mistral
   # Add other models as needed
   ```

3. **Start Ollama**:
   ```bash
   ollama serve
   ```

## 🛠️ Advanced Usage

### Custom Templates

Add custom templates in your configuration:
```
php
'templates' => [
    'sentiment_analysis' => 'Analyze sentiment in this text: {data}',
    'code_review' => 'Review this code for improvements: {data}',
    'content_generation' => 'Generate content based on: {data}',
],
```
### Custom Prompt Generation
```
php
$customPrompt = "Analyze this e-commerce data and suggest marketing strategies: ";
$data = json_encode($ecommerceData);

$response = OllamaInsights::generateCompletion($customPrompt . $data, 'mistral');
```
## 🐛 Troubleshooting

### Common Issues

1. **Connection Issues**:
   ```bash
   # Verify Ollama is running
   curl http://localhost:11434/api/tags
   ```

2. **Model Not Found**:
   ```bash
   # List available models
   ollama list
   
   # Pull missing model
   ollama pull model-name
   ```

3. **Timeout Errors**: Increase timeout in configuration

### Debug Mode

Check Laravel logs for detailed error information:
```
bash
tail -f storage/logs/laravel.log
```
## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🆘 Support

- **Documentation**: [Ollama Documentation](https://ollama.ai)
- **Issues**: [GitHub Issues](https://github.com/devcbh/laravel-ollama-insights/issues)
- **Discussions**: [GitHub Discussions](https://github.com/devcbh/laravel-ollama-insights/discussions)

## 🏆 Credits

- [Your Name](https://github.com/devcbh)

## 🔗 Links

- [Ollama Official Website](https://ollama.ai)
- [Laravel Documentation](https://laravel.com/docs)
- [Packagist](https://packagist.org/packages/devcbh/laravel-ollama-insights)

---

**Note**: Ensure Ollama is properly installed and running before using this package. Visit [ollama.ai](https://ollama.ai) for installation instructions.
```

